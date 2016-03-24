<?php

namespace cashier\models;

use Yii;
use common\models\BaseApi;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class WebPOSUser extends BaseApi implements \yii\web\IdentityInterface {

    private $username;
    private $_userId;
    private $_user = false;

    public function __construct($userId = "") {
        parent::__construct($userId);
        $this->_userId = $userId;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {

        $session = Yii::$app->getSession();
        $userInfo_unserilze = $session->getHasSessionId() || $session->getIsActive() ? $session->get('__webPOSUser') : null;
        $userInfo = unserialize($userInfo_unserilze);
        if ($id === null || $userInfo === null) {
            return null;
        } else {
            $user = new self($id);
            $user->_userId = $id;
            $user->_user = $userInfo;
            return $user;
        }
    }

    /**
     * @inheritdoc
     */
    public function getId() {

        return $this->_userId;
    }

    public function getPassport() {
        return $this->_user;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     *
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return $this->password === $password;
    }

    public function getUser() {
        if ($this->_user === false) {
            $this->_user = $this->findIdentity($this->_userId);
        }
        return $this->_user;
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login($params) {

        $IdAPIs = new PassportApi();

        $user = $IdAPIs->logon($params);
        if ($user['identity']['loginCode'] == '00') {//登陆成功
            if (!empty($user['identity']['passport']['roles'])) {
                $session = Yii::$app->session;
                $userid = $user['identity']['passport']['userId'];
                $this->_userId = $userid;
                $session['__webPOSUser'] = serialize($this);
                Yii::$app->webPOSUser->login($this->getUser(), 0);
                return $user;
            }
            else{
                return $user;
            }
        } else {
            //登陆失败，返回错误信息给api 调用者
            return $user;
        }
    }

    public function logout() {
        Yii::$app->webPOSUser->logout();
    }

    public function getAuthKey() {
        
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        
    }

}
