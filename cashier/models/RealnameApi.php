<?php


namespace cashier\models;

use common\models\RealnameBaseApi;
use common\helpers\Tools;


class RealnameApi extends RealnameBaseApi
{

    public function callErrorProcess($errorCode = '99001', $errorMsg = '', $errorAll = '')
    {
        $data = Tools::error($errorCode, $errorMsg, $this->format, 'RealnameApi', $errorAll);
    }

}