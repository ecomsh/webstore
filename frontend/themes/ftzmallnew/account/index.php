<?php
/* @var $this yii\web\View */

use frontend\assets\ftzmallnew\UserAsset;

UserAsset::register($this);
$this->title = '我的预存款_上海外高桥进口商品网';
?>

<div class="container user-color">
<?= $this->render('../layouts/_user-nav-left') ?>
    <div class="member-right-order">
        <div class="orderlist-warp">
            <h3>预存款信息</h3>
            <div class = "admin-title admin-title2">您当前的预存款余额为：<span class = "point">¥<?= $remain ?></span></div>
        </div>
    </div>
</div>
