<?php

namespace mobile\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class BindMobileForm extends Model {

    public $mobile;
    public $smsCode;
    public $smsStub;
    public $verifyCode;
    

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['mobile', 'smsCode', 'verifyCode'], 'required'],
	    ['mobile', 'trim'],
            ['mobile', 'mobile\validators\MobileValidator'],
            ['mobile', 'checkMobileAvailable'],
            ['smsCode', 'verifySMSCode'],
            ['verifyCode', 'captcha']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'mobile' => '手机号',
            'smsCode' => '短信验证码',
            'verifyCode' => '验证码'
        ];
    }

    /**
     * 只有在这里的属性，才会在对应的场景中可以用
     * @return type
     */
    public function scenarios() {
        return [
            'indexexcluesevc' => ['mobile', 'smsCode'],
            'index' => ['mobile', 'smsCode', 'verifyCode'],
            'ajaxMobile' => ['mobile'],
            'ajaxsmsCode' => ['mobile', 'verifyCode'],
        ];
    }

    public function checkMobileAvailable($attribute) {
        $userId = Yii::$app->mobileUser->getId();
        $IdApi = new IdentityApi($userId);
        $params = [
            'identity' => $this->mobile,
            'type' => 'mobile'
        ];

        $result = $IdApi->checkIdentity($params);

        if ($result['identity']['result'] === true) {
            $this->addError($attribute, '手机号已经被绑定');
        }
    }

    private function getIdentifyByType($userIdentities, $type) {

        //     	echo var_dump($this->userIdentities);
        $count_json = count($userIdentities);
        for ($i = 0; $i < $count_json; $i++) {
            if ($userIdentities[$i]['type'] == $type) {
                return $userIdentities[$i]['identity'];
            }
        }
        return null;
    }

    public function verifySMSCode($attribute, $params) {

        $session = Yii::$app->session;
        $validationStub = $session ['smsStub'];
        if (!isset($validationStub)) {
            $this->addError($attribute, '请先点击获取验证码');
            return;
        }
        $userId = Yii::$app->mobileUser->getId();
        $IdApi = new IdentityApi($userId);
        $params = [
            'mobile' => $this->mobile,
            'code' => $this->smsCode,
            'validationStub' => $validationStub
        ];

        $result = $IdApi->validateSMSCode($params);

        if ($result['identity']['result'] !== true) {
            $this->addError($attribute, '验证码错误');
        }
    }

    public function bindUser($type) {
        $session = Yii::$app->session;
        $userId = Yii::$app->mobileUser->getId();
        $idApi = new IdentityApi($userId);
        $params = [];
        if ($type == 'mobile') {
            $params = [
                'identityType' => 'mobile',
                'identityCode' => $this->mobile,
                'userId' => Yii::$app->mobileUser->getId(),
            ];
        }
        $user = $idApi->bindUser($params);
        if (isset($user['identity']['userId'])) {
            return $user;
        } else {
            return null;
        }
    }

}
