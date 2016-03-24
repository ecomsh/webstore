<?php


namespace cashier\models;

use common\models\ProductBaseApi;
use common\helpers\Tools;


class ProductApi extends ProductBaseApi
{

    public function callErrorProcess($errorCode = '99001', $errorMsg = '', $errorAll = '')
    {
        $data = Tools::error($errorCode, $errorMsg, $this->format, 'ProductApi', $errorAll);

    }

}