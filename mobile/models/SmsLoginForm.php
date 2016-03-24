<?php

namespace mobile\models;

use yii\base\Model;
use mobile\models\MobileUser;
use Yii;
use common\models\BaseApi;

/**
 * login form
 */
class SmsLoginForm extends BaseApi {

    public $mobile;
    public $smsCode;
    public $verifyCode;
    public $stub;

    public function attributeLabels() {
        return [
            'mobile' => '手机号',
            'smsCode' => '动态密码',
            'verifyCode' => '验证码'
        ];
    }

    /**
     * 只有在这里的属性，才会在对应的场景中可以用
     * @return type
     */
    public function scenarios() {
        return [
            'index' => ['mobile', 'smsCode', 'verifyCode'],
            'create' => ['mobile', 'smsCode'],
            'ajaxsmsCode' => ['mobile', 'smsCode'],
            'ajaxData' => ['mobile', 'verifyCode'],
            'ajaxMobile' => ['mobile'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['mobile', 'smsCode', 'verifyCode'], 'required', 'on' => ['index']],
            [['mobile', 'verifyCode'], 'required', 'on' => ['ajaxData']],
            ['mobile', 'trim'],
            ['verifyCode', 'captcha', 'message' => '验证码错误'],
            [['mobile'], '\mobile\validators\MobileValidator'],
            ['mobile', 'checkMobile'],
            ['smsCode', 'verifySMSCode'],
        ];
    }

    public function checkMobile($attribute, $params) {
        $user = new MobileUser();
        $userExist = $user->checkIdentity('mobile', $this->mobile);
        if (!$userExist) {
            $usernameExist = $user->checkIdentity('username', $this->mobile);
            if(!$usernameExist){
                $this->addError($attribute, '该手机未被注册，请更换注册的手机号或立即注册');
            }
            else{
                $this->addError($attribute, '此手机号未被绑定，请用普通方式登录');
            }
        }
    }

    public function verifySMSCode($attribute, $params) {

        $session = Yii::$app->session;
        $validationStub = $session ['smsStub'];

        if (!isset($validationStub)) {
            $this->addError($attribute, '请先点击获取动态密码');
            return;
        }

        $IdApi = new IdentityApi ();
        $params = [
            'mobile' => $this->mobile,
            'code' => $this->smsCode,
            'validationStub' => $validationStub
        ];

        $result = $IdApi->validateSMSCode($params);

        if ($result['identity']['result'] !== true) {
            $this->addError($attribute, '动态密码错误');
        }
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function loginByWeiXin() {
        $muser = new MobileUser();

        $user = $muser->loginByWeiXin();

        return $user;
    }

    public function bindWeiXin() {
        $muser = new MobileUser();

        $user = $muser->bindWeiXin();

        return $user;
    }

    public function login($params) { //TBD需要后端支持动态密码登录
        $session = Yii::$app->session;
        $validationStub = $session ['smsStub'];
        $muser = new MobileUser();
        $loginParams = [
            'mobile' => $params['mobile'],
            'code' => $params['smsCode'],
            'validationStub' => $validationStub
        ];
        $user = $muser->dynamicPwdlogin($loginParams);
        return $user;
    }

    public function isBindIdentity($user, $type) {
        $identities = $user['identity']['identities'];
        $count_json = count($identities);

        for ($i = 0; $i < $count_json; $i++) {
            if ($identities[$i]['type'] == $type) {
                return isset($identities[$i]['identity']);
            }
        }
        return false;
    }

    public function isBindAddress() {

        $muser = new MobileUser();
        return $muser->isBindAddress();
    }

}
