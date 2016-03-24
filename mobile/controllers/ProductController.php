<?php

namespace mobile\controllers;

use Yii;
use mobile\models\ProductApi;
use mobile\models\InventoryApi;
use mobile\models\AddressApi;
use mobile\models\RecommendApi;
use mobile\helpers\Sku;
use yii\helpers\Url;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use common\helpers\Tools;
use common\helpers\Buylimits;

/**
 * Site controller
 */
    
class ProductController extends Controller {

    public $layout = false;
    
    public function behaviors() {
         /**
                 * 开启页面缓存功能
                 */
        return [
          //  [
               
//                'class' => 'yii\filters\PageCache',
//                
//                //'only' => ['view'],
//                'duration' => 3600,
//                'variations' => [
//                    Yii::$app->language,
//                ],
                //'dependency' => [
                    //'class' => 'yii\caching\DbDependency',
                    //'sql' => 'SELECT COUNT(*) FROM post',
                //],
        //    ],
        ];              
    }

    public function actionIndex() {
        
        //$this->behaviors();
        return $this->render('/product/view');
    }
  
    public function actionView($id = '')
    {
        $userId = Yii::$app->mobileUser->getId(); //获取用户默认地址        
        if (!$userId)
        {
            $request = Yii::$app->getRequest();
            Yii::$app->getUser()->setReturnUrl($request->getUrl());//为登陆记录当前页面            
        }
        $id = Yii::$app->request->get('id');          
        $model = new ProductApi($userId);
        $data = $model->getProductById($id);    
        $desc =  ArrayHelper::getColumn($data, 'desc'); //获取商品信息       
        $key = key($desc);
        $desc = isset($desc[$key]) ? $desc[$key] : [];      
        if(isset($desc['fullImage'])& !empty($desc['fullImage']))
        {
            $fullImage = $desc['fullImage'];                       //为了从assets中去除这个重复的图，先保留一个原始的fullImage
            $desc['thumbnail'] = Tools::qnImg($fullImage, 56, 56); //thumbnail这个值已然没用，都用fullImage这个值转大小
            $desc['bigImage'] = Tools::qnImg($fullImage, 354, 354);            
            $desc['fullImage'] = Tools::qnImg($fullImage, 800, 800);            
        }
        //$desc['longDescription'] = isset($desc['longDescription'])?str_replace('<img src="', '<img data-original="', $desc['longDescription']):''; //lazyload,具体怎么改等再议       
        //$desc['longDescription'] = isset($desc['longDescription'])?str_replace('<img src="', '<img width="320px" src="', $desc['longDescription']):'';//lazyload 前
        $desc['longDescription'] = isset($desc['longDescription'])?str_replace('src="', 'data-restrictwidth="320" data-img="', $desc['longDescription']):'';//lazyload
        $brand = ArrayHelper::getColumn($data, 'brand'); //获取品牌信息 
        $key = key($brand);
        $brand = isset($brand[$key]) ? $brand[$key] : [];     
        if(isset($brand['country']) && $brand['country']!="")
        {
            $country = explode('_', $brand['country']);
            $brand['countryid'] = $country[0];
            $brand['countryname'] = $country[1];
        }      
        $description = ArrayHelper::getColumn($data, 'descriptiveAttributes'); //获取规格参数信息
        $key = key($description);
        $description = isset($description[$key]) ? $description[$key] : [];
        $descriptive = [];
        foreach($description as $k => $arr)
        {
            if($arr['displayable']==1&&$arr['type']==0) //只取displayable为1且type为0的
            {
                $descriptive[] = $arr;
            }
        }
        $defining = ArrayHelper::getColumn($data, 'definingAttributes'); //获取规格信息（就是颜色的挑选，大小挑选等）
        $key = key($defining);
        $defining = isset($defining[$key]) ? $defining[$key] : [];
        $skumap = $this->actionSku($data); //根据选取的信息获取partNumber
        $listprice2 = ArrayHelper::getColumn($data, 'listPriceInfo');
        $key = key($listprice2);
        $listprice2 = isset($listprice2[$key]) ? $listprice2[$key] : []; //获取曾经的价格
        $listprice[0] = isset($listprice2[0]) ? $listprice2[0] : [];
        $offerprice = ArrayHelper::getColumn($data, 'offerPriceInfo');
        $key = key($offerprice);
        $offerprice = isset($offerprice[$key]) ? $offerprice[$key] : []; //获取现在的价格
        $promotionprice = ArrayHelper::getColumn($data, 'promotionPriceInfo');
        $key = key($promotionprice);
        $promotionprice = isset($promotionprice[$key]) ? $promotionprice[$key] : []; //获取现在的价格
        $parentCatgroups = ArrayHelper::getColumn($data, 'parentCatgroups');        
        $key = key($parentCatgroups);
        $parentCatgroups = isset($parentCatgroups[$key]) ? $parentCatgroups[$key] : []; //获取面包削,并且整理面包削数组        
        $arr = array();
        $cates = array();
        $categoryRecommend = Array();
        if($parentCatgroups)
        {          
            foreach( $parentCatgroups as $k =>$v)
            {
                if($v['catalogId'] == 'master')
                {                    
                    $arr['id']= explode("/",$v['categoryKeyPath']);
                    $arr['name']= explode("/",$v['categoryNamePath']);
                    $categoryRecommend = $this -> getRecommendBycategory($v['categoryId'],11,'ftzmall',$id);       //获取推荐同类型产品的category，品类读的是catalogId=master的时候的categoryId                    
                    foreach($categoryRecommend as $k => $v)
                    {
                        $categoryRecommend[$k]['fullImage'] = Tools::qnImg($v['desc']['fullImage'],159, 159); //好像yii没有类似的arrayhelper函数，手动写了，小图的处理方式待定
                    }
                }
            }

	    if(isset($arr['id']) && $arr['id'] !=""){
                foreach($arr['id'] as $k =>$v)
                {
                    if($v)
                    { 
                        $cates[$k]['id'] = $v;
                    }
                }
            }
            if(isset($arr['name']) && $arr['name'] !=""){    
                foreach($arr['name'] as $k =>$v)
                {
                    if($v)
                    { 
                        $cates[$k]['name'] = $v;
                    }
                }
            }
            
        }
        
        //Begin: 需要在商品详情页判断sku是category level的，还是product下面的sku.一定显示category level sku的自定义属性
        $isProductSku = false;
        $parentCatentries = ArrayHelper::getColumn($data, 'parentCatentries'); 
        $type = ArrayHelper::getColumn($data, 'type');
        if(!empty($parentCatentries) && ($type == "item")){
            foreach($parentCatentries as $v){
                if($v['type'] == "Product"){
                    $isProductSku = true;
                    break;
                }
            }
        }
        //End: 需要在商品详情页判断sku是category level的，还是product下面的sku，一定显示category level sku的自定义属性

        $assets = ArrayHelper::getColumn($data, 'assets'); //缩略图,但我觉得不太对,待确定
        $key = key($assets);
        $assets = isset($assets[$key]) ? $assets[$key] : []; 
        $goodspic = Array();
        $shipaipic = Array();
        foreach($assets as $k => $v)
        {
            if($v['usage'] == "原图")
            {
                if($v['path'] != $fullImage)
                {
                    $goodspic[$k] = $v; //好像yii没有类似的arrayhelper函数，手动写了，小图的处理方式待定
                    $goodspic[$k]['thumbnail'] = Tools::qnImg($v['path'], 56, 56); //thumbnail这个值已然没用，都用fullImage这个值转大小
                    $goodspic[$k]['bigImage'] = Tools::qnImg($v['path'], 354, 354);  
                    $goodspic[$k]['fullImage'] = Tools::qnImg($v['path'], 800, 800);  
                }
            }
            
            if($v['usage'] == "实拍图")
            {
                $shipaipic[]['path'] = Tools::qnImg($v['path'],750);        
            }
        }

        $tag = ArrayHelper::getColumn($data, 'tag'); //tag获取整理 
        $key = key($tag);
        $tag = isset($tag[$key]) ? $tag[$key] : [];
        $is_cart = 0;           
        foreach ($tag as $k => $arr) 
        {
           if (isset($arr['type']) && isset($arr['display']) && $arr['type'] == "PR" && $arr['display']) {
                $tag['PR'][] = $arr;
            }

            if (isset($arr['type']) && isset($arr['display']) && $arr['type'] == "SP" && $arr['display']) {
                $tag['SP'][] = $arr;
            }

            if (isset($arr['type']) && isset($arr['display']) && $arr['type'] == "NM" && $arr['display']) {
                $cartModel = new \mobile\models\CartApi($userId);
                $nmMetadata = $cartModel->getNSelectMetaDataByTagKey($arr['key']);
                if($nmMetadata !== null){
                    $tag['NM'][] = $arr;
                }
            }

            if (isset($arr['type']) && isset($arr['display']) && $arr['type'] == "BR" && $arr['display']&& $arr["id"] == "加入购物车") {
                $is_cart = 1; 
            }
        }      
        $tax = ArrayHelper::getColumn($data, 'tax'); //获取折扣
        $key = key($tax);
        $tax = isset($tax[$key]) ? $tax[$key] : [];         
        $associationProducts = ArrayHelper::getColumn($data, 'associationProducts'); //相关产品
        $key = key($associationProducts);
        $associationProducts = isset($associationProducts[$key]) ? $associationProducts[$key] : [];    
        $key = key($data);        
        $data = isset($data[$key]) ? $data[$key] : [];
        $brandRecommend = Array();
        if($data['brand']['name'] && $data['brand']['name']!="")
        {  
            $brandRecommend = $this -> getRecommendByBrand($data['brand']['name'],11,'ftzmall',$id);
            foreach($brandRecommend as $k => $v)
            {
                $brandRecommend[$k]['fullImage'] = Tools::qnImg($v['desc']['fullImage'],159,159); //好像yii没有类似的arrayhelper函数，手动写了，小图的处理方式待定     
                if (!empty($v['parentCatentries'])) {
                    $brandRecommend[$k]['id'] = $v['parentCatentries'][0]['id']; //对于子sku商品，在推荐页的链接应该跳转到product上
                }
                if (isset($v['promotionPriceInfo'][0]['price']) && $v['promotionPriceInfo'][0]['price'] != "") {
                    $brandRecommend[$k]['offerPriceInfo'][0]['price'] = $v['promotionPriceInfo'][0]['price'];
                }           
            }                
        }
        

        //$userId = Yii::$app->mobileUser->getId(); //获取用户默认地址
        //$modelAddress = new AddressApi($userId);
        //$defaultAddress = $modelAddress->getDefaultAddress($userId);  
        //$stateCode = isset($defaultAddress['defaultAddress']['stateCode'])?$defaultAddress['defaultAddress']['stateCode']:Null;
        //$stateName = isset($defaultAddress['defaultAddress']['stateName'])?$defaultAddress['defaultAddress']['stateName']:Null;   
        Url::remember(); 
        $_csrf = Yii::$app->request->getCsrfToken();
        return $this->render('/product/view', [
            'model' => $model,
            'data' => $data,
            'desc' => $desc,     
            'brand' => $brand, 
            'descriptive' => $descriptive,
            'cates' => $cates,
            'defining' => $defining,
            'pid' => $id,      
            'listprice' => $listprice,
            'offerprice' => $offerprice,
            'skumap' => $skumap,
            'goodspic' => $goodspic,
            'shipaipic' => $shipaipic,
            'tag' => $tag,
            '_csrf' => $_csrf,
            'tax'=> $tax,
            'brandRecommend' => $brandRecommend,
            'categoryRecommend' => $categoryRecommend,
            'promotionprice' => $promotionprice,
            //'stateCode' => $stateCode,
            //'stateName' => $stateName,
            'associationProducts' => $associationProducts,
            'userId'=>$userId,
            'isProductSku' => $isProductSku,
            'is_cart' => $is_cart,
        ]);       
    }
    
    public function actionApp($id = '')
    {
    	$userId = Yii::$app->mobileUser->getId(); //获取用户默认地址
    	if (!$userId)
    	{
    		$request = Yii::$app->getRequest();
    		Yii::$app->getUser()->setReturnUrl($request->getUrl());//为登陆记录当前页面
    	}
    	$id = Yii::$app->request->get('id');
    	$model = new ProductApi($userId);
    	$data = $model->getProductById($id);
    	$desc =  ArrayHelper::getColumn($data, 'desc'); //获取商品信息
    	$key = key($desc);
    	$desc = isset($desc[$key]) ? $desc[$key] : [];
    	if(isset($desc['fullImage'])& !empty($desc['fullImage']))
    	{
    		$fullImage = $desc['fullImage'];                       //为了从assets中去除这个重复的图，先保留一个原始的fullImage
    		$desc['thumbnail'] = Tools::qnImg($fullImage, 56, 56); //thumbnail这个值已然没用，都用fullImage这个值转大小
    		$desc['bigImage'] = Tools::qnImg($fullImage, 354, 354);
    		$desc['fullImage'] = Tools::qnImg($fullImage, 800, 800);
    	}
    	//$desc['longDescription'] = isset($desc['longDescription'])?str_replace('<img src="', '<img data-original="', $desc['longDescription']):''; //lazyload,具体怎么改等再议
    	//$desc['longDescription'] = isset($desc['longDescription'])?str_replace('<img src="', '<img width="320px" src="', $desc['longDescription']):'';//lazyload 前
    	$desc['longDescription'] = isset($desc['longDescription'])?str_replace('src="', 'data-restrictwidth="320" data-img="', $desc['longDescription']):'';//lazyload
    	$brand = ArrayHelper::getColumn($data, 'brand'); //获取品牌信息
    	$key = key($brand);
    	$brand = isset($brand[$key]) ? $brand[$key] : [];
    	if(isset($brand['country']) && $brand['country']!="")
    	{
    		$country = explode('_', $brand['country']);
    		$brand['countryid'] = $country[0];
    		$brand['countryname'] = $country[1];
    	}
    	$description = ArrayHelper::getColumn($data, 'descriptiveAttributes'); //获取规格参数信息
    	$key = key($description);
    	$description = isset($description[$key]) ? $description[$key] : [];
    	$descriptive = [];
    	foreach($description as $k => $arr)
    	{
    		if($arr['displayable']==1&&$arr['type']==0) //只取displayable为1且type为0的
    		{
    			$descriptive[] = $arr;
    		}
    	}
    	$defining = ArrayHelper::getColumn($data, 'definingAttributes'); //获取规格信息（就是颜色的挑选，大小挑选等）
    	$key = key($defining);
    	$defining = isset($defining[$key]) ? $defining[$key] : [];
    	$skumap = $this->actionSku($data); //根据选取的信息获取partNumber
    	$listprice2 = ArrayHelper::getColumn($data, 'listPriceInfo');
    	$key = key($listprice2);
    	$listprice2 = isset($listprice2[$key]) ? $listprice2[$key] : []; //获取曾经的价格
    	$listprice[0] = isset($listprice2[0]) ? $listprice2[0] : [];
    	$offerprice = ArrayHelper::getColumn($data, 'offerPriceInfo');
    	$key = key($offerprice);
    	$offerprice = isset($offerprice[$key]) ? $offerprice[$key] : []; //获取现在的价格
    	$promotionprice = ArrayHelper::getColumn($data, 'promotionPriceInfo');
    	$key = key($promotionprice);
    	$promotionprice = isset($promotionprice[$key]) ? $promotionprice[$key] : []; //获取现在的价格
    	$parentCatgroups = ArrayHelper::getColumn($data, 'parentCatgroups');
    	$key = key($parentCatgroups);
    	$parentCatgroups = isset($parentCatgroups[$key]) ? $parentCatgroups[$key] : []; //获取面包削,并且整理面包削数组
    	$arr = array();
    	$cates = array();
    	$categoryRecommend = Array();
    	if($parentCatgroups)
    	{
    		foreach( $parentCatgroups as $k =>$v)
    		{
    			if($v['catalogId'] == 'master')
    			{
    				$arr['id']= explode("/",$v['categoryKeyPath']);
    				$arr['name']= explode("/",$v['categoryNamePath']);
    				$categoryRecommend = $this -> getRecommendBycategory($v['categoryId'],11,'ftzmall',$id);       //获取推荐同类型产品的category，品类读的是catalogId=master的时候的categoryId
    				foreach($categoryRecommend as $k => $v)
    				{
    					$categoryRecommend[$k]['fullImage'] = Tools::qnImg($v['desc']['fullImage'],159, 159); //好像yii没有类似的arrayhelper函数，手动写了，小图的处理方式待定
    				}
    			}
    		}
    
    		if(isset($arr['id']) && $arr['id'] !=""){
    			foreach($arr['id'] as $k =>$v)
    			{
    				if($v)
    				{
    					$cates[$k]['id'] = $v;
    				}
    			}
    		}
    		if(isset($arr['name']) && $arr['name'] !=""){
    			foreach($arr['name'] as $k =>$v)
    			{
    				if($v)
    				{
    					$cates[$k]['name'] = $v;
    				}
    			}
    		}
    
    	}
    
    	//Begin: 需要在商品详情页判断sku是category level的，还是product下面的sku.一定显示category level sku的自定义属性
    	$isProductSku = false;
    	$parentCatentries = ArrayHelper::getColumn($data, 'parentCatentries');
    	$type = ArrayHelper::getColumn($data, 'type');
    	if(!empty($parentCatentries) && ($type == "item")){
    		foreach($parentCatentries as $v){
    			if($v['type'] == "Product"){
    				$isProductSku = true;
    				break;
    			}
    		}
    	}
    	//End: 需要在商品详情页判断sku是category level的，还是product下面的sku，一定显示category level sku的自定义属性
    
    	$assets = ArrayHelper::getColumn($data, 'assets'); //缩略图,但我觉得不太对,待确定
    	$key = key($assets);
    	$assets = isset($assets[$key]) ? $assets[$key] : [];
    	$goodspic = Array();
    	$shipaipic = Array();
    	foreach($assets as $k => $v)
    	{
    		if($v['usage'] == "原图")
    		{
    			if($v['path'] != $fullImage)
    			{
    				$goodspic[$k] = $v; //好像yii没有类似的arrayhelper函数，手动写了，小图的处理方式待定
    				$goodspic[$k]['thumbnail'] = Tools::qnImg($v['path'], 56, 56); //thumbnail这个值已然没用，都用fullImage这个值转大小
    				$goodspic[$k]['bigImage'] = Tools::qnImg($v['path'], 354, 354);
    				$goodspic[$k]['fullImage'] = Tools::qnImg($v['path'], 800, 800);
    			}
    		}
    
    		if($v['usage'] == "实拍图")
    		{
    			$shipaipic[]['path'] = Tools::qnImg($v['path'],750);
    		}
    	}
    
    	$tag = ArrayHelper::getColumn($data, 'tag'); //tag获取整理
    	$key = key($tag);
    	$tag = isset($tag[$key]) ? $tag[$key] : [];
    	$is_cart = 0;
    	foreach ($tag as $k => $arr)
    	{
    		if (isset($arr['type']) && isset($arr['display']) && $arr['type'] == "PR" && $arr['display']) {
    			$tag['PR'][] = $arr;
    		}
    
    		if (isset($arr['type']) && isset($arr['display']) && $arr['type'] == "SP" && $arr['display']) {
    			$tag['SP'][] = $arr;
    		}
    
    		if (isset($arr['type']) && isset($arr['display']) && $arr['type'] == "NM" && $arr['display']) {
    			$cartModel = new \mobile\models\CartApi($userId);
    			$nmMetadata = $cartModel->getNSelectMetaDataByTagKey($arr['key']);
    			if($nmMetadata !== null){
    				$tag['NM'][] = $arr;
    			}
    		}
    
    		if (isset($arr['type']) && isset($arr['display']) && $arr['type'] == "BR" && $arr['display']&& $arr["id"] == "加入购物车") {
    			$is_cart = 1;
    		}
    	}
    	$tax = ArrayHelper::getColumn($data, 'tax'); //获取折扣
    	$key = key($tax);
    	$tax = isset($tax[$key]) ? $tax[$key] : [];
    	$associationProducts = ArrayHelper::getColumn($data, 'associationProducts'); //相关产品
    	$key = key($associationProducts);
    	$associationProducts = isset($associationProducts[$key]) ? $associationProducts[$key] : [];
    	$key = key($data);
    	$data = isset($data[$key]) ? $data[$key] : [];
    	$brandRecommend = Array();
    	if($data['brand']['name'] && $data['brand']['name']!="")
    	{
    		$brandRecommend = $this -> getRecommendByBrand($data['brand']['name'],11,'ftzmall',$id);
    		foreach($brandRecommend as $k => $v)
    		{
    			$brandRecommend[$k]['fullImage'] = Tools::qnImg($v['desc']['fullImage'],159,159); //好像yii没有类似的arrayhelper函数，手动写了，小图的处理方式待定
    			if (!empty($v['parentCatentries'])) {
    				$brandRecommend[$k]['id'] = $v['parentCatentries'][0]['id']; //对于子sku商品，在推荐页的链接应该跳转到product上
    			}
    			if (isset($v['promotionPriceInfo'][0]['price']) && $v['promotionPriceInfo'][0]['price'] != "") {
    				$brandRecommend[$k]['offerPriceInfo'][0]['price'] = $v['promotionPriceInfo'][0]['price'];
    			}
    		}
    	}
    
    
    	//$userId = Yii::$app->mobileUser->getId(); //获取用户默认地址
    	//$modelAddress = new AddressApi($userId);
    	//$defaultAddress = $modelAddress->getDefaultAddress($userId);
    	//$stateCode = isset($defaultAddress['defaultAddress']['stateCode'])?$defaultAddress['defaultAddress']['stateCode']:Null;
    	//$stateName = isset($defaultAddress['defaultAddress']['stateName'])?$defaultAddress['defaultAddress']['stateName']:Null;
    	Url::remember();
    	$_csrf = Yii::$app->request->getCsrfToken();
    	return $this->render('/product/view_app', [
    			'model' => $model,
    			'data' => $data,
    			'desc' => $desc,
    			'brand' => $brand,
    			'descriptive' => $descriptive,
    			'cates' => $cates,
    			'defining' => $defining,
    			'pid' => $id,
    			'listprice' => $listprice,
    			'offerprice' => $offerprice,
    			'skumap' => $skumap,
    			'goodspic' => $goodspic,
    			'shipaipic' => $shipaipic,
    			'tag' => $tag,
    			'_csrf' => $_csrf,
    			'tax'=> $tax,
    			'brandRecommend' => $brandRecommend,
    			'categoryRecommend' => $categoryRecommend,
    			'promotionprice' => $promotionprice,
    			//'stateCode' => $stateCode,
    			//'stateName' => $stateName,
    			'associationProducts' => $associationProducts,
    			'userId'=>$userId,
    			'isProductSku' => $isProductSku,
    			'is_cart' => $is_cart,
    			]);
    }

    public function actionSku($data) {
        $skuMap = ArrayHelper::getColumn($data, 'skuMap'); //获取规格信息（就是颜色的挑选，大小挑选等）
        $key = key($skuMap);
        $skuMap = isset($skuMap[$key]) ? $skuMap[$key] : [];     
        $childCatentries = ArrayHelper::getColumn($data, 'childCatentries'); //获取规格参数信息        
        $key = key($childCatentries);
        $childCatentries = isset($childCatentries[$key]) ? $childCatentries[$key] : [];       
        foreach($childCatentries as $i => $a)
        {
            foreach($skuMap as $k => $v){                 
                $aaa = explode("|", $v['value']);
                if($a['id'] == $aaa[0])
                {
                    $skuMap[$k]['value'] = $aaa[0];
                    $skuMap[$k]['partNumber'] = $aaa[1];           
                    $skuMap[$k]['content'] = "";
                    foreach($a['definingAttributes'] as $n => $b)
                    {
                        $skuMap[$k]['content'] .= $b['value'];
                    }
                }
            }       
        }
        $arr = ArrayHelper::index($skuMap, 'key');                
        return $arr;
            //echo json_decode($skuMap);
    }
         
    public function actionGetproductprice()
    {        
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $userId = Yii::$app->mobileUser->getId();
        $model = new ProductApi($userId);
        $params = Yii::$app->request->post();
        $data = ArrayHelper::remove($params, '_csrf'); 
        $params["priceList"] = [        
            "0" => "list",
            "1" => "offer",  
            "2" => "promotion",                    
        ];
        // $params["itemPartnumber"] = "yanjiao1";
        // $params["itemOrg"] = "ftzmall";         
        // $params["shop"] = "ftzmall";   
        // $params["queryItemType"] = "product";   
        $data = $model->getProductPrices($params);       
        $key = key($data);
        $data = isset($data[$key]) ? $data[$key] : [];
        $price = array();
        $price2 = array();
        if (isset($data['offer'] ) && is_array($data['offer']))
        {
            foreach ($data['offer'] as $key => $value)
            {
                $arr = explode(":", $key);
                if(isset($arr[1]) && $arr[1] != "")
                {                    
                    $price[$arr[1]]['offer'] = $value;                    
                    foreach ($price[$arr[1]]['offer'] as $a => $b) {                     
                        $price2[$arr[1]]['offer'][$b['currency']] = $b['value']; 
                    }
                }

                else if(isset($arr[0]) && $arr[0] != "")
                {
                    $price[$arr[0]]['offer'] = $value;
                    foreach ($price[$arr[0]]['offer'] as $a => $b) {
                        $price2[$arr[0]]['offer'][$b['currency']] = $b['value']; 
                    }
                }

                else
                {
                    return false;
                }
            }
        }

        if (isset($data['list'] ) && is_array($data['list']))
        {
            foreach ($data['list'] as $key => $value)
            {
                $arr = explode(":", $key);
                if(isset($arr[1]) && $arr[1] != "")
                {
                    $price[$arr[1]]['list'] = $value;
                    foreach ($price[$arr[1]]['list'] as $a => $b) {                     
                        $price2[$arr[1]]['list'][$b['currency']] = $b['value']; 
                    }
                }

                else if(isset($arr[0]) && $arr[0] != "")
                {
                    $price[$arr[0]]['list'] = $value;
                    foreach ($price[$arr[0]]['list'] as $a => $b) {                     
                        $price2[$arr[0]]['list'][$b['currency']] = $b['value']; 
                    }                    
                }

                else
                {
                    return false;
                }
            }
        }

        if (isset($data['promotion'] ) && is_array($data['promotion']))
        {
            foreach ($data['promotion'] as $key => $value)
            {
                $arr = explode(":", $key);         
                if(isset($arr[1]) && $arr[1] != "")
                {
                    $price[$arr[1]]['promotion'] = $value;
                    foreach ($price[$arr[1]]['promotion'] as $a => $b) {                     
                        $price2[$arr[1]]['promotion'][$b['currency']] = $b['value']; 
                    }
                }

                else if(isset($arr[0]) && $arr[0] != "")
                {
                    $price[$arr[0]]['promotion'] = $value;
                    foreach ($price[$arr[0]]['promotion'] as $a => $b) {                     
                        $price2[$arr[0]]['promotion'][$b['currency']] = $b['value']; 
                    }
                }

                else
                {
                    return false;
                }
            }
        }
        
        return $price2;
     }
     
     public function actionGetinventory()
     {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
       // $userId = Yii::$app->mobileUser->getId();       #todo 此处为指甲获取库存，可以不用添加
        $postData = Yii::$app->request->post();

        if (!$postData || !is_array($postData))
        {
            throw new BadRequestHttpException("非法请求");
        }
        
        $InventoryModel = new InventoryApi();
        if(is_array($postData['itemPartNumber'])){
            foreach($postData['itemPartNumber'] as $val){
                $itemPartNumber[] = $val['itemPartNumber'];
                $itemOrg[] = $val['itemOrg'];
            }
            $params = [
                'itemPartNumber' => $itemPartNumber,
                'itemOrg' => $itemOrg,
                'shop' => $postData['itemPartNumber'][0]['shop'],
                'country' => $postData['itemPartNumber'][0]['country'],
                'stateCode' => $postData['itemPartNumber'][0]['stateCode']
            ];
            $inventory = $InventoryModel->getInventorys($params);
            foreach ($inventory['inventory'] as $val){
                if(isset($val['quantityOnhand'])){
                    $quantityOnhand[$val['itemPartnumber']] =  $val['quantityOnhand'];
                }
            }
        }else{       
            $data = ArrayHelper::remove($postData, '_csrf'); 
            $data = $InventoryModel->getInventory($postData);    
            $key = key($data);        
            $data = isset($data[$key]) ? $data[$key] : [];
            $quantityOnhand = $data["quantityOnhand"];
        }

        return $quantityOnhand;
     }
     
    public function getDefaultAddress(&$item)
    {
        if (!empty($item))
        {
            $is_defaultAddress = false;
            foreach ($item as $key => $val) {
                if ($val['isDefault'] == 1) {
                    $defaultAddress = $val;
                    array_splice($item, $key, 1);
                    $is_defaultAddress = true;
                }
            }
            if (!$is_defaultAddress) {
                $defaultAddress = $item[0];
                array_splice($item, 0, 1);
            }
        } else {
            $defaultAddress = [];
        }
        return $defaultAddress;
    }
    
    public function actionGetall(){
     //   $userId = Yii::$app->mobileUser->getId();
        $searchModel = new ProductApi('12321321321321');
        $proGetAll = $searchModel->getAll();

        return $this->render('getall', ['getall'=>$proGetAll,]);
    }
    
    public function getRecommendByBrand($brand, $num=8, $memberId="ftzmall" ,$id)
    {
        //Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $RecommendModel = new RecommendApi();
        $params = [
            "brand" => $brand, //required, 品牌
            "number" => $num, //optional, 推荐商品的数量,默认为8
            "memberId" => $memberId,
        ];
        $recommend = $RecommendModel->recommendByBrand($params);
        $key = key($recommend);
        $recommend = isset($recommend[$key]['result']) ? $recommend[$key]['result'] : [];
        $recommendTrue = array();
        foreach($recommend as $k => $arr)
        {
            if($arr['id']!=$id)
            {
                $recommendTrue[] = $arr;
            }
        }
        return $recommendTrue;
    }
    
    public function getRecommendBycategory($category, $num=8, $memberId="ftzmall",$id)
    {
        //Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $RecommendModel = new RecommendApi();
        $params = [
            "category" => $category, //required, 品牌
            "number" => $num, //optional, 推荐商品的数量,默认为8
            "memberId" => $memberId,
        ];
        $recommend = $RecommendModel->recommendBycategory($params);        
         $key = key($recommend);
        $recommend = isset($recommend[$key]['result']) ? $recommend[$key]['result'] : [];
        $recommendTrue = array();
        foreach($recommend as $k => $arr)
        {
            if($arr['id']!=$id)
            {
                $recommendTrue[] = $arr;
            }
        }
        return $recommendTrue;
    }
    
    public function actionGetproductbyid()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $id = Yii::$app->request->get('id');
        $model = new ProductApi();
        $data = $model->getProductById($id);
        $assets = ArrayHelper::getColumn($data, 'assets'); //缩略图,但我觉得不太对,待确定
        $key = key($assets);
        $assets = isset($assets[$key]) ? $assets[$key] : []; 
        $key = key($data);       
        $data = isset($data[$key]) ? $data[$key] : [];       
        $goodspic = Array();
        foreach($assets as $k => $v)
        {
            if($v['usage'] == "原图")
            {
                if($v['path'] != $data['desc']['fullImage'])
                {
                    $goodspic[$k] = $v; //好像yii没有类似的arrayhelper函数，手动写了，小图的处理方式待定
                    $goodspic[$k]['thumbnail'] = Tools::qnImg($v['path'], 56, 56); //thumbnail这个值已然没用，都用fullImage这个值转大小
                    $goodspic[$k]['bigImage'] = Tools::qnImg($v['path'], 354, 354);  
                    $goodspic[$k]['fullImage'] = Tools::qnImg($v['path'], 800, 800);  
                }
            }                
        } 
    
        $data['goodspic'] = $goodspic;
        $data['desc']['thumbnail'] = Tools::qnImg($data['desc']['fullImage'], 56, 56); //thumbnail这个值已然没用，都用fullImage这个值转大小
        $data['desc']['bigImage'] = Tools::qnImg($data['desc']['fullImage'], 354, 354);            
        $data['desc']['fullImage'] = Tools::qnImg($data['desc']['fullImage'], 800, 800); 
        
        return $data;
    }        
    
    public function actionGnotify($id = '') {
        //$this -> layout = "main";
        return $this->render('/product/gnotify', ['pid' => $id]);
    }

    public function actionChecknobuy() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $params = Yii::$app->request->post();
        $data = ArrayHelper::remove($params, '_csrf');       
        $userId = Yii::$app->mobileUser->getId(); //获取用户默认地址    
        $buylimitsClass = new Buylimits();
        $result = $buylimitsClass->isBuyItem($userId,$params['itemPartnumber']);
        return $result;
    }
    
}
