<?php



namespace frontend\models;

use Yii;
use common\models\BaseApi;
use common\helpers\Tools;
use yii\data\ArrayDataProvider;

/**
 * 用于请求其他数据的基类
 */



/**
 * @return stub
 *
 *   userid
 *   shippingReceiverName
 *   image_files
 *   refund_type
 *   token
 *
 *
 */




class RefundApi extends BaseApi
{

    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public $refund_id;
    public $service_type;
    public $products;
    public $description;
    public $image_files;

    public $currency;
    public $owner_id;
    public $oms_order_id;



    public $carrier_name;
    public $carrier_number;
    //public $shipping_amount;

    private $_baseUrl;









    /**
     * 验证器，验证规则
     * @return type
     */
    public function rules()
    {
        return [
            [['service_type', 'products', 'descrption','currency','oms_order_id','owner_id'], 'required', 'on' => [self::SCENARIO_CREATE],'message' => '此项为必填'],

            [['refund_id', 'carrier_name', 'carrier_number'], 'required', 'on' => [self::SCENARIO_UPDATE], 'message' => '此项为必填'],

            [['refund_id', 'carrier_number'], 'integer', 'on' => [self::SCENARIO_UPDATE], 'message' => '此项应为整数'],


        ];
    }



    /**
     * 只有在这里的属性，才会在对应的场景中可以用
     * @return type
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = ['service_type','products','description','image_files','currency','oms_order_id','owner_id'];
        $scenarios[self::SCENARIO_UPDATE] = ['refund_id', 'carrier_name', 'carrier_number'];
        return $scenarios;
    }


    public function __construct()
    {
        $userId = Yii::$app->user->getId();
        parent::__construct($userId);
        //pesdo
        //$userId = 'mark';
        //-pesdo

        $this->owner_id = $userId; //一期operatorId和buyerId是同一个，所以这样设计是ok的。后期需求有变化再改动。
        //$this->document_type = '0003';

        $this->_baseUrl = Yii::$app->params['sm']['refund']['baseUrl'];
//        $header = ['X-dbecom-OperatorId:'.$this->owner_id, 'X-dbecom-AppId:Web'];
        $header[] =Yii::$app->params['sm']['refund']['authorization'];
        $this->header = array_merge($this->header,$header);

    }





    public function loadRefundInfo($data){

        $this->oms_order_id = $data['oms_order_id'];
        $this->currency = $data['currency'];
        $this->service_type = $data['service_type'];
        $this->description = $data['content'];
        $this->products = array();
        $this->image_files = array();


        $items = isset($data['images'])?$data['images']:array();

        foreach($items as $item){
            $e = array();
            $e['url'] = explode('?',$item)[0];
            array_push($this->image_files,$e);
        }



        $items = $data['products'];

        foreach($items as $item){
            $e = array();
            $e['orderLineId'] = $item;
            $e['quantity'] = $data['product_'.$item.'_num'];
            array_push($this->products,$e);
        }

    }


    //create refund order
    public function createRefundOrder(){


        $fragmentUrl='executeFlow/CreateReturnFromStorefront';
        $url = $this->_baseUrl.$fragmentUrl;



        $params = [];
        $params['orderId'] = $this->oms_order_id;
        $params['type'] = $this->service_type;
        $params['buyerId'] = $this->owner_id;
        $params['comment'] = $this->description;
        $params['currency'] = $this->currency;
        $params['buyerId']=$this->owner_id;



        $params['imageList'] = array();
        $params['imageList']['image']=$this->image_files;


        $params['orderLineList'] = array();
        $params['orderLineList']['orderLine'] = $this->products;

        //debug
        //return $params;
        //debug

        $data = $this->create( array('result'=>$url) ,$params);


        return $data;
    }





    public function getRefundOrders(){



        $fragmentUrl = 'Order?sort(-Createts)&DocumentType=~eq~0003&BuyerUserId=~eq~'.$this->owner_id;
        $url = $this->_baseUrl.$fragmentUrl;



        $data = $this->get(array('result'=>$url),array())['result'];



        $provider = new ArrayDataProvider([
                'allModels' => $data
        ]);


        return $provider;



    }


    public function getDetail($id){

        $fragmentUrl = 'CompleteOrder/';
        $url = $this->_baseUrl.$fragmentUrl.$id;


        $data = $this->get(array('result'=>$url),array())['result'];


        return $data;


    }



    public function loadShippingInfo($data){
        $this->load($data);
    }


    public function updateReturnInfo($refundId){


        $fragmentUrl='executeFlow/UpdateReturnFromStorefront';
        $url = $this->_baseUrl.$fragmentUrl;


        $params = array();
        $params['returnId'] = $refundId;
        $params['carrierName'] = $this->carrier_name;
        $params['carrierNumber'] = $this->carrier_number;





        $data = $this->create( array('result'=>$url) ,$params)['result'];


        return $data;



    }


    public function getRefundLog($refundId){

        $fragmentUrl='executeFlow/GetOrderFulfillmentLog';
        $url = $this->_baseUrl.$fragmentUrl;


        $params = array('orderId'=>$refundId);

        $data = $this->create( array('result'=>$url) ,$params)['result'];

        $data = $data['OrderFulfillmentLog'];


        return $data;

    }


    public function callErrorProcess($errorCode = '99001', $errorMsg = '', $errorAll = '')
    {
        $data = Tools::error($errorCode, $errorMsg, $this->format, 'BaseApi', $errorAll);

    }



}
