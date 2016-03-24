<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace frontend\models;

use common\models\AccountBaseApi;

/**
 * 用于请求其他数据的基类
 */
class AccountApi extends AccountBaseApi
{

    public function __construct($operatorId='')
    {
        parent::__construct($operatorId);
    }

}
