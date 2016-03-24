<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author yyjia@cn.ibm.com
 */

namespace mobile\models\cps;

use common\models\cps\CpsBaseApi;

/**
 * 用于请求其他数据的基类
 */
class CpsApi extends CpsBaseApi
{

    public function __construct($operatorId='')
    {
        parent::__construct($operatorId);
    }

}
