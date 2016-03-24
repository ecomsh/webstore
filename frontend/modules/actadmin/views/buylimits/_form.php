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
    
    <?= $form->field($model, 'limits_item')->textarea(['rows'=>5]) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app','确定') : Yii::t('app','确定'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app','取消'), Url::previous(), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
