<?php

namespace mobile\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class IndexController extends Controller {

    public $layout = "main";
    public function actionIndex()
    {
        return $this->render('index');
    }

}
