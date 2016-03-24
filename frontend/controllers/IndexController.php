<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class IndexController extends Controller {

    public $layout = "index_main";
    public function actionIndex()
    {
        return $this->render('index');
    }

}
