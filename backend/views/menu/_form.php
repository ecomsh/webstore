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
    <input type="checkbox" name="select-url" id="select-url" <?php if(!empty($menuUrl->url)){ echo "checked";}?>>跳转到指定URL
    
    <div id="div-cms_view" <?php if(empty($menuUrl->cms_view) and !empty($menuUrl->url)){ echo "style='display:none;'";}?>>
    <?= $form->field($menuUrl, 'cms_view')->dropDownList($urlList)->hint('(目前提供已发布的最新的50个模板，如不存在您需要的选项，请先发布模板)') ?>
    </div>
    
    <div id="div-url" <?php if(empty($menuUrl->url)){ echo "style='display:none;'";}?>>
    <?= $form->field($menuUrl, 'url')->textInput(['maxlength' => true]) ?>
    </div>
    
    <div class="form-group">
        <?= $form->field($model,'platform', ['template'=> '{input}'])->hiddenInput(); ?>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app','确定') : Yii::t('app','确定'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app','取消'), Url::previous('menu'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php $this->registerJs("
            $('#select-url').click(function(){
                if(this.checked){
                    $('#div-url').show();
                    $('#div-cms_view').hide();
                }else{
                    $('#div-url').hide();
                    $('#div-cms_view').show();
                }
            });
        ");?>
</div>
