<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

use frontend\models\OrderApi;
use frontend\models\RefundApi;

class AftersalesController extends Controller {

    public $layout = "main";


    public function behaviors() {
        return [
            'access' => Yii::$app->params['pageAccess']['refund']
        ];
    }


    public function actionIndex()
    {


        $refundApi = new RefundApi();

        $refundDataProvider = $refundApi->getRefundOrders();

        return $this->render('/aftersales/index',['refundDataProvider'=>$refundDataProvider,]);
    }



    public function actionAdd()
    {
        $request = Yii::$app->request;

        if($request->isGet){


            $orderId = $request->get('orderId');


            if($orderId == null){
                throw new NotFoundHttpException;
            }

            $orderAPI = new OrderApi();

            $order = $orderAPI->getOrderDetail($orderId)['order'];



            //**** check can be returned or not
            $cantNotRefundStatus = ['CREATED','CREATING','PAID','SCHEDULED','RELEASED',];


            if(in_array($order['orderStatus'],$cantNotRefundStatus)){
                throw new NotFoundHttpException();
            }


            Yii::$app->response->headers->set('Cache-Control','no-store');
            Yii::$app->response->headers->set('Expires',0);
            Yii::$app->response->headers->set('Pragma','no-cache');
            
            return $this->render('/aftersales/request-refund',['order'=>$order,]);



        }elseif($request->isPost){



            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;


            $refundApi = new RefundApi();
            $refundApi->scenario = RefundApi::SCENARIO_CREATE;

            $refundApi->loadRefundInfo($request->post());



            //try{
                $data = $refundApi->createRefundOrder();

                //debug
                //$data['code'] = 200;
                //return $data;
                //debug

                $key = key($data);
                $data = $data[$key];
            //}catch(HttpException $e){
            //    return $this->dealException($e);
            //}



            $return = [];

            $return['status'] = '200';

            $omsOrderId = $data['OrderHeaderKey'];

            $return['url'] = Url::to(['aftersales/detail','refundId'=>$omsOrderId]);

            return $return;


        }


    }





    public function actionDetail()
    {

        $request = Yii::$app->request;

        $refundId = $request->get('refundId');

        if($refundId == null ){
            throw new NotFoundHttpException();
        }


        $refundApi = new RefundApi();
        $refundApi->refund_id = $refundId;
        $refundApi->scenario = RefundApi::SCENARIO_UPDATE;





        if($request->isGet){

            $detail = $refundApi->getDetail($refundId);
            //return json_encode($detail);
            $refundLog = $refundApi->getRefundLog($refundId);
            //return var_dump($refundLog);

            $typeMap = Yii::$app->params['sm']['refund']['typeMap'];



            //status |已创建|审批已通过|等待仓库收货|等待退款|退单已完成|退单已取消|已下达
            $statusMap = Yii::$app->params['sm']['refund']['statusMap'];
            $detail['Status'] = $statusMap[$detail['Status']] ;



            $detail['CarrierCharge']='';

            foreach( $detail['References']['Reference'] as $reference ){

                if($reference['Name']=='order_remark'){
                    $detail['ReturnType'] = isset($typeMap[$reference['Value']])?$typeMap[$reference['Value']]:null;
                }

                if($reference['Name']=='order_comment'){
                    $detail['Comment']=$reference['Value'];
                }

                if($reference['Name']=='charge_ship_reverse'){
                    $detail['CarrierCharge']=$reference['Value'];
                }

                if($reference['Name']=='refund_completed'){

                    if($reference['Value'] == true){
                        $detail['Status'] = '退单已完成';
                    }


                }

            }



            //set status bar

            $statusBar = [];

            switch($detail['Status']){
                case '已创建': $statusBar=['dot','notready','notreadyAndPre','notreadyAndPre']; break;
                case '审批已通过': $statusBar=['dot','ready','notready','notreadyAndPre']; break;
                case '等待仓库收货': $statusBar=['dot','ready','ready','notready']; break;
                case '等待退款': $statusBar=['dot','ready','ready','notready']; break;
                case '退单已完成': $statusBar=['dot','ready','ready','ready']; break;
                case '退单已取消': $statusBar=['dot opacity','ready opacity','ready opacity','ready opacity']; break;
                default: $statusBar=['dot opacity','ready opacity','ready opacity','ready opacity'];
            }

           

            //去除组合商品中的子商品
            foreach($detail['OrderLines']['OrderLine'] as $key => $item ){
                if( isset($item['BundleParentLine']) && $item['IsBundleParent']=='N' ){
                    unset($detail['OrderLines']['OrderLine'][$key]); 
                }
            }


            return $this->render('/aftersales/detail',['detail'=>$detail,'statusBar'=>$statusBar,'model'=>$refundApi,'refundLog'=>$refundLog,]);


        }elseif($request->isPost){


            $refundApi->loadShippingInfo($request->post());
            $result = $refundApi->validate();

            if(!$result){
                Yii::$app->session->setFlash('ship-error','快递信息不完整');
                return $this->redirect( Url::to(['aftersales/detail','refundId'=>$refundId]), 200);
            }

            $data = $refundApi->updateReturnInfo($refundId);


            //return var_dump($data);

            return $this->redirect( Url::to(['aftersales/detail','refundId'=>$refundId]), 200);

        }

    }

}