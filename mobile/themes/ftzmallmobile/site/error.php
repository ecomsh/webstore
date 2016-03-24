<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = '无效商品404-上海外高桥进口商品网';
?>

<div class = "main w1200">
    <div class = "mTB">
        <div class = "feed-back">
            <div class = "error clearfix">
                <div class = "span-1 pic"></div>
                <div class = "span-11 ">
                    <!--<h1>无效商品！<br>可能是商品未上架</h1>--->
                    <h1><?= nl2br(Html::encode($message)) ?></h1>
                    <p class = "jumpurl"><a onclick = "javascript:clearTimeout(SiteSplash);" href = "javascript:history.back()">3秒后系统会自动跳转，也可点击本处直接跳转</a></p>
                </div>
            </div>
        </div>
        <script>
            function jumpurl() {
                history.back();
            }
            var SiteSplash = setTimeout('jumpurl()', 5000);
        </script>
    </div>
</div>