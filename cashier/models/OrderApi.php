<?php

namespace cashier\models;

use Yii;

use common\models\OrderBaseApi;
use common\helpers\Tools;
use common\data\APIDataProvider;

class OrderApi extends OrderBaseApi
{
    
    public function callErrorProcess($errorCode = '99001', $errorMsg = '', $errorAll = '')
    {
        $data = Tools::error($errorCode, $errorMsg, $this->format, 'BaseApi', $errorAll);

    }
    
    public function getMemOrders($params, $pagesize = 20)
    {
        $baseUrl = Yii::$app->params['o2omemorders']['baseUrl'];
        $provider = new APIDataProvider([
            'url' => $baseUrl,
            'key' => 'id',
            'pageKey' => 'pageInfo',
            'header' => $this->header, //TODO is that ok?
            'dataKey' => 'result',
            'pagination' => [
                'pageSize' => $pagesize,
            ],
            'params' => $params,
        ]);
        return $provider;
    }

}

