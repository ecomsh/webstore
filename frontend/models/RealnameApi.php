<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace frontend\models;

use yii;
use common\models\RealnameBaseApi;
use common\helpers\Tools;

/**
 * 用于web端实名认证的类
 */
class RealnameApi extends RealnameBaseApi
{


    public function rules()
    {
        return parent::rules();
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

    public function __construct($userId)
    {
        parent::__construct($userId);
    }
}
