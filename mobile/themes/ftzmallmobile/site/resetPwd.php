<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use mobile\assets\RegisterAsset;
RegisterAsset::register($this);
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mobile\models\ResetPasswordForm */

$this->title = 'Mobile Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please choose your new password:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                <?= $form->field($model, 'mobile')->textInput() ?>
                 <?= $form->field($model, 'newPassword')->textInput() ?>
                  <?= $form->field($model, 'confirmNewPassword')->textInput() ?>
                    <?= $form->field($model, 'smsCode')->textInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
            <script>

            $('input#resetpwdform-smscode').parent().after("<div  ><label class='yanzhengma'> <button   class='btn ' onClick='clickVCode()'>获取码</button> <lable></div>");

            
            mobileStub = '';

            //绑定事情回车时间，验证验证码
            $(function() {
                $('input#resetpwdform-smscode').bind('keypress', function(event) {
                    if (event.keyCode == "13") {
                        //获取验证码
                        var messageCode = $('input#resetpwdform-smscode').val();
                        //得到action URL
                        var url = '<?= Url::to(['register/validatecode'])?>';
                        //发送ajax 请求
                        $.ajax({
                            url: url,
                            method: 'get',
                            data: {
                                'mobile': $('input#resetpwdform-mobile').val(),
                                'code': $('input#resetpwdform-smscode').val(),
                                'validationStub': mobileStub,
                            },
                            dataType: 'json',
                            success: function(data) {
                                //验证码验证成功后启用注册按钮
                                if (data.identity.result == true) {
                                    alert("true data: " + url + "\ndata:" + data.identity.result);
                                } else {
                                    alert("false data: " + url + "\ndata:" + data.identity.result);
                                }
                            },
                            error: function(data) {
                                alert("无法验证你的手机验证码" + data);
                            }
                        });
                        return false;
                    }
                });
            });

            
            //获取手机短信验证码
            function clickVCode() {
                var phoneNumber = $("input#resetpwdform-mobile").val();
                var url = '<?= Url::to(['register/getsmscode'])?>'; //记住这里不能换行哦~~~
                $.ajax({
                    url: url,
                    method: 'get',
                    data: {
                        'mobile': phoneNumber
                    },
                    dataType: 'json',
                    success: function(data) {
                        mobileStub = data.identity.validationStub
                        alert("sucess data: " + url + "\ndata:" + data.identity.validationStub +
                            "mobile:" + data.identity.mobile);
                    },
                    error: function(data) {
                        alert("failed data: " + data);
                    }
                });
            }
            </script>
        </div>
    </div>
</div>
