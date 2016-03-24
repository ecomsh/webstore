<?php
	use yii\helpers\Url;
	use yii\helpers\Html;
?>

<section class="ui-container"> 
<? /* 
	<?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ImagetextAdvertisement', "adId" => 180301, 'tpl' => 'focusfigure']) ?>
*/ ?>
	<section class="meizhuang-group">
		<div class="group-title">面部护理</div>
		<?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ProductAdvertisement', "adId" => 80306, 'tpl' => 'floorrecom']) ?>

		<div class="group-title">护发美体</div>
		<?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ProductAdvertisement', "adId" => 80307, 'tpl' => 'floorrecom']) ?>

		<div class="group-title">魅力彩妆</div>
		<?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ProductAdvertisement', "adId" => 80308, 'tpl' => 'floorrecom']) ?>

		<div class="group-title">个人护理</div>
		<?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ProductAdvertisement', "adId" => 80309, 'tpl' => 'floorrecom']) ?>

	</section>
	<section class="fix-btn clear">
		<div class="fix-cart fl"></div>
		<div class="ui-icon-gototop fix-top fr"></div>
	</section>
</section>