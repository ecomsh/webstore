<?php
    use frontend\assets\ftzmallnew\LoginAsset;
    use frontend\assets\ftzmallnew\RegisterAsset;
    use yii\bootstrap\ActiveForm;
    use yii\captcha\Captcha;
    use yii\helpers\Html;
    use yii\helpers\Url;
	LoginAsset::register($this);
	$this -> title = '登录页';
        

?>
<div class="container"  >
   
    <div class="login-rightbigbox" >
        <div class="login-rightbox">
            <div class="login-right-topbox">
<!--                <span class="font-20 font-red">用户注册</span>-->
                  <a href="javascript:void(0)"><img src="http://static.tbh.dev/yingyuan/static/images/dlzc_logo.png"></a>
                <span class="font-12 font-gray ">还没有账号
                <a href="<?= Url::to(['register/']); ?>" class="font-red">30秒注册</a>
           </span>
                  <h3>账号登录</h3>
            </div>
            <div class="form-box">
                <?php
                    $options = [];
                    $options['enableClientValidation'] = true;
                    $options['fieldConfig'] = ['template' => "{label}{input}{error}", 'horizontalCssClasses' => ['label' => 'control-label']];
                    //, 'horizontalCssClasses' => ['label' => 'control-label']
                    $form = ActiveForm::begin($options);
                ?>                
                    <?= $form->field($model, 'username',['enableAjaxValidation' => true])->textInput([ 'class' => 'input-box', 'size' => 30, 'placeholder' => '邮箱/手机号'])->label('手机号') ?>
              
                 <?= $form->field($model, 'password', ['enableAjaxValidation' => true])->passwordInput([ 'class' => 'input-box', 'size' => 30, 'placeholder' => '密码'])->label('手机号') ?>
                <!--密码强度，最后根据取到的密码强度属性决定id为哪个的div框显示，目前由于要测试样式，先显示最弱的，1=>弱，2=>中，3=>强-->
                <div class="passwordpower" id="passwordpower0"></div>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), ['options' =>['class' => 'input-box-short','placeholder'=>"图片验证码"],  
                  					'imageOptions' => ['alt' => '点击换一张', 'title' => '点击换一张']]) ?>
    
           
                
               
                
                
                <div class="control-group2">
                    <?= Html::submitButton('立即登录', ['class' => 'btn red']) ?>                            
                </div>
            </div>
            <?php ActiveForm::end(); ?>            
            <div class="login-bottombox">
               <p>其他方式登录</p>
            <a href="javascript:void(0)"><img src="http://static.tbh.dev/yingyuan/static/images/qq.png"></a>
            <a href="javascript:void(0)"><img src="http://static.tbh.dev/yingyuan/static/images/xinlang.png"></a>
            <a href="javascript:void(0)"><img src="http://static.tbh.dev/yingyuan/static/images/zfb.png"></a>
            </div>   
             <div class="login-options">
            <a href="<?= Url::to(['register/']); ?>">注册账号</a>｜<a href="javascript:void(0)">忘记密码</a>
            </div>

        </div>
    </div>
     <div class="foot">Copyright © 2006 - 2015上海外高桥进口商品网版权所有　沪ICP备11030945号-3 增值电信业务经营许可证　沪B-20110100</div>
</div>

 <script>

 var urlArray = {'valregmobile': '<?= Url::to(['register/valregmobile'])?>', 'getsmscode': '<?= Url::to(['register/getsmscode'])?>'};
 
</script>
