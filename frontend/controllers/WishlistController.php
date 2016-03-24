<?php

namespace frontend\controllers;

use Yii;
use frontend\models\WishlistApi;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\helpers\Tools;
use yii\helpers\ArrayHelper;

class WishlistController extends Controller
{
    public function  actionAjaxcreate()
    {
        $userId = Yii::$app->user->getId(); 
        if ($userId == "") {
            return 'error';
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $wishlistModel = new \frontend\models\WishlistApi($userId);
        $params = Yii::$app->request->post();
        $data = ArrayHelper::remove($params, '_csrf');   
        $data = ArrayHelper::remove($params, 'userId');   
        if (1) {          
            $data = $wishlistModel->addtoWishlist($params, $userId);
            return $data;
        } else {            
            return 'error';
        }
    }
}