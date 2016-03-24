<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use mobile\assets\ftzmallmobilenew\PassportAsset;

PassportAsset::register($this);

$this->title = '重置密码';
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
                    <?= $form->field($model, 'mobile', ['enableAjaxValidation' => true, 'options' => ['class' => 'ui-form-item ui-form-item-pure ui-border-b']])->textInput([ 'size' => 30, 'placeholder' => '请填写手机号']) ?>
                    <?= $form->field($model, 'newPassword', ['enableAjaxValidation' => true, 'options' => ['class' => 'ui-form-item ui-form-item-pure ui-border-b']])->passwordInput(['placeholder' => "请输入密码", 'data-caution' => "密码栏不能为空"]) ?>
                    <?= $form->field($model, 'confirmNewPassword', ['options' => ['class' => 'ui-form-item ui-form-item-pure ui-border-b']])->passwordInput(['placeholder' => "请确认密码", 'data-caution' => "确认密码不能为空"]) ?>
                    <?= $form->field($model, 'verifyCode', ['options' => ['class' => 'ui-form-item ui-form-item-r ui-border-b']])->widget(Captcha::className(), ['options' => ['placeholder' => '验证码'],
                        'imageOptions' => ['alt' => '点击换图', 'title' => '点击换图', 'style' => 'cursor:pointer;position:absolute;top:0;right:0;margin-right:.875rem;']]) ?>
                    <?= $form->field($model, 'smsCode', ['enableAjaxValidation' => true, 'options' => ['class' => 'ui-form-item ui-form-item-r ui-border-b'], 'template' => '{input}<button type="button" id="reset-vcode">获取验证码</button>{error}'])->textInput(['size' => 15, 'placeholder' => '短信验证码']) ?>
                    <div class="ui-btn-wrap">
                        <?= Html::submitButton('确定', ['class' => 'ui-btn-lg ui-btn-pink']) ?>   
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>    
    </section>
</section>

<script>
    var params = {'checkmobileurl': '<?= Url::to(['passport/valresetpwdmobile']) ?>', 'getsmscodeurl': '<?= Url::to(['passport/getsmscode']) ?>',  'vcodeId':'reset-vcode', 'formId': 'resetpwdform', 'form': 'ResetPwdForm', 'smsType': 'ResetPwdSMSVerificationCode'};
</script>