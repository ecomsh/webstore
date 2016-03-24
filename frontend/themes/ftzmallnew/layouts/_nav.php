<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Tools;
use frontend\widgets\MenuNew;
use frontend\assets\ftzmallnew\CartBarAsset;
CartBarAsset::register($this);
/* @var $this yii\web\View */
?>

<div class="nav-con">
	<div class="container clearfix">
		<div class="pull-left">
			<ul class="nav nav-ul">
                          <?php //echo MenuNew::widget(Tools::getNavMenu(1));?>
				<li class="bg-color1 pull-left"><a href="index.html">首页</a></li>
				<li class="pull-left"><a href="">美妆个护</a></li>
				<li class="pull-left"><a href="">母婴益智</a></li>
				<li class="pull-left"><a href="">食品保健</a></li>
				<li class="pull-left"><a href="">国际轻奢</a></li>
			</ul>
		</div>
		<div class="pull-right" onclick="javascript:window.location.href='<?= Url::to(['cart/']); ?>'" style="cursor:pointer;">
			<div class="nav-car navbar-right">
				购物车<span class="car-count">0</span>>
			</div>
		</div>
                <script>
                        var cartNumUrl = '<?= Url::to(['cart/getcarttotalnum']) ?>';
                        var userId = '<?= Yii::$app->user->getId() ?>';
                </script>
	</div>
</div>