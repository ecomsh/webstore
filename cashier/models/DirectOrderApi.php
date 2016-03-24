<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author yyjia@cn.ibm.com
 */

namespace cashier\models;

use common\models\DirectOrderBaseApi;
use common\helpers\Tools;

/**
 * 用于请求web-POS端直接下单的类
 */
class DirectOrderApi extends DirectOrderBaseApi
{

    public function __construct($userid = '')
    {
        parent::__construct($userid);
    }

    public function callErrorProcess($errorCode = '99001', $errorMsg = '', $errorAll = '')
    {
        $data = Tools::error($errorCode, $errorMsg, $this->format, 'DirectOrderApi', $errorAll);
    }

 }

