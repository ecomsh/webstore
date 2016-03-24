<?php

namespace mobile\controllers;

use Yii;
use yii\web\Controller;
use mobile\models\InventoryApi;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class InventoryController extends Controller
{
    public $layout = "main";
    
    public function actionCheckInventorys(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $model = new InventoryApi();
        $postData = Yii::$app->request->post('postData');
        
        if (Yii::$app->request->isAjax)
        {
            return $model->ckeckInventorys($postData);
        }
    }
}
