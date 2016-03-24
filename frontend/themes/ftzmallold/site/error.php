<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '无效商品404-上海外高桥进口商品网';
if(YII_DEBUG){
    echo "DEBUG 模式:".Html::encode($message);
}else{
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
        <?php
        /**
         * #TODO   错误页面之前需要用Url::remember();同时防止重复再错误页面提交
         */
     //   Url::remember(Url::current());
        $pUrl = Url::previous();
       // echo $pUrl;
        ?>
        <script>
            function jumpurl() {
                var purl = '<?= $pUrl ?>';
                var home = '<?= Url::home() ?>';
                var current = '<?= Url::current() ?>';
                if(home==current){
                    return;
                }
                if (purl != current) {
                    location.href = purl;
                } else {
                    location.href = home;
                }
            }
            var SiteSplash = setTimeout('jumpurl()', 30000);
        </script>
    </div>
</div>
<?php  } ?>