<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
?>

<div class="header">
	<div class="container clearfix">	
		<div class="pull-left logo">
			<a href="<?=Url::to(['act/page','view'=>'index'])?>"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/logo.png', true)?>"></a>
		</div>
		<div class="pull-right checkout-right">
                    <?php if (Yii::$app->controller->action->id === 'index'):?>
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/progressbarimg-01.png', true)?>"> 
				<!--CART用01的图 暂无 因为两个ECOM的设计跟立晶妹子切的方式不一致 以立晶妹子的切图为准-->
                    <?php elseif(Yii::$app->controller->action->id === 'checkout'):?>
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/progressbarimg-02.png', true)?>">
                    <?php else:?>
                        <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/pay/pay-lc.png', true)?>">
                    <?php endif;?>
		</div>	
	</div>
</div>