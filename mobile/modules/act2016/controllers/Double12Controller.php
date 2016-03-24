<?php

namespace mobile\modules\act2016\controllers;

use yii\web\Controller;

class Double12Controller extends Controller {

    public function __construct(&$app) {
        echo '活动已下线';exit;
    }

    public function actionIndex() {
        $this->layout = "main";
        return $this->render('main');
    }

    public function actionBaby() {
        $this->layout = "empty";
        return $this->render('baby');
    }

    public function actionHealth() {
        $this->layout = "empty";
        return $this->render('health');
    }

    public function actionLuxury() {
        $this->layout = "empty";
        return $this->render('luxury');
    }

    public function actionMakeups() {
        $this->layout = "empty";
        return $this->render('makeups');
    }

    public function actionFood() {
        $this->layout = "empty";
        return $this->render('food');
    }

}
