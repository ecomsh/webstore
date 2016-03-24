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
    </head>
    <body>
        <?php $this->beginBody() ?>
            <?= $this->render('_topbar') ?>			
            <?= $this->render('_header-cart-order') ?>	
            <?= $content ?>
            <?= $this->render('_footer') ?> 
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>