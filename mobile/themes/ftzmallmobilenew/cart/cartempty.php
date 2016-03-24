<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use mobile\assets\ftzmallmobilenew\CartAsset;
CartAsset::register($this);

//use mobile\widgets\Alert;
/* @var $this \yii\web\View */
/* @var $content string */
$this->title = '购物车';

?>
<header class="ui-header ui-header-positive ui-border-b">
	<div class="topbar-bigbox">
		<a href="<?= Yii::$app->request->referrer?>" class="ui-icon-return fl"></a>
		<div class="topbar-fontbox">购物车(<span id="total_cart_num" class="cart-num">0</span>)</div>
		<a href="<?= Url::to(['user/index']) ?>" class="ui-icon-home fr font-32"></a>
	</div>
</header>
<section class="ui-container">
	
	<div class="empty-div">
		<p class="empty-text">购物车里空空如也，赶紧去逛逛吧！</p>
		<a href="<?= Url::to(['site/index']) ?>" class="go">去逛逛</a>
	</div>
</section>