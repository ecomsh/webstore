<?php

namespace frontend\controllers;


use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class HwzgController extends Controller {

    public $layout = "main";
    public function actionIndex()
    {
        return $this->render('/hwzg/index');
    }
}

