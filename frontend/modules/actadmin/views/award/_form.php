<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use conquer\codemirror\CodemirrorWidget;

/* @var $this yii\web\View */
/* @var $model backend\models\Cms */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cms-form">
    <?php $form = ActiveForm::begin();?>
    
    <?= $form->field($model, 'award_type')->dropDownList(array(1=>'微信红包', 2=>'优惠券',3=>'商品')); ?>
    <?= $form->field($model, 'award_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'award_bn')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'award_pic_url_s')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'award_pic_url_m')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'award_pic_url_b')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'award_store')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'award_rate')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'award_depict')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'award_state')->dropDownList(array(0=>'禁用', 1=>'启用')); ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app','确定') : Yii::t('app','确定'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app','取消'), Url::previous(), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
