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
        <link rel="icon" href="">
        <?= Html::csrfMetaTags() ?>
        <title><?= $this->title ?></title>
        <script type="text/javascript" src="<?= Yii::$app->params['staticUrl'] ?>common/jQuery/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="<?= Yii::$app->params['staticUrl'] ?>common/jquery-migrate/jquery-migrate.min.js"></script>
        <script type="text/javascript" src="<?= Yii::$app->params['staticUrl'] ?>js/index.js"></script>

        <?php $this->head();
              ?>
    </head>
    <body>
        <?php $this->beginBody() ?>        
            <?= $this->render('_topbar') ?>
            <?= $this->render('_header') ?> 
            <?= $this->render('_nav') ?> 
            <?= $content ?>   
            <?= $this->render('_footer') ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>