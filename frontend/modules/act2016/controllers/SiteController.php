<?php

namespace frontend\modules\act2016\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\PromotionApi;

class SiteController extends Controller
{
    public function actionIndex()
    {
    	if ( YII_ENV === 'dev' || YII_ENV === 'allinone' )
    	{
	    	//会员ID
	    	$memberId = Yii::$app->user->getId();
	    	if ( !$memberId )
	    	{
	    		header("Location: /login.html");
	    	}
	    	
	    	if ( Yii::$app->request->post() )
	    	{
	    		$coupon = Yii::$app->request->post('coupon');
	    		
	    		$promotionModel = new PromotionApi($memberId);
	    		$result = $promotionModel->getCouponbyRule($coupon);
	    		
	    		if ($result["promotion"]["result"])
	    		{
	    			echo "<script>alert('优惠券领取成功！');</script>";
	    		}
	    		else
	    		{
	    			var_dump($result);
	    			//echo "<script>alert('优惠券领取失败！');</script>";
	    		}
	    	}
	    	
	    	return $this->render('index');
    	}
    	else
    	{
    		header("Location: /index.html");
    	}
    }
}
