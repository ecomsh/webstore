<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author yyjia@cn.ibm.com
 */

namespace common\models;

use Yii;
use common\models\BaseApi;
use common\data\APIDataProvider;
use common\helpers\Tools;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

/**
 * 商品类的接口
 */
class ProductBaseApigai extends BaseApi
{

//    private $_operatorId;
    private $_baseUri;
    private $_basePriceUri;
    private $_baseSearchUri;
    public function __construct($userId = '')
    {
        parent::__construct($userId);
//        $this->operatorId = $userId? $userId:'anonymousUser';
        $this->_baseUri = Yii::$app->params['sm']['product']['baseUrl'];
        $this->_basePriceUri = Yii::$app->params['sm']['price']['baseUrl'];
//        $header = ['X-dbecom-OperatorId:'.$this->operatorId, 'X-dbecom-AppId:Web'];
//        $this->header = array_merge($header, $this->header);
    }
    
    /**
     * 获取产品详情
     * input params can be product id, sku id and catalog id.
     */
    public function getProductById($id)
    {
        $tmp_url = $this->_baseUri .'item/_byId/'. $id;
//        $this->header = ['Content-Type=application/json', 'X-dbecom-OperatorId='.$this->operatorId];
        return $this->get(['product' => $tmp_url], [], 'GET', false);
    }
    
    /**
     * 获取多个产品详情，支持catalogId
     * @input
     * $ids => [id1, id2, id3] //required, can be product id, sku id.若id只是一个时，可以用string形式
     * $params => [         //optional,需要query的keys，请严格按照下面的入参填写，大小写敏感 
     *      'member_id',    //填上这些字段之后，后端返回结果中对应项（和固定返回项key, id, type, partnumber, salesVolumn, buyable）有值，其余各项值为空。
     *      'mf_partnumber',
     *      'mf_name',
     *      'sales_type',
     *      'channel_type',
     *      'min_buy_count',
     *      'max_buy_count',
     *      'sorted_price'
     * ]
     */
    public function getProductByIds($ids, $params=[])
    {
        $tmp_url = $this->_baseUri .'item/_byIds?ids=';
        if(is_array($ids))
        {
            $comb_ids = implode('|',$ids);
            $comb_ids = urlencode($comb_ids);
        }
        else{
            $comb_ids = $ids;
        }
        $tmp_url = $tmp_url . $comb_ids;
        if(!empty($params))
        {
            $tmp_url = $tmp_url . '&template=';
            $comb_params = implode('|',$params);
            $comb_params = urlencode($comb_params);
            $tmp_url = $tmp_url . $comb_params;            
        }
        return $this->get(['product' => $tmp_url], [], 'GET');
    }
    /**
     * 查询产品价格，只从一个pricelist里面查询
     * $params = {
     * "priceList" => "list" or "offer" or "promotion",
     * "itempartNumber" => 从前端取得的itempartNumber,
     * "itemOrg" => "ftzmall",
     * "shop" => "ftzmall",
     * "queryItemType" => "Product",(optional，有此参数的话，这个api返回当前商品及子sku(如果有子sku的话)的所有价格，若无此参数，这个api只会返回当前商品的价格)
     * }
     */
    public function getProductPrice($params = array())
    {
        if (isset($params['priceList']) && isset($params['itempartNumber']) && isset($params['itemOrg']) && isset($params['shop'])){
            $priceList = $params['priceList'];
            $itemNo = $params['itempartNumber'];
            $itemNo = urlencode($itemNo);
            $itemOrg = $params['itemOrg'];
            $shop = $params['shop'];
            $tmp_url = $this->_basePriceUri . 'pricelist/' . $priceList . '/item/' . $itemNo . '/itemOrganization/' . $itemOrg . '/shop/' .$shop;
            if(isset($params['queryItemType']))
            {
                $tmp_url = $tmp_url . '?queryItemType=' . $params['queryItemType'];
            }
//            $this->header = ['Content-Type=application/json', 'X-dbecom-OperatorId='.$this->operatorId];
            return $this->get(['pay' => $tmp_url], [], 'GET');
        }
        else{
            $msg = YII_DEBUG? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'getProductPrice input param error' . $msg);
        }
    }
    
    /**
     * 查询产品价格，从多个pricelist里面查询，也支持从单个pricelist里面查询
     * $params = {
     * "priceList" => 
     *          [
     *              "list",
     *              "offer",  //可任选某种或则某几种list查询，若查询单个pricelist可使用string形式
     *              "promotion"
     *          ],
     * "itempartNumber" => 从前端取得的itempartNumber,
     * "itemOrg" => "ftzmall",
     * "shop" => "ftzmall",
     * "queryItemType" => "Product" or "Package",(optional，大小写敏感，有此参数的话，这个api返回当前商品及子sku(如果有子sku的话)的所有价格，若无此参数，这个api只会返回当前商品的价格)
     * }
     */
    public function getProductPrices($params = array())
    {
        if (isset($params['priceList']) && isset($params['itempartNumber']) && isset($params['itemOrg']) && isset($params['shop'])){
            $itemNo = $params['itempartNumber'];
            $itemNo = urlencode($itemNo);
            $itemOrg = $params['itemOrg'];
            $shop = $params['shop'];
            if(is_array($params['priceList']))
            {
                $priceList = implode('|', $params['priceList']);
            }
            else{
                $priceList = $params['priceList'];
            }
            $enpriceList = urlencode($priceList);
            $tmp_url = $this->_basePriceUri . 'pricelists/' . $enpriceList . '/item/' . $itemNo . '/itemOrganization/' . $itemOrg . '/shop/' .$shop;
            if(isset($params['queryItemType']))
            {
                $tmp_url = $tmp_url . '?queryItemType=' . $params['queryItemType'];
            }
            return $this->get(['pay' => $tmp_url], [], 'GET');
        }
        else{
            $msg = YII_DEBUG? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'getProductPrice input param error' . $msg);
        }
    }
    /**
     * 查询单件商品的购买价格（区别于getProductPrices，那个返回的价格会包含阶梯价格，这个api只返回单件商品的购买价格），从多个pricelist里面查询， 也支持从单个pricelist里面查询
     * $params = {
     * "priceList" => 
     *          [
     *              "list",
     *              "offer",  //可任选某种或则某几种list查询，若查询单个pricelist可使用string形式
     *              "promotion"
     *          ],
     *  "itemInfo" => [        //required
     *       "itempartNumber1" => "itemOrg1",
     *       "itempartNumber2" => ""itemOrg2"",
     *       "itempartNumber3" => "itemOrg3"
     * ],
     * "shop" => "ftzmall",
     * "queryItemType" => "Product" or "Package",(optional，不确定这个查询参数是否支持！！大小写敏感，有此参数的话，这个api返回当前商品及子sku(如果有子sku的话)的所有价格，若无此参数，这个api只会返回当前商品的价格)
     * }
     */
    public function getSinglePrices($params = array())
    {
        if (isset($params['priceList']) && isset($params['itemInfo']) && isset($params['shop'])){
            $shop = $params['shop'];
            if(is_array($params['priceList']))
            {
                $priceList = implode('|', $params['priceList']);
            }
            else{
                $priceList = $params['priceList'];
            }
            $enpriceList = urlencode($priceList);
            
            if (count($params['itemInfo']) > 1)
            {
                $partnumber = array_keys($params['itemInfo']);
                $org = array_values($params['itemInfo']);
                $itemNo = implode('|', $partnumber);
                $itemOrg = implode('|', $org);
            } else
            {
                $itemNo = key($params['itemInfo']);
                $itemOrg = $params['itemInfo'][$itemNo];
            }
            $enItemNo = urlencode($itemNo);
            $enItemOrg = urlencode($itemOrg);
            
            $tmp_url = $this->_basePriceUri . '_singlePriceInfo/pricelists/' . $enpriceList . '/items/' . $enItemNo . '/itemOrganizations/' . $enItemOrg . '/shop/' .$shop;
            if(isset($params['queryItemType']))
            {
                $tmp_url = $tmp_url . '?queryItemType=' . $params['queryItemType'];
            }
            return $this->get(['price' => $tmp_url], [], 'GET');
        }
        else{
            $msg = YII_DEBUG? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'getActualPrices input param error' . $msg);
        }
    }
    
    /**
     * 获取制定类目下的商品列表，支持query params
     * $shop (一期只支持ftzmall)
     * $Id --- Category ID 
     * $params = [    //optional，以下四组每组都是可有可无
     *      "facets" => [
     *          "facetname1" => [facet1_value1, facet1_value2], //Note: the values must be array, or the implode function would crash!
     *          "facetname2" => [facet2_value1, facet2_value2]
     *      ],
     *      "range" =>[
     *          "rangeField"=> "price",
     *          "rangeFrom" => "xxx",
     *          "rangeTo" => "xxx"
     *      ],
     *      "sort" =>[
     *          "sortField" => "sorted_price" or "salesVolumn",
     *          "sortType" => "desc" or "asc"
     *      ],
     *      "pageinfo" =>[
     *          "pageSize" => "xxx",
     *          "currentPage" => "xxx"
     *      ]
     *]} 
     */
    public function getProListByCatId($shop, $id, $params = array())
    {
        $id_encode = urlencode($id);
        $tmp_url = $this->_baseUri .'shop/' . $shop . '/item/_byCategory/'. $id_encode;
        if (!empty($params))
        {
            $tmp_url = $tmp_url . '?';
            if(isset($params['facets']))
            {
                foreach($params['facets'] as $k=>$v){
                    $str = $k.':';
                     if (is_array($v))
                     {
                        $str .= implode(';',$v);
                     }
                     else{
                         $str .= $v;
                     }
                    $strs[] = $str;
                }
                $facets = implode('|',$strs); 
                $facet_encode = urlencode($facets);
                $tmp_url = $tmp_url .'facets=' . $facet_encode; 
            }
            
            if(isset($params['range']))
            {
                $range = http_build_query($params['range']);
                $tmp_url = $tmp_url . '&' . $range;
            }
            
            if(isset($params['sort']))
            {
                $sort = http_build_query($params['sort']);
                $tmp_url = $tmp_url . '&' . $sort;
            }
            
            if(isset($params['pageinfo']))
            {
                $pageinfo = http_build_query($params['pageinfo']);
                $tmp_url = $tmp_url . '&' . $pageinfo;
            }
        }
        return $this->get(['product' => $tmp_url], [], 'GET');
    }
    
    /**
     * 支持分页的获取制定类目下的商品列表，支持query params
     * $shop (一期只支持ftzmall)
     * $CategoryId 
     * $params = [    //optional，以下四组每组都是可有可无
     *      "facets" => [
     *          "facetname1" => [facet1_value1, facet1_value2], //Note: the values must be array, or the implode function would crash!
     *          "facetname2" => [facet2_value1, facet2_value2]
     *      ],
     *      "range" =>[
     *          "rangeField"=> "price",
     *          "rangeFrom" => "xxx",
     *          "rangeTo" => "xxx"
     *      ],
     *      "sort" =>[
     *          "sortField" => "sorted_price" or "salesVolumn",
     *          "sortType" => "desc" or "asc"
     *      ],
     *      "pageinfo" =>[
     *          "pageSize" => "xxx",
     *          "currentPage" => "xxx"
     *      ]
     *]} 
     */
    public function getProDataProvider($shop, $id, $params = array()){
        $id_encode = urlencode($id);
        $tmp_url = $this->_baseUri .'shop/' . $shop . '/item/_byCategory/'. $id_encode;
        $pagesize = 20;
        if (!empty($params))
        {
            $tmp_url = $tmp_url . '?';
            if(isset($params['facets']))
            {
                foreach($params['facets'] as $k=>$v){
                    $str = $k.':';
                     if (is_array($v))
                     {
                        $str .= implode(';',$v);
                     }
                     else{
                         $str .= $v;
                     }
                    $strs[] = $str;
                }
                $facets = implode('|',$strs); 
                $facet_encode = urlencode($facets);
                $tmp_url = $tmp_url .'facets=' . $facet_encode;
            }
            
            if(isset($params['range']))
            {
                $range = http_build_query($params['range']);
                $tmp_url = $tmp_url . '&' . $range;
            }
            
            if(isset($params['sort']))
            {
                $sort = http_build_query($params['sort']);
                $tmp_url = $tmp_url . '&' . $sort;
            }
            
            if(isset($params['pageinfo']))
            {
                $pageinfo = http_build_query($params['pageinfo']);
                $tmp_url = $tmp_url . '&' . $pageinfo;
                $pagesize = $params['pageinfo']['pageSize'];
            }
        }
        $provider = new APIDataProvider([
            'url' => $tmp_url,
            'key' => 'key',
            'pageKey' => 'pageInfo',
            'header' => $this->header,
            'dataKey' =>'result',
            'pagination' => [
                'pageSize' => $pagesize,
            ],
        ]);
        return $provider;
    }
    
    public function getAll(){
        
       
        $url = 'http://119.254.100.251:48081/search-web/rest/v1/search/item/_byTypes?types=Item'; //fixme if this deployed on api.soupian.me
                
        $data = $this->get(array('product'=>$url),array())['product'];

        $provider = new ArrayDataProvider([
                'allModels' => $data
        ]);

        return $provider;
        
    }
    /*
     * 按关键字搜索商品，直接返回后端结果，不支持分页
     * $params = [    //optional，以下六组每组都是可有可无
     *      "memberId" => "ftzmall",   //一期只支持ftzmall，后期支持多商店时，此项不填，代表所有商城搜索，此项填某个商店id，代表相应商店内搜索
     *      "term" => "xxx",  //从前端搜索框获得，搜索框没填时，不传此参数，则返回全部商品
     *      "facets" => [
     *          "facetname1" => [facet1_value1, facet1_value2], //Note: the values must be array, or the implode function would crash!
     *          "facetname2" => [facet2_value1, facet2_value2]
     *      ],
     *      "range" =>[
     *          "rangeField"=> "price",
     *          "rangeFrom" => "xxx",
     *          "rangeTo" => "xxx"
     *      ],
     *      "sort" =>[
     *          "sortField" => "sorted_price" or "salesVolumn",
     *          "sortType" => "desc" or "asc"
     *      ],
     *      "pageinfo" =>[
     *          "pageSize" => "xxx",
     *          "currentPage" => "xxx"
     *      ]
     *]
      */
    public function getProByTerm(){
        $tmp_url = $this->_baseUri . '/item/_byTerm/';
        if (!empty($params))
        {
            $tmp_url = $tmp_url . '?';
            
            if(isset($params['memberId']))
            {
                $memberId = urlencode($params['memberId']);
                $tmp_url = $tmp_url . '&memberId=' . $memberId;
            }
            
            if(isset($params['term']))
            {
                $term = urlencode($params['term']);
                $tmp_url = $tmp_url . '&term=' . $term;
            }
            
            if(isset($params['facets']))
            {
                foreach($params['facets'] as $k=>$v){
                    $str = $k.':';
                     if (is_array($v))
                     {
                        $str .= implode(';',$v);
                     }
                     else{
                         $str .= $v;
                     }
                    $strs[] = $str;
                }
                $facets = implode('|',$strs); 
                $facet_encode = urlencode($facets);
                $tmp_url = $tmp_url .'&facets=' . $facet_encode;
            }
            
            if(isset($params['range']))
            {
                $range = http_build_query($params['range']);
                $tmp_url = $tmp_url . '&' . $range;
            }
            
            if(isset($params['sort']))
            {
                $sort = http_build_query($params['sort']);
                $tmp_url = $tmp_url . '&' . $sort;
            }
            
            if(isset($params['pageinfo']))
            {
                $pageinfo = http_build_query($params['pageinfo']);
                $tmp_url = $tmp_url . '&' . $pageinfo;
            }
        }
        
        return $this->get(['product' => $tmp_url], [], 'GET');
        
    }
    
    /**
     * 支持分页的按关键字搜索的商品列表，支持query params
     * $params = [    //optional，以下七组每组都是可有可无
     *      "memberId" => "ftzmall",   //一期只支持ftzmall，
     *                     //后期支持多商店时，此项不填，代表所有商城搜索，此项填某个商店id，代表相应商店内搜索
     *      "term" => "xxx",  //从前端搜索框获得，搜索框没填时，不传此参数，则返回全部商品
     *      "facets" => [
     *          "facetname1" => [facet1_value1, facet1_value2], //Note: the values must be array, or the implode function would crash!
     *          "facetname2" => [facet2_value1, facet2_value2]
     *      ],
     *      "range" =>[
     *          "rangeField"=> "price",
     *          "rangeFrom" => "xxx",
     *          "rangeTo" => "xxx"
     *      ],
     *      "sort" =>[
     *          "sortField" => "sorted_price" or "salesVolumn",
     *          "sortType" => "desc" or "asc"
     *      ],
     *      "pageinfo" =>[
     *          "pageSize" => "xxx",
     *          "currentPage" => "xxx"
     *      ],
     *      "channel" => "xxx" //0--mobile and pc， 1--mobile only, 2--pc only
     *] 
     */
    public function getProByTermWithP($params = array()){
        $tmp_url = $this->_baseUri . 'item/_byTerm/';
        $pagesize = 20;//#todo 
        if (!empty($params))
        {
            $tmp_url = $tmp_url . '?';
            
            if(isset($params['memberId']))
            {
                $memberId = urlencode($params['memberId']);
                $tmp_url = $tmp_url . '&memberId=' . $memberId;
            }
            
            if(isset($params['term']))
            {
                $term = urlencode($params['term']);
                $tmp_url = $tmp_url . '&term=' . $term;
            }
            
            if(isset($params['facets']))
            {
                foreach($params['facets'] as $k=>$v){
                    $str = $k.':';
                     if (is_array($v))
                     {
                        $str .= implode(';',$v);
                     }
                     else{
                         $str .= $v;
                     }
                    $strs[] = $str;
                }
                $facets = implode('|',$strs); 
                $facet_encode = urlencode($facets);
                $tmp_url = $tmp_url .'&facets=' . $facet_encode;
            }
            
            if(isset($params['range']))
            {
                $range = http_build_query($params['range']);
                $tmp_url = $tmp_url . '&' . $range;
            }
            
            if(isset($params['sort']))
            {
                $sort = http_build_query($params['sort']);
                $tmp_url = $tmp_url . '&' . $sort;
            }
            
            if(isset($params['pageinfo']))
            {
                $pageinfo = http_build_query($params['pageinfo']);
                $tmp_url = $tmp_url . '&' . $pageinfo;
                $pagesize = $params['pageinfo']['pageSize'];
            }
            
            if(isset($params['channel']))
            {
                $channel = $params['channel'];
                $tmp_url = $tmp_url . '&channel=' . $channel;
            }
        }
        $provider = new APIDataProvider([
            'url' => $tmp_url,
            'key' => 'key',
            'pageKey' => 'pageInfo',
            'header' => $this->header,
            'dataKey' =>'result',
            'pagination' => [
                'pageSize' => $pagesize,
            ]
        ]);
        return $provider;
    }
    
    
    
    
    
    
    /*
     * 从byids返回结果中filter出商品的商品类型，partnumber，上下架，起订数量，限定数量，税费信息，活动价格和子类目信息
     * @input:
     * $ids -- => ['itemid1', 'itemid2', 'itemid3'] //required, can be product id, sku id.请以string而非number的形式输入itemids。若id只是一个时，可以用string形式
     * @Return:
     * {
     *     csrp_itemid1=>[
     *          "partNumber" => "xxx";
     *           "buyable" => 0/1;
     *           "itemType" => "xxx" //item, product, package
     *           "minBuyCount" => xxx, //若是null的话没有此项
     *           "maxBuyCount" => xxx, //若是null的话没有此项
     *           "tax" => [
     *              "taxRate" => xxx,
     *              "taxSerialNumber" => xxx
     *            ]
     *          "promotionPriceInfo" => [xxx]; //若为空，不返回此项 
     *          "childCatentries" => [xxx]; //若为空，不返回此项
     *          "productId" => xxx, //当seacrh的商品有父类信息时，返回父类中type为product的产品id，无父类信息时，不返回此项。
     *      ],
     *    csrp_itemid2=>[
     *          "partNumber" => "xxx";
     *           "buyable" => 0/1;
     *           "itemType" => "xxx" //item, product, package
     *           "minBuyCount" => xxx, //若是null的话没有此项
     *           "maxBuyCount" => xxx, //若是null的话没有此项
     *           "tax" => [
     *              "taxRate" => xxx,
     *              "taxSerialNumber" => xxx
     *            ]
     *          "promotionPriceInfo" => [xxx]; //若为空，不返回此项 
     *          "childCatentries" => [xxx]; //若为空，不返回此项
     *          "productId" => xxx, //当seacrh的商品有父类信息时，返回父类中type为product的产品id，无父类信息时，不返回此项。
     *      ],
     *      xxx
     * }
     */
    
    public function filterInfoFromByids($ids)
    {
        $productData = $this->getProductByIds($ids); 
        $cache = Yii::$app->cache;
        
        $resultExtroInfo = array();
        $itemInfo = array();
        $param = array();
        if(is_array($productData) && isset($productData['product']) && count($productData['product']) > 0){
            $productData = $productData['product'];
            $searchResultPrefix = 'csrp_';  //cached search result prefix
            
            foreach($productData as $vp)
            {
                $itemInfo[$vp['partNumber']] = $vp['memberId'];
            }
            $param['priceList'] = ['offer'];
            $param['itemInfo'] =$itemInfo;
            $param['shop'] = 'ftzmall';
            
            $offerPrice = $this->processGetSinglePrice($this->getSinglePrices($param));
            if(empty($offerPrice)){
                $msg = YII_DEBUG? '----|input param is' . json_encode($param) . '|----' : '';
                Yii::error('99008', 'getOfferPrice error, may let luozong check' . $msg);
            }
            foreach($productData as $v)
            {
                $extroInfo = array();
//                $keys = ['partNumber', 'buyable', 'type', 'minBuyCount', 'maxBuyCount',
//                         'tax', 'promotionPriceInfo', 'childCatentries', 'parentCatentries' , 'salesType'];
//                $info = $this->arrayFilter($v, $keys);
                $info = $v;
                
                if(isset($info['tax'])){
                    //$extroInfo['taxRate'] = (number_format($info['tax']['taxRate'],2,'.','') * 100) . '%';
                    $extroInfo['taxRate'] = $info['tax']['taxRate'];
                } 
                if(isset($info['buyable'])){  //change key to buyAble
                    $extroInfo['buyable'] = (int)($info['buyable']);
                    if ($extroInfo['buyable'] < 1) {
                        $cache->set($searchResultPrefix . $v['id'], $extroInfo, 24*60*60 ); //写缓存 为了checkout 和 orderdetail 
                        $resultExtroInfo[$v['id']] = $extroInfo;
                        continue;// 如果下架 后面都不用算了
                    }
                }
                //拿offerPrice
                if(isset($offerPrice[$v['partNumber'].'|'.$v['memberId']])){
                    $extroInfo['itemOfferPrice'] = number_format($offerPrice[$v['partNumber'].'|'.$v['memberId']],2,'.','');     
                }
                if(isset($info['type'])){
                    $extroInfo['itemType'] = $info['type']; // change key name to itemType
                }
                if(isset($info['minBuyCount']) && $info['minBuyCount']>1){
                    $extroInfo['minBuyCount'] = $info['minBuyCount']; // change key name to itemType
                    setcookie('minBuyCount_'.$v['id'],  $extroInfo['minBuyCount'], 0, '/');
                }
                if(isset($info['maxBuyCount']) && $info['maxBuyCount'] >0){
                    $extroInfo['maxBuyCount'] = $info['maxBuyCount']; // change key name to itemType
                    setcookie('maxBuyCount_'.$v['id'],  $extroInfo['maxBuyCount'], 0, '/');
                }
                if(isset($info['parentCatentries']) && (!empty($info['parentCatentries']))){ //由于一个item有可能捆绑在几种组合商品里，因此parentCatentries有可能有多个，但是type = Product的只有一个。
                    $productId = $this->getProductId($info['parentCatentries']);
                    if($productId){
                        $extroInfo['productId'] = $productId;
                    }
                }
                if(isset($info['tag']) && (!empty($info['tag']))){
                    $tag = $this->getNSelectTag($info['tag']);
                    if($tag !== null){
                        $extroInfo['N-tagKey'] = $tag['key'];
                        $extroInfo['N-tagName'] = $tag['name'];
                    }
                }
                if(isset($info['promotionPriceInfo']) && (!empty($info['promotionPriceInfo']))){
                    $extroInfo['promotionPrice'] = $info['promotionPriceInfo'][0]['price']; //有可能存在多个货币单位的情况，以后需要修改
                }
                if(isset($info['childCatentries']) && (!empty($info['childCatentries']))){
                    if($extroInfo['itemType'] == 'package'){
                        $extroInfo['children'] = $this->getChilds($info['childCatentries'], $info['salesType']);
                    }
                }
                $cache->set($searchResultPrefix . $v['id'], $extroInfo, 24*60*60 ); //写缓存 为了checkout 和 orderdetail 
                $resultExtroInfo[$v['id']] = $extroInfo;
            }
        }
        return $resultExtroInfo;
    }
    
    private function processGetSinglePrice($offerPrice) {
        $result = array();
        if(is_array($offerPrice) && isset($offerPrice['price']) && count($offerPrice['price']) >0 ){
            $op = $offerPrice['price'];
            foreach ($op as  $value) {
                if (isset($value['offer'])){
                    //以这个商品的partnumber和orgid为key 如果以后加上了shopid 仍然可以扩展
                    //‘|’是为了追随 后端的习惯
                    $result[$value['offer']['itemPartnumber'].'|'.$value['offer']['itemOrgId']] = $value['offer']['priceContent'][0]['value'];
                }
            }
            return $result;
        }
    }






    /*
     * 从array里面提取需要的keys及其值，返回过滤后的array.若对应的值为空，则不返回这一项.s
     *  
     *     
     */
    private function arrayFilter($array, $keys){
        $data = array();
        foreach($keys as $key)
        {
            if(array_key_exists($key, $array) && (!empty($array[$key]))){
                $data[$key] = $array[$key];
            }
        }
        return $data;
    }
    
    public function getChilds($productData,$salesType) {
        $childItems = array();
        if(count($productData)>0)
        {
            foreach ($productData as $key => $item) {
                $child = array();
                $child['quantity'] = $item['quantity'];
                if(isset($item['parentCatentryId'])){
                    $child['parentCatentryId'] = $item['parentCatentryId'];
                }
                $child['itemDisplayText'] = $item['desc']['name'];
                $child['itemImageLink'] = $item['desc']['fullImage'];
                $descriptiveAttributes = ArrayHelper::index($item['descriptiveAttributes'], 'id');
                if(isset($descriptiveAttributes['Sales-Weight']['value'])){
                    $child['Sales-Weight'] = $descriptiveAttributes['Sales-Weight']['value'];
                }else{
                    $child['Sales-Weight'] = ' ';
                }
                if(isset($descriptiveAttributes['Sales-WeightUOM']['value'] )){
                    $child['Sales-WeightUOM'] = $descriptiveAttributes['Sales-WeightUOM']['value']; 
                }else{
                    $child['Sales-WeightUOM'] = ' '; 
                }
                if(in_array($salesType, Yii::$app->params['sm']['store']['isCBT'])){
                    $child['itemTaxRate'] = ($item['tax']['taxRate']* 100) . '%';;
                }
                $childItems[$item['id']] = $child;
            }
        }
        return $childItems;
    }
    public function getProductId($productData) {
       $id = null;
       foreach($productData as $entry){
            if($entry['type'] == 'Product'){
                $id = $entry['id'];
            }
        }
        return $id;
    }
    
    public function getNSelectTag($tags) {
        $tag = null;
        foreach($tags as $entry){
            if($entry['type'] === 'NM'){
                $tag['name'] = $entry['id'];
                $tag['key'] = $entry['key'];
                break;
            }
        }
        return $tag;
    }
    

    public function getPrealtime_curl($price = array(), $inventory = array(), $id) {
        if (isset($price['priceList']) && isset($price['itempartNumber']) && isset($price['itemOrg']) && isset($price['shop'])){
            $itemNo = $price['itempartNumber'];
            $itemNo = urlencode($itemNo);
            $itemOrg = $price['itemOrg'];
            $shop = $price['shop'];
            if(is_array($price['priceList']))
            {
                $priceList = implode('|', $price['priceList']);
            }
            else{
                $priceList = $price['priceList'];
            }
            $enpriceList = urlencode($priceList);
            $price_url = $this->_basePriceUri . 'pricelists/' . $enpriceList . '/item/' . $itemNo . '/itemOrganization/' . $itemOrg . '/shop/' .$shop;
            if(isset($price['queryItemType']))
            {
                $price_url = $price_url . '?queryItemType=' . $price['queryItemType'];
            }
        }
        else{
            $msg = YII_DEBUG? '----|input param is' . json_encode($price) . '|----' : '';
            return Tools::error('99008', 'getProductPrice input param error' . $msg);
        }

        if ($inventory['itempartNumber'] && $inventory['itemOrg'] && $inventory['shop']) {
            $itemNo = $inventory['itempartNumber'];
            $itemNo = urlencode($itemNo);
            $itemOrg = $inventory['itemOrg'];
            $shop = $inventory['shop'];
            $inventory_url =  Yii::$app->params['sm']['inventory']['baseUrl'] . 'item/' . $itemNo . '/itemOrganization/' . $itemOrg . '/shop/' . $shop;
            if (isset($inventory['country']) && isset($inventory['stateCode']))
            {
                $country = $inventory['country'];
                $stateCode = $inventory['stateCode'];
                $inventory_url .= '?country=' . $country . '&state=' . $stateCode;
                if (isset($inventory['city']))
                {
                    $inventory_url .= '&city=' . $inventory['city'];
                }
            }
        } 

        else
        {
            $msg = YII_DEBUG ? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'getInventory input param error' . $msg);
        }

        $product_url = $this->_baseUri .'item/_byId/'. $id;
//        $this->header = ['Content-Type=application/json', 'X-dbecom-OperatorId='.$this->operatorId];
        $data = $this->get(['price' => $price_url, 'product' => $product_url , 'inventory' => $inventory_url], "", 'GET', false);
        return $data;
    }
    
}