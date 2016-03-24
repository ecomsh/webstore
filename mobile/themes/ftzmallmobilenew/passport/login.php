<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use mobile\widgets\Alert;
use mobile\assets\ftzmallmobilenew\LoginAsset;

LoginAsset::register($this);

$this->title = '用户登录';
?>

<section class="ui-container">
    <section id="type">
        <div class="demo-item">
            <div class="demo-block">
                <div class="ui-whitespace">
                    <p class="font-16 text-right">
                        <span>还没有账号？</span>
                        <a href="<?= Url::to(['passport/reg', 'sc' => Yii::$app->request->get('sc')]) ?>" class="font-red">30秒注册</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section id="tab">
        <div class="demo-item">
            <div class="demo-block">
                <div class="ui-tab">
                    <ul class="ui-tab-nav ui-border-b">
                        <li class="current">手机动态密码登录</li>
                        <li>普通登录</li>
                    </ul>
                    <ul class="ui-tab-content" style="width:300%">
                        <li>
                            <section id="mobile-login-box">
                                <?php
                                $options = [];
                                $options['enableClientValidation'] = true;
                                $options['fieldConfig'] = ['errorOptions' => ['class' => 'help-block help-block-error'], 'labelOptions' => ['style' => 'display:none']];
                                $form = ActiveForm::begin($options);
                                ?>  
                                <div class="demo-item">
                                    <div class="demo-block">
                                        <div class="ui-form ui-border-t">
                                            <?= $form->field($smsloginmodel, 'mobile', ['enableAjaxValidation' => true, 'options' => ['class' => 'ui-form-item ui-form-item-pure ui-border-b']])->textInput(['size' => 30, 'placeholder' => '已注册的手机号码']) ?>
                                            <?= $form->field($smsloginmodel, 'verifyCode', ['options' => ['class' => 'ui-form-item ui-form-item-pure ui-border-b']])->widget(Captcha::className(), ['options' => ['placeholder' => '验证码'], 'imageOptions' => ['alt' => '点击换图', 'title' => '点击换图', 'style' => 'cursor:pointer;position:absolute;top:0;right:0;margin-right:.875rem;']]) ?>
                                            <?= $form->field($smsloginmodel, 'smsCode', ['enableAjaxValidation' => true, 'options' => ['class' => 'ui-form-item ui-form-item-r ui-border-b'], 'template' => '{input}<button type="button" id="dynamic-vcode">获取动态密码</button>{error}'])->textInput(['size' => 15, 'placeholder' => '动态密码']) ?>
                                            <div class="ui-btn-wrap">
                                                <?= Html::submitButton('登录', ['class' => 'ui-btn-lg ui-btn-pink']) ?> 
                                                <?=
                                                Alert::widget(['alertTypes' => [
                                                        'login_error' => 'alert-danger'], 'closeButton' => false]);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php ActiveForm::end(); ?> 
                            </section>
                        </li>
                        <li>
                            <section id="common-login-box">
                                <?php
                                $options = [];
                                $options['enableClientValidation'] = true;
                                $options['fieldConfig'] = ['errorOptions' => ['class' => 'help-block help-block-error'], 'labelOptions' => ['style' => 'display:none']];
                                $form = ActiveForm::begin($options);
                                ?>  
                                <div class="demo-item">
                                    <div class="demo-block">
                                        <div class="ui-form ui-border-t">
                                            <?= $form->field($model, 'username', [ 'enableAjaxValidation' => true, 'options' => ['class' => 'ui-form-item ui-form-item-pure ui-border-b']])->textInput(['size' => 30, 'placeholder' => '用户名']) ?>
                                            <?= $form->field($model, 'password', [ 'options' => ['class' => 'ui-form-item ui-form-item-pure ui-border-b']])->passwordInput(['placeholder' => '密码']) ?>
                                            <?= $form->field($model, 'verifyCode', ['options' => ['class' => 'ui-form-item ui-form-item-pure ui-border-b']])->widget(Captcha::className(), ['options' => ['placeholder' => '验证码'], 'imageOptions' => ['alt' => '点击换图', 'title' => '点击换图', 'style' => 'cursor:pointer;position:absolute;top:0;right:0;margin-right:.875rem;']]) ?>
                                            <div class="ui-btn-wrap">
                                                <?= Html::submitButton('登录', ['class' => 'ui-btn-lg ui-btn-pink']) ?> 
                                                <?=
                                                Alert::widget(['alertTypes' => ['login_error' => 'alert-danger'], 'closeButton' => false]);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php ActiveForm::end(); ?> 
                            </section>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="type">
        <div class="demo-item">
            <div class="demo-block">
                <div class="ui-whitespace">
                    <p class="font-16 text-right">
                        <a href= "<?= Url::to(['passport/resetpassword']); ?>" class="font-red">忘记密码？</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</section>
<script>
    var params = {'checkmobileurl': '<?= Url::to(['passport/checklogindata']) ?>', 'getsmscodeurl': '<?= Url::to(['passport/getsmscode']) ?>', 'vcodeId': 'dynamic-vcode', 'formId': 'smsloginform', 'form': 'SmsLoginForm', 'smsType': 'RegSMSDynamicCode', 'checkCaptcha': 'true'};
</script>
