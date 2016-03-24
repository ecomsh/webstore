<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use mobile\assets\ftzmallmobilenew\PassportAsset;
PassportAsset::register($this);
//use mobile\widgets\Alert;
/* @var $this \yii\web\View */
/* @var $content string */
$this->title = '用户注册';
?>
<section class="ui-container">
    <section id="type">
        <div class="demo-item">
            <div class="demo-block">
                <div class="ui-whitespace">
                    <p class="font-16 text-right">
                        <span>已有账号？</span>
                        <a href="<?= Url::to(['passport/login']); ?>" class="font-red">在此登录</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
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
                    <?= $form->field($model, 'mobile', ['enableAjaxValidation' => true, 'options' => ['class' => 'ui-form-item ui-form-item-pure ui-border-b']])->textInput(['size' => 30, 'placeholder' => '手机号']) ?>
                    <?= $form->field($model, 'gender', ['options' => ['class' => 'ui-form-item ui-form-item-radio ui-border-b']])->radioList(['1' => '先生', '2' => '女士'], ["itemOptions"=>["labelOptions" => ["class" => "ui-radio"]]]) ?>
                    <?= $form->field($model, 'verifyCode', ['options' => ['class' => 'ui-form-item ui-form-item-pure ui-border-b']])->widget(Captcha::className(), 
                    ['options' => ['placeholder' => '验证码'], 
                        'imageOptions' => ['alt' => '点击换图', 'title' => '点击换图', 'style' => 'cursor:pointer;position:absolute;top:0;right:0;margin-right:.875rem;']]) ?>
                                            
                     <?= $form->field($model, 'smsCode', ['enableAjaxValidation' => true, 'options' => ['class' => 'ui-form-item ui-form-item-r ui-border-b'], 'template' => '{input}<button type="button" id="register-vcode">获取验证码</button>{error}'])->textInput(['size' => 15, 'placeholder' => '短信验证码']) ?>
                    <?= $form->field($model, 'password', ['enableAjaxValidation' => true, 'options' => ['class' => 'ui-form-item ui-form-item-pure ui-border-b']])->passwordInput(['placeholder' => '密码']) ?>
                    <?= $form->field($model, 'confirmPassword', ['options' => ['class' => 'ui-form-item ui-form-item-pure ui-border-b']])->passwordInput(['placeholder' => '重复密码']) ?> 
                    <div class="ui-btn-wrap">
                        <?= Html::submitButton('同意协议并注册', ['class' => 'ui-btn-lg ui-btn-pink', 'isSubmit' => 'T', 'id' => 'regSubmitBtn']) ?>                            
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?> 
    </section>
    <section id="type">
        <div class="demo-item">
            <div class="demo-block">
                <div class="ui-whitespace">
                    <p class="font-16">
                        <a href= "<?= Url::to(['article/page', 'view' => 'fwxy']); ?>" class="font-red">《上海外高桥进口网用户协议》</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</section>

<script>
    var params = {'checkmobileurl': '<?= Url::to(['passport/valregmobile']) ?>', 'getsmscodeurl': '<?= Url::to(['passport/getsmscode']) ?>', 'vcodeId':'register-vcode', 'formId': 'mobileregistrationform', 'form': 'MobileRegistrationForm', 'smsType': 'RegSMSVerificationCode'};
</script>

