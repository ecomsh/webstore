<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace common\models;

use Yii;
use common\models\BaseApi;
use common\models\ProductBaseApi;
use common\models\CartBaseApi;
use common\data\APIDataProvider;
use common\models\ValidateBaseApi;
use common\helpers\Tools;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;

/**
 * 用于请求订单数据的基类
 */
class OrderBaseApi extends BaseApi
{

    const NO_ERROR_CODE = '06013';  //库存冻结失败
    const NO_IN_ERROR_CODE = '07003'; //库存失败  （此处请后端告知，为啥有两种）todo  20150907

    public $channelId;
    public $channelType;
    public $carrierId;
    public $carrierName;
    public $buyerId;
    public $paymentType;
    public $expDeliveryDate;
    public $requestShippingDate;
    public $shipAddressNickName;
    public $shipAddress;
    public $shipAddressId;
    public $shipReceiverName;
    public $shipReceiverMobile;
    public $shipReceiverPhone;
    public $shipReceiverEmail;
    public $shipCountryCode;
    public $shipCountryName;
    public $shipStateCode;
    public $shipStateName;
    public $shipCityCode;
    public $shipCityName;
    public $shipDistrictCode;
    public $shipDistrictName;
    public $shipPostcode;
    public $shipType;
    public $shipCustomField;
    public $shipInst;
    public $currency;
    public $invType;
    public $invNo;
    public $invCode;
    public $invCategory;
    public $invName;
    public $invComment;
    public $orderComment;
    public $couponId;
    public $cartlineId;
    public $cartlineDTOList;
    public $params = [];
    private $_baseUri;
    private $_baseCartUri;
//    private $_operatorId;

    public function __construct($operatorId = '')
    {
        parent::__construct($operatorId);
        $this->_baseCartUri = Yii::$app->params['sm']['cart']['baseUrl'];
        $this->_baseUri = Yii::$app->params['sm']['order']['baseUrl'];
//        $this->operatorId = $operatorId ? $operatorId : 'anonymousUser';
//        $header = ['X-dbecom-OperatorId:' . $this->operatorId, 'X-dbecom-AppId:Web'];
//        $this->header = array_merge($header, $this->header);
    }

    public function rules()
    {
        return [
            [['buyerId', 'paymentType', 'shipAddress', 'shipReceiverName', 'shipReceiverMobile', 'shipCountryCode', 'shipCountryName', 'shipStateCode', 'shipStateName', 'shipCityCode', 'shipCityName', 'shipDistrictCode', 'shipDistrictName', 'shipType', 'shipInst', 'currency', 'invType'], 'required'],
            [['shipReceiverMobile', 'shipStateCode', 'shipCityCode', 'shipPostcode', 'shipInst'], 'integer'],
//            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
//            [['auth_key'], 'string', 'max' => 32]
        ];
    }

    /**
     * 提交订单
     */
    public function SubmitOrder($params = array())
    {
        $tmp_url = $this->_baseCartUri . '_submit';
        return $this->create(['order' => $tmp_url], $params);
    }

    /**
     * 直接购买，提交订单
     * 
     */
    public function directSubmitOrder($params = array())
    {
        $tmp_url = $this->_baseCartUri . '_directSubmit';
        return $this->create(['order' => $tmp_url], $params);
    }

    /**
     * 查看买家的订单列表
     */
    public function getOrderList($buyerId = '')
    {
        $tmpbuyerId = $buyerId ? $buyerId : $this->operatorId;
        $tmp_url = $this->_baseUri . '?buyerId=' . $tmpbuyerId;
        return $this->get(['order' => $tmp_url], [], 'GET');
    }

    /**
     *查看买家需要补全地址的列表  
     */
        public function getnoAddrOrderList($buyerId = '')
    {
        $tmpbuyerId = $buyerId ? $buyerId : $this->operatorId;
        $tmp_url = $this->_baseUri . 'noAddressOrders/' . $tmpbuyerId;
        return $this->get(['order' => $tmp_url], [], 'GET');
    }
    
    /**
     * 查看某个订单详情
     */
    public function getOrderDetail($orderid)
    {
        $tmp_url = $this->_baseUri . $orderid;
        return $this->get(['order' => $tmp_url], [], 'GET');
    }



    /**
     * 查看某个订单是否被支付
     */
    public function checkIsPaid($orderid){

        $orderDetail = $this->getOrderDetail($orderid);
        $orderDetail = $orderDetail['order'];
        if( in_array($orderDetail['orderStatus'], ['CREATED','CREATING'])){
            return false;
        }else{
            return true;
        }
    }


    /**
     * 获取某个订单操作日志
     */
    public function getOrderLog($orderid)
    {
        $tmp_url = $this->_baseUri . $orderid . '/logs';
        return $this->get(['order' => $tmp_url], [], 'GET');
    }

    /**
     * 取消订单
     */
    public function CancelOrder($orderid)
    {
        $tmp_url = $this->_baseUri . $orderid . '/_cancel';
        return $this->create(['order' => $tmp_url], []);
    }

    /**
     * 确认收货
     */
    public function ConfirmRcvOrder($orderid)
    {
        $tmp_url = $this->_baseUri . $orderid . '/_confirmReceived';
        return $this->create(['order' => $tmp_url], []);
    }

    /**
     * 查看买家的订单列表
     * params = [
     *              'sortType' => 'desc',                   //排序
     *              'orderStatus' => 'CREATED-CREATING',    //筛选状态，以-分隔
     *              'createDate' => 2015-12-23,             //查询创建时间之后的订单
     *          ]
     */
    public function getOrderDataProvider($pagesize = 20, $params = array(), $buyerId = '')
    {
        $tmpbuyerId = $buyerId ? $buyerId : $this->operatorId;
        $tmp_url = $this->_baseUri . '?buyerId=' . $tmpbuyerId;
        $provider = new APIDataProvider([
            'url' => $tmp_url,
            'key' => 'orderId',
            'pageKey' => 'pageInfo',
            'header' => $this->header, //TODO is that ok?
            'dataKey' => 'result',
            'pagination' => [
                'pageSize' => $pagesize,
            ],
            'params' => $params,
        ]);
        return $provider;
    }
    /*
     * @input 
     * $params = [      //required
     *     'channelId' = xxx,
     *     'startDate' = xxx,
     *     'endDate' = xxx, 
     * ]
     * $pagesize //每页条目数
     *     
     */
        public function getOrdersbyChannel($params, $pagesize = 20) {
        $tmp_url = $this->_baseUri . 'channelOrderList?';
        $provider = new APIDataProvider([
            'url' => $tmp_url,
            'key' => 'orderId',
            'pageKey' => 'pageInfo',
            'header' => $this->header, //TODO is that ok?
            'dataKey' => 'result',
            'pagination' => [
                'pageSize' => $pagesize,
            ],
            'params' => $params,
        ]);
        return $provider;
        
        
    }

    public function callErrorProcess($errorCode = '99001', $errorMsg = '', $errorAll = '')
    {
        $data = Tools::error($errorCode, $errorMsg, [self::NO_ERROR_CODE => 'raw', self::NO_IN_ERROR_CODE => 'raw'], 'BaseApi', $errorAll);

        if (is_array($data))
        {
            if (isset($data['errorMsg']))
            {
                $_NII = explode(':', $data['errorMsg']);
                $_tmp_NII = explode(',', $_NII[1]);
                $NII['itemPartNumber'] = $_tmp_NII[0]; //#todo, bug need fix
                $NII['itemOwnerId'] = $_tmp_NII[1];
                $NII['shipStateName'] = $this->shipStateName;
                $NII['shipStateCode'] = $this->shipStateCode;
                $NII['shipCityName'] = $this->shipCityName;
                $NII['shipCityCode'] = $this->shipCityCode;
                Yii::$app->cache->set('__NII' . $NII['itemPartNumber'] . $this->shipStateCode, $NII, 3600);
                Yii::$app->cache->set('__NII'.Yii::$app->user->id, ['ipn'=>$NII['itemPartNumber'], 'ssc' => $this->shipStateCode],3600);  //这个是为了得到上面一行的key
                $data['errorMsg'] = '商品缺货，请从购物车删除再提交';
            }
            Yii::$app->response->format = 'html';
            throw new BadRequestHttpException($data['errorMsg'], $errorCode);
        } else
        {
            return $data;
        }
    }
    
    /*
     * 根据订单id更新对应的送货地址。
     * @input: 
     * $orderid -- orderid
     * $addrParam => [     //所有参数都必须传，因为这些参数会覆盖order里面的地址信息。若不传，则对应的字段会被null覆盖。
     *      "address" => "xxx",
     *      "receiverName" => "xxx",
     *      "receiverMobile" => "xxx",
     *      "receiverPhone" => "xxx",
     *      "stateCode" => "xxx",
     *      "stateName" => "xxx",
     *      "cityName" => "xxx",
     *      "cityCode" => "xxx",
     *      "districtCode" => "xxx",
     *      "districtName" => "xxx",
     *      "countryCode" => "xxx",
     *      "countryName" => "xxx",
     *      "postcode" => "xxx"
     * ]
     * $buyerid -- buyerid //optional
     *      
     */
    public function updateShippingByOrderid($orderid, $addrParams, $buyerId = '')
    {
        $tmpbuyerId = $buyerId ? $buyerId : $this->operatorId;
        $tmp_url = $this->_baseUri . $orderid . '/_updateShippingInfo';
        return $this->update($tmp_url, $addrParams);
    }
    
    public function getPackageChildren($orderList){
        $cache = Yii::$app->cache;
        $productModel = new ProductBaseApi();
        $packageChildren = Array();
        
        foreach($orderList as $orderLineList){
            foreach($orderLineList['orderLineList'] as $itemKey => $item){
                if($item['itemType'] == 'package'){
                    $itemCache = $cache->get("csrp_".$item['itemId']);
                    if($itemCache === FALSE){
                        $itemIds[] = $item['itemId'];
                    }else{
                        $packageChildren[$item['itemId']] = $itemCache;
                    }
                }
            }
        }
        
        if(!empty($itemIds)){
            $itemCache = $productModel->filterInfoFromByids($itemIds);
            $packageChildren = ArrayHelper::merge($packageChildren, $itemCache);
        }
        return $packageChildren;
    }
    
    public function submitValidate($cartLineIds,$orderAmount,$buyerId = ''){
        $tmpbuyerId = $buyerId ? $buyerId : $this->operatorId;
      
        $validateModel = new ValidateBaseApi();
        $cartModel = new CartBaseApi($tmpbuyerId);
        $productModel = new ProductBaseApi($tmpbuyerId);
        
        $cartInfo = $cartModel->getCartLinebyIds($cartLineIds);
        //将购物车的二维数组变成一维方便处理
        $keys = array_keys($cartInfo);
        if(!$cartInfo){
            Tools::error('99041', '购物车不存在，或者已经被结算！');exit;//#todo 这个地方有个bug，未完全fix  1119 added by hzl
        }
        $cartInfo = $cartInfo[$keys[0]];
        $itemIds = ArrayHelper::getColumn($cartInfo, 'itemId');
        $productInfo = $productModel->getProductByIds($itemIds,['min_buy_count','max_buy_count','sales_type']);
        $productInfo = ArrayHelper::index($productInfo['product'], 'id');
         
        $validateModel->scenario = 'all';
        foreach($cartInfo as $val){
            $params['ValidateBaseApi'] = [
                'minBuyCount' => $productInfo[$val['itemId']]['minBuyCount'], 
                'maxBuyCount' => $productInfo[$val['itemId']]['maxBuyCount'], 
                'buyable' => $productInfo[$val['itemId']]['buyable'], 
                'quantity' => $val['cartlineQuantity'],
                'salesType' => $productInfo[$val['itemId']]['salesType'], 
                'orderAmount' => $orderAmount
            ];
            
            if($validateModel->load($params) && $validateModel->validate()){
                return true;
            }else{
                $validateModel->setErrors();
                return false;
            }
        }
    }
}
