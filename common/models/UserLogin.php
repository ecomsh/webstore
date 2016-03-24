<?php
namespace common\models;

use yii\web\IdentityInterface;
use Yii;
use yii\web\Cookie;
use yii\helpers\Url;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserLogin extends \yii\web\User{
    
    public function login(IdentityInterface $identity, $duration = 0)
    {
        if ($this->beforeLogin($identity, false, $duration)) {
            $this->switchIdentity($identity, $duration);
            $id = $identity->getId();
            $ip = Yii::$app->getRequest()->getUserIP();
            if ($this->enableSession) {
                $log = "User '$id' logged in from $ip with duration $duration.";
            } else {
                $log = "User '$id' logged in from $ip. Session not enabled.";
            }
            Yii::info($log, __METHOD__);
            $this->afterLogin($identity, false, $duration);
            //$this->plantCookie($identity,$duration);
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
            setcookie('carttotalNum'.$identity->getId(),null,time()-3600,'/',null,false,true);
            //setcookie('_u',null,time()-3600,'/',null,false,true);
        }
        return $this->getIsGuest();
    }
    
    public function plantCookie($identity,$duration)
    {
        $userInfo  = json_encode([$identity->getId(),$identity->getRealName()], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        setcookie('_u',$userInfo,time()+3600,'/',null,false,true);
    }
    
    
    public function switchIdentity($identity, $duration = 0)
    {
        $this->setIdentity($identity);

        if (!$this->enableSession) {
            return;
        }

        $session = Yii::$app->getSession();
        if (!YII_ENV_TEST) {
            $session->regenerateID(true);
        }
        $session->remove($this->idParam);
        $session->remove($this->authTimeoutParam);
        $session->remove('__userName');

        if ($identity) {
            $session->set($this->idParam, $identity->getId());
            $session->set('__userName', $identity->getUserName());
            if ($this->authTimeout !== null) {
                $session->set($this->authTimeoutParam, time() + $this->authTimeout);
            }
            if ($this->absoluteAuthTimeout !== null) {
                $session->set($this->absoluteAuthTimeoutParam, time() + $this->absoluteAuthTimeout);
            }
            if ($duration > 0 && $this->enableAutoLogin) {
                $this->sendIdentityCookie($identity, $duration);
            }
        } elseif ($this->enableAutoLogin) {
            Yii::$app->getResponse()->getCookies()->remove(new Cookie($this->identityCookie));
        }
    }

}