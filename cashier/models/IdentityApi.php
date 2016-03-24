<?php


namespace cashier\models;

use common\models\IdentityBaseApi;
use common\helpers\Tools;


class IdentityApi extends IdentityBaseApi
{

    public function callErrorProcess($errorCode = '99001', $errorMsg = '', $errorAll = '')
    {
        $data = Tools::error($errorCode, $errorMsg, $this->format, 'IdentityApi', $errorAll);
    }
}