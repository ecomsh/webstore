<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace common\models;

use Yii;
use common\models\BaseApi;
use common\helpers\Tools;
use yii\helpers\ArrayHelper;

/**
 * 用于请求购物车的基类
 * #TBD yyjia, addtocart might need to modify.
 */
class CartBaseApi extends BaseApi
{

    public $itemId;
    public $cartlineQuantity;
    public $shopId;
    public $itemListPrice;
    public $itemOfferPrice;
    public $tariffno;
    public $cartlineId;
    public $cartlineType;
    public $cartlineComment;
    public $channelType;
    public $channelId;
    public $shopDisplayText;
    public $shopLink;
    public $shopContactId;
    public $itemPartNumber;
    public $itemOwnerId;
    public $itemPriceListId;
    public $itemDisplayText;
    public $itemLink;
    public $itemImageLink;
    public $userId;
    public $itemSalestype;
    public $extensionData;
    public $itemMfname;
    public $itemWeight;
    public $itemVolumn;
    public $isGift;
    public $_baseUri; //need to change to private when frontend module is fixed.
    public $minBuyCount; //To validate cartlineQuantity
    public $maxBuyCount; //To validate cartlineQuantity
    public $buyable; //To validate cartlineQuantity

    public function __construct($operatorId='')
    {
        parent::__construct($operatorId);
        $this->_baseUri = Yii::$app->params['sm']['cart']['baseUrl'];
    }

    public function rules()
    {
        return [
            [['itemId', 'cartlineQuantity', 'itemOfferPrice','itemPriceListId','cartlineType', 'shopDisplayText', 'userId', 
                'shopContactId',  'itemListPrice', 'channelType', 'channelId', 'itemOwnerId', 'itemLink', 'itemImageLink', 'itemSalestype',
                'shopId', 'shopLink', 'itemWeight', 'itemVolumn', 'itemPartNumber', 'tariffno', 'minBuyCount', 'maxBuyCount', 'buyable'], 'required'],// 'itemDisplayText',先去了测试
//            [['cartlineQuantity', 'shopId', 'tariffno'], 'integer'],
            [['cartlineQuantity'], '\common\validators\ItemQtyValidator'],
        ];
    }
    /**
     * 加入购物车
     */
    public function addToCart($params = array()){
        $tmp_url = $this->_baseUri . 'cartline';
        return $this->create(['cart' =>$tmp_url], $params);
    }
    /**
     * 查看购物车，由于会有代客下单的情况，所以buyer ID不一定等于operator ID(login user).
     */
    public function getCartList($BuyerId = ''){
        $tmpbuyerId = $BuyerId? $BuyerId:$this->operatorId;
        $tmp_url = $this->_baseUri  . $tmpbuyerId;
        return $this->get(['cart' => $tmp_url], [], 'GET');
    }
    /**
     * 计算购物车价格
     */

    public function caculateCartPrice($params = array(), $BuyerId = ''){
        $tmpbuyerId = $BuyerId? $BuyerId:$this->operatorId;
        $tmp_url = $this->_baseUri  . $tmpbuyerId . '/_calculation'; 
        
        if(isset($_COOKIE['promotion']))
        {
            $params['promotion'] = $_COOKIE['promotion'];
        }
        return $this->create(['cart' =>$tmp_url], $params);
    }
    
    /**
     * 获得购物车可用couponid，入参与计算价格类似。需要传入couponids信息
     */

    public function checkCouponsValidity($params, $BuyerId = ''){
        $tmpbuyerId = $BuyerId? $BuyerId:$this->operatorId;
        $tmp_url = $this->_baseUri  . 'getCoupons';        
        return $this->create(['cart' =>$tmp_url], $params);
    }
    
    public function deleteById($id)
    {
        $tmp_url = $this->_baseUri . 'cartline/' . $id;
        return $this->delete(['cart' =>$tmp_url]);
    }
    /**
     * 根据CartlinId更新购物车中对应的商品数量。
     * input params:
     * $id -- cartlineid
     * $quantity -- 商品数量
     * $tariffno -- 税则号，对应商品详情页返回的taxSerialNumber
     */
    public function updateQTYById($id, $quantity,$tariffno)
    {
        $tmp_url = $this->_baseUri . 'cartline/' . $id . '/' . 'cartlineQuantity';
        $params = ['cartlineQuantity'=>$quantity, 'cartlineId'=>$id, 'tariffno' => $tariffno];
        return $this->update(['cart' => $tmp_url], $params);
    }
    
     /**
     * 根据CartlinId返回对应的Cartline信息。
     */
    public function getCartLinebyIds($ids = array())
       {
            $data = $this->getCartList($this->operatorId);
            $key = key($data);
            $data = isset($data[$key]) ? $data[$key] : [];
            $CartLines = array();
            if(!empty($data))
            {
                foreach ($data as $k => $v)
                {
                    $CartLine = array();
                    foreach($v as $value)
                    {
                        if (isset($value['cartlineId']) && in_array($value['cartlineId'], $ids))
                        {
                           $CartLine[] = $value;
                        }
                    }
                    if (!empty($CartLine))
                    {
                        $CartLines[] = $CartLine; //Different itemSalestype things should in different arrays.
                    }                
                }
            }
            $CartLines = ArrayHelper::index($CartLines, function ($element) {
                return $element[0]['itemSalestype'];
            });
            return $CartLines;
       }
       
    // 计算价格的核心
    public function calculatePriceCore($postData,$dtoModel, $userId='') 
        {
        $userId = $userId ? $userId : $this->operatorId;
        if (isset($postData['cartlineIds'])) {
            $Ids = explode(',', $postData['cartlineIds']);
            $data = $this->getCartLinebyIds($Ids);
            ArrayHelper::remove($postData, 'cartlineIds');
        } else if (isset($postData['dtoItemsInfo'])) { //直接下单使用 cartlines放空    
            
            $postData['dtoItemsInfo'] = json_decode($postData['dtoItemsInfo'], true);
            $data[] = $dtoModel->getDTOInfo($postData['dtoItemsInfo'])['DTOinfo'];
            ArrayHelper::remove($postData, 'dtoItemsInfo');
        } else {
            $data = $this->getCartList($userId)['cart'];
        }
        ArrayHelper::remove($postData, '_csrf');
        $postData['cartlineList'] = Tools::getColumn($data);
        $result = $this->priceResultPreprocess($postData);
        return $result;
    }

    // 对价格API返回的结果进行处理 dcj 10.27
       public function priceResultPreprocess($config){
//          print_r(json_encode($config));
//          exit;
        //ArrayHelper::remove($config, '_csrf');
        $quantity = ArrayHelper::map($config['cartlineList'],'itemId', 'cartlineQuantity');
        $offerPrice = ArrayHelper::map($config['cartlineList'],'itemId', 'itemOfferPrice');
        $price = $this->caculateCartPrice($config)['cart'];
            if(is_array($price) && isset($price['itemDetail']) && isset($price['orderDetail']) && isset($price['total']))
            {
                $itemDetail = $price['itemDetail'];
                $orderDetail = $price['orderDetail'];
                foreach ($itemDetail as $itemId => $idetail) {
                    $itemDetail[$itemId]['itemTax'] = number_format($idetail['itemTax'],2,'.','');
                    $itemDetail[$itemId]['unitPrice'] = number_format($idetail['unitPrice'],2,'.','');
                    $itemp = $this->getItemPromotionInfo($idetail,$quantity[$itemId],$offerPrice[$itemId]);
                    $itemDetail[$itemId] = ArrayHelper::merge($itemDetail[$itemId], $itemp);
                }
                foreach ($orderDetail as $orderKey => $odetail) {
                    $orderDetail[$orderKey]['originalPrice'] = number_format($odetail['originalPrice'],2,'.','');
                    $orderDetail[$orderKey]['promotion'] = number_format($odetail['promotion'],2,'.','');
                    $orderDetail[$orderKey]['shipping'] = number_format($odetail['shipping'],2,'.','');
                    $orderDetail[$orderKey]['tax'] = number_format($odetail['tax'],2,'.','');
                    $orderDetail[$orderKey]['realTax'] = number_format($odetail['realTax'],2,'.','');
                    
                    if($config['shipping'] === 'false'){
                        $orderDetail[$orderKey]['actualPrice'] = number_format($odetail['actualPrice']+$odetail['realTax'],2,'.','');
                    }else{
                        $orderDetail[$orderKey]['actualPrice'] = number_format($odetail['actualPrice']+$odetail['realTax']+$odetail['shipping'],2,'.','');
                    }
                    if(in_array(Tools::getSalesType($orderKey), Yii::$app->params['sm']['store']['isCBT'])
                            && $orderDetail[$orderKey]['originalPrice'] - $orderDetail[$orderKey]['promotion'] > Yii::$app->params['sm']['store']['maxAmount']
                            && ($orderDetail[$orderKey]['itemNum'] > 1
                            || $orderDetail[$orderKey]['itemCategoryNum'] > 1)){//只有两个值都是1（单品单件）的情况下才能提交
                        $orderDetail[$orderKey]['canSubmit'] = 0;
                    }else{
                        $orderDetail[$orderKey]['canSubmit'] = 1;
                    }
                    $orderp = $this->getOrderPromotionInfo($odetail['promotionDetail']);
                    $orderDetail[$orderKey] = ArrayHelper::merge($orderDetail[$orderKey], $orderp);
                    
                }
                $price['itemDetail'] = $itemDetail;
                $price['orderDetail'] = $orderDetail;
                $price['total']['originalPrice'] = number_format($price['total']['originalPrice'],2,'.','');
                $price['total']['promotion'] = number_format($price['total']['promotion'],2,'.','');
                $price['total']['shipping'] = number_format($price['total']['shipping'],2,'.','');
                $price['total']['tax'] = number_format($price['total']['tax'],2,'.','');
                if($config['shipping'] === 'false'){
                    $price['total']['actualPrice'] = number_format($price['total']['actualPrice']+$price['total']['realTax'],2,'.','');
                }else{
                   $price['total']['actualPrice'] = number_format($price['total']['actualPrice']+$price['total']['realTax']+$price['total']['shipping'],2,'.','');
                 
                }
                return $price;
           }else{
               return [];
           }
       }
       //获取订单级优惠信息
       private function getOrderPromotionInfo($promotionDetail) {
           $result = array();
           if(!empty($promotionDetail)){
                foreach ($promotionDetail as $key => $promotion) {
                    if($promotion['deltaorderprice']<0){
                        $result['orderPromotionName'][] = $promotion['name'];
                    }
                    if($promotion['deltafreight']<0){
                        $result['orderFreeShipment'] = $promotion['name'];
                    }
                }
           }
           //$result['orderPromotionName'][] = 'test1';
           //$result['orderPromotionName'][] = 'test2';
           return $result;
       }
       //获取商品级优惠信息
       private function getItemPromotionInfo($itemDetail,$quantity,$offerPrice) {
           $result = array();
           if(!empty($itemDetail['itemPromotionDetail'])){
                foreach ($itemDetail['itemPromotionDetail'] as $k => $v) {
                    if($v['deltaitemprice']<0){ // 有商品直降
                        $result['directCutName'] = $v['name'];
                        $result['newUnitPrice'] = number_format($itemDetail['unitPrice']+($v['deltaitemprice']/$quantity),2,'.','');
                        $result['savePrice'] = number_format(($offerPrice - $result['newUnitPrice']) * $quantity,2,'.','');
                        $result['newTotalPrice'] = number_format(($result['newUnitPrice']) * $quantity,2,'.','');
                        $result['deltaItemPrice'] = number_format(-$v['deltaitemprice'],2,'.','');
                    }
                    if($v['deltafreight']<0){//有单品包邮
                        $result['itemFreeShipment'] = '单品包邮';
                    }                              
                }
                
            }
            if(! isset($result['savePrice'])){
                    $result['savePrice'] = number_format(($offerPrice - $itemDetail['unitPrice']) * $quantity,2,'.','');
                    $result['newTotalPrice'] = number_format(($itemDetail['unitPrice']) * $quantity,2,'.','');
            }
            return $result;
       }
    //构建拆单的key dcj 10.27
    private function innerF($element) {
        if (in_array($element['salesType'], Yii::$app->params['sm']['store']['needmfName'])) {
            return $element['salesType'] . '_' . $element['manufactureName'];
        } else {
            return $element['salesType'] . '_';
        }
    }
    // 获取需要从搜索拿到的各种信息 dcj 10.27
    // 如果当天已经有商品被缓存过了，再次主调用这个函数是否会重复缓存？
    public function getExtraInfoFromSearch($productModel,$sourceData, $Ids, $userId = '') {
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $userId = $userId? $userId : $this->operatorId;
        $cache = Yii::$app->cache;
        $data = $sourceData;
        //$productData = $productModel->getProductByIds($Ids);
//        $productData = $productModel->getProductByIds(['2049']);
//        print_r($productData);
//        exit;
        
        $resultExtroInfo = $productModel->filterInfoFromByids($Ids);
        foreach ($data as $type => $items) {
                foreach ($items as $key => $value) {
                    if (isset($resultExtroInfo[$value['itemId']])){
                        $data[$type][$key] = array_merge($data[$type][$key], $resultExtroInfo[$value['itemId']]);
                    } else {
                        $data[$type][$key]['buyable'] = 0;
                        $data[$type][$key]['taxRate'] = 0;
                        $errorInfo = '购物车数据异常：购物车数据和搜索数据不一致 userId = ' . $userId . 'itemId = ' . $value['itemId'].' type= '.$type;  
                        Yii::error($errorInfo);
                    }
                    $data[$type][$key]['itemPartNumber'] = trim($value['itemPartNumber']);
                    setcookie('inv_'.$data[$type][$key]['itemPartNumber'], null, time() - 3600, '/');
                }
            //$data['1_'][0]['N'] = 'x';
//                if($type == '1_'){
//            $data['1_'][1]['N-tagKey'] = '10027';
//            $data['1_'][3]['N-tagKey'] = '10027';
//            //$data['1_'][0]['N'] = 'y';
//            $data['1_'][2]['N-tagKey'] = '10008';
//                $this->reGroupCartLine($data['1_']);
//                
//                }
            $this->reGroupCartLine($data[$type]);    
        }
//        $data['1_'][0]['sdf'] = 'Nyuan';
//        $test = ArrayHelper::map($data['1_'], 'sdf', 'cartlineId');
        //print_r($data);
        //exit;
        return $data;
    }

  
    //检查是否可以提交
    public function canCheckOut($InventoryModel,$productModel,$Ids, $userId) {

        $sourceData = $this->getCartLinebyIds($Ids);
        $data = Tools::getColumn($sourceData);
        if (!is_array($data)) {
            return ['canCheckOut' => false, 'errorCode' =>4 ];
        }
        $inventoryParamInfo = array();
        $needQuantity = array();
        $itemidMapPartnum = array();
        $itemIds = array();
        
        foreach ($data as $key => $item) {
            //查库存需要的参数
            $inventoryParamInfo[$item['itemPartNumber']] = $item['itemOwnerId'];
            //购物车中 顾客想买的数量
            $needQuantity[$item['itemPartNumber']] = $item['cartlineQuantity'];
            //partnum 和 itemId的 对应
            $itemidMapPartnum[$item['itemPartNumber']] = $item['itemId'];
            $itemIds[] = $item['itemId'];
        }
        $inventoryParam = array();
        $inventoryParam['itemInfo'] = $inventoryParamInfo;
        $inventoryParam['shop'] = 'ftzmall';
        $resultExtroInfo = $productModel->filterInfoFromByids($itemIds);
        $inventory = $InventoryModel->ckeckInventorys($inventoryParam);
        foreach ($needQuantity as $ipn => $nq) {
            // 购买数量大于库存
            if (isset($inventory[$ipn]) && $nq > $inventory[$ipn]) {
                return ['canCheckOut' => false, 'itemId' => $itemidMapPartnum[$ipn], 'errorCode' =>1 ];
            }
            if(isset($resultExtroInfo[$itemidMapPartnum[$ipn]])){
                // 低于起购数量
                if (isset($resultExtroInfo[$itemidMapPartnum[$ipn]]['minBuyCount']) && $nq < $resultExtroInfo[$itemidMapPartnum[$ipn]]['minBuyCount']) {
                    return ['canCheckOut' => false, 'itemId' => $itemidMapPartnum[$ipn], 'errorCode' => 2];
                }
                //高于限购数量
                if (isset($resultExtroInfo[$itemidMapPartnum[$ipn]]['maxBuyCount']) && $nq > $resultExtroInfo[$itemidMapPartnum[$ipn]]['maxBuyCount']) {
                    return ['canCheckOut' => false, 'itemId' => $itemidMapPartnum[$ipn], 'errorCode' => 3];
                }
            }
        }
        return  ['canCheckOut' => true];
    }
    function deleteCartLine($deleteData) {
        
        $data = $this->deleteById($deleteData['cartlineId']);
        if ($data['cart']['cartlineId'] === $deleteData['cartlineId']) {
            $result['status'] = 'c200';
            $cartNum = unserialize($_COOKIE['cartNum']);
            $totalNum = $_COOKIE['totalNum'] - 1;
            $cartNum[$deleteData['itemSalestype']] = $cartNum[$deleteData['itemSalestype']] - 1;
            if ($totalNum < 1) {
                setcookie('totalNum', null, time() - 3600, '/', null, false, true);
                setcookie('cartNum', null, time() - 3600, '/', null, false, true);
                $result['isTotalEmpty'] = 1;
            } else if ($cartNum[$deleteData['itemSalestype']] < 1) {
                $cartNum[$deleteData['itemSalestype']] = 0;
                $result['isEmpty'] = 1;
            }else{
                setcookie('totalNum', $totalNum, 0, '/', null, false, true);
                setcookie('cartNum', serialize($cartNum), 0, '/', null, false, true);
            }
        }
        else {
            $result['errorCode'] = 'c500';
            $result['errorMsg'] = '删除失败，请稍后再试';
        }
        return $result;
    }
    function updateCartLineQuantity($InventoryModel,$productModel,$updateData, $userId = '') {
        $userId = $userId ? $userId : $this->operatorId;
        $itemId = $updateData['itemId'];
        $itemExtroInfo = Yii::$app->cache->get('csrp_' . $itemId);
        if($itemExtroInfo === FALSE){
            $iei= $productModel->filterInfoFromByids($itemId);
            if(isset($iei[$itemId])){
                $itemExtroInfo = $iei[$itemId];
            }else{
                $errorInfo = 'search或者获取offerPrice异常，userId = ' . $userId . 'itemId = ' . $itemId;
                Yii::error($errorInfo);
                return ['errorCode' => 'c500', 'errorMsg' =>'修改失败，请稍后再试！'];
            }
        }
        if (isset($itemExtroInfo['minBuyCount']) && $itemExtroInfo['minBuyCount'] > $updateData['quantity']) {
            return ['errorCode' =>'c001', 'errorMsg'=> '对不起，最少购买' . $itemExtroInfo['minBuyCount'] . '件'];
        }
        if (isset($itemExtroInfo['maxBuyCount']) && $itemExtroInfo['maxBuyCount'] < $updateData['quantity']) {
            return ['errorCode' =>'c001', 'errorMsg'=> '对不起，最多购买' . $itemExtroInfo['maxBuyCount'] . '件'];
        }
        //如果 需要查库存
        if ($updateData['isNeedCheckInv']) {
            $params = [
                'itemInfo' => [
                    $updateData['itemPartNumber'] => $updateData['itemOrg'],
                ],
                'shop' => $updateData['shop'],
            ];
            
            $inventory = $InventoryModel->ckeckInventorys($params)[$updateData['itemPartNumber']];
            if (is_numeric($inventory)) {
                if ($inventory > 200) {
                    setcookie('inv_' . $updateData['itemPartNumber'], $inventory, 0, '/');
                }
                else if((isset($itemExtroInfo['minBuyCount']) &&$inventory <$itemExtroInfo['minBuyCount']) ||
                        $inventory <1 ){
                    return ['errorCode' =>'c400', 'errorMsg'=> '对不起，暂时缺货'];
                }
            } else {
                return ['errorCode' =>'c500', 'errorMsg'=> '对不起，库存查询失败，请稍后再试'];
            }
        }
        if ($updateData['isNeedCheckInv'] && $updateData['quantity'] > $inventory) {
            return ['errorCode' =>'c401', 'errorMsg'=> '仅剩' .$inventory. '件'];
        } else {
            $data = $this->updateQTYById($updateData['cartlineId'], $updateData['quantity'], $updateData['tariffno']);
            if(isset($data['cart']['cartlineQuantity'])){
                if(isset($updateData['itemOfferPrice'])){//pc版，计算节省的钱
                    //商品活动价
                    $result['newTotalPrice'] = number_format($data['cart']['cartlineQuantity'] * $updateData['newUnitPrice'], 2, '.', '');
                    //商品原价
                    $result['oldTotalPrice'] = number_format($data['cart']['cartlineQuantity'] * $updateData['itemOfferPrice'], 2, '.', '');
                    $result['savePrice'] = number_format($result['oldTotalPrice'] - $result['newTotalPrice'], 2, '.', '');
                }
                    $result['status'] = 'c200';
            }else{
                return ['errorCode' => 'c500', 'errorMsg' =>'修改失败，请稍后再试！'];
            }
        }
        return $result;
    }

    //检查优惠券的适用性 dcj 10.27
    public function checkCoupons($postData, $dtoModel,$couponIds, $isActive=false, $userId='') {
        
        $userId = $userId ? $userId : $this->operatorId;
        $postData['couponIds'] = $couponIds;
        //$postData['couponIds'] = ['101','102','123'];
        if (isset($postData['cartlineIds'])) {
            $Ids = explode(',', $postData['cartlineIds']);
            $data = $this->getCartLinebyIds($Ids);
            ArrayHelper::remove($postData, 'cartlineIds');
        } else if (isset($postData['dtoItemsInfo'])) { //直接下单使用 cartlines放空
            $postData['dtoItemsInfo'] = json_decode($postData['dtoItemsInfo'], true);
            $data[] = $dtoModel->getDTOInfo($postData['dtoItemsInfo'])['DTOinfo'];
            ArrayHelper::remove($postData, 'dtoItemsInfo');
        } else{
            return null;
        }
        ArrayHelper::remove($postData, 'couponCode');
        ArrayHelper::remove($postData, '_csrf');
        $postData['cartlineList'] = Tools::getColumn($data);
        
        $result = $this->checkCouponsValidity($postData);
        if(isset($result['cart'])){
            $result = $result['cart'];
            if($isActive){
                if(isset($result[$couponIds[0]]) && $result[$couponIds[0]] === 'true'){
                   return ['status' =>'p200','couponId' =>$couponIds[0] ];
                }
                return ['errorCode' =>'p500','errorMsg' =>'优惠码激活成功,但不适用于当前订单,详情见个人中心-我的优惠券，谢谢'];
            }
            $validCouponIds = array();
            foreach ($result as $key => $value) {
                if($value === 'true'){
                    $validCouponIds[] = $key;
                }
            }
            return $validCouponIds;
        }
    }
    
    
    
    public function getQuantityInCart($itemId) {
        $data = $this->getCartList();
        $quantity = 0;
        if ($data && is_array($data) && isset($data['cart'])) {
            $data = $data['cart'];
            foreach ($data as $key => $value) {
                foreach ($value as $v) {
                    if($itemId === $v['itemId']){
                        $quantity = $v['cartlineQuantity'];
                        return $quantity;
                    }  
                }
            }
        }
        return $quantity;
    }
    // 根据购物车中的信息，从price模块拿offerprice
    public function getOfferPrice($data) {
        
        if ($data && is_array($data)) {
            foreach ($data as $key => $value) {
                foreach ($value as $v) {
                    if($itemId === $v['itemId']){
                        $quantity = $v['cartlineQuantity'];
                        return $quantity;
                    }  
                }
            }
        }
        return $quantity;
    }
    
    
    private function moveArrayElement(&$A, $newp, $oldp) {
        if($oldp === $newp) return;
        $p = $oldp;
        $temp = $A[$oldp];
        while($p > $newp){
            $A[$p] = $A[$p-1];
            $p--;
        }
        $A[$newp] = $temp;
        
    }
    
    public function getNSelectStatus($itemCategoryNum, $itemNum, $typeCode, $numOfGoods, $fixedPrice){
        if(substr($typeCode, 2, 3) === '600'){//N 选 M 件
            if($itemNum >= $numOfGoods){
                return ['status' => 1, 'Msg' => '已满足【'.$fixedPrice.'元任选'.$numOfGoods.'件】'];
            }else{
                return ['status' => 0, 'Msg' => '再购<span class="font-color4">'.(int)($numOfGoods-$itemNum) .' </span>件 立享<span class="font-color1">【'.$fixedPrice.'元任选'.$numOfGoods.'件】</span>'];
            }
        }else if(substr($typeCode, 2, 3) === '700'){
            if($itemCategoryNum >= $numOfGoods){
                return ['status' => 1, 'Msg' => '已满足【'.$fixedPrice.'元任选'.$numOfGoods.'件】'];
            }else{
                return ['status' => 0, 'Msg' => '再购<span class="font-color4">'.(int)($numOfGoods-$itemCategoryNum) .' </span>件 立享<span class="font-color1">【'.$fixedPrice.'元任选'.$numOfGoods.'件】</span>'];
            }
        }
    }
    //通过tag key获取meatdata
    public function getNSelectMetaDataByTagKey($tag,$userId=''){
        $userId = $userId ? $userId : $this->operatorId;
        $promotionModel = new PromotionBaseApi($userId);
        $tagKey = $tag;//Yii::$app->params['sm']['promotion']['tagMap'][$tag];
        $metaData = $promotionModel->getNSelectMetaDataInfo([$tagKey]);
        if(isset($metaData[$tagKey]) && !empty($metaData[$tagKey])){
            return $metaData[$tagKey];
        }else{
            return null;
        }
    }
    
    //重新group 购物车中的数据
    public function reGroupCartLine(&$cartLine,$userId='') {
        
        $len = count($cartLine);
        $i = 0;
        $result = array();
        while ($i < $len) {
            if(!isset($cartLine[$i]['N-tagKey'])){
                $result[] = $cartLine[$i];
                $i++;
                continue;
            }
            $md = $this->getNSelectMetaDataByTagKey($cartLine[$i]['N-tagKey']);
            if($md === null){
                $result[] = $cartLine[$i];
                $i++;
                continue;
            }
            $j = $i + 1;
            $temp = array();
            $start = true;
            $end = false;
            $theFirstOne = $i;
            while($j < $len){
                if(isset($cartLine[$j]['N-tagKey']) && $cartLine[$i]['N-tagKey'] === $cartLine[$j]['N-tagKey']){
                   if($i +1  < $j){
                       $this->moveArrayElement($cartLine, $i+1, $j); 
                    }
                    if($start === true){
                        
                        $cartLine[$i]['N-start'] = 1;                       
                        $cartLine[$i]['N-metaData'] = $md;
                        $start = false;
                        $end = true;
                    }
                    $temp[] = $cartLine[$i];
                    $i++;
                    $j++;   
                }else{
                    $j++;
                }  
            }
            if($start === true){
                $cartLine[$i]['N-start'] = 1;
                $cartLine[$i]['N-metaData'] = $md;
            }
            $cartLine[$i]['N-end'] = 1;
            $temp[] = $cartLine[$i];
            $result[] = $temp;
            $cartLine[$theFirstOne]['N-status'] = $this->getNSelectStatus(count($temp), 
                    array_sum(ArrayHelper::getColumn($temp, 'cartlineQuantity')), 
                    $cartLine[$theFirstOne]['N-metaData']['typecode'], 
                    $cartLine[$theFirstOne]['N-metaData']['numOfGoods'],
                    $cartLine[$theFirstOne]['N-metaData']['fixedPrice']);
            $i++;
        }
        return $result;
    }
}
