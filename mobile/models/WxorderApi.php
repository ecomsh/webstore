<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace mobile\models;

use Yii;
use common\models\BaseApi;
use common\data\APIDataProvider;
use yii\base\InvalidConfigException;
use yii\base\Exception;
use common\helpers\Tools;

/**
 * 用于请求其他数据的基类
 */
class WxorderApi extends BaseApi
{

    private $_baseUri;
    private $_operatorId;
    private $_salesType = 'cbt';

    public function __construct($salesType, $operatorId = '')
    {

        parent::__construct($operatorId);
        $this->_salesType = $salesType;
        $this->_baseUri = Yii::$app->params['pay']['wx'][$this->_salesType]['baseUrl'];
        $this->_operatorId = $operatorId ? $operatorId : 'anonymousUser';
        
//        $header = ['X-dbecom-OperatorId:'.$this->_operatorId, 'X-dbecom-AppId:Mobile'];
//        $this->header = array_merge($header, $this->header);
    }

    public function createLocalUnifiedOrder($params = [])
    {
        if (isset($params['orderId']) && isset($params['payMethod']))
        {
            $orderId = $params['orderId'];
            $payMethod = $params['payMethod'];
            $tmp_url = $this->_baseUri . 'payurl/orderId/' . $orderId . '/paymentmethod/' . $payMethod;
            return $this->get(['order' => $tmp_url]);
        } else
        {
            $msg = YII_DEBUG ? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'createLocalUnifiedOrder input param error' . $msg);
        }
    }

}
