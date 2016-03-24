<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\Controller;
use frontend\models\AddressApi;
use frontend\models\CartApi;
use frontend\models\OrderApi;
use frontend\models\ProductApi;
use frontend\models\DirectOrderApi;
use frontend\models\PaymentApi;
use frontend\models\RealnameApi;
use yii\web\BadRequestHttpException;
use yii\helpers\ArrayHelper;
use common\helpers\Tools;
use common\helpers\Buylimits;

/**
 * Site controller
 */
class OrderController extends Controller
{

    public $layout = "main";

    public function behaviors()
    {
        return [
            'access' => Yii::$app->params['pageAccess']['order']
        ];
    }

    public function beforeAction($action)
    {
        $userId = Yii::$app->user->getId();
        if ($action->id === 'create')
        {
            $cartModel = new CartApi($userId);
            $cart = $cartModel->getCartList();

            $itemId = array();
            if (!empty($cart['cart']))
            {
                foreach ($cart['cart'] as $key => $value)
                {
                    foreach ($value as $k => $v)
                    {
                        $itemId[$v['itemId']] = $v['itemPartNumber'];
                    }
                }
            } else
            {
                $params = Yii::$app->request->post();
                if (isset($params['itemInfo']))
                {
                    $itemInfo = json_decode($params['itemInfo'], true);
                    foreach ($itemInfo as $key => $value)
                    {
                        $productId = $key;
                    }
                    $productModel = new ProductApi($userId);
                    $product = $productModel->getProductById($productId);
                    $itemId[] = $product['product']['partNumber'];
                }
            }

            $buylimitsClass = new Buylimits();
            foreach ($itemId as $key => $id)
            {
                $result = $buylimitsClass->isBuyItem($userId, $id);
                if ($result['no_buy'])
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
        if ($action->id === 'create')
        {
            if (isset($result['orderId']))
            {
                $userId = Yii::$app->user->getId();
                //保存限购商品购买记录
                $buylimitsClass = new Buylimits();
                $buylimitsClass->saveBuyLog($userId, $result['orderId']);
            }
        }
        return $result;
    }

    public function actionIndex()
    {
        /**
         * 定义显示按钮需要的状态条件
         */
        $conditions = Yii::$app->params['sm']['store']['showButton'];
        $this->layout = "main";

        $userId = Yii::$app->user->getId();
//        $userId = '5209416283169691449';
        $searchData = Yii::$app->request->get('orderSearch');
        
        if(is_array($searchData))
        $searchData = array_map('addslashes', $searchData);


        $orderModel = new OrderApi($userId);
        if (isset($searchData) && !empty($searchData))
        {
            //print_r($getData['search']);exit;
            if (isset($searchData['order_time']) && $searchData['order_time'] != 'all')
            {
                switch ($searchData['order_time'])
                {
                    case '3th':
                        $searchData['createDate'] = date('Y-m-d', strtotime("-3 month"));
                        break;
                    case '6th':
                        $searchData['createDate'] = date('Y-m-d', strtotime("-6 month"));
                        break;
                    case 'nowYear':
                        $searchData['createDate'] = date('Y-01-01');
                        break;
                    case '1yearsAgo':
                        $searchData['createDate'] = date('Y-m-d', strtotime("-12 month"));
                        break;
                }
            }

            if (isset($searchData['orderStatus']) && !empty($searchData['orderStatus']))
            {
                switch ($searchData['orderStatus'])
                {
                    case '1':
                        $searchData['orderStatus'] = 'CREATED-CREATING';
                        break;
                    case '2':
                        $searchData['orderStatus'] = 'PAID-SCHEDULED-RELEASED';
                        break;
                    case '3':
                        $searchData['orderStatus'] = 'INCLUDED_IN_SHIPPMENT';
                        break;
                    case '4':
                        $searchData['orderStatus'] = 'SHIPPED';
                        break;
                    case '5':
                        $searchData['orderStatus'] = 'CLOSED-CANCELED';
                        break;
                }
            }
        }
        $searchData['sortType'] = 'desc';
        $dataProvider = $orderModel->getOrderDataProvider(10, $searchData);

        $orderList = $dataProvider->getModels();
        $packageChildren = $orderModel->getPackageChildren($orderList);
        Url::remember();
        return $this->render('/order/index', [
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
        $this->layout = "main";

        $userId = Yii::$app->user->getId();

        $orderId = Yii::$app->request->get('orderId');

        $orderModel = new OrderApi($userId);
        $paymentModel = new PaymentApi($userId);

        $data = $orderModel->getOrderDetail($orderId);
        $log = $orderModel->getOrderLog($orderId);
        $paymentInfo = $paymentModel->getPaymentDetails($orderId);

        $data['order']['adjustmentAmount'] = abs($data['order']['adjustmentAmount']) - ($data['order']['shippingOriginalAmount'] - $data['order']['shippingAmount']);

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
        $this->layout = "user_main";

        $userId = Yii::$app->user->getId();

        $orderid = Yii::$app->request->get('id');

        $orderModel = new OrderApi($userId);
        $rc = $orderModel->ConfirmRcvOrder($orderid);

        if (!isset($rc['errorCode']))
        {
//            if ($rc['orderStatus'] == 'SHIPPED')
//            {
//                //ok
            return $this->redirect(['index']);
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
        $this->layout = "user_main";

        $userId = Yii::$app->user->getId();

        $orderid = Yii::$app->request->get('id');

        $orderModel = new OrderApi($userId);
        $rc = $orderModel->CancelOrder($orderid);
        $rc = $rc['order'];
        if (!isset($rc['errorCode']))
        {
            if ($rc['orderStatus'] == 'CLOSED' || $rc['orderStatus'] == 'CANCELED')
            {
                //ok
                return $this->redirect(['index']);
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
        $userId = Yii::$app->user->getId();
        $order = new OrderApi($userId);
        $directOrder = new DirectOrderApi($userId);
        $postData = Yii::$app->request->post();

        if (!is_array($postData) || !$postData)
        {
            Tools::error(99008);
        }

        if (!empty($postData['cartlineId']))
        {
            $isDirectOrder = false;
        } else
        {
            $isDirectOrder = true;
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        //NII = NO Inventory Item
        Yii::$app->cache->delete('__NII');

//        $realnameModel = new RealnameApi($userId);
//        $realnameInfo = $realnameModel->isNeedRealname($CartLines);
//        $isCBT = $realnameInfo['isCBT'];
//        $isRealname = $realnameInfo['isRealname'];
//        if($isCBT && $isRealname){
//            return ['status' => FALSE, 'info' => '请先进行实名认证'];
//        }

        if (!$isDirectOrder)
        {
            $data = $order->orderCreate($postData);
        } else
        {
            $data = $directOrder->directOrderCreate($postData);
        }

        if (!$data)
        {
            Tools::error('99041', '下单异常，请稍后重试');
            exit;
        }

        $keys = array_keys($data);
        if (!isset($data[$keys[0]]))
        {
            return ['status' => FALSE, 'message' => '下单异常，请稍后重试']; //todo: 需要统一修复
        }
        $data = $data[$keys[0]];

        if (isset($data['orderId']) === TRUE)
        {
            return ['status' => TRUE, 'orderId' => $data['orderId']];
        } else
        {
            return ['status' => FALSE, 'message' => $data];
        }
    }

    public function actionPay()
    {

        $userId = Yii::$app->user->getId();
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
        $this->layout = "main-cart-order";
        $userId = Yii::$app->user->getId();

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
//        print_r($orderInfos);exit;
        $salesType = isset($orderInfos[0]['orderLineList'][0]['itemSalesType']) ? $orderInfos[0]['orderLineList'][0]['itemSalesType'] : 4;
        return $this->render('payment', [
                    'orderInfos' => isset($orderInfos[0]) ? $orderInfos[0] : [],
                    'packageChildren' => $packageChildren,
                    'type' => Yii::$app->params['sm']['pay']['type'][$salesType],
        ]);
    }

}
