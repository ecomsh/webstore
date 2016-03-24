<?php

namespace mobile\controllers;

use Yii;
use common\pay\wxpay\JsApiPay;
use common\pay\wxpay\lib\WxPayUnifiedOrder;
use common\pay\wxpay\lib\WxPayApi;
use mobile\models\WxorderApi;
use mobile\models\OrderApi;
use yii\base\InvalidConfigException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/**
 * Description of PayController
 *
 * @author hezonglin
 */
class PayController extends Controller
{

    public $layout = "main-pay";
    public function behaviors()
    {
            return [
              //  'access' => Yii::$app->params['pageAccess']['pay']   如果需要登陆和不登录用户都能支付，则不能设此值
            ];
    }
    public function actionWx()
    {
       // $userId = Yii::$app->mobileUser->getId();因为无论谁支付，只要金额没有问题就可以
        $orderModel = new OrderApi();
        $getData = Yii::$app->request->get();
        if (!$getData || !is_array($getData) || !isset($getData['orderId']))
        {
            throw new BadRequestHttpException("非法请求，订单号不存在！");
        }
        $oId = $getData['orderId'];
        $orderInfo = $orderModel->getOrderDetail($oId);
        if (!$orderInfo || !is_array($orderInfo) || !isset($orderInfo['order']['orderId']))
        {
            throw new BadRequestHttpException("订单异常，请稍后再试！");
        }
        $orderDetail = $orderInfo['order'];
        //是否已经支付
        if(! in_array( $orderDetail['orderStatus'], ['CREATED','CREATING'])){
            throw new BadRequestHttpException("该订单已支付，无需重复支付");
        }
        $totalNum = 0;
        $msg = '';
        $salseType = '';
        foreach ($orderDetail['orderLineList'] as $key => $value) {
            $salseType = $value['itemSalesType'];
            $totalNum = $totalNum + $value['quantity'];
            $msg = $msg . $value['itemDisplayText'];
        }
        if($salseType === '4' ){
            $salseType = 'sr';
        }else{
            $salseType = 'sr';
        }
        $msg = \common\helpers\Tools::substr_mb($msg, 10);
        
        //获取用户ID
        if(isset($orderDetail['buyerId'])){
            $userId = $orderDetail['buyerId'];
        }else{
            $userId = Yii::$app->mobileUser->getId();
        }
        
        
        
        //①、获取用户openid
        #todo hezll get openId from member;
        
        $tools = new JsApiPay($salseType);
        $openId = $tools->GetOpenid();
        if(!$openId){
            Yii::error('can not get the open id when paying through wx!');
        }
        /** call payment api to create payment instruction */ 
        $model = new WxorderApi($salseType,$userId);
        $params = [];
        $params['orderId'] = $orderDetail['orderId'];
        $params['userId'] = $userId;
        if($salseType === 'cbt'){
            $params['payMethod'] = 'Wechat';
        }else{
            $params['payMethod'] = 'WechatSelfRun';
        }
        $data = $model->createLocalUnifiedOrder($params);
        if($data && isset($data['order']['data'])){
            $payInfo = explode('^', $data['order']['data']);
            if(!$payInfo[1]){
                throw new BadRequestHttpException($data);
            }
        }else{
            throw new BadRequestHttpException($data);
        }
        /*# todo 联调后端下单确定接口 hezll 20150825 */
        $tradeNo = isset($payInfo[0]) ? $payInfo[0] : Yii::$app->params['pay']['wx'][$salseType]['MCHID'] . date("YmdHis");
        $orderId = isset($params['orderId']) ? $params['orderId'] : time();
        $notifyUrl = Yii::$app->params['pay']['wx'][$salseType]['notifyUrl'].'paycallback/orderId/' . $orderId . '/paymentmethod/'.$params['payMethod'].'/actionName/deposit/storeId/ftzmall';
       
//②、统一下单
        //var_dump($postData);
        $input = new WxPayUnifiedOrder($salseType);
        $input->SetBody('订单：'.$oId);
        $input->SetAttach($oId);
        $input->SetOut_trade_no($tradeNo);
        $input->SetTotal_fee($payInfo[1]);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag('tag');
        $input->SetNotify_url($notifyUrl);
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $wpModel = new WxPayApi($salseType);
        $order = $wpModel->unifiedOrder($input, 30);
        if (isset($order['err_code']) && $order['err_code'] != 'SUCCESS')
        {
            throw new BadRequestHttpException($order['err_code_des']);
        }

        $jsApiParameters = $tools->GetJsApiParameters($order);
        //echo '2';
//
////获取共享收货地址js函数参数
        // $editAddress = $tools->GetEditAddressParameters();  #todo 获取地址失败
        //echo '3';

        //var_dump($jsApiParameters);

//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
        /**
         * 注意：
         * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
         * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
         * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
         */
        return $this->render('pay', ['order' => $order, 
            'jsApiParameters' => $jsApiParameters, 
            'editAddress' => '$editAddress',
            'payInfo' => $payInfo[1],
            'msg' => $msg,
            'totalNum'=> $totalNum,
            'returnUrl'=>  \yii\helpers\Url::to(['order/index'],true)]);
    }

    public function actionNotify()
    {
        return $this->render('pay', [
            'jsApiParameters' => '$sApiParameters', 
            'editAddress' => '$editAddress',
            'payInfo' => 1,
            'msg' => '中国香港 Lion & Globe Brand狮球唛',
            'totalNum'=> 5]);
    }

    //put your code here
}
