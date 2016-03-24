<?php
	use yii\helpers\Url;
	use yii\helpers\Html;
	use yii\icons\Icon;
	use frontend\assets\ftzmallnew\MainAsset;
	MainAsset::register($this);
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
        <title><?= Html::encode($this->title) ?></title>
        <script type="text/javascript" src="<?= Yii::$app->params['staticUrl'] ?>common/jQuery/jquery-1.11.3.min.js"></script>
        <?php $this->head() ?>
        <link href="<?= Yii::$app->params['staticUrl'] ?>common/font/iconfont.css" rel="stylesheet">
        <link href="<?= Yii::$app->params['staticUrl'] ?>css/common1.css" rel="stylesheet">
    </head>
    <body style="background:#f9f4ec;">
        <?php $this->beginBody() ?>
            <?= $this->render('_topbar') ?>			
            <?= $this->render('_header-cart-order') ?>	
            <?= $content ?>
            <?= $this->render('_footer') ?> 
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>