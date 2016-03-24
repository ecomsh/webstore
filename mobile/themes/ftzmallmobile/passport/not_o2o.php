<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mobile\widgets\Alert;
/* @var $this yii\web\View */
$this->title = '会员注册_上海外高桥进口商品网';
?>


                <div class="m-page" style="">
                    <div class="m-header">
                        <div class="header-left-btn">
                            <span onclick="history.back()" class="icon-back"></span>
                        </div>
                        <h2>手机号注册</h2>
                        <div class="header-right-btn">
                            <a href="<?= Url::to(['user/index'])?>" class="icon-home"></a>
                        </div>
                    </div>
                      <?=  Alert::widget(); ?>
                    <div class="full-screen">
                        <div class="full-padding">
                            <?php 
                            $options = [];
                            $options['enableClientValidation'] = true;
                         	$options['fieldConfig'] = ['errorOptions' => ['class'=>'help-block help-block-error'], 'template' => " <div class='c-g' > {label} <div class='x1'>  {input}  <div class=''></div> </div><div style='clear:both;'></div>{error} </div>", 'labelOptions' => ['class' => 'c-l']];
                            $options['options'] = ['method' => 'post',  'class'=> 'form'];
                             $form = ActiveForm::begin( $options); ?>
                                <div class="login-box">
                                    <?= $form->field($model, 'mobile_id',['enableAjaxValidation' => true])->textInput([ 'class' => 'text', 'placeholder' => '请填写手机号']) ?>

                                        <div class="notice" style="height:10px;"></div>
                                        
                                         <?= $form->field($model, 'password')->textInput([ 'class'=> 'text', 'type'=>'password', 'placeholder'=>"请输入密码", 'data-caution'=>"密码栏不能为空"]) ?>
                                           
                                                <div class="notice" style="height:10px;"></div>
                                         <?= $form->field($model, 'smsCode',['enableAjaxValidation' => true])->textInput([ 'class'=> 'text', 'placeholder'=>"输入验证码", 'data-caution'=>"密码栏不能为空"]) ?>
                                <div class="btn-bar mt20">
                                    <button type="submit" class="btn red_btn" >注册</button>
                                </div>
                                <div class="notice" style="height:10px;"></div>
                                <div class="c-g-c" style="padding-top:5px;padding-bottom:30px;">
                                    <p>已有账号？
                                        <a href="<?= Url::to(['passport/login']) ?>" class="signup-link">立即登录</a>
                                    </p>
                                </div>
                        </div>
                        <?php  ActiveForm::end(); ?>
                    </div>
                </div>
                </div>
          
                <script>
                 
                $(document).ready(function(){
                    //数据输入前，禁用提交按钮
                    //          		 $("button:submit").attr({"disabled":"disabled"});
                    // 添加验证码按钮
                    //          		   getValiCode  class='btn ' 
                    $('input#mobileregistrationform-mobile_id').siblings().prop('class', 'input-clean');
                      $('input#mobileregistrationform-mobile_id').css("border","none");
                    $('input#mobileregistrationform-password').siblings().prop('class', 'input-eyes');
                    $('input#mobileregistrationform-smscode').parent().prop('class', 'x2');  
                       
                    $('input#mobileregistrationform-smscode').parent().after("<label class='yanzhengma'><input type='button' id='btn-vcode' class='getValiCode' value='获取验证码'><lable>");
//                     $('.yanzhengma').click(function(e){clickVCode(e);})
                    
                       // 获取验证码的倒计时
                    var count;
                    $(".getValiCode").click(function () {
                        var phoneNumber = jQuery("input#mobileregistrationform-mobile_id").val();
//                         alert(phoneNumber);
                        var url = '<?= Url::to(['passport/valregmobile'])?>';
                        jQuery.ajax({
                        url: url,
                        method: 'get',
                        data: {
                              'MobileRegistrationForm':{
                                'mobile_id': phoneNumber 
                                }
                        },
                        dataType: 'json',
                        success: function(data) {

                            var obj = eval(data);
                            var mobile = obj.mobile_id;
//                            alert(mobile);
                            if(mobile === undefined){
                                clickVCode();
                                count = 59;
                                getNumber();
                            }
                            else{
                                $("input#mobileregistrationform-mobile_id").focus();
                                $(".field-mobileregistrationform-mobile_id .c-g .help-block-error").html(mobile);
                                return false;
                            }
                        },
                        error: function(data) {
                            alert("服务器发生错误: " + data);
                        }

                    });
                       
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
                    
                        
                        
                    //定义全局变量 stub code
                    var mobileStub = '';
                        
                        //清除手机号
                        var click_i = 0;
                        $('.input-clean').on('click', function() {
                            $(this).siblings().val('');
                        });
                        //显示 隐藏密码
                        $('.input-eyes').on('click', function() {

                            if (click_i == 0) {
                                $(this).siblings().prop('type', 'text');
                                click_i = 1;
                            } else {
                                $(this).siblings().prop('type', 'password');
                                click_i = 0;
                            };
                        });
                        //广告点击关闭事件
                        $('.login-close-btn').on('click', function() {
                            $('.login-bg').hide();
                        });

                         //获取手机短信验证码
                    function clickVCode(e) {

//                     	$("button#btn-vcode").removeAttr('onclick');
                        var phoneNumber = $("input#mobileregistrationform-mobile_id").val();
                        var url = '<?= Url::to(['passport/getsmscode'])?>';
                        $.ajax({
                            url: url,
                            method: 'get',
                            data: {
                                'mobile': phoneNumber,
                                'type': 'RegSMSVerificationCode'
                            },
                            dataType: 'json',
                            success: function(data) {
                                mobileStub = data.identity.validationStub
//                                alert("sucess data: " + url + "\ndata:" + data.identity.validationStub +
//                                    "mobile:" + data.identity.mobile);
                            },
                            error: function(data) {
                                alert("发生错误: " + data);
                            }
                        });
                        
                    }

                   })

                </script>
           