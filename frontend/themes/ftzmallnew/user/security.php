<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\widgets\Alert;
use frontend\assets\ftzmallnew\UserAsset;

UserAsset::register($this);

/* @var $this yii\web\View */
$this->title = '修改密码_上海外高桥进口商品网';
?>
<div class="container user-color">
    <?= $this->render('../layouts/_user-nav-left') ?>
    <div class="member-right">
        <div class="col-lg-11">
            <?=
            Alert::widget(['alertTypes' => [
                    'security_success' => 'alert-success',
                    'security_error' => 'alert-danger',
                    'security_danger' => 'alert-danger',
                    'security_info' => 'alert-info',
                    'security_warning' => 'alert-warning']]);
            ?>
            <?php
            $options = [];
            $options['options'] = ["class" => "form-horizontal"];
            $options['enableClientValidation'] = true;
            $options['fieldConfig'] = ['labelOptions' => ['class' => 'control-label pw-title'],
                    //   'template'=>"{input}\n<div class=\"ppp\">{error}</div>"
                    // 'labelOptions' => ['class' => 'ddd'],  
            ]; //'errorOptions' => ['style' => 'margin:0px;padding-left:240px;']];
//           
            $form = ActiveForm::begin($options);
            ?>
            <?= $form->field($model, 'oldPassword')->textInput([ 'class' => 'form-control pw-input', 'type' => 'password', 'placeholder' => '原始密码']) ?>
            <?= $form->field($model, 'password')->textInput([ 'class' => 'form-control pw-input', 'type' => 'password', 'placeholder' => "新密码", 'data-caution' => "密码栏不能为空"]) ?>
            <?= $form->field($model, 'confirmPassword')->textInput([ 'class' => 'form-control pw-input', 'type' => 'password', 'placeholder' => "确认密码", 'data-caution' => "密码栏不能为空"]) ?>
            <?= Html::submitButton('修改', [ 'class' => 'btn btn-success pw-btn']) ?>
            <?php ActiveForm::end(); ?>   
        </div>
    </div>
</div>
