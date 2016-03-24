<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mobile\widgets\Alert;
use yii\helpers\Url;
use mobile\assets\ftzmallmobilenew\ChangePasswordAsset;
use mobile\assets\ftzmallmobilenew\AlertAsset;

ChangePasswordAsset::register($this);
AlertAsset::register($this);

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mobile\models\ResetPasswordForm */

$this->title = '修改密码';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="ui-container">
    <section id="form">
        <?php
        $options = [];
        $options['enableClientValidation'] = true;
        $options['fieldConfig'] = ['errorOptions' => ['class' => 'help-block help-block-error'], 'labelOptions' => ['style' => 'display:none']];
        $form = ActiveForm::begin($options);
        ?>
        <div class="demo-item">
            <div class="demo-block">
                <div class="ui-form ui-border-t">
                    <?= $form->field($model, 'oldPassword', ['options' => ['class' => 'ui-form-item ui-form-item-pure ui-border-b']])->passwordInput([ 'placeholder' => '请输入旧密码']) ?>
                    <?= $form->field($model, 'password', ['enableAjaxValidation' => true, 'options' => ['class' => 'ui-form-item ui-form-item-pure ui-border-b']])->passwordInput(['placeholder' => "请输入新密码", 'data-caution' => "密码栏不能为空"]) ?>
                    <?= $form->field($model, 'confirmPassword', ['options' => ['class' => 'ui-form-item ui-form-item-pure ui-border-b']])->passwordInput(['placeholder' => "请确认新密码", 'data-caution' => "密码栏不能为空"]) ?>
                    <div class="ui-btn-wrap">
                        <?= Html::submitButton('提交', ['class' => 'ui-btn-lg ui-btn-pink']) ?>   
                            <?= Alert::widget( ['alertTypes' => [
                    'passport_success' => 'alert-success',
                    'passport_error' => 'alert-danger',
                    'danger' => 'alert-danger',
                    'info' => 'alert-info',
                    'warning' => 'alert-warning'], 'closeButton'=>false]);?>
                    
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </section>
</section>