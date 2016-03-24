<?php
use yii\helpers\Url;
use yii\helpers\Html;
$this->title = '支付';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="am-touch js cssanimations">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
        <?php $this->head() ?>
    </head>
    <body ontouchstar>
        <?php $this->beginBody() ?>
          
            <?=$content?>
           
        <?php $this->endBody() ?>
        <?= $this->render('_tongji') ?>
    </body>
</html>
<?php $this->endPage() ?>
