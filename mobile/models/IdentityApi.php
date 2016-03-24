<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace mobile\models;

use common\models\IdentityBaseApi;

/**
 * 用于请求其他数据的基类
 */
class IdentityApi extends IdentityBaseApi
{
    public function __construct($userid = '')
    {
        parent::__construct($userid);
    }
    
}
