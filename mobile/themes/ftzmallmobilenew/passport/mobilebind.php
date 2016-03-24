<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\captcha\Captcha;
use mobile\widgets\Alert;
use mobile\assets\ftzmallmobilenew\PassportAsset;

PassportAsset::register($this);
/* @var $this yii\web\View */
$this->title = '绑定手机_上海外高桥进口商品网';
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
                    <?= $form->field($model, 'verifyCode', ['options' => ['class' => 'ui-form-item ui-form-item-r ui-border-b']])->widget(Captcha::className(), ['options' => ['placeholder' => '验证码'],
                        'imageOptions' => ['alt' => '点击换图', 'title' => '点击换图', 'style' => 'cursor:pointer;position:absolute;top:0;right:0;margin-right:.875rem;']]) ?>
                     <?= $form->field($model, 'smsCode', ['enableAjaxValidation' => true, 'options' => ['class' => 'ui-form-item ui-form-item-r ui-border-b'], 'template' => '{input}<button type="button" id="bind-vcode">获取验证码</button>{error}'])->textInput(['size' => 15, 'placeholder' => '短信验证码']) ?>
                    <div class="ui-btn-wrap">
                        <?= Html::submitButton('绑定手机号', ['class' => 'ui-btn-lg ui-btn-pink']) ?>  
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </section>
</section>


<script>
    var params = {'checkmobileurl': '<?= Url::to(['passport/valmobile']) ?>', 'getsmscodeurl': '<?= Url::to(['passport/getsmscode']) ?>', 'vcodeId':'bind-vcode', 'formId': 'bindmobileform', 'form': 'BindMobileForm', 'smsType': ''};
</script>
</script>

