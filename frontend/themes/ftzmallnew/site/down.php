<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = '上海外高桥进口商品网即将开放';
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
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body style="border:0;margin:0;padding:0">
        <?php $this->beginBody() ?>
        <div class="container">
            <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/openingsoon.jpg', true)?>" width="100%;">
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>