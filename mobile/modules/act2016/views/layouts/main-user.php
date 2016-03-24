<?php
use yii\helpers\Url;
use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
//use yii\widgets\Breadcrumbs;
use mobile\assets\MainAsset;

//use mobile\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */
MainAsset::register($this);
?>
    <?php $this->beginPage() ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="<?= Yii::$app->charset ?>">
            <?= Html::csrfMetaTags() ?>
                <title>
                    <?= Html::encode($this->title) ?>
                </title>
                <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
                <meta name="format-detection" content="telephone=no">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="description" content=" ">
                <meta name="apple-touch-fullscreen" content="yes">
                <meta name="full-screen" content="yes">
                <meta name="apple-mobile-web-app-capable" content="yes"/>
                <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
                <meta name="format-detection" content="telephone=no"/>
                <meta name="format-detection" content="address=no"/>
                
                <?php $this->head() ?>
        </head>

        <body ontouchstart>
            <?php $this->beginBody() ?>
            <header class="ui-header ui-header-positive ui-border-b">
                <div class="topbar-bigbox">
                    <i class="ui-icon-return fl"></i>
                    <div class="topbar-fontbox"><?= Html::encode($this->title);?></div>
                    <i class="ui-icon-home fr font-32"></i>
                </div>
            </header>  
                <?= $content ?>
                <?php $this->endBody() ?>
            <?= $this->render('_tongji') ?>
        </body>

        </html>
        <?php $this->endPage() ?>
