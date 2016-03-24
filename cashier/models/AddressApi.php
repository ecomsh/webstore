<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace cashier\models;

use common\models\AddressBaseApi;
use common\helpers\Tools;

/**
 * 用于请求web端地址数据的类
 */
class AddressApi extends AddressBaseApi
{

    /**
     * 验证器，验证规则
     * @return type
     */
    public function rules()
    {
        return  parent::rules();
    }

    /**
     * 只有在这里的属性，才会在对应的场景中可以用
     * @return type
     */
    public function scenarios()
    {
        return parent::scenarios();
    }

    public function attributeLabels()
    {
        return parent::attributeLabels();
    }

    public function __construct($operatorId = '')
    {
        parent::__construct($operatorId);
    }


    public function callErrorProcess($errorCode = '99001', $errorMsg = '', $errorAll = '')
    {
        $data = Tools::error($errorCode, $errorMsg, $this->format, 'AddressApi', $errorAll);
    }

}
