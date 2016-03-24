<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\widgets;

use yii\base\Widget;
use Yii;

class LoginWidget extends Widget
{

    public $message;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $cookies = Yii::$app->request->cookies;

// get the "language" cookie value. If the cookie does not exist, return "en" as the default value.
//        $language = $cookies->getValue('_rn', 'xxoo');
//        return $language;
        Yii::$app->getSession()->set('__returnUrl', Yii::$app->getRequest()->getUrl());
        return $this->render('//login/loginwidget');
    }

}
