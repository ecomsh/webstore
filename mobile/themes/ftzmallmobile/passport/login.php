<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mobile\widgets\Alert;
use yii\captcha\Captcha;
/* @var $this yii\web\View */
$this->title = '会员登录_上海外高桥进口商品网';
?>


    <div class="m-page">
        <div class="m-header">
            <div class="header-left-btn">
                <span onclick="history.back()" class="icon-back"></span>
            </div>
            <h2>登录</h2>
            <div class="header-right-btn">
                <a href="<?= Url::to(['user/index'])?>" class="icon-home"></a>
            </div>
        </div>
           <?= Alert::widget(); ?>
        <div class="full-screen">
            <div class="full-padding">
                <div class="login-bg">
                    <div class="login-close-btn"></div>
                </div>
                <?php 
                            $options = [];
                            $options['enableClientValidation'] = true;
                            //,['enableAjaxValidation'=>true]
                          $options['fieldConfig'] = ['template' => " <div class='c-g' > {label} <div class='x1'>  {input}  <div class='input-common'></div> </div><div style='clear:both;'></div>{error} </div>", 'labelOptions' => ['class' => 'c-l']];
                            $options['options'] = ['method' => 'post',  'class'=> 'form'];
                             $form = ActiveForm::begin( $options); ?>
                    <div class="login-box">
                        <?= $form->field($model, 'username')->textInput([ 'class' => 'text', 'placeholder' => '账号/手机']) ?>

                            <div class="notice" style="height:10px;"></div>
                            <?= $form->field($model, 'password')->textInput([  
                                         		'class'=> 'text', 'type'=>'password','placeholder'=>"请输入密码", 'data-caution'=>"密码栏不能为空"]) ?>
                                 <?= $form->field($model, 'verifyCode')->widget(Captcha::className(),[
                                        'imageOptions'=>['alt'=>'点击换图','title'=>'点击换图', 'style'=>'cursor:pointer']]) ?>

                                    <div class="login-btn">
                                        <div class="btn-bar mt20">
                                            <button type="submit" class="btn red_btn" >登录</button>
                                        </div>
                                        <div class="c-g-c" style="padding-top:20px;padding-bottom:30px;">
                                            <p  style="text-align:right">
                                              <a href="<?= Url::to(['passport/resetpassword']) ?>" class="signup-link">忘记密码</a>
                                            还没有账号？
                                                <a href="<?= Url::to(['passport/reg']) ?>" class="signup-link">手机注册</a>
                                                  </p>
                                        </div>
                                    </div>
                    </div>
                        <?php  ActiveForm::end(); ?>


            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('input#mobileloginform-stub').parent().parent().css('display', 'none');
            $('.field-mobileloginform-username .x1 .input-common').addClass('input-clean');
            $('.field-mobileloginform-password .x1 .input-common').addClass('input-eyes');
          //输入框清空和呈密码状
            var click_i = 1;
            $('.input-clean').on('click', function() {
                $(this).siblings().val('');
            });
            $('.input-eyes').on('click', function() {
                if (click_i == 0) {
                    $(this).siblings().prop('type', 'text');
                    click_i = 1;
                } else {
                    $(this).siblings().prop('type', 'password');
                    click_i = 0;
                };
            });
        })

    </script>
