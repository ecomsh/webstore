<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace frontend\models;

use common\models\PaymentBaseApi;

/**
 * 用于请求web端支付数据的类
 */
class PaymentApi extends PaymentBaseApi
{

    public function __construct($userid = '')
    {
        parent::__construct($userid);
    }

 }
