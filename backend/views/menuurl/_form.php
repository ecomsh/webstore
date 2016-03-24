<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\MenuUrl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-url-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <input type="checkbox" name="select-url" id="select-url" <?php if(!empty($model->url)){ echo "checked";}?>>跳转到指定URL
    
    <div id="div-cms_view" <?php if(empty($model->cms_view) and !empty($model->url)){ echo "style='display:none;'";}?>>
    <?= $form->field($model, 'cms_view')->dropDownList($urlList)->hint('(目前提供已发布的最新的50个模板，如不存在您需要的选项，请先发布模板)') ?>
    </div>
    
    <div id="div-url" <?php if(empty($model->url)){ echo "style='display:none;'";}?>>
    <?= $form->field($model, 'url')->textInput(['maxlength' => true])->hint("示例：http://www.baidu.com，注意：如不填写http://则为站内地址") ?>
    </div>
    
    <?php if($model->is_default != '1'){ ?>
    <label class="control-label" for="menuurl-url">开始时间</label>
    <?= DateTimePicker::widget([
        'model' => $model,
        'attribute' => 'stime',
        'language' => Yii::$app->language,
        'template' => '{input}',
//        'size' => 'md',
        'clientOptions' => [
//            'pickerReferer' => 'input',
            'startDate' => $startDate,
            'endDate' => $endDate,
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii:00',
            'todayBtn' => false,
        ],
    ]);?>
    <br>
    <label class="control-label" for="menuurl-url">结束时间</label>
    <?= DateTimePicker::widget([
        'model' => $model,
        'attribute' => 'etime',
        'language' => Yii::$app->language,
        'template' => '{input}',
//        'size' => 'md',
        'clientOptions' => [
//            'pickerReferer' => 'input',
            'startDate' => $startDate,
            'endDate' => $endDate,
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii:00',
            'todayBtn' => false,
        ],
    ]);?>
    <?php } ?>
    <?= $form->field($model,'menu_id',['template'=>'{input}'])->hiddenInput() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '确定' : '确定', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app','取消'), Url::previous(), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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
