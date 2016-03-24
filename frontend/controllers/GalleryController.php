<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ProductApi;
use frontend\models\InventoryApi;
use frontend\helpers\Sku;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/*
 * Site controller
 */
class GalleryController extends Controller {

    public $layout = "main";
    public function actionIndex()
    {
        //$id = Yii::$app->request->get('id');      
        $model = new ProductApi();      
        $shop = 'ftzmall';
        $id = '饼干蛋糕';
        $params = [
                "facets" => [
                    'brand' => ['瓦格纳'],
                    '产地' => ['美国纽约州']
                ],
                "pageinfo" =>[
                    "pageSize" => '10',
                    "currentPage" => '1'
                ],
               "sort" =>[
                   "sortField" => "price",
                   "sortType" => "desc"
                   ]
            ];
        $rc = $model->getProListByCatId($shop, $id, $params);
         var_dump($rc);
        return $this->render('/gallery/index2');
    }
    
    public function actionIndexpic()
    {
        return $this->render('/gallery/index1');
    }
}

