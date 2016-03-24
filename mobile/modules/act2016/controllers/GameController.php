<?php

namespace mobile\modules\act2016\controllers;

use Yii;
use mobile\modules\act2016\models\AwardConf;
use mobile\modules\act2016\models\GameDraw;
use mobile\modules\act2016\models\GameInvite;
use mobile\modules\act2016\models\GameWechat;
use mobile\modules\act2016\models\GameAddress;
use mobile\modules\act2016\models\ProductApi;
use mobile\modules\act2016\models\Order2Draw;
use mobile\modules\act2016\models\GameItemBuyLog;
use mobile\models\PromotionApi;
use mobile\models\OrderApi;
use common\helpers\Wechatjssdk;
use common\helpers\hongbao\Packet;
use common\helpers\Buylimits;
use yii\web\Controller;
use yii\helpers\Url;

//use common\sdk\jswx\Wechatjssdk;

/**
 * Site controller
 */
class GameController extends Controller {

    //默认抽奖次数
    public $defaultDrawCount = 3;
    //邀请好友次数（用于兑换抽奖次数）
    public $inviteCount = 3;
    //邀请好友抽奖优惠券ID(订单满减21-20)
    public $inviteCouponId = 12;
    //订单兑换抽奖优惠券ID(订单满减6-5)
    public $orderCouponId = 14;
    
    public $layout = 'main';
    public $enableCsrfValidation = false;

    public function __construct(&$app) {
        echo '活动已下线';exit;
    }
    
    /**
     * 初始化抽奖
     * @return boolean
     */
    public function actionInitialize() {
        //获取微信openId
        $callback = 'http://' . $_SERVER['SERVER_NAME'] . '/act2016/game/initialize.html';

        $openId = $this->getWechatopenId($callback);

        $result['open_id'] = $openId;

        //会员ID
        $memberId = Yii::$app->mobileUser->getId();

        $drawModel = new GameDraw();
        //查询用户默认抽奖次数
        $userDefaultDrawCount = $drawModel->getUserDefaultDrawCount($openId);

        //设置用户默认抽奖
        if ($userDefaultDrawCount == 0) {
            $drawModel->setUserDefaultDraw($this->defaultDrawCount, $openId, $memberId);
        }

        //获取用户抽奖次数
        $result['draw_count'] = $drawModel->getUserDrawCount($openId);

        //获取用户获奖信息
        $result['user_draw'] = $drawModel->getUserWinDrawList($openId);

        //获取邀请好友次数
        $inviteModel = new GameInvite();
        $notConvertCount = $inviteModel->getNotConvertCount($openId);
        $result['again_invite'] = $this->inviteCount - ( $notConvertCount % $this->inviteCount );

        //获取参加抽奖奖品列表
        $awardModel = new AwardConf();
        $result['award_list'] = $awardModel->getAwardList();

        //获取用户地址
        $addressModel = new GameAddress();
        $address = $addressModel->getUserAddress($openId, $memberId);

        //未领取实物奖品总数
        if ($address['add_id']) {
            $result['no_receive'] = 0;
        } else {
            $result['no_receive'] = $drawModel->getUserGoodsDrawCount($openId, $memberId);
        }

        return json_encode($result);
    }

    /**
     * 邀请好友
     * @return boolean
     */
    public function actionInvitefriend() {
        //邀请人openid
        if (Yii::$app->request->get('refer_openid')) {
            Yii::$app->session['refer_openid'] = Yii::$app->request->get('refer_openid');
            $referOpenId = Yii::$app->request->get('refer_openid');
        } else {
            $referOpenId = Yii::$app->session['refer_openid'];
        }

        //获取微信openId
        $callback = 'http://' . $_SERVER['SERVER_NAME'] . '/act2016/game/invitefriend.html';
        $openId = $this->getWechatopenId($callback);

        $inviteModel = new GameInvite();

        //添加邀请数据
        if ($openId != $referOpenId) {
            if ($inviteModel->insertInviteData($openId, $referOpenId)) {
                //获取未兑换抽奖的邀请次数
                $notConvertCount = $inviteModel->getNotConvertCount($referOpenId);
                if ($notConvertCount >= $this->inviteCount) {
                    $drawModel = new GameDraw();
                    //设置用户邀请抽奖
                    return $drawModel->setUserInviteDraw($referOpenId);
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 用户抽奖
     * @return string
     */
    public function actionUserdraw() {
        //获取微信openId
        $callback = 'http://' . $_SERVER['SERVER_NAME'] . '/act2016/game/userdraw.html';
        $openId = $this->getWechatopenId($callback);

        //会员ID
        $memberId = Yii::$app->mobileUser->getId();

        $drawModel = new GameDraw();

        //获取一条用户抽奖信息
        $userDraw = $drawModel->getUserDrawOne($openId);
        if ($userDraw) {
            //默认抽奖
            if ($userDraw['draw_type'] == 'default') {
                $result = $this->getDefaultDrawResult($openId, $userDraw);
            }
            //邀请好友抽奖
            elseif ($userDraw['draw_type'] == 'invite') {
                $result = $this->getInviteDrawResult($openId, $userDraw);
            }
            //订单兑换抽奖
            elseif ($userDraw['draw_type'] == 'order') {
                $result = $this->getOrderDrawResult($openId, $userDraw);
            }

            //发放奖品
            if ($result['award_data']) {
                if ($result['award_data']['award_type'] == 1) {
                    //设置微信红包文字描述
                    $userDrawTmp = $drawModel->getUserDrawById($userDraw['draw_id']);

                    $wechatModel = new GameWechat();
                    $wechatPacket = $wechatModel->getWechatById($userDrawTmp['draw_award_id']);

                    $result['award_data']['award_depict'] = str_replace("$$", $wechatPacket['wechat_money'], $result['award_data']['award_depict']);

                    //判断中奖金额
                    if ($wechatPacket['wechat_money'] > 0 && $wechatPacket['wechat_money'] <= 5) {
                        //设置红包金额(单位分)
                        $packetMoney = $wechatPacket['wechat_money'] * 100;

                        //发送红包
                        $packet = new Packet();
                        $re = $packet->_route('wxpacket', array('openid' => $openId, 'money' => $packetMoney));
                        
                        if ( $re->return_code == 'SUCCESS' )
                        {
                        	//成功
                        	$send = 1;
                        }
                        else
                        {
                        	//失败
                        	$send = 0;
                        }
                        
                        $drawModel->updateDrawSend($userDraw['draw_id'], $send);
                    }
                } elseif ($result['award_data']['award_type'] == 2) {
                    //发送优惠券
                    $promotionModel = new PromotionApi($memberId);
                    $rc = $promotionModel->getCouponbyRule($result['award_data']['award_name']);
                } elseif ($result['award_data']['award_type'] == 3) {
                    //发实物奖品
                }
            }
        } else {
            $result['is_winning'] = 'error';
            $result['error_data'] = '不能参加抽奖';
        }

        //获取剩余抽奖次数
        $result['draw_count'] = $drawModel->getUserDrawCount($openId);

        return json_encode($result);
    }

    /**
     * 用户抽奖日志
     * @return string
     */
    public function actionUserdrawlog() {
        //获取微信openId
        $callback = 'http://' . $_SERVER['SERVER_NAME'] . '/act2016/game/userdrawlog.html';
        $openId = $this->getWechatopenId($callback);

        $drawModel = new GameDraw();
        $userDraw = $drawModel->getUserDrawList($openId);
        return json_encode($userDraw);
    }

    /**
     * 获取地址
     * @return string|boolean
     */
    public function actionAddress() {
        $callback = 'http://' . $_SERVER['SERVER_NAME'] . '/act2016/game/getuseraddress.html';
        $openId = $this->getWechatopenId($callback);

        $memberId = Yii::$app->mobileUser->getId();

        if ($openId && $memberId) {
            $addressModel = new GameAddress();
            $address = $addressModel->getUserAddress($openId, $memberId);
            return json_encode($address);
        } else {
            return false;
        }
    }

    /**
     * 设置地址
     * @return boolean
     */
    public function actionAddressup() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $callback = 'http://' . $_SERVER['SERVER_NAME'] . '/act2016/game/getuseraddress.html';
        $data['add_open_id'] = $this->getWechatopenId($callback);

        $data['add_member_id'] = Yii::$app->mobileUser->getId();
        $data['add_name'] = Yii::$app->request->post('add_name');
        $data['add_phone'] = Yii::$app->request->post('add_phone');
        $data['add_address'] = Yii::$app->request->post('add_address');

        $addressModel = new GameAddress();
        if ($addressModel->setUserAddress($data)) {
            return ['msg' => '成功领取'];
        } else {
            return ['msg' => '领取失败'];
        }
    }

    /**
     * 获取默认抽奖结果
     * @param unknown_type $openId
     * @param unknown_type $userDraw
     * @return string
     */
    private function getDefaultDrawResult($openId, $userDraw) {
        $drawModel = new GameDraw();

        //获取用户默认抽奖的中奖次数
        $winCount = $drawModel->getUserIsWinDefaultDrawCount($openId, '1');
        //获取用户默认抽奖的未中奖次数
        $noWinCount = $drawModel->getUserIsWinDefaultDrawCount($openId, '0');

        //判断之前是否中奖
        if ($winCount != 1) {
            //设置中奖信息
            $award = $this->getRandAward();
            if (!$award) {
                $result['is_winning'] = 'error';
                $result['error_data'] = '奖品已抽完';
                return $result;
            }

            //判断是否为默认抽奖的最后一次
            if ($noWinCount < 2) {
                //抽奖
                $rand = array(0 => 50, 1 => 50);
                $isWin = $this->getRand($rand);
                if ($isWin == 1) {
                    //更新抽奖信息
                    if ($drawModel->updateUserDraw($userDraw['draw_id'], $openId, 1, $award)) {
                        $result['is_winning'] = 1;
                        $result['award_data'] = $award;
                    } else {
                        $result['is_winning'] = 'error';
                        $result['error_data'] = '抽奖发生错误，请重新抽奖';
                    }
                } else {
                    if ($drawModel->updateUserDraw($userDraw['draw_id'], $openId, 0)) {
                        $result['is_winning'] = 0;
                        $result['award_data'] = array();
                    } else {
                        $result['is_winning'] = 'error';
                        $result['error_data'] = '抽奖发生错误，请重新抽奖';
                    }
                }
            } else {
                if ($drawModel->updateUserDraw($userDraw['draw_id'], $openId, 1, $award)) {
                    $result['is_winning'] = 1;
                    $result['award_data'] = $award;
                } else {
                    $result['is_winning'] = 'error';
                    $result['error_data'] = '抽奖发生错误，请重新抽奖';
                }
            }
        } else {
            if ($drawModel->updateUserDraw($userDraw['draw_id'], $openId, 0)) {
                $result['is_winning'] = 0;
                $result['award_data'] = array();
            } else {
                $result['is_winning'] = 'error';
                $result['error_data'] = '抽奖发生错误，请重新抽奖';
            }
        }

        return $result;
    }

    /**
     * 获取邀请抽奖结果
     * @param unknown_type $openId
     * @param unknown_type $userDraw
     * @return number
     */
    private function getInviteDrawResult($openId, $userDraw) {
        $awardModel = new AwardConf();
        $awardTmp = $awardModel->getAwardById($this->inviteCouponId);

        $award['award_id'] = $awardTmp['award_id'];
        $award['award_type'] = $awardTmp['award_type'];
        $award['award_name'] = $awardTmp['award_name'];
        $award['award_bn'] = $awardTmp['award_bn'];
        $award['award_pic_url_s'] = $awardTmp['award_pic_url_s'];
        $award['award_pic_url_m'] = $awardTmp['award_pic_url_m'];
        $award['award_pic_url_b'] = $awardTmp['award_pic_url_b'];

        $drawModel = new GameDraw();
        if ($drawModel->updateUserDraw($userDraw['draw_id'], $openId, 1, $award)) {
            $result['is_winning'] = 1;
            $result['award_data'] = $award;
        } else {
            $result['is_winning'] = 'error';
            $result['error_data'] = '抽奖发生错误，请重新抽奖';
        }

        return $result;
    }

    /**
     * 获取订单抽奖结果
     * @param unknown_type $openId
     * @param unknown_type $userDraw
     * @return number
     */
    private function getOrderDrawResult($openId, $userDraw) {
        $rand = array(0 => 100 - $userDraw['draw_rate'], 1 => $userDraw['draw_rate']);
        $isWin = $this->getRand($rand);

        if ($isWin == 1) {
            //设置中奖信息
            //$award = $this->getRandAward();
            $awardModel = new AwardConf();
            $awardTmp = $awardModel->getAwardById($this->orderCouponId);

            $award['award_id'] = $awardTmp['award_id'];
            $award['award_type'] = $awardTmp['award_type'];
            $award['award_name'] = $awardTmp['award_name'];
            $award['award_bn'] = $awardTmp['award_bn'];
            $award['award_pic_url_s'] = $awardTmp['award_pic_url_s'];
            $award['award_pic_url_m'] = $awardTmp['award_pic_url_m'];
            $award['award_pic_url_b'] = $awardTmp['award_pic_url_b'];

            $drawModel = new GameDraw();
            if ($drawModel->updateUserDraw($userDraw['draw_id'], $openId, 1, $award)) {
                $result['is_winning'] = 1;
                $result['award_data'] = $award;
            } else {
                $result['is_winning'] = 'error';
                $result['error_data'] = '抽奖发生错误，请重新抽奖';
            }
        } else {
            $result['is_winning'] = 0;
            $result['award_data'] = array();
        }

        return $result;
    }

    /**
     * 获取微信open_id
     * @param unknown_type $callback
     * @return unknown
     */
    public function getWechatopenId($callback) {
        if ('dev' === YII_ENV) {
            return '111';
        }
        if (Yii::$app->request->get('type') != 'test') {
            if (!Yii::$app->session['wechat_openId']) {
                $openId = $this->actionGetopenid($callback);
            } else {
                $openId = Yii::$app->session['wechat_openId'];
            }
        } else {
            Yii::$app->session['wechat_openId'] = 'test_open_id_' . $_SERVER['SERVER_NAME'];
            $openId = Yii::$app->session['wechat_openId'];
        }
        return $openId;
    }

    public function actionGetopenid($callback) {
        if (!Yii::$app->request->get('code')) {
            //触发微信返回code码
            Yii::$app->session['callback'] = $callback;
            $redirectUri = urlencode($callback);
            $url = $this->__CreateOauthUrlForCode($redirectUri);
            Header("Location: $url");
            exit();
        } else {
            //获取code码，以获取openid
            $code = Yii::$app->request->get('code');
            $openid = $this->getOpenidFromMp($code);
            Yii::$app->session['wechat_openId'] = $openid;
            $callback = Yii::$app->session['callback'];
            header("location: {$callback}");
            exit;
        }
    }

    private function __CreateOauthUrlForCode($redirectUrl) {
        $urlObj["appid"] = Yii::$app->params['pay']['wx']['APPID'];
        $urlObj["redirect_uri"] = "$redirectUrl";
        $urlObj["response_type"] = "code";
        $urlObj["scope"] = "snsapi_base";
        $urlObj["state"] = "STATE" . "#wechat_redirect";
        $bizString = $this->ToUrlParams($urlObj);
        return "https://open.weixin.qq.com/connect/oauth2/authorize?" . $bizString;
    }

    private function __CreateOauthUrlForOpenid($code) {
        $urlObj["appid"] = Yii::$app->params['pay']['wx']['APPID'];
        $urlObj["secret"] = Yii::$app->params['pay']['wx']['APPSECRET'];
        $urlObj["code"] = $code;
        $urlObj["grant_type"] = "authorization_code";
        $bizString = $this->ToUrlParams($urlObj);
        return "https://api.weixin.qq.com/sns/oauth2/access_token?" . $bizString;
    }

    private function getOpenidFromMp($code) {
        $url = $this->__CreateOauthUrlForOpenid($code);
        //初始化curl
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        //运行curl，结果以jason形式返回
        $res = curl_exec($ch);
        curl_close($ch);
        //取出openid
        $data = json_decode($res, true);
        $openid = isset($data['openid']) ? $data['openid'] : '';
        return $openid;
    }

    private function ToUrlParams($urlObj) {
        $buff = "";
        foreach ($urlObj as $k => $v) {
            if ($k != "sign") {
                $buff .= $k . "=" . $v . "&";
            }
        }
        $buff = trim($buff, "&");
        return $buff;
    }

    /**
     * 概率算法
     * @param unknown_type $proArr
     * @return Ambigous <string, unknown>
     */
    private function getRand($proArr) {
        $result = '';
        //概率数组的总概率精度
        $proSum = array_sum($proArr);
        //概率数组循环
        foreach ($proArr as $key => $proCur) {
            //抽取随机数
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $proCur) {
                //得出结果
                $result = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
        }
        unset($proArr);
        return $result;
    }

    /**
     * 随机获取奖品
     * @return unknown
     */
    private function getRandAward() {
        $awardModel = new AwardConf();
        $awardListTmp = $awardModel->getAwardList();

        if ($awardListTmp) {
            foreach ($awardListTmp as $key => $value) {
                $awardList[$value['award_id']]['award_id'] = $value['award_id'];
                $awardList[$value['award_id']]['award_type'] = $value['award_type'];
                $awardList[$value['award_id']]['award_name'] = $value['award_name'];
                $awardList[$value['award_id']]['award_bn'] = $value['award_bn'];
                $awardList[$value['award_id']]['award_pic_url_s'] = $value['award_pic_url_s'];
                $awardList[$value['award_id']]['award_pic_url_m'] = $value['award_pic_url_m'];
                $awardList[$value['award_id']]['award_pic_url_b'] = $value['award_pic_url_b'];
                $awardList[$value['award_id']]['award_depict'] = $value['award_depict'];

                $rand[$value['award_id']] = $value['award_rate'];
            }

            $awardId = $this->getRand($rand);
            return $awardList[$awardId];
        } else {
            return array();
        }
    }

    /* 初始化抽奖
     * @return boolean
     */

    public function actionIndex() {

        $referOpenId = empty($_GET['open_id']) ? '' : $_GET['open_id'];
        Yii::$app->session['referOpenId'] = $referOpenId;
        Url::remember();
       
        
        $callback = 'http://' . $_SERVER['SERVER_NAME'] . '/act2016/game/index.html?open_id='.Yii::$app->session['referOpenId'];
        $openId = $this->getWechatopenId($callback);
        $userId = Yii::$app->mobileUser->getId();

//                            $appid = 'wx77be89a71184009b';
//                            $appSecret = '12cf3d2cbd1ba9696bde81a724c95376';


        $appid = Yii::$app->params['pay']['wx']['APPID'];
        $appSecret = Yii::$app->params['pay']['wx']['APPSECRET'];
        $weixin = new Wechatjssdk($appid, $appSecret);
//                            $jsapi_ticket = $weixin->getJsApiTicket();
        //获取微信js sdk 参数
        $jssdk = $weixin->getSignPackage();


//                            $timestamp = time();
//                    $noncestr = 'Wm3WZYTPz0wzccnW';
//                    $url = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
//                    var_dump($url);exit;
//                     $str1 = "jsapi_ticket={$jsapi_ticket}&noncestr={$noncestr}&timestamp={$timestamp}&url={$url}";       
//                            $bind_id = 1;
//                        $weixin = kernel::single('weixin_wechat');
//                        $jsapi_ticket = $weixin->get_jsapi_ticket($bind_id);
//                        $timestamp = time();
//                        $noncestr = 'Wm3WZYTPz0wzccnW';
//                        $url = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
//                        $str1 = "jsapi_ticket={$jsapi_ticket}&noncestr={$noncestr}&timestamp={$timestamp}&url={$url}";
//                        $this->pagedata['appId'] = 'wx77be89a71184009b';
//                        $this->pagedata['jsapi_ticket'] = $jsapi_ticket;
//                        $this->pagedata['nonceStr'] = $noncestr;
//                        $this->pagedata['timestamp'] = $timestamp;
//                        $this->pagedata['url'] = $url;
//                        $this->pagedata['signature'] = sha1($str1);
//                    
        $data = [
            'referOpenId' => $referOpenId,
            'openId' => $openId,
            'userId' => $userId,
            'surl' => 'http://' . $_SERVER['SERVER_NAME'] . '/act2016/game/index.html',
        ];
        $data = array_merge($jssdk, $data);
        //获取微信openId
        $this->layout = "empty";
        return $this->render('index', $data);
    }

    /**
     * 订单号兑换抽奖机会
     */
    public function actionOrder() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $orderId = Yii::$app->request->get('orderId'); //订单号

        $userId = Yii::$app->mobileUser->getId();

        $orderModel = new OrderApi($userId);
//        $paymentModel = new PaymentApi($userId);

        $model_gamedraw = new GameDraw();
        $data = $orderModel->getOrderDetail($orderId); //获取订单信息
//        echo date('Y-m-d H:i:s' , $data['order']['createTimestamp']/1000),$data['order']['createTimestamp'];exit;
        if (!$this->_isVaildOrder($data)) {
            return ['msg' => '订单号不存在或未支付', 'draw_count' => $model_gamedraw->getUserDrawCount(Yii::$app->session['wechat_openId'])];
        }



//        my_dump($data);exit;
//        $paymentInfo = $paymentModel->getPaymentDetails($orderId);
//        if(!empty($data['order']['adjustmentAmount'])){
//            $adjustmentAmount = $data['order']['adjustmentAmount'];
//        }else if(!empty($data['order']['orderAdjustmentList'])){
//            foreach ($data['order']['orderAdjustmentList'] as $val){
//                $adjustmentAmount += abs($val['amount']);
//            }
//        }
        //检查无误，将抽奖次数写入抽奖表
        $count = Order2Draw::find()->andWhere(['order_id' => $data['order']['orderId']])->count('*');
        if ($count) {
            return ['msg' => '该订单号已使用', 'draw_count' => $model_gamedraw->getUserDrawCount(Yii::$app->session['wechat_openId'])];
        }

        $model_order2draw = new Order2Draw();
        $model_order2draw->order_id = $orderId;
        $model_order2draw->member_id = $userId;
        $model_order2draw->insert_time = date('Y-m-d H:i:s');
        try {
            $model_order2draw->insert() && $model_gamedraw->setUserOrderDraw($userId);
            return ['msg' => '成功领取', 'draw_count' => $model_gamedraw->getUserDrawCount(Yii::$app->session['wechat_openId'])];
        } catch (Exception $ex) {
            return ['msg' => '错误', 'draw_count' => $model_gamedraw->getUserDrawCount(Yii::$app->session['wechat_openId'])];
        }
    }

    public function actionTest() {
    	$openId = 'o9qHRsgET2pbJYftKGnryMXqA8S8';
    	$packetMoney = 101;
    	$packet = new Packet();
    	$re = $packet->_route('wxpacket', array('openid' => $openId, 'money' => $packetMoney));
    	
    	print_r($re);
    }

    private function _isVaildOrder($data) {
        if (empty($data)) {
            return false;
        }
        if (empty($data['order']['orderStatus'])) {
            return false;
        }
        $userId = Yii::$app->mobileUser->getId();
        if (intval($data['order']['buyerId']) !== $userId) {
            return false;
        }
        if (!($data['order']['orderStatus'] === 'PAID' || $data['order']['orderStatus'] === 'SCHEDULED' || $data['order']['orderStatus'] === 'RELEASED' || $data['order']['orderStatus'] === 'INCLUDED_IN_SHIPPMENT' || $data['order']['orderStatus'] === 'SHIPPED')) {
            return false;
        }

        //生产环境使用12-05-12-13
        $begin = strtotime('2015-12-05 00:00:00') * 1000;
        $end = strtotime('2015-12-13 23:59:59') * 1000;
        if ('dev' === YII_ENV) { //测试环境使用 11月27日
            $begin = strtotime('2015-11-27 00:00:00') * 1000;
            $end = strtotime('2015-11-27 23:59:59') * 1000;
        }

        if ($data['order']['createTimestamp'] < $begin || $data['order']['createTimestamp'] > $end) {
            return false;
        }

        return true;
    }
}
