<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author yyjia@cn.ibm.com
 */

namespace frontend\models;

use common\models\ProductBaseApigai;
use common\helpers\Tools;

/**
 * web端商品类的接口
 */
class ProductApigai extends ProductBaseApigai
{
    public function __construct($userId = '')
    {
        parent::__construct($userId);
    }

    public function getProductById($id = "")
    {
        $tmp_url = 'http://apia.soupian.me/v1/products/'. $id;
        return $this->get(['product' => $tmp_url], [], 'GET', false);
    }

    public function getPrealtime($params = array())
    {
    	if (isset($params["itempartNumber"]) && isset($params["fatheritempartNumber"]) && isset($params["shop"]) && isset($params["type"]) && isset($params["itemId"])) {
    		$tmp_url = 'http://api3.soupian.me/v1/products/getprealtime?itempartNumber='.$params["itempartNumber"].'&shop='.$params["shop"].'&type='.$params["type"].'&id='.$params["itemId"].'&fatheritempartNumber='.$params['fatheritempartNumber'];
    		return $this->get(['product' => $tmp_url], [], 'GET', false);
    	}

    	else {
    		$msg = YII_DEBUG ? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'getPrealtime input param error' . $msg);
    	}        
    }
    
}