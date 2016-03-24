<?php

use frontend\assets\ftzmallnew\MainAsset;
use yii\helpers\Html;
MainAsset::register($this);
yii\web\JqueryAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=1200" />
        <meta name="description" content="">
        <meta name="author" content="">
        <!--<link rel="icon" href="http://7xoo3k.com2.z0.glb.qiniucdn.com/icon-pig-ftzmall_ICON-01.png">-->
        <link rel="icon" href="http://7xoo3k.com2.z0.glb.qiniucdn.com/icon-pig-ftzmall_ICON-04.png">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?> 
            <?php // echo 1;?>
            <?= $this->render('_topbar') ?>
            <?= $this->render('_header') ?> 
            <?= $this->render('_nav') ?> 
            <?= $content ?>   
            <?= $this->render('_footer') ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>