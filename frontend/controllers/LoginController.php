<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class LoginController extends Controller
{

    public $layout = "main";

    public function actionIndex()
    {
        Yii::$app->session->open();
        Yii::$app->session->setTimeout(7*24*3600);
        $model = new User();
        $model->login();
        return $this->goBack();
    }

    public function actionLogout()
    {
        Yii::$app->session->open();
        $model = new User();
        $model->logout();
    }

    public function actionGetcookie()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->session->open();
//        $model = new User();
//        if($model->isloginCas()){
//            $model->login();
//        }
        $userName = Yii::$app->user->identity;
        if ($userName){ 
            return ['userName'=> $userName->getUserName()];
        }
        else 
        {
            return [];
        }
    }

//    public function actionPassportlost()
//    {
//        return $this->render('/login/passport-lost1');
//    }
//
//    public function actionPassportlost2()
//    {
//        return $this->render('/login/passport-lost2');
//    }

}
