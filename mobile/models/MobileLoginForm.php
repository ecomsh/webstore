<?php

namespace mobile\models;

use yii\base\Model;
use mobile\models\MobileUser;
use Yii;
use common\models\BaseApi;

/**
 * login form
 */
class MobileLoginForm extends BaseApi {

    public $username;
    public $password;
    public $verifyCode;
    public $stub;

    public function attributeLabels() {
        return [
            'username' => '用户名',
            'password' => '密码',
            'verifyCode' => '验证码'
        ];
    }

    /**
     * 只有在这里的属性，才会在对应的场景中可以用
     * @return type
     */
    public function scenarios() {
        return [
            'index' => ['username', 'password', 'verifyCode'],
            'create' => ['username', 'password', 'verifyCode'],
            'ajaxUsername' => ['username'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['username', 'password'], 'required', 'on' => ['index', 'create']],
            ['username', 'filter', 'filter' => 'trim'],
            ['verifyCode', 'captcha', 'message' => '验证码错误'],
            ['username', 'checkUsername'],
        ];
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

    public function login($params) {
        $muser = new MobileUser();
        $user = $muser->login($params);
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

    public function checkUsername($attribute, $params) {
        $user = new MobileUser();
        $username = $this->username;
        $phonePattern = '/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/';
        $emailPattern = '/^[a-zA-Z0-9_\\-]{1,}@[a-zA-Z0-9_\\-]{1,}\\.[a-zA-Z0-9_\\-.]{1,}$/';
        if (preg_match($phonePattern, $username)) {
            $type = 'mobile';
        } else if (preg_match($emailPattern, $username)) {
            $type = 'email';
        } else {
            $type = 'username';
        }
        $userExist = $user->checkIdentity($type, $username);
        if (!$userExist) {
            if ($type == 'username') {
                $this->addError($attribute, '该用户不存在，请更换用户名或立即注册');
            }
            //由于个别用户的username是手机号或者email格式，对于手机号和email的，除了用mobile和email的type检查是否存在，还需要用username检查是否存在。
            else {
                $type = 'username';
                $usernameExist = $user->checkIdentity($type, $username);
                if(!$usernameExist){
                    $this->addError($attribute, '该用户不存在，请更换用户名或立即注册');
                }
            }
        }
    }

}
