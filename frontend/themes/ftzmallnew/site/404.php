<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
use frontend\assets\ftzmallnew\ErrorAsset;
ErrorAsset::register($this);
$this->title = '404-上海外高桥进口商品网';
?>

<div class="container">
    <div class = "left-box"></div>
    <div class = "right-box ">
        <p class="big-font font-red">404</p>
        <p class="middle-font">error message!error message!error message!error message!error message!error message!error message!error message!error message!error message!error message!error message!</p>
        <p class = "jumpurl"><a onclick = "javascript:clearTimeout(SiteSplash);" href = "javascript:history.back()">3秒后系统会自动跳转，也可点击本处直接跳转</a></p>  
    </div>
        <script>
            function jumpurl() {
                history.back();
            }
            var SiteSplash = setTimeout('jumpurl()', 3000);
        </script>
</div>