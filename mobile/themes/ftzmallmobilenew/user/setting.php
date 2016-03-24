<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mobile\widgets\Alert;
use mobile\assets\ftzmallmobilenew\UserAsset;

UserAsset::register($this);//为了将activeForm的js代码依赖于mainasset
/* @var $this yii\web\View */
$this->title = '账户信息_上海外高桥进口商品网';
?>

    <div class="m-page">
        <div class="m-header">
            <div class="header-left-btn">
                <span onclick="history.back()" class="icon-back"></span>
            </div>
            <h2>信息完善</h2>
            <div class="header-right-btn">
                <a href="<?=Url::to(['register/o2o'])?>" class="icon-home"></a>
            </div>
        </div>
        <div class="full-screen">
            <div class="full-padding" style="padding:20px 10px;">
                <div class="title title2"><strong>温馨提示:&nbsp;</strong><span class="disc">请尽量完整填写您的个人信息，方便店家与您联系。</span></div>
                
                 <?php 
                            $options = [];
                            $options['enableClientValidation'] = true;
                            //,
                          $options['fieldConfig'] = ['template' => " <div class='c-g' > {label} <div class='x1'>  {input}  <div class='input-common'></div> </div><div style='clear:both;'></div>{error} </div>", 'labelOptions' => ['class' => 'c-l']];
                            $options['options'] = ['method' => 'post',  'class'=> 'form'];
                             $form = ActiveForm::begin( $options); ?>
                    <div class="login-box">
                        <?= $form->field($model, 'mobile',['enableAjaxValidation' => true])->textInput([ 'class' => 'text', 'placeholder' => '手机号码']) ?>

                            <div class="notice" style="height:10px;"></div>
                            <?= $form->field($model, 'smsCode',['enableAjaxValidation' => true])->textInput([  
                                         		'class'=> 'text','placeholder'=>"请输入短信验证码", 'data-caution'=>"验证码不能为空"]) ?>
                                    <div class="login-btn">
                                        <div class="btn-bar mt20">
                                            <button type="submit" class="btn red_btn" >绑定手机</button>
                                        </div>
                                    </div>
                    </div>
                    <?= Alert::widget(); ?>
                        <?php  ActiveForm::end(); ?>

            </div>
        </div>
    </div>


    <script>

    $(document).ready(function(){
   			 $('input#bindmobileform-smscode').parent().prop('class', 'x2');
    	  $('input#bindmobileform-smscode').parent().after("<label class='yanzhengma'><input type='button' id='btn-vcode' class='getValiCode' value='获取验证码'><lable>");
          $('.yanzhengma').click(function(e){clickVCode(e);})



          // 获取验证码的倒计时
          var count;
          $(".getValiCode").click(function () {
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
          
              
          
         });
        //获取手机短信验证码
   function clickVCode(e) {

//    	$("button#btn-vcode").removeAttr('onclick');
       var phoneNumber = $("input#bindmobileform-mobile").val();
       var url = '<?= Url::to(['passport/getsmscode'])?>';
       $.ajax({
           url: url,
           method: 'get',
           data: {
               'mobile': phoneNumber,
               'type':'RegSMSVerificationCode'
           },
           dataType: 'json',
           success: function(data) {
               mobileStub = data.identity.validationStub
//               alert("sucess data: " + url + "\ndata:" + data.identity.validationStub +
//                   "mobile:" + data.identity.mobile);
           },
           error: function(data) {
               alert("发生错误: " + data);
           }
       });
       
   }

  
    </script>
