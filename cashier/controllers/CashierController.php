<?php

namespace cashier\controllers;

use Yii;
use yii\web\Controller;
use cashier\models\Order;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use cashier\models\AddressApi;
use cashier\models\ProductApi;
use cashier\models\InventoryApi;
use cashier\models\CartApi;
use cashier\models\OrderApi;
use cashier\models\RealnameApi;
use cashier\models\IdentityApi;
use cashier\models\DirectOrderApi;
use yii\web\BadRequestHttpException;
use frontend\models\PaymentApi;
use yii\web\HttpException;
use yii\filters\AccessControl;
use yii\web\MethodNotAllowedHttpException;

class CashierController extends Controller {

    public $layout = "main_cashier";

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'user' => 'webPOSUser',
                'rules' => [['allow' => true, 'roles' => ['@']]],
                'except' => ['error'],
                ],
        ];
    }

    public function actions() {
        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ],
            'page' => ['class' => 'yii\web\ViewAction'],
        ];
    }

    public function actionIndex() {

        $addressModel = new AddressApi();
        $addressModel->scenario = 'ajaxwebposcreate';
        
        $nextOrder = false;
        $request = Yii::$app->request;
        $Isnext = $request->get('Isnext');
        if($Isnext){
            $nextOrder = true;
        }
        

        return $this->render('index.php', ['addressModel' => $addressModel, 'Isnext' => $nextOrder]);
    }

    public function actionConfirm() {
        $request = Yii::$app->request;
        $session = Yii::$app->session;


        if ($request->isPost) {

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $productApi = new ProductApi();
            $directOrderApi = new DirectOrderApi();

            $data = $request->post();
            $userId = $data['orderUserId'];
            $addrId = $data['orderAddrId'];

            $calData = ['cartlineList' => [], 'couponIds' => null, 'price' => true, 'promotion' => true, 'shipping' => true, 'tax' => true,
                'address' => ['country_code' => 'CN', 'district_code' => '', 'postcode' => '', 'city_code' => '']];

            //get channel info from sesseion

            $channel = $session->get('channel');
            $channel = json_decode($channel, true);


            //arrange items
            $items = [];
            $items_id = $data['id'];
            $items_name = $data['name'];
            $items_price = $data['price'];
            $items_tax = $data['tax'];
            $items_num = $data['num'];

            $itemsInfo = [];

            for ($i = 0; $i < count($items_id); $i++) {

                //确认页展示用数据
                $item = [];
                $item['id'] = $items_id[$i];
                $item['name'] = $items_name[$i];
                $item['price'] = number_format($items_price[$i], 2);
                $item['tax'] = number_format($items_tax[$i], 2);
                $item['num'] = $items_num[$i];
                array_push($items, $item);

                //生成符合 DirectOrderApi.getDTOInfo 的数据
                $itemsInfo[$items_id[$i]] = $items_num[$i];
            }



            //暂时给一个固定的id
            $calData['cartlineList'] = $directOrderApi->getDTOInfo($itemsInfo, $channel['channelId'], 'cashier')['DTOinfo'];




            if (substr($addrId, 0, 8) == 'tempAddr') {

                $calData['address']['state_code'] = $data['stateCode'];

                //compose an address
                $address = [];
                $address['addressId'] = $data['orderAddrId'];
                $address['userId'] = $data['orderUserId'];
                $address['address'] = $data['address'];
                $address['cityCode'] = $data['cityCode'];
                $address['cityName'] = $data['cityName'];
                $address['districtCode'] = $data['districtCode'];
                $address['districtName'] = $data['districtName'];
                $address['postcode'] = $data['postcode'];
                $address['receiverMobile'] = $data['receiverMobile'];
                $address['receiverName'] = $data['receiverName'];
                $address['receiverPhone'] = $data['receiverPhone'];
                $address['stateCode'] = $data['stateCode'];
                $address['stateName'] = $data['stateName'];
            } else {

                //fetch address
                $addressApi = new AddressApi($userId);

                $data = $addressApi->getList();
                $key = key($data);
                $addrList = $data[$key];

                $address = null;
                foreach ($addrList as $addr) {
                    if ($addr['addressId'] == $addrId) {
                        $address = $addr;
                        break;
                    }
                }


                $calData['address']['state_code'] = $address['stateCode'];
            }




            //calculate price
            $cartApi = new CartApi($userId);

            $priceInfo = $cartApi->priceResultPreprocess($calData);
            
            $itemDetail = $priceInfo['itemDetail'];
            foreach($items as $k=>$v){
                $items[$k]['price'] = isset($itemDetail[$v['id']]['newUnitPrice'])? $itemDetail[$v['id']]['newUnitPrice'] : $itemDetail[$v['id']]['unitPrice'];
                $items[$k]['tax'] = $itemDetail[$v['id']]['itemTax'];
            }

            //检查是否会被拆单
            if (count($priceInfo['orderDetail']) != 1) {
                $arr = [];
                //*** 应该为多少呢？****
                $arr['code'] = 404;
                $arr['message'] = '商品订单中存在2类不同类型商品';
                return $arr;
            }


            $itemDiscount = [];
            foreach ($priceInfo['itemDetail'] as $key => $val) {
                if (!empty($val['itemPromotionDetail'])) {
                    $itemDiscount[$key] = $val['itemPromotionDetail'];
                }
            }

            $key = key($priceInfo['orderDetail']);
            $priceInfo = $priceInfo['orderDetail'][$key];

            $data = ['status' => '200', 'data' => []];

            $data['data']['uid'] = $userId;
            //也会被receipt用作填充items
            $data['data']['items'] = $items;
            $data['data']['address'] = $address;
            $data['data']['itemDiscount'] = $itemDiscount;
            //也会被receipt用作填充priceInfo
            $data['data']['priceInfo'] = $priceInfo;
            return $data;
        }
    }

    public function actionCreateorder() {

        $request = Yii::$app->request;
        $session = Yii::$app->session;

        if ($request->isPost) {

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;


            $directOrderApi = new DirectOrderApi();
            $productApi = new ProductApi();

            $data = $request->post();
            $userId = $data['uid'];
            $addrId = $data['addrid'];


            $orderData = ['buyerId' => $userId, 'cartlineDTOList' => [], 'currency' => 'cny', 'extensionData' => ['limitAmount' => true, 'promotion' => true, 'shipping' => true, 'tax' => true],];

            //get channel info from sesseion
            $channel = $session->get('channel');
            $channel = json_decode($channel, true);

            $orderData['channelType'] = $channel['channelType'];
            $orderData['channelId'] = $channel['channelId'];

            //arrange items
            $items_id = $data['id'];
            $items_num = $data['num'];
            $totalNum = array_sum($items_num);

            //DirectOrderApi.getDTOInfo 的入参
            $itemsInfo = [];

            for ($i = 0; $i < count($items_id); $i++) {
                //生成符合 DirectOrderApi.getDTOInfo 的数据
                $itemsInfo[$items_id[$i]] = $items_num[$i];
            }

            //暂时给一个固定的id
            $orderData['cartlineDTOList'] = $directOrderApi->getDTOInfo($itemsInfo, $channel['channelId'], 'cashier')['DTOinfo'];


            //shipping info
            $orderData['paymentType'] = '1';
            $orderData['shipCountryCode'] = 'CN';
            $orderData['shipCountryName'] = '中国';
            $orderData['shipType'] = '快递';


            if (substr($addrId, 0, 8) == 'tempAddr') {

                $orderData['shipAddress'] = $data['address'];
                $orderData['shipCityCode'] = $data['cityCode'];
                $orderData['shipCityName'] = $data['cityName'];
                $orderData['shipDistrictCode'] = $data['districtCode'];
                $orderData['shipDistrictName'] = $data['districtName'];
                $orderData['shipPostcode'] = $data['postcode'];
                $orderData['shipReceiverMobile'] = $data['receiverMobile'];
                $orderData['shipReceiverName'] = $data['receiverName'];
                $orderData['shipReceiverPhone'] = $data['receiverPhone'];
                $orderData['shipStateCode'] = $data['stateCode'];
                $orderData['shipStateName'] = $data['stateName'];
            } else {

                //fetch address
                $addressApi = new AddressApi($userId);

                $data = $addressApi->getList();
                $key = key($data);
                $addrList = $data[$key];

                $address = null;
                foreach ($addrList as $addr) {
                    if ($addr['addressId'] == $addrId) {
                        $address = $addr;
                        break;
                    }
                }

                $orderData['shipAddress'] = $address['address'];
                $orderData['shipCityCode'] = $address['cityCode'];
                $orderData['shipCityName'] = $address['cityName'];
                $orderData['shipDistrictCode'] = $address['districtCode'];
                $orderData['shipDistrictName'] = $address['districtName'];
                $orderData['shipPostcode'] = $address['postcode'];
                $orderData['shipReceiverMobile'] = $address['receiverMobile'];
                $orderData['shipReceiverName'] = $address['receiverName'];
                $orderData['shipReceiverPhone'] = $address['receiverPhone'];
                $orderData['shipStateCode'] = $address['stateCode'];
                $orderData['shipStateName'] = $address['stateName'];
            }




            $orderApi = new OrderApi($userId);

            $orderData = $orderApi->directSubmitOrder($orderData);
            $key = key($orderData);
            $orderData = $orderData[$key][0];

            $data = [];
            $data['status'] = 200;

            setcookie('orderId', $orderData['orderId'], 0, '/', null, false, false);
            setcookie('buyerId', $orderData['buyerId'], 0, '/', null, false, false);
            setcookie('totalNum', $totalNum, 0, '/', null, false, false);
            setcookie('preAddrid', $addrId, 0, null, false, false);
            return $data;
        }
    }

    public function actionQrcode($url = '', $size = 3) {
        return \dosamigos\qrcode\QrCode::png($url, false, 1, $size);
    }

    public function actionWechat() {
        if (isset($_COOKIE['orderId']) && isset($_COOKIE['buyerId'])) {
            $orderApi = new OrderApi('nobody');
            $isPaied = $orderApi->checkIsPaid($_COOKIE['orderId']);
            $url = Yii::$app->params['cashier']['wechatPayurl'] . '?orderId=' . $_COOKIE['orderId'] . '&buyerId=' . $_COOKIE['buyerId'];
            $qrcode = Url::to(['cashier/qrcode', 'url' => $url, 'size' => 8]);
            return $this->render('pay.php', [
                        'payMethod' => 'wechat',
                        'otherMethod' => 'alipay',
                        'qrcode' => $qrcode,
                        'isPaied' => $isPaied,
            ]);
        } else {
            throw new BadRequestHttpException("无法获得订单信息");
        }
    }

    public function actionAlipay() {
        if (isset($_COOKIE['orderId']) && isset($_COOKIE['buyerId']) && isset($_COOKIE['totalNum'])) {
            $orderApi = new OrderApi('nobody');
            $isPaied = $orderApi->checkIsPaid($_COOKIE['orderId']);
            $qrcode = null;
            if(!$isPaied){
                $paymentModel = new PaymentApi();

                $params = [
                    'orderId' => $_COOKIE['orderId'],
                    'payMethod' => 'AliPayQr',
                    'subject' => 'FTZMALL web pos 支付',
                    'itemSum' => $_COOKIE['totalNum'],
                    'return_url_pay' => "index"
                ];

                $r = $paymentModel->payForOrder($params);
                $key = key($r);
                $r = $r[$key];
                if ($r['format'] === 'html') {
                    $result = $r['data'];
                    $payInfo = explode('^', $result);
                    if ($payInfo[0] != 10000) {
                        throw new BadRequestHttpException($payInfo[1]);
                    } else {
                        $url = $payInfo[1];
                        $qrcode = Url::to(['cashier/qrcode', 'url' => $url, 'size' => 8]);
                    }
                } 
            }
            return $this->render('pay.php', [
                        'payMethod' => 'alipay',
                        'otherMethod' => 'wechat',
                        'qrcode' => $qrcode,
                        'isPaied' => $isPaied,
            ]);
        } else {
            throw new BadRequestHttpException("无法获得订单信息");
        }
    }

    /**
     * 查询用户的收货地址
     * query a user's addr
     */
    public function actionQueryaddr() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $uphone = $request->get('phone');
        $uid = null;

        //检查用户
        //check the user  
        $identityApi = new IdentityApi();

        $data = $identityApi->checkIdentity(['type' => 'mobile', 'identity' => $uphone]);
        $identityData = $data[key($data)];

        if ($identityData['result'] == false) {
            $data = $identityApi->checkIdentity(['type' => 'username', 'identity' => $uphone]);
            $identityData = $data[key($data)];
            if ($identityData['result'] == false) {
                return ['code' => '404', 'message' => '用户未注册'];
            } else {
                $uid = (string) $identityData['userId'];
            }
        } else {
            $uid = (string) $identityData['userId'];
        }

        //获取地址列表
        //get the addr list
        $addressApi = new AddressApi($uid);

        $data = $addressApi->getList();
        $addrList = $data[key($data)];
        //如果存在默认地址，放在数组末尾，因为显示是向前插入的，所以放在数组末尾
        ArrayHelper::multisort($addrList, 'isDefault', SORT_ASC);


        //获取实名信息，无实名显示未认证
        $realnameApi = new RealnameApi($uid);
        $realname = $realnameApi->getById();
        $realname = $realname[key($realname)];
        if ($realname['realName'] == null) {
            $realname = "未认证";
        } else {
            $realname = mb_substr($realname['realName'], 0, 1, 'utf-8');
            $realname = $realname . 'XX';
        }


        $return = [];
        $return['status'] = '200';
        $return['uid'] = $uid;
        $return['uname'] = $realname;
        $return['addrList'] = $addrList;
        return $return;
    }
    public function actionQueryrealname(){
        $request = Yii::$app->request;
        $uid = $request->get('uid');
        $realnameApi = new RealnameApi($uid);
        $realname = $realnameApi->getById();
        $realname = $realname[key($realname)];
        if ($realname['realName'] == null) {
            $realname = "未认证";
        } else {
            $realname = mb_substr($realname['realName'], 0, 1, 'utf-8');
            $realname = $realname . 'XX';
        }
        return $realname;
    }

    /**
     * add a the user's addr
     *
     */
    public function actionAddaddr() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;

        $uid = $request->post()['userid'];
        $params = $request->post()['AddressApi'];

        //add the addr
        $addressApi = new AddressApi($uid);

        $return = $addressApi->createAddress($params);

        $key = key($return);
        $data = $return[$key];


        $data['status'] = '200';
        return $data;
    }

    /**
     * 查询物品信息
     * query the infomation of item
     */
    public function actionIteminfo() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $request = Yii::$app->request;
        $itemId = $request->get('id');


        //查询商品信息
        //query the product info;
        $productApi = new ProductApi();

        $data = $productApi->getProductById($itemId);
        $itemData = $data[key($data)];
        if (strtolower($itemData['type']) != 'item') {
            $error = ['code' => 404, 'message' => '不存在此商品'];
            return $error;
        }


        //查询库存信息
        //query the inventory info;
        $inventoryApi = new InventoryApi();

        $data = $inventoryApi->getInventory([
            'itemPartNumber' => $itemData['partNumber'],
            //'itemPartNumber' => $itemData['partNumber'],
            'itemOrg' => 'ftzmall',
            'shop' => 'ftzmall'
        ]);
        $inventoryData = $data[key($data)];


        $return = [];
        $return['status'] = '200';
        $return['name'] = $itemData['desc']['name'];
        if(!empty($itemData['promotionPriceInfo'])){    //might be fixed
            $return['price'] = $itemData['promotionPriceInfo'][0]['price'];
        }
        else{
            $return['price'] = $itemData['offerPriceInfo'][0]['price'];
        }
        $return['tax'] = round($itemData['tax']['taxRate'] * $return['price'], 2);
        $return['partNumber'] = $itemData['partNumber'];
        $return['minBuyCount'] = $itemData['minBuyCount'];
        $return['maxBuyCount'] = $itemData['maxBuyCount'] == null ? 9999 : $itemData['maxBuyCount'];
        $return['quantityOnhand'] = $inventoryData['quantityOnhand'];
        $return['salesType'] = $itemData['salesType'];
        $return ['memberId'] = $itemData['memberId'];
        return $return;
    }

    public function actionModifyaddr() {

        $request = Yii::$app->request;



        $uid = $request->post()['userid'];
        $addrid = $request->post()['addrid'];
        $params = $request->post()['AddressApi'];

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $addressApi = new AddressApi($uid);

        $data = $addressApi->updateById($addrid, $params);
        $key = key($data);
        $data = $data[$key];

        $data['status'] = '200';

        return $data;
        //return json_encode($data);
    }

    public function actionPaymentstatus() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $request = Yii::$app->request;
        $orderId = $request->get()['orderId'];

        $orderApi = new OrderApi('nobody');
        $isPaied = $orderApi->checkIsPaid($orderId);

        $result = [];
        $result['isPaied'] = $isPaied;

        return $result;
    }

//    public function actionQrtest() {
//
//
////        $qr=[];
////        $ids = ['591','592','800','900','439494421761328952','1648540677817861089','4440492382112688664','551','631','634',
////            '642','648','657','656','565','572','591','592'];
////
////
////        for ($i = 0; $i < 18; $i++)
////        {
////            $url = 'http://m.ftzmall.com/p/'.$ids[$i].'.html';
////            $qr[] = Url::to(['cashier/qrcode', 'url'=>$url,'size' => 6]);
////        }
//        $url = 'https://qr.alipay.com/bax01713ziyjrsqisdhv2090.html';
//        $qr[] = Url::to(['cashier/qrcode', 'url' => $url, 'size' => 6]);
//        return $this->render('qr', ['qr' => $qr]);
//    }

    public function actionError() {
        $exception = Yii::$app->errorHandler->exception;
        $displayName = true;
        if ($exception !== null) {
            if ($exception instanceof MethodNotAllowedHttpException) {
                $displayName = false;
                $returnUrl = Url::to(['cashier/index']);
            } else {
                $returnUrl = $this->goBack();
            }

            return $this->render('error', 
                                ['name' => $exception->statusCode, 
                                    'message'=> $exception->getMessage(),
                                    'returnUrl' => $returnUrl,
                                    'display' => $displayName]);
        }
    }

}
