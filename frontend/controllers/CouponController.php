<?php

namespace frontend\controllers;

use Yii;
use frontend\models\PromotionApi;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\helpers\Tools;


/**
 * Site controller
 */
class CouponController extends Controller {

    public $layout = "main";
    
    public function behaviors()
    {
        return [
            'access' => Yii::$app->params['pageAccess']['coupon']
        ];
    }
    
     public function actionIndex($id = 0)
    {
         $userId = Yii::$app->user->getId();
         //$userId = 5032;
         //初始化api
        $couponData = Yii::$app->request->get('CouponStatus');
        //初始化api
        $model = new PromotionApi($userId);
        if (isset($couponData) && !empty($couponData)) {
            switch ($couponData) {
                case '1':
                    $data = $model->getValidCoupons();
                    $key = key($data);
                    $data = isset($data[$key]) ? $data[$key] : [];
                    $count = count($data);
                    $msg = '可使用';
                    break;
                case '2':
                    $data = $model->getUsedCoupons();
                    $key = key($data);
                    $data = isset($data[$key]) ? $data[$key] : [];
                    $count = count($data);
                    $msg = '已使用';
                    break;
                case '3':
                    $data = $model->getInvalidCoupons();
                    $key = key($data);
                    $data = isset($data[$key]) ? $data[$key] : [];
                    $count = count($data);
                    $msg = '已过期';
                    break;
            }
        } else {
            $data = $model->getValidCoupons();
            $key = key($data);
            $data = isset($data[$key]) ? $data[$key] : [];
            $count = count($data);
            $msg = '可使用';
        }
        return $this->render('/coupon/index', [
                    'data' => $data,
                    'count' => $count,
                    'msg' => $msg,
                    '_csrf' => Yii::$app->request->getCsrfToken(),
        ]);
     }
     
     public function actionActivatecoupon(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $userId = Yii::$app->user->getId();
        
        if(empty($userId)){
            return false;
        }
        
        $model = new PromotionApi($userId);
        $postData = Yii::$app->request->post();
        if ($postData && is_array($postData) && isset($postData['couponCode'])) {
            $couponCode = $postData['couponCode'];
            $data = $model->bindCouponCode($couponCode);
            $key = key($data);
            $data = isset($data[$key])? $data[$key] : [];
            if(empty($data)){
                throw new BadRequestHttpException("服务器返回空数据");
            }
            if($data['result'] == true){
                return $data;
            }
            else{
                $failReason = Yii::$app->params['sm']['promotion']['activateFail'];
                if(isset($data['detail']['errcode']) && $data['detail']['errcode']
                   && array_key_exists($data['detail']['errcode'], $failReason))
                {
                    $errmsg = $failReason[$data['detail']['errcode']];
                    $data['errmsg'] = $errmsg;
                }
                else{
                    $data['errmsg'] = '激活优惠码失败';
                }
                return $data;
            }
        }
        else{      
            throw new BadRequestHttpException("非法请求");
        }
     }
}

