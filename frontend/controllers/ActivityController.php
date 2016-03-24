<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;



/**
 * Site controller
 */
class ActivityController extends Controller {

    public $layout = "main";
    public function actionIndex()
    {
        return $this->render('/activity/index');
    }
    
    public function actionView($id='')
    {
        if($id=='211'||$id=='226')
        {
            return $this->render('/activity/'.$id);
        }
        else
        {
            return $this->render('/activity/index');
        }
    }
}

