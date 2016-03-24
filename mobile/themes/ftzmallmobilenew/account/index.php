<?php
/* @var $this yii\web\View */

use mobile\assets\ftzmallmobilenew\AccountAsset;

AccountAsset::register($this);
$this->title = '我的预存款';
?>

<section class="ui-container">
<div class="ui-tab">
    <div>您当前的预存款余额为：<span style="font-weight: bold; color: #ed145a;">¥<?= $remain ?></span></div>
</div>
</section>
