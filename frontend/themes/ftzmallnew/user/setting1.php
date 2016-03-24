<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\widgets\Alert;

/* @var $this yii\web\View */
$this->title = '账户信息_上海外高桥进口商品网';
?>

   
   <style>
       .field-bindmobileform-mobile{
          float: left;
          width: 350px;
          margin-left: 100px;
       }
       .field-bindmobileform-smscode{
          float: left;
          width: 350px;
       }
       .submit-btn{
          background:#b30013;
       }
       .yanzhengma{
          margin-left:10px;
       }
   </style>
   
   
   
    <div class="member-main" style="width: 960px;">
        <div class="title title2">个人信息<span class="disc">| 请尽量完整填写您的个人信息，方便店家与您联系。</span></div>

        <?php 
                            $options = [];
                            $options['enableClientValidation'] = true;
//                             $options['fieldConfig'] = ['labelOptions' => ['class' => 'address-label'], 'errorOptions' => ['style' => 'margin:0px;padding-left:240px;']];
                            
                          $options['fieldConfig'] = ['errorOptions' => ['class'=>'help-block help-block-error'],'template' => " <div class='c-g' > {label} <div class='x1'>  {input} </div><div style='clear:both;'></div>{error} </div>"];
//                             $options['options'] = ['method' => 'post', 'id'=>'form_saveMember',  'class'=> 'section'];
                             $form = ActiveForm::begin( $options); ?>
            <?= $form->field($model, 'mobile')->textInput([ 'class' => 'inputstyle', 'placeholder' => '手机号码']) ?>
                <?= $form->field($model, 'smsCode',['enableAjaxValidation' => true])->textInput([  
                                         		'class'=> 'inputstyle','placeholder'=>"请输入短信验证码", 'data-caution'=>"验证码不能为空"]) ?>
                    <div class="division" style="border:none;padding-top:0; border-bottom:1px dashed #ddd">
                        <table class="forform" width="100%" border="0" cellspacing="0" cellpadding="0">
                        </table>
                    </div>
                    <div>
                        <button class="btn submit-btn" type="submit" style="margin-left:300px"> <span><span>绑定手机</span></span>
                        </button>
                    </div>
                    <?= Alert::widget(); ?>
                        <?php  ActiveForm::end(); ?>

    </div>


    <script>
        jQuery(document).ready(function() {

        	var mobile = jQuery('input#bindmobileform-mobile').val();
        	if(mobile == null || mobile == ''){
        		 jQuery('input#bindmobileform-smscode').after("<label class='yanzhengma'><input type='button' id='btn-vcode' class='getValiCode' value='获取验证码'><lable>");
            }else{
            	jQuery('input#bindmobileform-mobile').prop('readonly','true');
            	jQuery('button.submit-btn').css('display','none');
            	jQuery('input#bindmobileform-smscode').parent().parent().parent().css('display', 'none');
              }
            

            // 获取验证码的倒计时
            var count;
            jQuery(".getValiCode").click(function(e) {
                var phoneNumber = jQuery("input#bindmobileform-mobile").val();
                var url = '<?= Url::to(['user/valmobile'])?>';
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
//                    alert(mobile);
                    if(mobile === undefined){
                        clickVCode();
                        count = 59;
                        getNumber();
                    }
                    else{
                        jQuery("input#bindmobileform-mobile").focus();
                        jQuery(".field-bindmobileform-mobile .c-g .help-block-error").html(mobile);
                        return false;
                    }
                },
                error: function(data) {
                    alert("服务器发生错误: " + data);
                }

            });
                });

            function getNumber() {
                jQuery(".getValiCode").attr("disabled", "disabled");
                jQuery(".getValiCode").val(count + "秒后重获");
                count--;
                if (count > -1) {
                    setTimeout(getNumber, 1000);
                } else {
                    jQuery(".getValiCode").val("重新获取");
                    jQuery(".getValiCode").attr("disabled", false);
                }
            }


        //获取手机短信验证码
        function clickVCode(e) {

            var phoneNumber = jQuery("input#bindmobileform-mobile").val();
            var url = '<?= Url::to(['user/getsmscode'])?>';
            jQuery.ajax({
                url: url,
                method: 'get',
                data: {
                    'mobile': phoneNumber,
                    'type': ''
                },
                dataType: 'json',
                success: function(data) {
                    mobileStub = data.identity.validationStub
                },
                error: function(data) {
                    alert("服务器发生错误: " + data);
                }
            });
        }
    });

    </script>
