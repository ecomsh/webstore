<?php

namespace mobile\models;

use mobile\models\MobileUser;
use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;

/**
 * API reset 
 * Password reset form
 */
class ResetPwdForm extends Model {

    public $mobile;
    public $newPassword;
    public $confirmNewPassword;
    public $smsCode;
    public $smsCodeStub;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules() {

        return [
            [['mobile', 'newPassword','verifyCode', 'confirmNewPassword', 'smsCode'], 'required'],
            ['mobile', 'trim'],
            ['mobile', '\mobile\validators\MobileValidator'],
            ['mobile', 'checkMobileExist'],
            [['newPassword', 'confirmNewPassword'], 'string', 'min' => 6, 'max' => 20],
//         		根据2015-12-08 panjiaming 从18 那里拿到的需求，把数字字母组合密码策略去掉
//             ['newPassword', 'mobile\validators\PasswordValidator'],
            ["confirmNewPassword", "compare", "compareAttribute" => "newPassword", "message" => "两次密码不一致"],
            ['smsCode', 'string', 'min' => 6],
            ['verifyCode','captcha']
        ];
    }

    /**
     * 只有在这里的属性，才会在对应的场景中可以用
     * @return type
     */
    public function scenarios() {
        return [
            'index' => ['mobile', 'newPassword', 'verifyCode','confirmNewPassword', 'smsCode'],
            'create' => ['mobile', 'newPassword','confirmNewPassword', 'smsCode'],
            'ajaxMobile' => ['mobile'],
            'ajaxsmsCode' => ['mobile', 'verifyCode'],
        ];
    }

    public function checkMobileExist($attribute) {
        $userId = Yii::$app->mobileUser->getId();
        $IdApi = new IdentityApi($userId);
        $params = [
            'identity' => $this->mobile,
            'type' => 'mobile'
        ];

        $result = $IdApi->checkIdentity($params);

        if ($result['identity']['result'] === false) {
            $usernameParam = [
                'identity' => $this->mobile,
                'type' => 'username'
            ];
            $checkResult = $IdApi->checkIdentity($usernameParam);
            if ($checkResult['identity']['result'] === false) {
                $this->addError($attribute, '手机号系统中不存在。');
            }
            else{
                $this->addError($attribute, '该手机号无法验证身份，请联系客服重置密码');
            }
        }
    }

    public function attributeLabels() {
        return [
            'mobile' => '手机号',
            'newPassword' => '密码',
            'confirmNewPassword' => '确认密码',
            'smsCode' => '短信验证码',
            'verifyCode' => '验证码'
        ];
    }

}
