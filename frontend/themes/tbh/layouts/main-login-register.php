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
        <?php $this->head() ?>
         <!--<script type="text/javascript" src="<?= Yii::$app->params['staticUrl'] ?>common/jQuery/jquery-1.11.3.min.js"></script>-->
         <!--<script type="text/javascript" src="<?= Yii::$app->params['staticUrl'] ?>common/jquery-migrate/jquery-migrate.min.js"></script>-->
        
    </head>
    <body>
        <?php $this->beginBody() ?>		
            <?= $this->render('_header-login-register') ?>	
            <?= $content ?>
         
        <?php $this->endBody() ?>
    </body><script src="http://static.tbh.dev/yingyuan/static/js/test.js"></script>
</html>
<?php $this->endPage() ?>