<?php

namespace mobile\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use mobile\models\AddressApi;
use mobile\models\CartApi;
use mobile\models\OrderApi;
use mobile\models\ProductApi;
use mobile\models\DirectOrderApi;
use mobile\models\PaymentApi;
use yii\web\BadRequestHttpException;
use yii\helpers\ArrayHelper;
use common\helpers\Tools;
use common\helpers\Buylimits;

/**
 * Site controller
 */
class OrderController extends Controller
{

    public $layout = "mainnew";

    public function behaviors()
    {
        return [
            'access' => Yii::$app->params['pageAccess']['order']
        ];
    }
    
    public function beforeAction($action)
    {
    	$userId = Yii::$app->mobileUser->getId();
    	 
    	if ( $action->id === 'create' )
    	{
    		$cartModel = new CartApi($userId);
    		$cart = $cartModel->getCartList();
    		
    		$itemId = array();
    		if ( !empty($cart['cart']) )
    		{
	    		foreach ( $cart['cart'] as $key => $value )
	    		{
	    			foreach ( $value as $k => $v )
	    			{
	    				$itemId[$v['itemId']] = $v['itemPartNumber'];
	    			}
	    		}
    		}
    		else
    		{
    			$params = Yii::$app->request->post();
    			if ( isset( $params['itemInfo'] ) )
    			{
	    			$itemInfo = json_decode($params['itemInfo'],true);
	    			foreach ( $itemInfo as $key => $value )
	    			{
	    				$productId = $key;
	    			}
	    			$productModel = new ProductApi($userId);
	    			$product = $productModel->getProductById($productId);
	    			$itemId[] = $product['product']['partNumber'];
    			}
    		}
    		
    		$buylimitsClass = new Buylimits();
    		foreach ( $itemId as $key => $id )
    		{
    			$result = $buylimitsClass->isBuyItem($userId,$id);
    			if ( $result['no_buy'] )
    			{
    				echo $result['depict'];
    				die;
    			}
    		}
    	}
    	return parent::beforeAction($action);
    }
    
    public function afterAction($action, $result)
    {
    	$result = parent::afterAction($action, $result);
    	if ( $action->id === 'create' )
    	{
    		if ( isset( $result['orderId'] ) )
    		{
    			$userId = Yii::$app->mobileUser->getId();
    			//保存限购商品购买记录
    			$buylimitsClass = new Buylimits();
    			$buylimitsClass->saveBuyLog($userId,$result['orderId']);
    		}
    	}
    	return $result;
    }

    public function actionIndex()
    {
        $this->layout = "mainorder";
        /**
         * 定义显示按钮需要的状态条件
         */
        $conditions = Yii::$app->params['sm']['store']['showButton'];
        

        $userId = Yii::$app->mobileUser->getId();
        $searchData = Yii::$app->request->get('orderSearch');

        $orderModel = new OrderApi($userId);
        
        if (isset($searchData) && !empty($searchData))
        {
            if (!empty($searchData['orderStatus']))
            {
                switch ($searchData['orderStatus'])
                {
                    case '1':
                        $searchData['orderStatus'] = 'CREATED-CREATING';
                        break;
                    case '2':
                        $searchData['orderStatus'] = 'PAID-SCHEDULED-RELEASED-INCLUDED_IN_SHIPPMENT';
                        break;
                    case '3':
                        $searchData['orderStatus'] = 'SHIPPED';
                        break;
                    case '4':
                        $searchData['orderStatus'] = 'CLOSED-CANCELED';
                        break;
                    case '5':
                        $searchData['orderStatus'] = 'RETURN_CREATED-RETURN_RECEIVED-REFUND_CREATED-REFUNDED-RETURN_CANCELED';
                        break;
                }
            }else{
                $searchData['orderStatus'] = 'CREATED-CREATING';
            }
        }else{
            $searchData['orderStatus'] = 'CREATED-CREATING';
        }
        $searchData['sortType'] = 'desc';
        $dataProvider = $orderModel->getOrderDataProvider(10, $searchData);
        
        $orderList = $dataProvider->getModels();
        $packageChildren = $orderModel->getPackageChildren($orderList);
        Url::remember();
        return $this->render('/order/orders', [
                    'dataProvider' => $dataProvider,
                    'conditions' => $conditions,
                    'packageChildren' => $packageChildren,
        ]);
    }

    public function actionOrderdetail()
    {
        /**
         * 定义显示按钮需要的状态条件
         */
        $conditions = Yii::$app->params['sm']['store']['detailShowButton'];

        $userId = Yii::$app->mobileUser->getId();

        $orderId = Yii::$app->request->get('orderId');

        $orderModel = new OrderApi($userId);
        $paymentModel = new PaymentApi($userId);

        $data = $orderModel->getOrderDetail($orderId);
        $log = $orderModel->getOrderLog($orderId);
        $paymentInfo = $paymentModel->getPaymentDetails($orderId);
//print_r($paymentInfo);exit;
        $data['order']['adjustmentAmount'] = abs($data['order']['adjustmentAmount']) - ($data['order']['shippingOriginalAmount']-$data['order']['shippingAmount']);
        
//        print_r($data);exit;
//        print_r($log);exit;
        $packageChildren = $orderModel->getPackageChildren($data);
        
        return $this->render('/order/orderdetail', [
                    'order' => $data['order'],
                    'packageChildren' => $packageChildren,
                    'log' => isset($log['order']) ? $log['order'] : [],
                    'paymentInfo' => isset($paymentInfo['pay']) ? $paymentInfo['pay'] : [],
                    'conditions' => $conditions,
        ]);
    }

    public function actionConfirmreceived()
    {
        $this->layout = "main-user";

        $userId = Yii::$app->mobileUser->getId();

        $orderid = Yii::$app->request->get('id');

        $orderModel = new OrderApi($userId);
        $rc = $orderModel->ConfirmRcvOrder($orderid);

        if (!isset($rc['errorCode']))
        {
//            if ($rc['orderStatus'] == 'SHIPPED')
//            {
//                //ok
            return $this->redirect(Url::previous());
//            } else
//            {
//                //error
//                Yii::error('系统繁忙，请稍后再试');
//                throw new BadRequestHttpException('系统繁忙，请稍后再试');
//            }
        } else
        {
            Yii::error($rc['errorMsg']);
            throw new BadRequestHttpException($rc['errorMsg']);
        }
    }

    public function actionCancelorder()
    {
        $this->layout = "main-user";

        $userId = Yii::$app->mobileUser->getId();

        $orderid = Yii::$app->request->get('id');

        $orderModel = new OrderApi($userId);
        $rc = $orderModel->CancelOrder($orderid);
        $rc = $rc['order'];
        if (!isset($rc['errorCode']))
        {
            if ($rc['orderStatus'] == 'CLOSED' || $rc['orderStatus'] == 'CANCELED')
            {
                //ok
                return $this->redirect(Url::previous());
            } else
            {
                //error
                Yii::error('系统繁忙，请稍后再试');
                throw new BadRequestHttpException('系统繁忙，请稍后再试');
            }
        } else
        {
            Yii::error($rc['errorMsg']);
            throw new BadRequestHttpException($rc['errorMsg']);
        }
    }

    public function actionCreate()
    {
        $userId = Yii::$app->mobileUser->getId();
        $order = new OrderApi($userId);
        $directOrder = new DirectOrderApi($userId);
        $postData = Yii::$app->request->post();
       
        if (!is_array($postData)||!$postData)
        { 
            Tools::error(99008);
        }
        
        if (!empty($postData['cartlineId']))
        {
            $isDirectOrder = false;
        }else{
            $isDirectOrder = true;
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        //NII = NO Inventory Item
        Yii::$app->cache->delete('__NII');
        if (!$isDirectOrder)
        {
            $data = $order->orderCreate($postData);
        }else{
            $data = $directOrder->directOrderCreate($postData);
        }
        
        if(!$data){
            Tools::error('99041', '下单异常，请稍后重试');exit;
        }
        
        $keys = array_keys($data);
        if(!isset($data[$keys[0]])){
            return ['status' => FALSE, 'message' => '下单异常，请稍后重试'];//todo: 需要统一修复
        }
        $data = $data[$keys[0]];
        
        if(isset($data['orderId']) === TRUE){
            return ['status' => TRUE,'orderId'=>$data['orderId']];
        }else{
            return ['status' => FALSE];
        }
    }
    
    public function actionPay()
    {

        $userId = Yii::$app->mobileUser->getId();
        $postData = Yii::$app->request->post();
        if (!$postData || !is_array($postData))
        {
            throw new BadRequestHttpException("非法请求");
        }
        $paymentModel = new PaymentApi();

        $params = [
            'orderId' => $postData['orderId'],
            'payMethod' => $postData['payMethod'],
            'subject' => $postData['subject'],
            'itemSum' => $postData['itemSum'],
            'mobile' => true,
            'return_url_pay' => $postData['return_url_pay']
        ];

        $r = $paymentModel->payForOrder($params)['pay'];

        if ($r['format'] === 'html')
        {
            $result = $r['data'];
        } else
        {
            $result = array();
        }
        return $this->render('pay', [ 'payPage' => $result,
                    'id' => 'paysubmit_' . $postData['orderId']]
        );
    }

    public function actionPayment()
    {

        $userId = Yii::$app->mobileUser->getId();

        $orderModel = new OrderApi($userId);
        $postData = Yii::$app->request->get();
        if (!$postData || !is_array($postData) || !isset($postData['orderIds']))
        {
            throw new BadRequestHttpException("非法请求");
        }
        $orderIds = explode(',', $postData['orderIds']);
        //$detailInfo = $orderModel->getOrderDetail(Yii::$app->request->get('orderId'));
        //$orderIds = ['4669814136443342452'];
        $orderInfos = array();

        foreach ($orderIds as $key => $orderId)
        {
            $orderInfos[$key] = $orderModel->getOrderDetail($orderId)['order'];
        }
        
        $packageChildren = $orderModel->getPackageChildren($orderInfos);
        
        return $this->render('payment', [
                    'orderInfos' => $orderInfos,
                    'packageChildren' => $packageChildren,
                    'type' => Yii::$app->params['sm']['pay']['type']
        ]);
    }
    
    public function actionPayTest(){
        $this->layout = null;
        return $this->render('payTest');
    }

}
