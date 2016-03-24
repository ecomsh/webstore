<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Cms */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cms-form">
    <?php 
    $form = ActiveForm::begin(); 
    ?>
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'index')->textInput(['maxlength' => true]) ?>
    
    <div class="form-group">
        <?= $form->field($model,'platform', ['template'=> '{input}'])->hiddenInput(); ?>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app','确定') : Yii::t('app','确定'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app','取消'), Url::previous('menu'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
