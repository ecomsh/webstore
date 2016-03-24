<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author yyjia@cn.ibm.com
 */

namespace frontend\models;

use common\models\InventoryBaseApi;

/**
 * 用于请求web端库存数据的类
 */
class InventoryApi extends InventoryBaseApi
{

    public function __construct($operatorId = '')
    {
        parent::__construct($operatorId);
    }

    public function rules()
    {
        return parent::rules();
    }
    
}
