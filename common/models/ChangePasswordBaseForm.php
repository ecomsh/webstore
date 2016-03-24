<?php

namespace common\models;

use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;

/**
 * Password reset form
 */
class ChangePasswordBaseForm extends Model {

    public $oldPassword;
    public $password;
    public $confirmPassword;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['oldPassword', 'password', 'confirmPassword'], 'required'],
            [['password'], 'string', 'min' => 6, 'max' => 20],
            ['password', 'compare', 'compareAttribute' => 'oldPassword', 'operator' => '!==', 'message' => '新密码不能和原始密码相同'],
            ["confirmPassword", "compare", "compareAttribute" => "password", "message" => "两次密码不一致"],
//         		根据2015-12-08 panjiaming 从18 那里拿到的需求，把数字字母组合密码策略去掉
//             ['password', 'common\validators\PasswordBaseValidator'],
        ];
    }

    public function attributeLabels() {
        return [
            'oldPassword' => '旧密码',
            'password' => '新密码',
            'confirmPassword' => '确认密码'
        ];
    }

    /**
     * 只有在这里的属性，才会在对应的场景中可以用
     * @return type
     */
    public function scenarios() {
    	return [
    			'index' => ['oldPassword', 'password', 'confirmPassword'],
    			'checkpassword' => ['oldPassword', 'password'],
    	];
    }
    
}
