<?php

namespace frontend\modules\act2016\controllers;

use yii\web\Controller;

class Double12Controller extends Controller
{
    public function actionIndex()
    {
       echo '双12主会场';
    }
    
    public function actionBaby()
    {
       echo '双12 母婴分会场';
    }
    
    public function actionHealth()
    {
       echo '双12 保健品分会场';
    }
    
    public function actionLuxury()
    {
       echo '双12 轻奢分会场';
    }
    
    public function actionMakeups()
    {
       echo '双12 美妆分会场';
    }
    
    public function actionFood()
    {
       echo '双12 食品分会场';
    }
    
}
