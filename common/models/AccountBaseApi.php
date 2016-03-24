<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace common\models;

use Yii;
use common\models\BaseApi;

/**
 * 用于请求其他数据的基类
 */
class AccountBaseApi extends BaseApi
{
     private $_operatorId;
     private $_baseUri;

    public function __construct($userId)
    {
        parent::__construct($userId);
        $this->_baseUri = Yii::$app->params['sm']['pay']['baseUrl'];
        $this->_operatorId = $userId? $userId: '';
    }

    /**
     * 根据用户id获得对应的账户信息
     * input params:
     * $uerId
     */
    public function getAccountInfo($userId = ''){
        $tmpUserId = $userId? $userId:$this->_operatorId;
        $tmp_url = $this->_baseUri . 'account/userId/' . $tmpUserId;
        return $this->get(['account' => $tmp_url], [], 'GET');
    }

    /**
     * 根据用户id获得对应的账户记录
     * input params:
     * $uerId
     */
    public function getAccountRecord($userId = ''){
        $tmpUserId = $userId? $userId:$this->_operatorId;
        $tmp_url = $this->_baseUri . 'accountrecord/userId/' . $tmpUserId;
        return $this->get(['account' => $tmp_url], [], 'GET');
    }
    
    /**
     * 账户充值
     * input params:
     * $uerId -- userid
     * $depositAmount --存款金额
     */
    public function depositForAccount($depositAmount, $userId = ''){
        $tmpUserId = $userId? $userId:$this->_operatorId;
        $tmp_url = $this->_baseUri . 'rechargeurl/userId/' . $tmpUserId . '/paymentmethod/Account/amount/' . $depositAmount;
        return $this->get(['account' => $tmp_url], [], 'GET');
    }
}
