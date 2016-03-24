<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author yyjia@cn.ibm.com
 */

namespace mobile\modules\act2016\models;

use common\models\ProductBaseApi;

/**
 * 商品类的接口
 */
class ProductApi extends ProductBaseApi
{

    public function __construct($userId = '')
    {
        parent::__construct($userId);
    }
 
}