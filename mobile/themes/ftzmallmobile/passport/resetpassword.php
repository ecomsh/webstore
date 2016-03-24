<?php
use yii\helpers\Html;

use yii\helpers\Url;
use mobile\assets\RegisterAsset;
use yii\widgets\ActiveForm;
use mobile\widgets\Alert;
RegisterAsset::register($this);
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mobile\models\ResetPasswordForm */

$this->title = '重置密码';
$this->params['breadcrumbs'][] = $this->title;
?>



    <div class="m-page" style="">
        <div class="m-header">
            <div class="header-left-btn">
                <span onclick="history.back()" class="icon-back"></span>
            </div>
            <h2>密码重置</h2>
            <div class="header-right-btn">
                <a href="<?= Url::to(['user/index'])?>" class="icon-home"></a>
            </div>
        </div>
        <div class="full-screen">
            <div class="full-padding">




                        <?php 
                            $options = [];
                            $options['enableClientValidation'] = true;
                          $options['fieldConfig'] = ['template' => " <div class='c-g' > {label} <div class='x1'>  {input}  <div class='input-common'></div> </div><div style='clear:both;'></div>{error} </div>", 'labelOptions' => ['class' => 'c-l']];
                            $options['options'] = ['method' => 'post',  'class'=> 'form'];
                             $form = ActiveForm::begin( $options); ?>
                                            <div class="login-box">
                                                <?= $form->field($model, 'mobile', ['enableAjaxValidation' => true])->textInput([ 'class' => 'text', 'placeholder' => '请填写手机号']) ?>

                                                    <div class="notice" style="height:10px;"></div>

                                                    <?= $form->field($model, 'newPassword')->textInput([ 'class'=> 'text', 'type'=>'password', 'placeholder'=>"请输入密码", 'data-caution'=>"密码栏不能为空"]) ?>
                                                        <div class="notice" style="height:10px;"></div>
                                                        <?= $form->field($model, 'confirmNewPassword')->textInput([ 'class'=> 'text', 'type'=>'password', 'placeholder'=>"请输入密码", 'data-caution'=>"密码栏不能为空"]) ?>
                                                            <div class="notice" style="height:10px;"></div>
                                                            <?= $form->field($model, 'smsCode',['enableAjaxValidation' => true])->textInput([ 'class'=> 'text','placeholder'=>"输入验证码", 'pattern'=>".{6,20}",'data-caution'=>"不能为空"]) ?>
                                                                <div class="notice" style="height:10px;"></div>
                                                                <div class="form-group">
                                                                    <?= Html::submitButton('提交', ['class' => 'btn red_btn']) ?>
                                                                </div>

                                            </div>
                                                  <?php  ActiveForm::end(); ?>
            </div>
        </div>
         </div>





        <script>
            $('input#resetpwdform-smscode').parent().prop('class', 'x2');
            $('input#resetpwdform-smscode').parent().after("<label class='yanzhengma'><input type='button' id='btn-vcode' class='getValiCode' value='获取验证码'><lable>");
            $('.yanzhengma').click(function(e){clickVCode(e);})
            


            // 获取验证码的倒计时
            var count;
            $(".getValiCode").click(function() {
                count = 59;
                getNumber();
            });

            function getNumber() {
                $(".getValiCode").attr("disabled", "disabled");
                $(".getValiCode").val(count + "秒后重获");
                count--;
                if (count > -1) {
                    setTimeout(getNumber, 1000);
                } else {
                    $(".getValiCode").val("重新获取");
                    $(".getValiCode").attr("disabled", false);
                }
            }



            mobileStub = '';

            //获取手机短信验证码
            function clickVCode() {
                var phoneNumber = $("input#resetpwdform-mobile").val();
                var url = '<?= Url::to(['passport/getsmscode'])?>'; //记住这里不能换行哦~~~                
                $.ajax({
                    url: url,
                    method:'get',
                    data: {
                        'mobile': phoneNumber,
                        'type': 'ResetPwdSMSVerificationCode'
                     
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
