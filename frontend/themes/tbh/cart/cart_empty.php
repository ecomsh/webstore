<?php
    use frontend\assets\ftzmallnew\CartEmptyAsset;
    CartEmptyAsset::register($this);
    $this -> title = '购物车';
?>
<div class="container cart-container">
    <div style="background:white;" class="cart-container-top">
        <div class="cart-empty">
        <span>
            购物车里空空如也，赶紧去 <a href="<?= \yii\helpers\Url::home();  ?>">逛逛吧></a>
        </span>
        </div> 
    </div>
</div>