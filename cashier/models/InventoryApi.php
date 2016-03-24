<?php


namespace cashier\models;

use common\models\InventoryBaseApi;
use common\helpers\Tools;


class InventoryApi extends InventoryBaseApi
{

    public function callErrorProcess($errorCode = '99001', $errorMsg = '', $errorAll = '')
    {
        $data = Tools::error($errorCode, $errorMsg, $this->format, 'InventoryApi', $errorAll);
    }

}