<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\LogintestApi;
use yii\captcha\Captcha;

/**
 * Site controller
 */
class LogintestController extends Controller
{

    public $layout = "main-login-register";

    public function actionIndex()
    {      
        $model = new LogintestApi();
        return $this->render('/login/login', [
            'model' => $model,                   
        ]);
    }
    
    public function actionRegister()
    {      
        $model = new LogintestApi();
        return $this->render('/login/register', [
            'model' => $model,                   
        ]);
    }
    
    public function actions() {
        return [
            'captcha' =>  [
                'class' => 'yii\captcha\CaptchaAction',
                'height' => 50,
                'width' => 80,
                'minLength' => 4,
                'maxLength' => 4
            ],
        ];
    }
}