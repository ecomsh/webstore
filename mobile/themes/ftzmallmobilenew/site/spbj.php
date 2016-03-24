<?php
	use yii\helpers\Url;
	use yii\helpers\Html;
?>

<section class="ui-container"> 
<? /* 
	<?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ImagetextAdvertisement', "adId" => 180201, 'tpl' => 'focusfigure']) ?>
*/ ?>
	<section class="meizhuang-group">
		<div class="group-title">营养保健</div>
		<?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ProductAdvertisement', "adId" => 80206, 'tpl' => 'floorrecom']) ?>

		<div class="group-title">休闲食品</div>
		<?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ProductAdvertisement', "adId" => 80207, 'tpl' => 'floorrecom']) ?>

		<div class="group-title">副食调味</div>
		<?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ProductAdvertisement', "adId" => 80208, 'tpl' => 'floorrecom']) ?>

		<div class="group-title">酒类饮料</div>
		<?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ProductAdvertisement', "adId" => 80209, 'tpl' => 'floorrecom']) ?>

<? /*
		<div class="group-title">水果生鲜</div>
		<?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ProductAdvertisement', "adId" => 80210, 'tpl' => 'floorrecom']) ?>
*/ ?>

	</section>
	<section class="fix-btn clear">
		<div class="fix-cart fl"></div>
		<div class="ui-icon-gototop fix-top fr"></div>
	</section>
</section>