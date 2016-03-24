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
 * 用于实名认证的基类
 */
class MemberBaseApi extends BaseApi
{

    public $userId; //": "string",
    public $gender; // 1-男，2-女，null-未知,
    public $_baseUri;


    public function rules()
    {
        return [
            [['gender'], 'required', 'message' => '请选择性别'],
        ];
    }

    /**
     * 只有在这里的属性，才会在对应的场景中可以用
     * @return type
     
    public function scenarios()
    {
        return [
            'index' => ['realName', 'mobile', 'email', 'identityType', 'identityNumber'],
            'create' => ['realName', 'mobile', 'email', 'identityType', 'identityNumber'],
            'update' => ['realName', 'mobile', 'email', 'identityType', 'identityNumber'],
        ];
    }
     *
     */

    public function attributeLabels()
    {
        return [
            'gender' => '',
        ];
    }

    public function __construct($userId)
    {
        parent::__construct($userId);
        $this->userId = $userId;
        $this->_baseUri = Yii::$app->params['sm']['user']['baseUrl'];
    }

    /*
     *  更新用户性别信息 
     *  @input: 
     *  $gender -- 1-男，2-女，null-未知
     * 
     */
    public function updateGender($gender)
    {
        $tmp_url = $this->_baseUri . $this->userId . '/userinfo';
        $params = [
            'gender' => $gender,
        ];
        return $this->update(['member' => $tmp_url], $params);  
    }

}
