<?php


namespace cashier\models;

use common\models\CartBaseApi;
use common\helpers\Tools;


class CartApi extends CartBaseApi
{

    public function callErrorProcess($errorCode = '99001', $errorMsg = '', $errorAll = '')
    {
        $data = Tools::error($errorCode, $errorMsg, $this->format, 'CartApi', $errorAll);
    }

}