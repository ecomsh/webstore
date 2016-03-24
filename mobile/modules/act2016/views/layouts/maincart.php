<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\icons\Icon;
//use yii\widgets\Breadcrumbs;
use mobile\assets\ftzmallmobilenew\MainnewAsset;

//use mobile\widgets\Alert;
/* @var $this \yii\web\View */
/* @var $content string */
MainnewAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <meta name="description" content="">
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

       

        <?= $content ?>

        <?php $this->endBody() ?>
        <?= $this->render('_tongji') ?>
    </body>
</html>
<?php $this->endPage() ?>