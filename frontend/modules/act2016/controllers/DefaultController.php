<?php

namespace frontend\modules\act2016\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
           var_dump($this->getViewPath());
        return $this->render('index');
    }
}
