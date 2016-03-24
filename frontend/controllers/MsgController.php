<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;


/**
 * Site controller
 */
class MsgController extends Controller {
    public $layout = "user_main";
    public function actionIndex()
    {
        return $this->render('/user/msg');
    }
    public function actionAdd()
    {
        return $this->render('/user/ordermsg');
    }
}