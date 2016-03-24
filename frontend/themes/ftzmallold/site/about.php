<?php
use yii\helpers\Html;
use frontend\widgets\HelloWidget;
use frontend\widgets\Alert;
/* @var $this yii\web\View */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= HelloWidget::widget() ?>
    <?= HelloWidget::widget() ?>
    <?= HelloWidget::widget() ?>
    <?= HelloWidget::widget() ?>
    <p>This is the About page. You may modify the following file to customize its content:</p>
<?= HelloWidget::widget() ?>
    <?= Alert::widget() ?>
    <?= \Yii::$app->getSession()->setFlash('error', 'This is the message')?>
    <?= \Yii::$app->getSession()->setFlash('success', '好的')?>
    <code><?= __FILE__ ?></code>
</div>
