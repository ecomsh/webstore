<?php
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\widgets\MenuNew;
use frontend\assets\ftzmallnew\CartBarAsset;
CartBarAsset::register($this);
/* @var $this yii\web\View */
?>
<div class="navbar">
        <div class="container">
<?= MenuNew::widget(Yii::$app->params['navMenu']);?>
    </div>
</div>
