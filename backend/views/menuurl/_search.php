<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MenuUrlSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-url-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'menu_id') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'is_default') ?>

    <?= $form->field($model, 'stime') ?>

    <?php // echo $form->field($model, 'etime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
