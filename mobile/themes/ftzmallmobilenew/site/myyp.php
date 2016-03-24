<?php
	use yii\helpers\Url;
	use yii\helpers\Html;
?>

<section class="ui-container"> 
<? /* 
	<?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ImagetextAdvertisement', "adId" => 180401, 'tpl' => 'focusfigure']) ?>
*/ ?>
	<section class="meizhuang-group">
		<div class="group-title">宝宝食品</div>
		<?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ProductAdvertisement', "adId" => 80406, 'tpl' => 'floorrecom']) ?>

<? /*
		<div class="group-title">宝宝洗护</div>
		<?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ProductAdvertisement', "adId" => 80407, 'tpl' => 'floorrecom']) ?>
*/ ?>

		<div class="group-title">宝宝用品</div>
		<?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ProductAdvertisement', "adId" => 80408, 'tpl' => 'floorrecom']) ?>

<? /*
		<div class="group-title">童装玩具</div>
		<?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ProductAdvertisement', "adId" => 80409, 'tpl' => 'floorrecom']) ?>
*/ ?>

	</section>
	<section class="fix-btn clear">
		<div class="fix-cart fl"></div>
		<div class="ui-icon-gototop fix-top fr"></div>
	</section>
</section>