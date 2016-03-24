<?php

namespace common\models;

use Yii;
use common\models\BaseApi;
use yii\helpers\Url;

require_once Yii::$app->params['CAS']['cas_path'];
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends BaseApi implements \yii\web\IdentityInterface {

    public $realName;
    private $_user = false;
    private $_userId = null;
    private $_userName;

    public function __construct($userId = "") {
        parent::__construct();
        $this->_userId = $userId;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($userId) {
        $session = Yii::$app->getSession();
        $id = $session->getHasSessionId() || $session->getIsActive() ? $session->get('__id') : null;
        $userNmae = $session->getHasSessionId() || $session->getIsActive() ? $session->get('__userName') : null;
        if ($id === null || $userNmae === null) {
            return  null;
        } else {
            $user = new self();
            $user->_userId = $id;
            $user->_userName = $userNmae;
            return $user;
        }
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->_userId;
    }

    public function getUserName() {
        return $this->_userName;
    }

    public function setId($userId) {
        $this->_userId = $userId;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return $this->password === $password;
    }

    public function getRealName() {
        return $this->realName;
    }

    public static function getUserInfoFromCAS() {
        #TODO dcj 添加一个内网的获取用户id的的域名支持，需要后端支持 20150823
        \phpCAS::client(CAS_VERSION_2_0, Yii::$app->params['CAS']['domain'], Yii::$app->params['CAS']['port'], Yii::$app->params['CAS']['path']);
        \phpCAS::setNoCasServerValidation();
        //\phpCAS::setCasServerCACert('C;/server.new.crt');
        //\phpCAS::setDebug('/tmp/phpcas.log');
        \phpCAS::forceAuthentication();
        if (\phpCAS::getUser()) {
            $user = new self();
            $user->_userId = \phpCAS::getAttribute('userId');
            $user->_userName = \phpCAS::getUser();
            return $user;
        } else {
            return null;
        }
    }
    
    public static function isloginCas() {
        #TODO dcj 添加一个内网的获取用户id的的域名支持，需要后端支持 20150823
        \phpCAS::client(CAS_VERSION_2_0, Yii::$app->params['CAS']['domain'], Yii::$app->params['CAS']['port'], Yii::$app->params['CAS']['path']);
        \phpCAS::setNoCasServerValidation();
        //\phpCAS::setCasServerCACert('C;/server.new.crt');
        //\phpCAS::forceAuthentication();
        if (\phpCAS::isAuthenticated()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getUser() {
        if ($this->_user === false) {
            $this->_user = $this->getUserInfoFromCAS();
            #todo，获取用户部分属性，到user hezll 20150826
        }
        return $this->_user;
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login() {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), 0);
        } else {
            return false;
        }
    }

    public function logout() {
        Yii::$app->user->logout();
        \phpCAS::client(CAS_VERSION_2_0, Yii::$app->params['CAS']['domain'], Yii::$app->params['CAS']['port'], Yii::$app->params['CAS']['path']);
        \phpCAS::setNoCasServerValidation();
        //\phpCAS::setDebug('/casphp.log');
        $url = Url::to(['site/'], true);
        \phpCAS::logout(['service' => $url]);
    }

}
