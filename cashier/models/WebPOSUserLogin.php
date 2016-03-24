<?php
namespace cashier\models;

use yii\web\IdentityInterface;
use Yii;
use yii\web\Cookie;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class WebPOSUserLogin extends \yii\web\User{
    
    public function login(IdentityInterface $identity, $duration = 0)
    {
        if ($this->beforeLogin($identity, false, $duration)) {
            $this->switchIdentity($identity, $duration);
            $id = $identity->getId();
            Yii::info($id . 'user id', __METHOD__);
            $ip = Yii::$app->getRequest()->getUserIP();
            if ($this->enableSession) {
                $log = "User '$id' logged in from $ip with duration $duration.";
            } else {
                $log = "User '$id' logged in from $ip. Session not enabled.";
            }
            Yii::info($log, __METHOD__);
            $this->afterLogin($identity, false, $duration);
            $this->plantCookie($identity,$duration);
        }
        return !$this->getIsGuest();
    }
    
    public function logout($destroySession = true)
    {
        $identity = $this->getIdentity();
        Yii::$app->getResponse()->getCookies()->remove('_rn', true);
        
        if ($identity !== null && $this->beforeLogout($identity)) {
            $this->switchIdentity(null);
            $id = $identity->getId();
            $ip = Yii::$app->getRequest()->getUserIP();
            Yii::info("User '$id' logged out from $ip.", __METHOD__);
            if ($destroySession && $this->enableSession) {
                Yii::$app->getSession()->destroy();
            }
            $this->afterLogout($identity);
            setcookie('_u',null,time()-3600,'/',null,false,true);
            
        }
        
        
        Yii::$app->getResponse()->getCookies()->remove($this->identityCookie['name'], false);
        return $this->getIsGuest();
    }
    
    
  
    public function plantCookie($identity,$duration)
    {
        $userInfo  = json_encode([$identity->getId()], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        setcookie('_u',$userInfo,time()+3600,'/',null,false,true);
        
    }
}