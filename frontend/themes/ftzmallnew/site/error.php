<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
use frontend\assets\ftzmallnew\ErrorAsset;
ErrorAsset::register($this);
$this->title = $name.'-上海外高桥进口商品网';
?>

<div class="container">
    <div class = "left-box"></div>
    <div class = "right-box ">
        <p class="big-font font-red"><?= nl2br(Html::encode($name)) ?></p>
        <p class="middle-font"><?= nl2br(Html::encode($message)) ?></p>
        <p class = "jumpurl"><a onclick = "javascript:clearTimeout(SiteSplash);" href = "javascript:history.back()">10秒后系统会自动跳转，也可点击本处直接跳转</a></p>  
    </div>
    <script>
        function jumpurl() {
            history.back();
        }
        var SiteSplash = setTimeout('jumpurl()', 10000);
    </script>
</div>