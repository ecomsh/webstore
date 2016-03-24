<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class ComplainController extends Controller {
    public $layout = "user_main";
    public function actionIndex()
    {
        return $this->render('/user/complain');
    }
    public function actionAdd()
    {
        return $this->render('/user/complain-add');
    }
}