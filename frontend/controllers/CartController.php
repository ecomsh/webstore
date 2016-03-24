<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\AddressApi;
use frontend\models\PromotionApi;
use frontend\models\CartApi;
use frontend\models\OrderApi;
use frontend\models\ProductApi;
use yii\helpers\ArrayHelper;
use frontend\models\InventoryApi;
use frontend\models\RealnameApi;
use frontend\models\DirectOrderApi;
use frontend\models\ValidateApi;
use yii\helpers\Url;

use common\helpers\Tools;
use common\helpers\Buylimits;

/**
 * Site controller
 */
class CartController extends Controller {

    public $layout = "main-cart-order";
    private $searchResultPrefix = 'csrp_';

    public function behaviors() {
        return [
            'access' => Yii::$app->params['pageAccess']['cart']
        ];
    }
    
    public function beforeAction($action)
    {
    	$userId = Yii::$app->user->getId();
    	
    	if ( $action->id === 'ajaxcreate' )
    	{
    		$params = Yii::$app->request->post();
    		
	    	if ( $userId && isset( $params['itemPartNumber'] ) )
	    	{
	    		$buylimitsClass = new Buylimits();
	    		$result = $buylimitsClass->isBuyItem($userId,$params['itemPartNumber']);
	    		
	    		if ( $result['no_buy'] )
	    		{
	    			Tools::error('99031', $result['depict']);
	    		}
	    	}
    	}
    	elseif ( $action->id === 'can-checkout' )
    	{
    		$cartModel = new CartApi($userId);
    		$cart = $cartModel->getCartList();
    		
    		$itemId = array();
    		foreach ( $cart['cart'] as $key => $value )
    		{
    			foreach ( $value as $k => $v )
    			{
    				$itemId[$v['itemId']] = $v['itemPartNumber'];
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
    	elseif ( $action->id === 'checkout' )
    	{
    		$params = Yii::$app->request->post();
    		$pid = isset($params['itemId'])?$params['itemId']:0;
    		if ( $pid )
    		{
	    		$productModel = new ProductApi($userId);
	    		$product = $productModel->getProductById($pid);
	    		$itemId = $product['product']['partNumber'];
	    		$buylimitsClass = new Buylimits();
	    		$result = $buylimitsClass->isBuyItem($userId,$itemId);
	    		if ( $result['no_buy'] )
	    		{
	    			$errorMsg = str_replace("baokuanshangpin", "", $result['depict']);
	    			Tools::error('99031', $errorMsg);
	    		}
    		}
    	}
    	return parent::beforeAction($action);
    }

    // 购物车errorCode 规范 CXG
    
    
    
    
    public function actionIndex() {
        //现阶段用户模块并没有完成，但是将来用下面的方法获取用户id
        
        $userId = Yii::$app->user->getId();
        $cartModel = new CartApi($userId);
        $productModel = new ProductApi($userId);
        $data = $cartModel->getCartList();

        /**
         * 所有数据都不值得信任，所以一定要校验，php一般有几种，是否有值，是否为数组，是否存在key
         */
        if (is_array($data) && isset($data['cart']) && count($data['cart']) > 0) {
            $data = $data['cart'];
            $cartNum = array();
            $allIds = array();
            foreach ($data as $key => $value) {
                $cartNum[$key] = count(ArrayHelper::getColumn($value, 'cartlineId'));// 统计每个单中商品种类数 删除时用
                $allIds = array_merge($allIds,ArrayHelper::getColumn($value, 'itemId'));
            }
            $finalData = $cartModel->getExtraInfoFromSearch($productModel,$data, $allIds, $userId);//添加是否下架字段,税率，限购数量
            
        } else {
            return $this->render('cart_empty');
        }
        //setcookie ($name, $value = null, $expire = 0, $path = null, $domain = null, $secure = false, $httponly = false)
        setcookie('cartNum', serialize($cartNum), 0, '/', null, false, true);
        setcookie('totalNum', array_sum($cartNum), 0, '/', null, false, true);

        $_csrf = Yii::$app->request->getCsrfToken();
        return $this->render('cart', [
                    'allItems' => $finalData,
                    'storeName' => Yii::$app->params['sm']['cart']['store'],
                    '_csrf' => $_csrf
        ]);
    }

    // private function itemsMapToPrice($data, $shipping = false, $address=array(),$promotion = false, $tax = true )
    

 
    #TODO    hezll 谁的购物车

    public function actionAjaxcreate() {

        $userId = Yii::$app->user->getId();        
        if ($userId == "") {
            return [$cart->getErrors()];
        }        
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $cart = new \frontend\models\CartApi($userId);
        $params = Yii::$app->request->post();
        $data = ArrayHelper::remove($params, '_csrf');
        $ProductModel = new ProductApi($userId);
        $product = $ProductModel->getProductById($params['itemId']);
        $key = key($product);
        $product = isset($product[$key]) ? $product[$key] : [];   
        //dcj  add by dcj
        // TODO 这个字段search 暂时拿不到， 但是加入购物车又必须，所以现在hardcode成0  
        $params['itemVolumn']= 0;                               //商品体积 required
        
        $params['itemWeightUOM'] = "克";
//        $params['itemWeight']= 98765;                              //商品重量 required
        foreach($product['descriptiveAttributes'] as $k => $arr)
        {
            if($arr['id']=='Sales-WeightUOM'){
                $params['itemWeightUOM'] = $arr['value'];
            }
            if($arr['id']=='Sales-Weight'){
                $params['itemWeight'] = $arr['value'];
            }
             if($arr['id']=='Sales-Volumn'){
                $params['itemVolumn'] = $arr['value'];
            }
        }
        
        if(isset($params['itemWeight']) === FALSE ){  
            if($product['type'] === 'package'){
                $params['itemWeight'] = 999999;
            }else{
                Yii::error("itemId=" .$params['itemId']." 该商品未设置重量");
                return ['errorCode'=>'c003' ,'errorMsg'=>'该商品未设置重量，暂不支持购买' ];
                //$params['itemWeight'] = 999999;
            }
        }
        $params['itemPriceListId'] = "offer";                  //购物车项商品的采用的价格列表 required
        $params['buyable'] = $product['buyable'];           
        $params['minBuyCount'] = isset($product['minBuyCount'])?$product['minBuyCount']:'1';
        $params['maxBuyCount'] = isset($product['maxBuyCount'])?$product['maxBuyCount']:'50';
        $params['itemType'] = $product['type'];       
        $params['cartlineType'] = 1;                           //买家类型，游客0，登录用户1 , required
        $params['itemDisplayText'] = $product['desc']['name'];
        $params['shopDisplayText'] = "自贸区直购专场";             //购物车项商品所属店铺显示的文本,自营情况下可以为空，或者默认 required   
        $params['shopContactId'] = "1111";                      //...听完了也没懂，跟店小二有关？
        $params['channelType'] = Yii::$app->params['platform']; //购物车来源类型,app,pc,wechat等,required
        $params['channelId'] = "ftzmall";                       //购物车来源Id , required
        //$params['itemImageLink'] = "{\"img\":\"".$product['desc']['thumbnail']."\",\"img_large\":\"".$product['desc']['fullImage']."\"}";
        $params['itemImageLink'] = $product['desc']['fullImage'];
        $params['itemSalestype'] = isset($product['salesType'])?$product['salesType']:$params['salestype'];       //商品销售来源,一般贸易（DIG，供应商直送），跨境贸易（自营，分销），海外直邮 required
        $params['shopId'] = $product['memberId'];               //购物车项商品所属店铺的Id,自营情况下可以为空，或者默认,required
        $params['shopLink'] = "http://www.ftzmall.com";      //required
        $params['itemOwnerId'] = $product['memberId'];					//购物车项商品的货主Id required
        $params['itemListPrice'] = isset($product['listPriceInfo'][0]['price'])?$product['listPriceInfo'][0]['price']:0;    //购物车项商品的标价，显示用 required
        $params['itemMfname'] = $product['manufactureName'];    //供应商 required   manufactureName   
        $params['cartlineComment']= "";                          //买家留言
        $params['itemOfferPrice'] = isset($product['offerPriceInfo'][0]['price'])?$product['offerPriceInfo'][0]['price']:0; //购物车项商品的售价，显示用(没懂，自己算？)
        $params['tariffno'] = isset($product['tax']['taxSerialNumber']) ? $product['tax']['taxSerialNumber'] : '0';        //税则号，一定要，tax里的
	$params['isGift'] = 0;
        $item['CartApi'] = $params;
        
        $quantity = $cart->getQuantityInCart($params['itemId']);
        
        $validator = new ValidateApi(); 
        $validateCartData['maxBuyCount'] =$params['maxBuyCount'];
        $validateCartData['minBuyCount'] =$params['minBuyCount'];
        $validateCartData['buyable'] =$params['buyable'];
        $validateCartData['itemInv'] =intval($params['inventory']); //等和曹琦确认以后再加上
        $validateCartData['quantity'] =$params['cartlineQuantity'] + $quantity;
        $cartInfo['ValidateApi'] = $validateCartData;
        $validator->scenario = 'itemsVal';
        if($validator->load($cartInfo) && (!$validator->validate())){
            $errors = $validator->getErrors();
            if(isset($errors['quantity'])){
                return ['errorCode'=>'c001' ,'errorMsg'=>'您购物车中已有'. $quantity . '件, '. $errors['quantity'][0] ];
            }
            if(isset($errors['itemInv'])){
                return ['errorCode'=>'c002' ,'errorMsg'=>'您购物车中已有'. $quantity . '件, '. $errors['itemInv'][0] ];
            }
        }
        if ($cart->load($item) && $cart->validate()) { 
            $data = $cart->addToCart($item['CartApi']);
            return $data;
        } else {
            return [$cart->getErrors()];
        }
    }

    public function actionCheckout() {
        Url::remember(['order/index']);
        $userId = Yii::$app->user->getId();
        $postData = Yii::$app->request->post();
        $cartModel = new CartApi($userId);
        $productModel = new ProductApi($userId);
        $isCBT = false;
        $isRealname = false;
        //$postData['productsel'] = ['2517645214672500084'];
        
        if ($userId && !empty($postData) && (isset($postData['productsel']) || isset($postData['itemId']))) {
            //获取用户所有地址
            $model = new AddressApi($userId);
            $address = $model->getList($userId)['address'];
            ArrayHelper::multisort($address, 'isDefault', SORT_DESC);
            //地址信息超过40个字符后，多余的隐藏，如果有默认地址，顺便取出来
            foreach($address as $key => $val){
                if($val['isDefault'] == 1){
                    $defaultAddress = $val;
                }
                $address[$key]['address'] = Tools::substr_mb($val['address']);
            }
            
            if (isset($postData['productsel'])) {
                //获取结算商品信息
                $ids = $postData['productsel'];
                $CartLines = $cartModel->getCartLinebyIds($ids);
                if(empty($CartLines) === TRUE){
                    Tools::error('99002','购物车信息无效，请检查购物车');
                }
                $itemIdsInfo = array();
            }
            if (isset($postData['itemId'])) {
                $ids = [];
                $DirectOrderApi = new DirectOrderApi($userId);
                $itemIdsInfo = [$postData['itemId'] => $postData['cartlineQuantity']];
                $DTOinfo = $DirectOrderApi->getDTOInfo($itemIdsInfo)['DTOinfo'];
                $CartLines[$DTOinfo[0]['itemSalestype']] = $DTOinfo;
            }
            
            $realnameModel = new RealnameApi($userId);
            $realnameInfo = $realnameModel->isNeedRealname($CartLines);
            $isCBT = $realnameInfo['isCBT'];
            $isRealname = $realnameInfo['isRealname'];
            if($isCBT && !$isRealname){
                $realnameInfo = $realnameModel->getById();
            }
            
            $params = [
                'cartlineList' => Tools::getColumn($CartLines),
                "couponIds" => null,
                "price" => true,
                "promotion" => true,
                "shipping" => false,
                "tax" => true,
            ];
            
            if($isCBT && isset($defaultAddress)){
                $params['address'] = [
                    'country_code' => 'CN',
                    'district_code' => $defaultAddress['districtCode'],
                    'postcode' => $defaultAddress['postcode'],
                    'city_code' => $defaultAddress['cityCode'],
                    'state_code' => $defaultAddress['stateCode'],
                ];
                $params['shipping'] = true;
            }
            $price = $cartModel->priceResultPreprocess($params);
            $keys = array_keys($price['orderDetail']);
            $price['orderDetail'] = $price['orderDetail'][$keys[0]];
            $orderType = $keys[0];
            $flag = true;
            foreach ($price['itemDetail'] as $val){
                //itemFreeShipment 有值代表单品包邮，如果单品包邮数量与订单商品总数相同，则认为订单包邮
                if(!isset($val['itemFreeShipment'])){
                    $flag = false;
                    break;
                }
            }
            if($flag){
                $price['orderDetail']['orderFreeShipment'] = '商品享受包邮活动';
            }
            
            //将购物车的二维数组变成一维方便处理
            $keys = array_keys($CartLines);
            $CartLines = $CartLines[$keys[0]];
            
            //先拿cache，如果拿不到就报id放到一个list里，在foreach外，统一再拿一次。
            $cache = Yii::$app->cache;
            foreach($CartLines as $key => $val){
                $cacheKey = $this->searchResultPrefix.$val['itemId'];
                $cacheInfo = $cache->get($cacheKey);
                if($cacheInfo !== FALSE){
                    $CartLines[$key] = ArrayHelper::merge($CartLines[$key], $cacheInfo);
                }else{
                    $itemIds[] = $val['itemId'];
                }
            }
            if(!empty($itemIds)){
                $itemCache = $productModel->filterInfoFromByids($itemIds);
                $CartLines = ArrayHelper::index($CartLines, 'itemId');
                foreach($CartLines as $key => $val){
                    $CartLines[$key] = ArrayHelper::merge($CartLines[$key], $itemCache[$key]);
                }
            }
            
//            print_r($price);exit;
            return $this->render('checkout', [
                        'model' => $model,
                        'addressData' => $address,
                        'CartLines' => $CartLines,
                        'orderModel' => new OrderApi($userId),
                        'CartLinesIds' => implode(',', $ids),
                        'price' => $price,
                        '_csrf' => Yii::$app->request->getCsrfToken(),
                        'itemIdsInfo' => empty($itemIdsInfo) ? '' : json_encode($itemIdsInfo),
                        'isRealname' => $isRealname,
                        'isCBT' => $isCBT,
                        'orderType' => $orderType,
                        'realnameModel' => $realnameModel,
                        'realnameInfo' => isset($realnameInfo['realname']) ? $realnameInfo['realname'] : '',
            ]);
        } else {
            $this->redirect(Url::to(['cart/index']));
        }
    }

    public function actionInventory() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $userId = Yii::$app->user->getId();
        $postData = Yii::$app->request->post();
        if (!$postData || !is_array($postData) || !isset($postData['itemPartNumber'])) {
            throw new BadRequestHttpException('查询库存传入数据异常');
        }
        $InventoryModel = new InventoryApi($userId);
        foreach ($postData['itemPartNumber'] as $val) {
            $params = [
                'itemInfo' => [
                    'itempartnumber1' => "itemOrg1",
                    'itempartnumber2' => "itemOrg2",
                    'itempartnumber3' => "itemOrg3"
                ],
                'shop' => $val['shop'],
                'country' => $val['country'],
                'stateCode' => $val['stateCode'],
                'city' => 'xxx'
            ];
            $inventory = $InventoryModel->getInventory($params);
            if (isset($inventory['inventory']['quantityOnhand'])) {
                $quantityOnhand[$val['itemPartNumber']] = $inventory['inventory']['quantityOnhand'];
            }
        }

        return $quantityOnhand;
    }

    

    public function actionOrders() {
        return $this->render('orders');
    }

    public function actionUpdate() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $userId = Yii::$app->user->getId();
        $updateData = Yii::$app->request->post();
        if (!$updateData || !is_array($updateData) || !isset($updateData['quantity'])) {
            $errorInfo = '购物车跟新传入数据异常';
            Yii::error($errorInfo);
            throw new BadRequestHttpException("非法请求");
        }
        $cartModel = new CartApi($userId);
        $InventoryModel = new InventoryApi($userId);
        $productModel = new ProductApi($userId);
        return $cartModel->updateCartLineQuantity($InventoryModel,$productModel,$updateData);
    }

    #TODO   如果用了format_json,将不再适用 throw new Exception的 异常形式，只能返回return []

    public function actionDelete() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $userId = Yii::$app->user->getId();
        $deleteData = Yii::$app->request->post();
        if (!$deleteData || !is_array($deleteData) || !isset($deleteData['cartlineId'])) {
            $errorInfo = '购物车删除传入数据异常';
            Yii::error($errorInfo);
            throw new BadRequestHttpException("非法请求");
        }
        $model = new CartApi($userId);
        return $model->deleteCartLine($deleteData);
    }

    /**
     * 计算价格，如果post的数据中有cartlineIds，则只计算传入的商品的价格
     *          如果post的数据中没有cartlineIds，则计算的是当前用户购物车中所有商品的价格（@caoqi详情页使用）
     * post = { '_csrf' : _csrf,
                     // 'cartlineIds':select_Ids,
                      "price": true,
                      "promotion": true,
                      "shipping": false,
                      "tax": true
                    };
     * @return 
     * [itemDetail]=>[.....]
     * [orderDetail]=>[.....]
     * [total]=>=> Array   @caoqi 你只需要这个字段就可以了
        (
            [originalPrice] => 8950.00
            [promotion] => 5762.80
            [shipping] => 0.00
            [tax] => 677.60
            [actualPrice] => 3187.20
            [itemNum] => 20
            [itemCategoryNum] => 3
        )
     * 
     * @throws BadRequestHttpException
     */
    public function actionPrice() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $userId = Yii::$app->user->getId();
        $postData = Yii::$app->request->post();
        if (!$postData || !is_array($postData) ) {
            throw new BadRequestHttpException("非法请求");
        }
        $model = new CartApi($userId);
        $dtoModel = new DirectOrderApi($userId);
        $result = $model->calculatePriceCore($postData,$dtoModel);
        return $result; 
    }

    //废弃
    public function actionPriceandnum() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $userId = Yii::$app->user->getId();
        $postData = Yii::$app->request->post();
        $model = new CartApi($userId);
        $data = $model->getCartList($userId);
        
        $params = ['cartlineList' => $totalCart,
            'price' => $postData['price'],
            'promotion' => $postData['promotion'],
            'shipping' => $postData['shipping'],
            'tax' => $postData['tax']];
        
        
        if ($data && is_array($data) && isset($data['cart'])) {
            $data = ArrayHelper::index($data['cart'], function ($element) {
                        return $element[0]['itemSalestype'];
                    });
            $totalCart = array();
            $totalNum = 0;
            foreach ($data as $key => $value) {
                $cartNum[$key] = count($value);
                foreach ($value as $v) {
                    $totalCart[] = $v;
                    $totalNum = $totalNum + $v['cartlineQuantity'];
                }
            }
        } else {
            throw new BadRequestHttpException("请求出错，请稍后重试");
        }
        $params = ['cartlineList' => $totalCart,
            'price' => $postData['price'],
            'promotion' => $postData['promotion'],
            'shipping' => $postData['shipping'],
            'tax' => $postData['tax']];
        $price = $model->caculateCartPrice($params);

        if ($price && is_array($price) && isset($price['cart'])) {
            $price = $price['cart'];
            $totalprice = 0;
            foreach ($price as $value) {
                $totalprice = $totalprice + $value['originalPrice'];
            }
            $type = count($totalCart);
            return ['originalPrice' => $totalprice, 'type' => $type, 'num' => $totalNum];
        } else {
            throw new BadRequestHttpException("请求出错，请稍后重试");
        }
    }

    public function actionGetcarttotalnum() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $userId = Yii::$app->user->getId();
        if ($userId == "") {
            return 0;
        }
        $model = new CartApi($userId);
        $data = $model->getCartList($userId);
        if ($data && is_array($data) && isset($data['cart'])) {
            $data = $data['cart'];
            $totalNum = 0;
            foreach ($data as $key => $value) {
                foreach ($value as $v) {
                    $totalNum = $totalNum + $v['cartlineQuantity'];
                }
            }
            setcookie('ccn_' . $userId, $totalNum, 0, '/');
            return $totalNum;
        } else {
            throw new BadRequestHttpException("请求出错，请稍后重试");
        }
    }
    // 是否可以去结算
    public function actionCanCheckout() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $userId = Yii::$app->user->getId();
        if ($userId == "")  return false;
        $checkoutData = Yii::$app->request->post();
        $model = new CartApi($userId);
        $InventoryModel = new \frontend\models\InventoryApi($userId);
        $productModel = new ProductApi($userId);
        $Ids = explode(',', $checkoutData['cartlineIds']);
        return $model->canCheckOut($InventoryModel,$productModel,$Ids, $userId);
    }
    
    public function actionGetShippingRule() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $userId = Yii::$app->user->getId();
        if ($userId == "")  return false;
        $getData = Yii::$app->request->get();
        $model = new \frontend\models\PromotionApi($userId);
        $rule = $model->findRuleByAttr($getData['attrname'], $getData['value']);
        if(isset($rule['promotion']) && !empty($rule['promotion'])){
            foreach ($rule['promotion'] as $value) {
                $result['name'] = $value['desc'];
            }
            return $result;
        }
        return ['errorCode' => 'c500'];
    }
    
    public function actionListValidCoupons() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $userId = Yii::$app->user->getId();
        if ($userId == "")  return false;
        $postData = Yii::$app->request->post();
        if ($postData && is_array($postData) &&(isset($postData['dtoItemsInfo'])||isset($postData['cartlineIds']))) {
            $cartModel = new CartApi($userId);
            $dtoModel = new DirectOrderApi($userId);
            $promotionMode = new PromotionApi($userId);
            return $promotionMode -> listValidCoupons($postData, $cartModel,$dtoModel);
        }else{      
            throw new BadRequestHttpException("非法请求, listcoupons未提供正确参数");
        }
    }

    public function actionActiveCoupon() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $userId = Yii::$app->user->getId();
        //$userId = '5032';
        if ($userId == "")  return false;
        $postData = Yii::$app->request->post();
        $couponId = '';
        if ($postData && is_array($postData) && isset($postData['couponCode'])) {
            $cartModel = new CartApi($userId);
            $dtoModel = new DirectOrderApi($userId);
            $promotionMode = new PromotionApi($userId);
            return $promotionMode ->activeCoupons($postData, $cartModel, $dtoModel);
        }else{      
            throw new BadRequestHttpException("非法请求");
        }
        
    }
    public function actionGetNselectStatus() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $userId = Yii::$app->user->getId();
        //$userId = '5032';
        if ($userId == "")  return false;
        //itemCategoryNum, $itemNum, $typeCode, $numOfGoods, $fixedPrice
        $getData = Yii::$app->request->get();
   
        if ($getData && is_array($getData) && isset($getData['typeCode'])) {
            $cartModel = new CartApi($userId);
            return $cartModel ->getNSelectStatus($getData['itemCategoryNum'], 
                    $getData['itemNum'], 
                    $getData['typeCode'], 
                    $getData['numOfGoods'], 
                    $getData['fixedPrice']);
        }else{      
            throw new BadRequestHttpException("非法请求");
        }
        
    }
    
    
    public function actionTest() {
        $userId = Yii::$app->user->getId();
        $cartModel = new CartApi($userId);
        
        exit;
    }

}
