<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author yyjia@cn.ibm.com
 */

namespace frontend\models;

use common\models\ProductBaseApi;

/**
 * web端商品类的接口
 */
class ProductApi extends ProductBaseApi
{
    public function __construct($userId = '')
    {
        parent::__construct($userId);
    }
    
}