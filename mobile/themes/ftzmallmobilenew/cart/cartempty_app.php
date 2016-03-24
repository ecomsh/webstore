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

<link href="/mobileapp/css/app.common.css" rel="stylesheet">

<body ontouchstart="" style="background: #EEEEEE;">
<header class="ui-header ui-header-positive ui-border-b">
	<div class="topbar-bigbox">
		<a href="<?= Yii::$app->request->referrer?>" class="ui-icon-return fl"></a>
		<div class="topbar-fontbox">购物车(<span id="total_cart_num" class="cart-num">0</span>)</div>
		<a href="<?= Url::to(['user/index']) ?>" class="ui-icon-home fr font-32"></a>
	</div>
</header>
<section class="ui-container">
	<div class="empty-div">
        <p class="empty-text empty-img"><img src="/mobileapp/images/empty.png" style="width:5rem;"></p>
		<p class="empty-text" style="font-weight: bold;font-size: 1.15rem;">购物车没有商品哦</p>
        <p class="empty-text" style="color:#848484;">可以去看看有哪些想买的</p>
        <a href="<?= Url::to(['site/index']) ?>" class="go">
            <div style="background: #EEEEEE;">随便逛逛</div>
        </a>
	</div>
</section>
</body>