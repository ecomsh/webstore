<?php

namespace mobile\controllers;

use Yii;
use mobile\models\AddressApi;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\StatisticClient;
use mobile\models\OrderApi;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * Site controller
 */
class AddressController extends Controller {

    //创建一条记录
    const CREATE = 'create';
    //更新一条记录
    const UPDATE = 'update';
    //获取所有列表
    const INDEX = 'index';

    public $layout = 'mainnew';

    public function behaviors() {
        return [
            'access' => Yii::$app->params['pageAccess']['address']
        ];
    }

    /**
     * 昨晚邮件里给了你一批新的测试id 

      3:25:59 AM: 6471120861615882072
      2888760349360512009
      1071972004169623239
      6296070117947500081
      4692625984968512990
      6828204151415112094
      9158401335075261813
      6482436603782325490
      8582210074373543566
     * @param type $id
     * @return type
     * @throws BadRequestHttpException
     * 
     */
    public function actionIndex($id = 0) {
        //现阶段用户模块并没有完成，但是将来用下面的方法获取用户id
        //Yii::$app->mobileUser->getId() = 'e468a389-19c1-11e5-bba0-00ffaa3562cc';
        $userId = Yii::$app->mobileUser->getId();

        //初始化api
        $model = new AddressApi($userId);


        //预定义当前场景状态  
        $model->scenario = self::INDEX;
        //判断当前model中的记录是否是全新记录，一般情况下，url中有id就代表旧的数据     
//TODO::防止重复提交 
//        if(isset($postData['_csrf'])&&Yii::$app->getRequest()->validateCsrfToken($postData['_csrf'])){
//             var_dump($postData['_csrf'],Yii::$app->getRequest()->getCsrfToken());exit;
//             //异常情况处理，记录错误日志，抛出异常
//            Yii::error('操作过于频繁，请稍后...');
//            throw new BadRequestHttpException('操作过于频繁，请稍后...');
//        }
        $this->_setErrors($model);
        $data = $model->getList();
        $key = key($data);
        $data = isset($data[$key]) ? $data[$key] : [];
        $editData = [];
        return $this->render('index', [
                    'model' => $model,
                    'data' => $data,
        ]);
    }

    /**
     * TODO list
     * @return type
     */
    public function actionCreate($id = 0) {
        //$model->scenario = self::UPDATE;
        //$model->scenario = self::CREATE;
        $userId = Yii::$app->mobileUser->getId();
        //  var_dump($_SESSION);
        //初始化api
        $model = new AddressApi($userId);
        //预定义当前场景状态  
        if ($id)
            $model->isNewRecord = false;
        else
            $model->isNewRecord = true;

        $postData = Yii::$app->request->post();

        if ($postData && $id) {
            $model->scenario = self::UPDATE;
        } else {
            $model->scenario = self::CREATE;
        }

//TODO::防止重复提交 
//        if(isset($postData['_csrf'])&&Yii::$app->getRequest()->validateCsrfToken($postData['_csrf'])){
//             var_dump($postData['_csrf'],Yii::$app->getRequest()->getCsrfToken());exit;
//             //异常情况处理，记录错误日志，抛出异常
//            Yii::error('操作过于频繁，请稍后...');
//            throw new BadRequestHttpException('操作过于频繁，请稍后...');
//        }
        /* add by cq */
        if ($model->load($postData) && $model->validate()) {

            if ($model->scenario == self::CREATE) {
                $info = $model->createAddress($postData['AddressApi']);
            } else if ($model->scenario == self::UPDATE) {
                $tmp = $this->_isMyAddressId($id, $userId, $model);

                if ($tmp)
                    $info = $model->updateById($id, $postData['AddressApi']);
                else {
                    //异常情况处理，记录错误日志，抛出异常
                    Yii::error('您没有该权限');
                    throw new BadRequestHttpException('您没有该权限');
                }
            }


            if ($info && is_array($info)) {
                Yii::$app->session->setFlash('success', '操作成功');
                if (!empty($postData['returnUrl'])) {
                    return $this->redirect($postData['returnUrl']);
                } else {
                    return $this->redirect(['address/index']);
                }
            } else {
                //用户操作错误处理，将错误放置于错误flash中，同时记录log日志
                Yii::$app->session->setFlash('error', '系统异常，请稍后重试');
                Yii::error($model->scenario . '地址薄的时候，系统异常，请稍后重试');
            }
            Yii::info('post');
            if (!empty($postData['returnUrl'])) {
                return $this->redirect($postData['returnUrl']);
            } else {
                return $this->redirect(['address/index']);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function actionCompleteaddress($userId = 0, $orderId = '') {
        $session = Yii::$app->session;

        $whencertify = $session->get('whencertify');
        if (empty($whencertify)) {
            return $this->redirect(['realname/certify']);
        }

        //初始化api
        $model = new AddressApi($userId);
        //预定义当前场景状态  
        $model->scenario = self::INDEX;
        $this->_setErrors($model);
        $data = $model->getList();
        $addrlist = $data[key($data)];
        $addrnum = count($addrlist);
        $orderApi = new OrderApi();
        $orderinfor = $orderApi->getOrderDetail($orderId);
        $orderInfo = $orderinfor[key($orderinfor)];

        $model->stateName = $orderInfo['shippingStateName'];
        $model->stateCode = $orderInfo['shippingStateCode'];
        $session->set('stateCode', $orderInfo['shippingStateCode']);
        $model->cityName = $orderInfo['shippingCityName'];
        $session->set('cityCode', $orderInfo['shippingCityCode']);
        $model->cityCode = $orderInfo['shippingCityCode'];
        $model->districtName = $orderInfo['shippingDistrictName'];
        $model->districtCode = $orderInfo['shippingDistrictCode'];
        $session->set('districtCode', $orderInfo['shippingDistrictCode']);

        $model->receiverName = $orderInfo['shippingReceiverName'];
        $model->address = $orderInfo['shippingAddress'];
        $model->receiverMobile = $orderInfo['shippingReceiverMobile'];
        $model->postcode = $orderInfo['shippingPostcode'];
        $commonAddr = $this->getSameDisAddrList($orderInfo['shippingDistrictCode'], $addrlist);

        $alertEnable = false; //用来控制页面上还有订单地址未补全的弹窗显示
        //已经补全地址
        if (isset($model->address) && strlen($model->address) > 8) {
            //查询有没有其他需要补全地址的订单，有的话弹出弹窗，没有，render感谢提醒页面
            $orderApi = new OrderApi($userId);
            $noAddrList = $orderApi->getnoAddrOrderList();
            $noAddrList = $noAddrList[key($noAddrList)];
            $orderIds = ArrayHelper::getColumn($noAddrList, 'orderId');
            if (!empty($orderIds)) {
                $alertEnable = true;
                return $this->render('completeaddress', [
                            'model' => $model,
                            'orderInfo' => $orderInfo,
                            'commonAddr' => $commonAddr,
                            'alertEnable' => $alertEnable,
                            'nextOrderId' => $orderIds[0], //取第一个订单号当做下一个需要补全地址的订单
                ]);
            }
            $whencertify = $session->get('whencertify');
            if ($whencertify == 'thistime') {//上一步做了实名认证，这一步不需要做添加不全地址
                return $this->render('thanks', ['updateInfo' => '亲，已经实名认证成功，谢谢您的支持！ 我们第一时间为您发货~ ']);
            } else { //以前认证的用户，再次进来认定是补全地址
                return $this->render('thanks', ['updateInfo' => '亲， 订单地址已经更新成功，谢谢您的支持！ 我们第一时间为您发货~ 您的地址是' . $model->address . ' 已经被补全。处于安全考虑，订单地址不能被多次修改哦！']);
            }
        }


        if (Yii::$app->request->isGet) {
            return $this->render('completeaddress', [
                        'model' => $model,
                        'orderInfo' => $orderInfo,
                        'commonAddr' => $commonAddr,
                        'alertEnable' => $alertEnable,
                        'nextOrderId' => null,
            ]);
        }

        $postData = Yii::$app->request->post();

        if ($postData) {
            $model->scenario = self::CREATE;
        }

        /* add by cq */
        if ($model->load($postData) && $model->validate()) {
            if ($model->scenario == self::CREATE) {
                //添加到地址库

                $params['address'] = $postData['AddressApi']['address'];
                $params['receiverName'] = $postData['AddressApi']['receiverName'];
                $params['receiverMobile'] = $postData['AddressApi']['receiverMobile'];
                $params['receiverPhone'] = $postData['AddressApi']['receiverPhone'];
                // $params['countryCode'] =  $postData['AddressApi']['countryCode'];
                // $params['countryName'] =  $postData['AddressApi']['countryName'];
                $params['cityName'] = $postData['AddressApi']['cityName'];
                $params['cityCode'] = $session->get('cityCode');
                $params['stateName'] = $postData['AddressApi']['stateName'];
                $params['stateCode'] = $session->get('stateCode');
                $params['postcode'] = $postData['AddressApi']['postcode'];
                $params['districtName'] = $postData['AddressApi']['districtName'];
                $params['districtCode'] = $session->get('districtCode');

                $result = $orderApi->updateShippingByOrderid($orderId, $params);
                $key = key($result);
                $result = $result[$key];

                if (isset($result)) {
                    //判断是不是需要保存地址
                    if ($postData['AddressApi']['isSave'] || $postData['AddressApi']['isDefault']) { 
                        //只在地址数量小于10的时候添加
                        if($addrnum < 10){
                            unset($postData['AddressApi']['isSave']);
                            if (!$postData['AddressApi']['isDefault']) {
                                $postData['AddressApi']['isDefault'] = false;
                            } else {
                                $postData['AddressApi']['isDefault'] = true;
                            }
                            $postData['AddressApi']['cityCode'] = $session->get('cityCode');
                            $postData['AddressApi']['stateCode'] = $session->get('stateCode');
                            $postData['AddressApi']['districtCode'] = $session->get('districtCode');
                            $info = $model->createAddress($postData['AddressApi']);
                            $fullAddrList = false;
                        }
                        else{
                            $fullAddrList = true;
                        }
                    }
                    //判断还有没有未补全地址的订单，如果有的话，让页面弹出是否继续补全地址的弹窗。
                    $noAddrList = $orderApi->getnoAddrOrderList($userId);
//                    var_dump($noAddrList);
                    $noAddrList = $noAddrList[key($noAddrList)];
                    $orderIds = null;
                    if(!empty($noAddrList)){
                        $orderIds = ArrayHelper::getColumn($noAddrList, 'orderId');
                    }
//                    var_dump($orderIds);exit();
                    if (!empty($orderIds)) {
                        $alertEnable = true;
                        return $this->render('completeaddress', [
                                    'model' => $model,
                                    'orderInfo' => $orderInfo,
                                    'commonAddr' => $commonAddr,
                                    'alertEnable' => $alertEnable,
                                    'nextOrderId' => $orderIds[0], //取第一个订单号当做下一个需要补全地址的订单
                                    'fullAddrList'=> $fullAddrList,
                        ]);
                    }
                    $session->set('whencertify', 'before'); //只要走到了这里，就是做了添加地址操作，我们认定实名认证是以前的做的了。
                    //只有是post方式，且保存地址的checkbox被勾选的时候才会创建地址，$fullAddrList代表地址列表是否满
                    if(isset($fullAddrList) && $fullAddrList){
                        $updateinfo = '亲， 订单地址已经更新成功，但地址列表已满，未保存至常用地址。我们第一时间为您发货，谢谢您的支持！';
                    }
                    else{
                        $updateinfo = '亲， 订单地址已经更新成功，谢谢您的支持！ 我们第一时间为您发货~';
                    }
                    return $this->render('thanks', ['updateInfo' => $updateinfo]);
                }
            }
        } else {
            return $this->render();
        }
    }

    public function actionUpdate($id = 0) {
        $userId = Yii::$app->mobileUser->getId();
        //初始化api
        $model = new AddressApi($userId);
        //预定义当前场景状态  
        if ($id)
            $model->isNewRecord = false;
        else
            $model->isNewRecord = true;

        $postData = Yii::$app->request->post();

        if ($postData && $id) {
            $model->scenario = self::UPDATE;
        } else {
            $model->scenario = self::CREATE;
        }

//TODO::防止重复提交 
//        if(isset($postData['_csrf'])&&Yii::$app->getRequest()->validateCsrfToken($postData['_csrf'])){
//             var_dump($postData['_csrf'],Yii::$app->getRequest()->getCsrfToken());exit;
//             //异常情况处理，记录错误日志，抛出异常
//            Yii::error('操作过于频繁，请稍后...');
//            throw new BadRequestHttpException('操作过于频繁，请稍后...');
//        }
        /* add by cq */
        if ($model->load($postData) && $model->validate()) {
            if ($model->scenario == self::CREATE) {
                $info = $model->createAddress($postData['AddressApi']);
            } else if ($model->scenario == self::UPDATE) {
                $tmp = $this->_isMyAddressId($id, $userId, $model);

                if ($tmp)
                    $info = $model->updateById($id, $postData['AddressApi']);
                else {
                    //异常情况处理，记录错误日志，抛出异常
                    Yii::error('您没有该权限');
                    throw new BadRequestHttpException('您没有该权限');
                }
            }


            if ($info && is_array($info)) {
                Yii::$app->session->setFlash('success', '操作成功');

                if (!empty($postData['returnUrl'])) {
                    return $this->redirect($postData['returnUrl']);
                } else {
                    return $this->redirect(['address/index']);
                }
            } else {
                //用户操作错误处理，将错误放置于错误flash中，同时记录log日志
                Yii::$app->session->setFlash('error', '系统异常，请稍后重试');
                Yii::error($model->scenario . '地址薄的时候，系统异常，请稍后重试');
            }
            Yii::info('post');
            if (!empty($postData['returnUrl'])) {
                return $this->redirect($postData['returnUrl']);
            } else {
                return $this->redirect(['address/index']);
            }
        } else {
            $this->_setErrors($model);
            $data = $model->getList();
            $key = key($data);
            $data = isset($data[$key]) ? $data[$key] : [];
            $editData = [];
            if ($id) {
                if (!$this->_getAddressById($id, $data, $model)) {
                    $model->isNewRecord = true;
                } else {
                    $model->isNewRecord = false;
                }
            }

            return $this->render('create', [
                        'model' => $model,
                        'data' => $data
            ]);
        }
    }

    public function actionAjaxcreate() {
        $userId = Yii::$app->mobileUser->getId();
        $postData = Yii::$app->request->post();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        //初始化api
        $model = new AddressApi($userId);

        $model->scenario = 'ajaxcreate';
        if (Yii::$app->request->isAjax && $model->load($postData, 'AddressApi')) {

            $d = \yii\widgets\ActiveForm::validate($model);

            if ($d) {
                //因用户体验，此处只返回第一个错误
                $key = key($d);
                return ['status' => false, 'message' => $d[$key][0]];
            } else {
                $info = $model->createAddress($postData['AddressApi']);
                if ($info && is_array($info)) {
                    if (isset($info['errorCode'])) {
                        return ['status' => false, 'message' => $info['errorMsg']];
                    }
                    return ['status' => true, 'info' => $info['address']];
                } else {
                    Yii::error($model->scenario . '地址薄的时候，系统异常，请稍后重试');
                    return ['status' => false, 'message' => '系统异常，请稍后重试'];
                }
            }
        }
    }

    /**
     * 此处处理较为特殊，因为接口返回的list已经包含完整信息，因此采用遍历的方式去获取需要修改的某一条记录的具体内容
     * 一般情况需要去单独的detail页面进行修改
     * @param type $id
     * @param type $list
     * @param type $model
     * @throws BadRequestHttpException
     */
    private function _getAddressById($id, $list = [], $model) {
        if ($id && is_array($list)) {
            foreach ($list as $k => $v) {

                if (isset($v['addressId']) && $v['addressId'] == $id) {
                    $tmp['AddressApi'] = $v;
                    if ($model->load($tmp)) {
                        return true;
                    }
                }
            }
        } else {
            Yii::error('获取地址异常');
            throw new BadRequestHttpException('获取地址异常');
        }
    }

    private function _setErrors($model) {
        $e = $model->getErrors();
        $msg = '';
        if ($e & is_array($e)) {
            foreach ($e as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $sv) {
                        $msg .= $model->getAttributeLabel($k) . "" . $sv . '</br>';
                    }
                } else {
                    $msg .= $model->getAttributeLabel($k) . "" . $v . '</br>';
                }
            }
            Yii::$app->session->setFlash('error', $msg);
        }
    }

//    public function actionCreate()
//    {
//    }
//
//    public function actionUpdate($id)
//    {
//        
//    }
    public function actionDelete($id) {
        //现阶段用户模块并没有完成，但是将来用下面的方法获取用户id
        //Yii::$app->mobileUser->getId() = 'e468a389-19c1-11e5-bba0-00ffaa3562cc';

        $userId = Yii::$app->mobileUser->getId();
        $model = new AddressApi($userId);
        if ($this->_isMyAddressId($id, $userId, $model)) {
            $info = $model->deleteById($id);
        }
        if (empty($info))
            Yii::$app->session->setFlash('success', '操作成功');
        else {
            Yii::$app->session->setFlash('error', '系统异常，请稍后重试');
            Yii::error('删除地址薄的时候，系统异常，请稍后重试' . json_encode($info));
        }
        return $this->redirect(['/address/index']);
    }

    public function actionDefault($id) {
        //现阶段用户模块并没有完成，但是将来用下面的方法获取用户id
        //Yii::$app->mobileUser->getId() = 'e468a389-19c1-11e5-bba0-00ffaa3562cc';

        $userId = Yii::$app->mobileUser->getId();
        $model = new AddressApi($userId);
        if ($this->_isMyAddressId($id, $userId, $model)) {
            $info = $model->setDefaultById($id);
        }
        if (isset($info['address']) && isset($info['address']['isDefault']) && $info['address']['isDefault'])
            Yii::$app->session->setFlash('success', '操作成功');
        else {
            Yii::$app->session->setFlash('error', '系统异常，请稍后重试');
            Yii::error('设置默认地址薄的时候，系统异常，请稍后重试' . json_encode($info));
        }
        return $this->redirect(['/address/index']);
    }

    public function actionGetnoaddrOrders() {
        $request = Yii::$app->request;
        $uid = $request->get('uid');
        if (!$uid) {
            Yii::error('未能获得用户信息，不能查询需补全地址的订单');
            throw new BadRequestHttpException('未能获得用户信息，不能查询需补全地址的订单');
        }
        $orderApi = new OrderApi($uid);
        $noAddrList = $orderApi->getnoAddrOrderList();
        $noAddrList = $noAddrList[key($noAddrList)];
        var_dump($noAddrList);
        exit();
        $orderIds = ArrayHelper::getColumn($noAddrList, 'orderId');
        return $orderIds;
    }

    // /member/users/{userId}/addresses/{addressId}/_setDefault
    private function _isMyAddressId($id, $userId, $model) {

        $info = $model->getById($id);

        if (isset($info['address']['userId']) && $info['address']['userId'] == $userId) {
            return true;
        } else {
            return false;
        }
    }

    private function getSameDisAddrList($districtCode, $addrlist) {
        $retlist = [];
        foreach ($addrlist as $v) {
            if ($v['districtCode'] == $districtCode) {
                $retlist[] = $v;
            }
        }
        return $retlist;
    }

}
