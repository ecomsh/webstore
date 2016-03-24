<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>


<?= GridView::widget([
    'dataProvider' => $productProvider,
    'columns'=>[
    	'catentryKey',
    	'catentryId',
    ],
]) ?>