<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace frontend\models;

use common\models\CartBaseApi;

/**
 * 用于请求web端购物车的类
 */
class CartApi extends CartBaseApi
{

    public function __construct($operatorId='')
    {
        parent::__construct($operatorId);
    }

    public function rules()
    {
        return parent::rules();
    }
         
}
