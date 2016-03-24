<?php

namespace frontend\controllers;

use Yii;
use Yii;use yii\web\Controller;

/**
 * Site controller
 */
class BksgController extends Controller {

    public $layout = "main";
    public function actionIndex()
    {
        return $this->render('/bksg/index');
    }
}

