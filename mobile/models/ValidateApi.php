<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace mobile\models;

use common\models\ValidateBaseApi;

/**
 * 用于请求web端购物车的类
 */
class ValidateApi extends ValidateBaseApi {

    public function __construct($operatorId = '') {
        parent::__construct($operatorId);
    }

    public function scenarios() {
        return parent::scenarios();
    }

    public function rules() {
        return parent::rules();
    }

}
