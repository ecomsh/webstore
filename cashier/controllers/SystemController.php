<?php

namespace cashier\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use cashier\models\OrderApi;
use cashier\models\IdentityApi;
use cashier\models\RealnameApi;
use cashier\models\PassportApi;
use yii\web\HttpException;
use yii\web\BadRequestHttpException;
use common\helpers\Tools;
use yii\filters\AccessControl;
use cashier\models\ProductApi;
use cashier\models\InventoryApi;

class SystemController extends Controller {

    public $layout = "main_cashier";

    public function behaviors() {
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

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'page' => ['class' => 'yii\web\ViewAction'],
        ];
    }

    public function actionIndex() {
        $session = Yii::$app->session;
        $channel = $session->get('channel');
        $channel = json_decode($channel, true);
        $storeName = '';
        if (!empty($channel) && isset($channel['storeName'])) {
            $storeName = $channel['storeName'];
        }
        return $this->render('storeinfo', ['storeName' => $storeName]);
    }

    public function actionSalesdata() {
        $session = Yii::$app->session;
        $channel = $session->get('channel');
        $channel = json_decode($channel, true);
        $channelId = '';
        if (!empty($channel) && isset($channel['channelId'])) {
            $channelId = $channel['channelId'];
        }
        if (empty($channelId)) {
            throw new BadRequestHttpException("未获得店铺信息");
        }
        $orderStatus = Yii::$app->request->get('orderStatus');
        $order_time = Yii::$app->request->get('order_time');
        $startDate = Yii::$app->request->get('startDate');
        $endDate = Yii::$app->request->get('endDate');
        $orderModel = new OrderApi();
        //print_r($getData['search']);exit;
        if (isset($order_time) && !empty($order_time)) { //选择时间段
            switch ($order_time) {
                case '3th':
                    $startDate = date('Y-m-d', strtotime("-3 month"));
                    break;
                case '1th':
                    $startDate = date('Y-m-d', strtotime("-1 month"));
                    break;
                case 'today':
                    $startDate = date('Y-m-d');
                    break;
                case '1yearAgo':
                    $startDate = date('Y-m-d', strtotime("-12 month"));
                    break;
            }
            $endDate = date('Y-m-d');
        } else if (isset($startDate) || isset($endDate)) {       //选择起止时间
            if (isset($startDate) && !empty($startDate)) {
                $startDate = $startDate;
            } else {
                $startDate = date('Y-m-d', strtotime("-1 month"));
            }
            if (isset($endDate) && !empty($endDate)) {
                $endDate = $endDate;
            } else {
                $endDate = date('Y-m-d');
            }
        } else {
            //默认进入这一页，显示全部订单信息
            $startDate = date('Y-m-d', strtotime("-1 month"));
            $endDate = date('Y-m-d');
        }
        if (isset($orderStatus) && $orderStatus == 2) {
            $orderStatusParam = 'PAID|SCHEDULED|RELEASED|INCLUDED_IN_SHIPPMENT|SHIPPED';
        }

        if (!isset($orderStatusParam)) {
            $params = [
                'channelId' => $channelId,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ];
        } else {
            $params = [
                'channelId' => $channelId,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'orderStatus' => $orderStatusParam,
            ];
        }
//        print_r($params);exit();
        $pagesize = 15;
        $dataProvider = $orderModel->getOrdersbyChannel($params, $pagesize);
        $orders = $dataProvider->getModels();
        $totalcount = $dataProvider->getTotalCount();
        if (!$orders) {
            return $this->render('orderempty');
        }
        $totalOrderAmountP = 0;
        foreach ($orders as $v) {
            $totalOrderAmountP += $v['totalAmount'];
        }
        return $this->render('salesdata', ['dataProvider' => $dataProvider,
                    'totalcount' => $totalcount,
                    'totalOrderAmount' => $totalOrderAmountP,]);
    }

    public function actionRegisteruser() {
        $session = Yii::$app->session;
        $channel = $session->get('channel');
        $channel = json_decode($channel, true);
        $channelId = '';
        if (!empty($channel) && isset($channel['channelId'])) {
            $channelId = $channel['channelId'];
        }
        if (empty($channelId)) {
            throw new BadRequestHttpException("未获得店铺信息");
        }
        //从url拿到查询起止时间，默认查询一个月内注册用户的信息
        $startDate = Yii::$app->request->get('startDate');
        $endDate = Yii::$app->request->get('endDate');
        if (isset($startDate) && !empty($startDate)) {
            $queryStart = $startDate;
        } elseif (!isset($startDate) && !isset($endDate)) {   //默认查询一个月内的订单
            $queryStart = date('Y-m-d', strtotime("-1 month"));
        } else {
            $queryStart = date('Y-m-d', 0);
        }
        if (isset($endDate) && !empty($endDate)) {
            $queryEnd = $endDate;
        } else {
            $queryEnd = date('Y-m-d');
        }
        //TBD begin 起止时间组params，或许有channelId,需要改接口的参数
        $params = [
            'channelId' => $channelId,
            'startDate' => $queryStart,
            'endDate' => $queryEnd,
        ];
        $Model = new PassportApi();
        $dataProvider = $Model->getUsersbyRegChannel($channelId, $params);
        $users = $dataProvider->getModels();
        if (!$users) {
            return $this->render('userempty');
        }
        return $this->render('registeruser', ['dataProvider' => $dataProvider]);
    }

    public function actionMemorders() {
        $session = Yii::$app->session;
        $channel = $session->get('channel');
        $channel = json_decode($channel, true);
        $channelId = '';
        if (!empty($channel) && isset($channel['channelId'])) {
            $channelId = $channel['channelId'];
        }
        if (empty($channelId)) {
            throw new BadRequestHttpException("未获得店铺信息");
        }
        //just for debug yyjia
//        $channelId = 'ftzmall';
        $token = Yii::$app->params['tokens'][$channelId];
        
        $orderStatus = Yii::$app->request->get('orderStatus');
        $order_time = Yii::$app->request->get('order_time');
        $startDate = Yii::$app->request->get('startDate');
        $endDate = Yii::$app->request->get('endDate');
        $orderModel = new OrderApi();
        //print_r($getData['search']);exit;
        if (isset($order_time) && !empty($order_time)) { //选择时间段
            switch ($order_time) {
                case '3th':
                    $startDate = date('Ymd', strtotime("-3 month"));
                    break;
                case '1th':
                    $startDate = date('Ymd', strtotime("-1 month"));
                    break;
                case 'today':
                    $startDate = date('Ymd');
                    break;
                case '1yearAgo':
                    $startDate = date('Ymd', strtotime("-12 month"));
                    break;
            }
            $endDate = date('Ymd');
        } else if (isset($startDate) || isset($endDate)) {       //选择起止时间
            if (isset($startDate) && !empty($startDate)) {
                $startDate = date('Ymd', strtotime($startDate));
            } else {
                $startDate = date('Ymd', strtotime("-1 month"));
            }
            if (isset($endDate) && !empty($endDate)) {
                $endDate = date('Ymd', strtotime($endDate));
            } else {
                $endDate = date('Ymd');
            }
        } else {
            //默认进入这一页，显示全部订单信息
            $startDate = date('Ymd', strtotime("-1 month"));
            $endDate = date('Ymd');
        }
        if (isset($orderStatus) && $orderStatus == 2) {
            $orderStatusParam = 1;
        }

        if (!isset($orderStatusParam)) {
            $params = [
                'storeId' => $channelId,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'token' => $token,
            ];
        } else {
            $params = [
                'storeId' => $channelId,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'paymentStatus' => $orderStatusParam,
                'token' => $token,
            ];
        }
//        print_r($params);exit();
        $pagesize = 15;
        $dataProvider = $orderModel->getMemOrders($params, $pagesize);
        $orders = $dataProvider->getModels();
        $totalcount = $dataProvider->getTotalCount();
        if (!$orders) {
            return $this->render('memorderempty');
        }
        $totalPayAmountP = 0;
        $totalrateAmountP = 0;
        foreach ($orders as $v) {
            $totalPayAmountP += $v['payAmount'];
            $totalrateAmountP += $v['rateAmount'];
        }
        return $this->render('memorders', ['dataProvider' => $dataProvider,
                    'totalcount' => $totalcount,
                    'totalPayAmount' => $totalPayAmountP,
                    'totalrateAmount' => $totalrateAmountP]);
    }

    public function actionDlorders() {
        $session = Yii::$app->session;
        $channel = $session->get('channel');
        $channel = json_decode($channel, true);
        $channelId = '';
        if (!empty($channel) && isset($channel['channelId'])) {
            $channelId = $channel['channelId'];
        }
        if (empty($channelId)) {
            throw new BadRequestHttpException("未获得店铺信息");
        }

        $orderStatus = Yii::$app->request->get('orderStatus');
        $order_time = Yii::$app->request->get('order_time');
        $startDate = Yii::$app->request->get('startDate');
        $endDate = Yii::$app->request->get('endDate');
        $totalCount = Yii::$app->request->get('totalCount');
        //如果出错，没有拿到订单总数，默认下载100个订单
        if (empty($totalCount)) {
            $totalCount = 100;
        }

        $orderModel = new OrderApi();
        //print_r($getData['search']);exit;
        if (isset($order_time) && !empty($order_time)) { //选择时间段
            switch ($order_time) {
                case '3th':
                    $startDate = date('Y-m-d', strtotime("-3 month"));
                    break;
                case '1th':
                    $startDate = date('Y-m-d', strtotime("-1 month"));
                    break;
                case 'today':
                    $startDate = date('Y-m-d');
                    break;
                case '1yearAgo':
                    $startDate = date('Y-m-d', strtotime("-12 month"));
                    break;
            }
            $endDate = date('Y-m-d');
        } else if (isset($startDate) || isset($endDate)) {       //选择起止时间
            if (isset($startDate) && !empty($startDate)) {
                $startDate = $startDate;
            } else {
                $startDate = date('Y-m-d', strtotime("-1 month"));
            }
            if (isset($endDate) && !empty($endDate)) {
                $endDate = $endDate;
            } else {
                $endDate = date('Y-m-d');
            }
        } else {
            //默认进入这一页，显示全部订单信息
            $startDate = date('Y-m-d', strtotime("-1 month"));
            $endDate = date('Y-m-d');
        }
        if (isset($orderStatus) && $orderStatus == 2) {
            $orderStatusParam = 'PAID|SCHEDULED|RELEASED|INCLUDED_IN_SHIPPMENT|SHIPPED';
        }

        if (!isset($orderStatusParam)) {
            $params = [
                'channelId' => $channelId,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ];
        } else {
            $params = [
                'channelId' => $channelId,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'orderStatus' => $orderStatusParam,
            ];
        }
        $dataProvider = $orderModel->getOrdersbyChannel($params, $pagesize = $totalCount);
        $data = $dataProvider->getModels();
        foreach ($data as $k => $v) {
            $data[$k]['createTimestamp'] = Tools::showDate('Y-m-d H:i:s', $v['createTimestamp']);
            $data[$k]['adjustmentAmount'] = abs($v['adjustmentAmount'] + ($v['shippingOriginalAmount'] - $v['shippingAmount']));
            $data[$k]['orderId'] = " " . $v['orderId'];
            $data[$k]['buyerId'] = " " . $v['buyerId'];
            $data[$k]['shippingReceiverMobile'] = " " . $v['shippingReceiverMobile'];
        }

        \moonland\phpexcel\Excel::export([
            'models' => $data,
            'columns' => ['orderId', 'createTimestamp', 'orderStatus', 'buyerId', 'total', 'shippingAmount',
                'adjustmentAmount', 'taxAmount', 'totalAmount', 'shippingReceiverName', 'shippingReceiverMobile', 'shippingAddress'], //without header working, because the header will be get label from attribute label. 
            'headers' => ['orderId' => '订单编号', 'createTimestamp' => '订单日期', 'orderStatus' => '订单状态',
                'buyerId' => '客户编号', 'total' => '订单金额', 'shippingAmount' => '运费', 'adjustmentAmount' => '折扣金额',
                'taxAmount' => '关税', 'totalAmount' => '结算金额', 'shippingReceiverName' => '收货人', 'shippingReceiverMobile' => '收件人手机', 'shippingAddress' => '收货地址'],
            'fileName' => '营业数据',
        ]);
    }
    
     public function actionDlmemorders() {
        $session = Yii::$app->session;
        $channel = $session->get('channel');
        $channel = json_decode($channel, true);
        $channelId = '';
        if (!empty($channel) && isset($channel['channelId'])) {
            $channelId = $channel['channelId'];
        }
        if (empty($channelId)) {
            throw new BadRequestHttpException("未获得店铺信息");
        }

        $token = Yii::$app->params['tokens'][$channelId];
        $orderStatus = Yii::$app->request->get('orderStatus');
        $order_time = Yii::$app->request->get('order_time');
        $startDate = Yii::$app->request->get('startDate');
        $endDate = Yii::$app->request->get('endDate');
        $totalCount = Yii::$app->request->get('totalCount');
        //如果出错，没有拿到订单总数，默认下载100个订单
        if (empty($totalCount)) {
            $totalCount = 100;
        }

        $orderModel = new OrderApi();
        //print_r($getData['search']);exit;
        if (isset($order_time) && !empty($order_time)) { //选择时间段
            switch ($order_time) {
                case '3th':
                    $startDate = date('Ymd', strtotime("-3 month"));
                    break;
                case '1th':
                    $startDate = date('Ymd', strtotime("-1 month"));
                    break;
                case 'today':
                    $startDate = date('Ymd');
                    break;
                case '1yearAgo':
                    $startDate = date('Ymd', strtotime("-12 month"));
                    break;
            }
            $endDate = date('Ymd');
        } else if (isset($startDate) || isset($endDate)) {       //选择起止时间
            if (isset($startDate) && !empty($startDate)) {
                $startDate = date('Ymd', strtotime($startDate));
            } else {
                $startDate = date('Ymd', strtotime("-1 month"));
            }
            if (isset($endDate) && !empty($endDate)) {
                $endDate = date('Ymd', strtotime($endDate));
            } else {
                $endDate = date('Ymd');
            }
        } else {
            //默认进入这一页，显示全部订单信息
            $startDate = date('Ymd', strtotime("-1 month"));
            $endDate = date('Ymd');
        }
        if (isset($orderStatus) && $orderStatus == 2) {
            $orderStatusParam = 1;
        }

        if (!isset($orderStatusParam)) {
            $params = [
                'storeId' => $channelId,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'token' => $token,
            ];
        } else {
            $params = [
                'storeId' => $channelId,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'paymentStatus' => $orderStatusParam,
                'token' => $token,
            ];
        }
        $dataProvider = $orderModel->getMemOrders($params, $pagesize = $totalCount);
        $data = $dataProvider->getModels();
        foreach ($data as $k => $v) {
            $data[$k]['orderCreateTimestamp'] = Tools::showDate('Y-m-d H:i:s', $v['orderCreateTimestamp']);
            $data[$k]['orderId'] = " " . $v['orderId'];
            $data[$k]['buyerId'] = " " . $v['buyerId'];
            $data[$k]['shippingReceiverMobile'] = " " . $v['shippingReceiverMobile'];
            $data[$k]['orderAmount'] = number_format($v['orderAmount'], 2);
            $data[$k]['shippingAmount'] = number_format($v['shippingAmount'], 2);
            $data[$k]['taxAmount'] = number_format($v['taxAmount'],2);
        }

        \moonland\phpexcel\Excel::export([
            'models' => $data,
            'columns' => ['orderId', 'orderCreateTimestamp', 'orderStatus', 'buyerId', 'orderAmount', 'shippingAmount',
                'adjustment', 'taxAmount', 'payAmount', 'rateAmount', 'itemDisplayText','shippingReceiverName', 'shippingReceiverMobile', 'shippingAddress'], //without header working, because the header will be get label from attribute label. 
            'headers' => ['orderId' => '订单编号', 'orderCreateTimestamp' => '订单日期', 'orderStatus' => '订单状态',
                'buyerId' => '客户编号', 'orderAmount' => '订单金额', 'shippingAmount' => '运费', 'adjustment' => '折扣金额',
                'taxAmount' => '关税', 'payAmount' => '支付金额', 'rateAmount'=> '分成金额', 'itemDisplayText'=> '商品信息','shippingReceiverName' => '收货人', 'shippingReceiverMobile' => '收件人手机', 'shippingAddress' => '收货地址'],
            'fileName' => '会员销售',
        ]);
    }
    
    public  function actionIteminfo(){
        $item = Yii::$app->request->get('item');
        $iteminfo = Yii::$app->request->get('iteminfo');
        if(isset($item) && !empty($item)){
            if(empty($iteminfo)){
                $msg = '商品信息不能为空';
                return $this->render('iteminfo',
                                    ['showEmpty' => false,
                                      'errormsg' => $msg]);
            }
            if($item == 'itemid'){
                if(!is_numeric($iteminfo)){
                  $msg = '商品编号为数字，请输入正确的商品编号';
                  return $this->render('iteminfo',
                                    ['showEmpty' => false,
                                      'errormsg' => $msg]);
                }
                else{
                    $model = new ProductApi();
                    $prod = $model->getProductByIds($iteminfo);
                    $prod = $prod[key($prod)]; 
                    if(empty($prod)){
                        return $this->render('iteminfo',
                              ['showEmpty' => true]);
                    }
                    $info = $this->getDisplayinfo($prod[0]);//getProductByIds returns an array, so need to get the first element in array
                    
                    return $this->render('iteminfo',
                                    ['showEmpty' => false,
                                     'displayInfo' => $info,]);
                }
            }
            else{
                $search= $this->replace_specialChar($iteminfo);
                if (isset($search) && !empty($search))
                {
                    $params['term'] = $search;
                }
                $model = new ProductApi();
                $dataProvider = $model->getProByTermWithP($params);       
                $products = $dataProvider->getModels();
                if(!$products){
                return $this->render('iteminfo',
                                    ['showEmpty' => true]);
                }
                $prolist = array_slice($products, 0,10); //list中只有前10个商品
                $list = array();
                foreach($prolist as $k=>$v){
                    $list[$k]['id'] = $v['id'];
                    $list[$k]['name'] = $v['desc']['name'];
                }
                $count = count($list);
                //当搜索结果多于1个即为一个列表时，显示列表弹层
                if($count > 1){
                    return $this->render('iteminfo',
                                    ['showEmpty' => false,
                                     'searchList' => $list,
                                     'count' => $count]);
                }
                //当搜索结果只有一个时，直接显示结果
                else{
                    $prod = $prolist[0];
                    $info = $this->getDisplayinfo($prod);
                    return $this->render('iteminfo',
                                    ['showEmpty' => false,
                                     'displayInfo' => $info,]);
                }
            }
        }
        
        else{
            return $this->render('iteminfo',
                                    ['showEmpty' => false,]);
        }
    }
    
    private function replace_specialChar($strParam){
        $regex = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/";
        return preg_replace($regex,"",$strParam);
    }
    
    private function getDisplayinfo($prod){
        $info = array();
        $info['id'] = $prod['id'];
        $info['name'] = $prod['desc']['name'];
        $info['brand'] = isset($prod['brand']['name'])?$prod['brand']['name'] : '';
        //取search模块中的价格显示
        $info['listprice'] = !empty($prod['listPriceInfo'])? $prod['listPriceInfo'][0]['price'] : '';
        $info['offerprice'] = !empty($prod['offerPriceInfo'])? $prod['offerPriceInfo'][0]['price'] : '';
        $info['promotprice'] = !empty($prod['promotionPriceInfo'])? $prod['promotionPriceInfo'][0]['price'] : '';
        //取库存
        $partnumber = $prod['partNumber'];
        $InventoryModel = new InventoryApi();
        $params = [         
            'itemOrg' => $prod['memberId'],
            //search by id的memberId是org的意思，加入店中店功能之后需要拿到shop信息，并且之前hard code成ftzmall的其他接口调用。
            'shop' => $prod['memberId'],  // TBD by yyjia, should change to shopid in B2B2C
            'itemPartNumber' => $partnumber,
            ];
        $data = $InventoryModel->getInventory($params);
        $key = key($data);
        $quantityOnhand = isset($data[$key]["quantityOnhand"]) ? $data[$key]["quantityOnhand"] : 0;
        $info['itemInv'] = $quantityOnhand;
        return $info;

    }

}
