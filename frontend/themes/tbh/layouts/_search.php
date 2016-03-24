<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
?>
<div class="top-search">
    <ul class="search-tab">
        <li class="cur">臻品</li>
        <li>店铺</li>
        <li>资讯</li>
    </ul>
    <div class="search-box">
        <input class="search-txt" type="text"/><button class="search-btn"><i class="iconfont icon-search"></i> 搜索</button>
    </div>
    <?= $this->render('_nav-search-keyword') ?>	
</div>
<div class="qr-code">
                <p><img src="<?= Yii::$app->params['staticUrl'] ?>images/sj_code.png" alt="手机客户端"/>手机客户端</p>
                <p><img src="<?= Yii::$app->params['staticUrl'] ?>images/wx_code.png" alt="官方微信"/>官方微信</p>
</div>


<script>
    $('.search-btn').click(function(){
        var txt=$('.search-txt').val();
        var name=$('.cur').html();
        if(name=='臻品'){
            window.location.href="<?= Url::to(['search/index'])?>?r=search/index&search="+txt;

        }
        if(name=='店铺'){
            window.location.href="<?= Url::to(['/search/dp','r'=>'search/dp'])?>?search="+txt;
        }
        if(name=='资讯'){
            window.location.href="<?=Yii::$app->params['blogUrl']?>?s="+txt;
        }
    })
</script>
