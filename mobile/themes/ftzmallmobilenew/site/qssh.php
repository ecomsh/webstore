<?php
	use yii\helpers\Url;
	use yii\helpers\Html;
?>

<section class="ui-container"> 
<? /* 
	<?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ImagetextAdvertisement', "adId" => 180501, 'tpl' => 'focusfigure']) ?>
*/ ?>
	<section class="meizhuang-group">
            <?php /*
		<div class="group-title">服装配饰</div>
		<?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ProductAdvertisement', "adId" => 80506, 'tpl' => 'floorrecom']) ?>
*/?>
		<div class="group-title">鞋包</div>
		<?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ProductAdvertisement', "adId" => 80507, 'tpl' => 'floorrecom']) ?>

		<div class="group-title">生活日用</div>
		<?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ProductAdvertisement', "adId" => 80508, 'tpl' => 'floorrecom']) ?>

		<div class="group-title">数码电器</div>
		<?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ProductAdvertisement', "adId" => 80509, 'tpl' => 'floorrecom']) ?>

	</section>
	<section class="fix-btn clear">
		<div class="fix-cart fl"></div>
		<div class="ui-icon-gototop fix-top fr"></div>
	</section>
</section>