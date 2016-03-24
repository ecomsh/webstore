<?php

namespace cashier\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use cashier\models\OrderApi;
use cashier\models\IdentityApi;
use cashier\models\RealnameApi;
use common\helpers\Tools;

use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;


class PrinterController extends Controller{

    public $layout = "main_cashier";
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'user' => 'webPOSUser',
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    
     public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'page' => ['class' => 'yii\web\ViewAction'],
        ];
    }



    public function actionIndex()
    {
        return $this->render('index.php');
    }
    
    public function actionQueryuser(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $uphone = $request->get('phone');
        $uid = null;
        //根据user phone查询uid
        $identityApi = new IdentityApi();   

        $data = $identityApi->checkIdentity(['type' => 'mobile', 'identity' => $uphone]);
        $identityData = $data[key($data)];

        if($identityData['result'] == false){
            $data = $identityApi->checkIdentity(['type' => 'username', 'identity' => $uphone]);
            $identityData = $data[key($data)];
            if($identityData['result'] == false){
                return ['code' => '404', 'message' => '用户未注册'];
            }
            else{
                $uid = (string) $identityData['userId'];
            }
        }else{
            $uid = (string) $identityData['userId'];
        }
        setcookie('userId', $uid, 0, '/', null, false, true);
        return ['code' => '200', 'uid' => $uid];
    }

    public function actionOrder()
    {
        $userId = null;
        if(isset($_COOKIE['userId']))
        {
            $userId = $_COOKIE['userId'];
        }
        if(empty($userId)){
            return; //TBD 怎么处理异常？
        }
        
        //先获取实名认证信息，显示在界面。
        $realnameApi = new RealnameApi($userId);
        $realname = $realnameApi->getById();
        $realname = $realname[key($realname)];
        if($realname['realName']==null){
            $realname = "未认证";
        }else{
            $realname = mb_substr( $realname['realName'], 0, 1, 'utf-8' );
            $realname = $realname.'XX';
        }
        
        $orderModel = new OrderApi($userId);
        //取7天内已支付的订单信息，按时间降序排列
        $searchData['createDate'] = date('Y-m-d H:i:s', strtotime("-7 day"));
        $searchData['orderStatus'] = 'PAID-SCHEDULED-RELEASED-INCLUDED_IN_SHIPPMENT-SHIPPED';
        $searchData['sortType'] = 'desc';
        
        $dataProvider = $orderModel->getOrderDataProvider(10, $searchData);
        return $this->render('order.php', [
                    'dataProvider' => $dataProvider,
                    'realname' => $realname,
            ]);
    }
    
    public function actionPrintorder(){
        $request = Yii::$app->request;
        $orderId = $request->get('orderId');
        
        if($orderId == null ){
            throw new NotFoundHttpException();
        }
        
        $userId = '';
        if(isset($_COOKIE['userId']))
        {
            $userId = $_COOKIE['userId'];
        }
        
        $orderModel = new OrderApi($userId);
        $orderInfo = $orderModel->getOrderDetail($orderId);
        $key = key($orderInfo);
        $orderInfo = $orderInfo[$key];
//        var_dump($orderInfo);
        $receiptData = [];
        //get o2o store name from session
//        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $session = Yii::$app->session;
        $channel = $session->get('channel');
        $channel = json_decode($channel,true);
        if(isset($channel['storeName'])){
            $receiptData['storeName'] = $channel['storeName'];
        }
        else{
            $receiptData['storeName'] = '';
        }
        //get login username as receipt cashier
        $loginuserName = $session->get('username');
        if($loginuserName){
            $receiptData['cashier'] = $loginuserName;
        }
        else{
            $receiptData['cashier'] = '';
        }
        //get order info
        $receiptData['orderId'] = $orderInfo['orderId'];
        $receiptData['time'] = Tools::showDate('Y-m-d H:i:s',$orderInfo['createTimestamp']);
        $orderLineList = $orderInfo['orderLineList'];
        $quanlity = ArrayHelper::getColumn($orderLineList, 'quantity');
        $totalNum = array_sum($quanlity);
        $receiptData['totalNum'] = $totalNum;
        $receiptData['originalPrice'] = number_format($orderInfo['total'],2); //商品原始价
//        number_format($items_price[$i],2)
        $receiptData['realTax'] = number_format($orderInfo['taxAmount'],2);
        $receiptData['shipping'] = number_format($orderInfo['shippingAmount'],2); //实际的运费?
        $shippingPromotion = $orderInfo['shippingOriginalAmount'] - $orderInfo['shippingAmount'];  
        $promotion = abs($orderInfo['adjustmentAmount']+$shippingPromotion);
        $receiptData['promotion'] =  number_format($promotion,2); //扣除运费之后的其他优惠?
        $receiptData['finalPrice'] = number_format($orderInfo['totalAmount'],2); //实际支付的价格
        $receiptData['items'] = [];
        $taxSum = 0;
        foreach($orderLineList as $v){
            $item = [];
            $item['id'] = $v['itemId'];
            $item['name'] = $v['itemDisplayText'];
            $item['tax'] =  number_format($v['tax'],2);
            $item['price'] =  number_format($v['unitPrice'],2);
            $item['num'] = $v['quantity'];
            $taxes = $v['tax'] * $v['quantity'];
            array_push($receiptData['items'], $item);
            $taxSum += $taxes;
        }
        $receiptData['tax'] =  number_format($taxSum,2);
        return $this->renderPartial ('receipt.php',['data'=>$receiptData]);    
        
    }


//    public function actionPrintreceipt(){
//        $data = [
//            'storeName' => '遵义店',
//            'orderId' => '88888',
//            'cashier' => 'admin',
//            'totalNum' => '1',
//            'originalPrice' => '100',
//            'time' => '2015-09-28 12:00',
//            'tax' => '70',
//            'realTax' => '60',
//            'shipping' => '1',
//            'promotion' => '10',
//            'finalPrice' => '20',
//            'items' => [
//                [
//                    'id' => '1',
//                    'name' => '韩国保湿洁面洗面奶300ML',
//                    'price' => '645',
//                    'tax' => '2',
//                    'num' => '30',
//                ],
//                [
//                    'id' => '2',
//                    'name' => '韩国保湿洁面洗面奶500ML',
//                    'price' => '745',
//                    'tax' => '3',
//                    'num' => '10',
//                ],
//            ],
//        ];
//        return $this->renderPartial ('receipt.php',['data'=>$data]);
//    }
    
}

