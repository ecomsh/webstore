<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use mobile\widgets\Alert;
/* @var $this yii\web\View */
$this->title = '绑定手机_上海外高桥进口商品网';
?>

    
                <div class="m-page" style="">
                    <div class="m-header">
                        <div class="header-left-btn">
                            <span onclick="history.back()" class="icon-back"></span>
                        </div>
                        <h2>手机号绑定</h2>
                        <div class="header-right-btn">
                            <a href="<?= Url::to(['user/index'])?>" class="icon-home"></a>
                        </div>
                    </div>
                    <div class="full-screen">
                        <div class="full-padding">
                         <?php 
                            $options = [];
                            $options['enableClientValidation'] = true;
                            //,['enableAjaxValidation'=>true]
 						$options['fieldConfig'] = ['errorOptions' => ['class'=>'help-block help-block-error'], 'template' => " <div class='c-g' > {label} <div class='x1'>  {input}  <div class=''></div> </div><div style='clear:both;'></div>{error} </div>", 'labelOptions' => ['class' => 'c-l']];
                            $options['options'] = ['method' => 'post',  'class'=> 'form'];
                             $form = ActiveForm::begin( $options); ?>
                                <div class="login-box">
                                    <?= $form->field($model, 'mobile')->textInput([ 'class' => 'text', 'placeholder' => '请填写手机号']) ?>
                                        <div class="notice" style="height:10px;"></div>
                                                <?= $form->field($model, 'smsCode',['enableAjaxValidation' => true])->textInput([ 'class'=> 'text','placeholder'=>"验证码不能为空", 'pattern'=>".{6,20}",'data-caution'=>"不能为空"]) ?>
                                </div>

<!--                                            <input class="btn getValiCode" onClick="clickVCode()" type="button" value="获取验证码">-->

                                                        
                                    <div class="btn-bar mt20">
                                        <button type="submit" class="btn red_btn" >绑定手机号</button>
                                    </div>
                                </div>
                                   <?= Alert::widget(); ?>
                            <?php  ActiveForm::end(); ?>
                        </div>
                    </div>
                  <script>
                  var mobileStub = '';

                  (function() {
                      
                      $('input#bindmobileform-mobile').siblings().prop('class', 'input-clean');
                      $('input#bindmobileform-smscode').parent().prop('class', 'x2');  
                      $('input#bindmobileform-smscode').parent().after("<label class='yanzhengma'><input type='button' id='btn-vcode' class='getValiCode' value='获取验证码'><lable>");
                   // $('.yanzhengma').click(function(e){clickVCode(e);})
                      $('.input-clean').on('click', function() {
                            $(this).siblings().val('');
                        });
                      
                      // 获取验证码的倒计时
                    var count;
                    $(".getValiCode").click(function () {
                        var phoneNumber = jQuery("input#bindmobileform-mobile").val();
                        var url = '<?= Url::to(['passport/valmobile'])?>';
                        jQuery.ajax({
                        url: url,
                        method: 'get',
                        data: {
                              'BindMobileForm':{
                                'mobile': phoneNumber 
                                }
                        },
                        dataType: 'json',
                        success: function(data) {

                            var obj = eval(data);
                            var mobile = obj.mobile;
//                            alert(mobile);
                            if(mobile === undefined){
                                clickVCode();
                                count = 59;
                                getNumber();
                            }
                            else{
                                $("input#bindmobileform-mobile").focus();
                                $(".field-bindmobileform-mobile .c-g .help-block-error").html(mobile);
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
                            setTimeout(GetNumber, 100);
                        } else {
                            $(".getValiCode").val("重新获取");
                            $(".getValiCode").attr("disabled", false);
                        }
                    } 
                     
                  })();

                  //获取手机短信验证码
                  function clickVCode(e) {
                      
                      var phoneNumber = $("input#bindmobileform-mobile").val();
                      var url = '<?= Url::to(['passport/getsmscode'])?>'; //记住这里不能换行哦~~~
                      $.ajax({
                          url: url,
                          method: 'get',
                          data: {
                              'mobile': phoneNumber,
                              'type':'RegSMSVerificationCode',
                          },
                          dataType: 'json',
                          success: function(data) {
                              mobileStub = data.identity.validationStub
//                              alert("sucess data: " + url + "\ndata:" + data.identity.validationStub +
//                                  "mobile:" + data.identity.mobile);
                          },
                          error: function(data) {
                              alert("failed data: " + data);
                          }
                      });
                  }

                </script>
        
