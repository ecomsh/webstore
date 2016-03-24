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

/**
 * 商品类的接口
 */
class RecommendBaseApi extends BaseApi
{
    private $_baseUri;
    public function __construct($userId = '')
    {
        parent::__construct($userId);
        $this->_baseUri = Yii::$app->params['sm']['product']['baseUrl'];
    }
    
    
    /*
     * 普通商品的同品牌推荐，按上架时间降序排列。
     * 目前需求为得到同一品牌下最新上架的8个商品。
     * @input:
     * $params =[
     * "brand" => "xxx", //required, 品牌
     * "number" => "xxx", //optional, 推荐商品的数量,默认为8
     * "memberId" => "xxx" //optional, 一期只支持ftzmall，后期支持多商店时，此项不填，代表所有商城搜索，此项填某个商店id，代表相应商店内搜索
     * ]
     * 
     */
    public function recommendByBrand($params)
    {   
        $tmp_url = $this->_baseUri . 'item/_byTerm/';
        if (isset($params['brand']))
        {
            $tmp_url = $tmp_url . '?facets=brand';
            $brand = ':' . $params['brand'];
            $encode = urlencode($brand);
            $tmp_url = $tmp_url . $encode;
            $page = [
                "pageSize" => 8,
                "currentPage" => 1
            ];
            $sort = [
                "sortField" => "start_date",
                "sortType" => "desc"
            ];
            
            if(isset($params['memberId']))
            {
                $memberId = urlencode($params['memberId']);
                $tmp_url = $tmp_url . '&memberId=' . $memberId;
            }
            
            if(isset($params['number']))
            {
                $page['pageSize'] = $params['number'];
            }
            
            $pageinfo = http_build_query($page);
            $sortinfo = http_build_query($sort);
            $tmp_url = $tmp_url . '&' . $pageinfo . '&' . $sortinfo;
            return $this->get(['recommend' => $tmp_url], [], 'GET');
        }
        else{
                $msg = YII_DEBUG? '----|input param is' . json_encode($params) . '|----' : '';
                return Tools::error('99008', 'recommendByBrand input param error' . $msg);
        }  
    }
    
    /*
     * 普通商品的同类型推荐，按上架时间降序排列。
     * 目前需求为得到同一品牌下最新上架的8个商品。
     * @input:
     * $params =[
     * "category" => "xxx", //required, 类型
     * "number" => "xxx", //optional, 推荐商品的数量,默认为8
     * "memberId" => "xxx" //optional, 一期只支持ftzmall，后期支持多商店时，此项不填，代表所有商城搜索，此项填某个商店id，代表相应商店内搜索
     * ]
     * 
     */
    public function recommendBycategory($params)
    {
         $tmp_url = $this->_baseUri . 'item/_byTerm/';
        if (isset($params['category']))
        {
            $tmp_url = $tmp_url . '?facets=category';
            $category = ':' . $params['category'];
            $encode = urlencode($category);
            $tmp_url = $tmp_url . $encode;
            $page = [
                "pageSize" => 8,
                "currentPage" => 1
            ];
            $sort = [
                "sortField" => "start_date",
                "sortType" => "desc"
            ];
            
            if(isset($params['memberId']))
            {
                $memberId = urlencode($params['memberId']);
                $tmp_url = $tmp_url . '&memberId=' . $memberId;
            }
            
            if(isset($params['number']))
            {
                $page['pageSize'] = $params['number'];
            }
            
            $pageinfo = http_build_query($page);
            $sortinfo = http_build_query($sort);
            $tmp_url = $tmp_url . '&' . $pageinfo . '&' . $sortinfo;
            return $this->get(['recommend' => $tmp_url], [], 'GET');
        }
        else{
                $msg = YII_DEBUG? '----|input param is' . json_encode($params) . '|----' : '';
                return Tools::error('99008', 'recommendBycategory input param error' . $msg);
        }  
    }
    /*
     * 组合商品推荐：最新上架的8个组合商品， 按上架时间降序排列。
     * $params =[
     * "number" => "xxx", //optional, 推荐商品的数量,默认为8
     * "memberId" => "xxx" //optional, 一期只支持ftzmall，后期支持多商店时，此项不填，代表所有商城搜索，此项填某个商店id，代表相应商店内搜索
     * ]
     */
    public function recommendPackage($params =[])
    {
         $tmp_url = $this->_baseUri . 'item/_byTerm/?productType=package';
        
        $page = [
            "pageSize" => 8,
            "currentPage" => 1
        ];
        $sort = [
            "sortField" => "start_date",
            "sortType" => "desc"
        ];

        if(isset($params['memberId']))
        {
            $memberId = urlencode($params['memberId']);
            $tmp_url = $tmp_url . '&memberId=' . $memberId;
        }

        if(isset($params['number']))
        {
            $page['pageSize'] = $params['number'];
        }

        $pageinfo = http_build_query($page);
        $sortinfo = http_build_query($sort);
        $tmp_url = $tmp_url . '&' . $pageinfo . '&' . $sortinfo;
        return $this->get(['recommend' => $tmp_url], [], 'GET'); 
    }
}