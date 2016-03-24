<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
?>

<div class="header bgf9">
	<div class="container clearfix">	
		<div class="logo">
			<a href="<?=Url::to(['act/page','view'=>'index'])?>"><img src="<?= Yii::$app->params['staticUrl'] ?>images/logo.jpg"></a>
		</div>
		<div class="checkout-r">
                    <?php if (Yii::$app->controller->action->id === 'index'):?>
			<img src="<?= Yii::$app->params['staticUrl'] ?>images/progressbarimg-01.png"> 
				<!--CART用01的图 暂无 因为两个ECOM的设计跟立晶妹子切的方式不一致 以立晶妹子的切图为准-->
                    <?php elseif(Yii::$app->controller->action->id === 'checkout'):?>
			<img src="<?= Yii::$app->params['staticUrl'] ?>images/progressbarimg-02.png">
                    <?php else:?>
                        <img src="<?= Yii::$app->params['staticUrl'] ?>images/pay/pay-lc.png">
                    <?php endif;?>
		</div>	
	</div>
</div>