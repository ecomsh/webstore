<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\icons\Icon;
//use yii\widgets\Breadcrumbs;
use mobile\assets\ftzmallmobilenew\MainindexAsset;

//use mobile\widgets\Alert;
/* @var $this \yii\web\View */
/* @var $content string */
MainindexAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <!--aaa
        <link rel="stylesheet" href="../css/frozen.css">
        <link rel="stylesheet" href="../css/font-awesome.css">
        <link rel="stylesheet" href="../demo/demo.css">-->
        <?php $this->head() ?>
    </head>

    <body ontouchstart>
        <?php $this->beginBody() ?>
        <!-- 页面头部固定区域start-->
        <?= $this->render('_index-nav') ?> 
        
        <!-- 页面头部固定区域end--> 
        <!-- 页面尾部固定区域start-->
        <footer id="footer-nav" class="ui-footer ui-footer-btn">
            <ul class="ui-tiled ui-border-t">
                <li>
                    <a href="<?=Url::to(['site/index']); ?>">
                        <div class="ui-footer-home-btn"><i class="icon-g-home"></i><span>首页</span></div>
                    </a>
                </li>
                <?php /*<li>
                    <a href="<?=Url::to(['site/index']); ?>">
                        <div class="ui-footer-home-btn"><i class="icon-g-dazhe"></i><span>特卖专区</span></div>
                    </a>
                </li>
                <li>
                    <a href="<?=Url::to(['site/index']); ?>">
                        <div class="ui-footer-home-btn"><i class="icon-g-buy"></i><span>我的收藏</span></div>
                    </a>
                </li>*/?>
                <li>
                    <a href="<?=Url::to(['cart/index']); ?>">
                        <div class="ui-footer-home-btn">
                            <i class="icon-g-cart ui-badge-wrap">
                                <div class="ui-badge-cornernum ui-badge-tr2 car-count">0</div>
                            </i><span>购物车</span></div>
                    </a>
                </li>
                <li>
                    <a href="<?=Url::to(['user/index']); ?>">
                        <div class="ui-footer-home-btn"><i class="icon-g-user"></i><span>会员</span></div>
                    </a>
                </li>
            </ul>
        </footer>
        <script>
                        var cartNumUrl = '<?= Url::to(['cart/getcarttotalnum']) ?>';
                        var userId = '<?= Yii::$app->mobileUser->getId() ?>';
        </script>
        <!-- 页面尾部固定区域end--> 
        <!-- 页面中部非固定区域1-幻灯片切换区域start-->
        <?= $content ?>    
        <?php $this->endBody() ?>
        <?= $this->render('_tongji') ?>
    </body>
</html>
<?php $this->endPage() ?>