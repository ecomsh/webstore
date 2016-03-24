
<?php
     use frontend\assets\ftzmallnew\LoginAsset;
    use frontend\assets\ftzmallnew\RegisterAsset;
    use yii\bootstrap\ActiveForm;
    use yii\captcha\Captcha;
    use yii\helpers\Html;
    use yii\helpers\Url;
	RegisterAsset::register($this);
	$this -> title = '注册页';
//        $a=new RegisterAsset;
//        echo '<pre>';
//        var_dump($a);die;
?>
<div class="container"  >
    <div class="login-rightbigbox" >
        <div class="login-rightbox">
            <div class="login-right-topbox">
<!--                <span class="font-20 font-red">用户注册</span>-->
                  <a href="javascript:void(0)"><img src="http://static.tbh.dev/yingyuan/static/images/dlzc_logo.png"></a>
                <span class="font-12 font-gray ">已有账号
                <a href="<?= Url::to(['passport/login/']); ?>" class="font-red">在此登录</a>
           </span>
                  <h3>注册账号</h3>
            </div>
            <div class="form-box">
                <?php
                    $options = [];
                    $options['enableClientValidation'] = true;
                    $options['fieldConfig'] = ['template' => "{label}{input}{error}", 'horizontalCssClasses' => ['label' => 'control-label']];
                    $form = ActiveForm::begin($options);
                ?>                
                <?= $form->field($model, 'mobile',['enableAjaxValidation' => true])->textInput([ 'class' => 'input-box', 'size' => 30, 'placeholder' => '请输入手机号码']) ?>
              

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), ['options' =>['class' => 'input-box-short','placeholder' => '图片验证码'],  
                  					'imageOptions' => ['alt' => '点击换一张', 'title' => '点击换一张']]) ?>
                    
    
           
                <?= $form->field($model, 'smsCode',['enableAjaxValidation' => true])->textInput([ 'class' => 'input-box-short', 'size' => 15, 'placeholder' => '短信校验码']) ?>
                <div class="getValiCode-box"><input type="button" id= 'btn-vcode' class="getValiCode" value="短信校验码"></div>
                <?= $form->field($model, 'password', ['enableAjaxValidation' => true])->passwordInput([ 'class' => 'input-box', 'size' => 30, 'placeholder' => '密码']) ?>
                <!--密码强度，最后根据取到的密码强度属性决定id为哪个的div框显示，目前由于要测试样式，先显示最弱的，1=>弱，2=>中，3=>强-->
                <div class="passwordpower" id="passwordpower0"><span></span><span></span><span></span><font></font></div>
                <div class="passwordpower" id="passwordpower1" style="display:none"><span class="active"></span><span></span><span></span><font>弱</font></div>
                <div class="passwordpower" id="passwordpower2" style="display:none"><span class="active"></span><span class="active"></span><span></span><font>中</font></div>
                <div class="passwordpower" id="passwordpower3" style="display:none"><span class="active"></span><span class="active"></span><span class="active"></span><font>强</font></div>
                <!--密码强度end-->
                <?= $form->field($model, 'confirmPassword')->passwordInput([ 'class' => 'input-box', 'size' => 30, 'placeholder' => '重复密码']) ?> 
                <div class="control-group2">
                    <?= Html::submitButton('立即注册', ['class' => 'btn red']) ?>                            
                </div>
            </div>
            <?php ActiveForm::end(); ?>            
            <div class="login-right-bottombox">
                 <p class="des">点击“立即注册”，即表示您同意并愿意遵守
                <a class="font-red " href="<?=  Url::to(['article/page','view'=>'fwxy']);?>" target="_blank">用户协议</a>
           </p>

            </div>
        </div>
        
    </div>
     <div class="foot">Copyright © 2006 - 2015上海外高桥进口商品网版权所有　沪ICP备11030945号-3 增值电信业务经营许可证　沪B-20110100</div>
</div>

 <script>

 var urlArray = {'valregmobile': '<?= Url::to(['register/valregmobile'])?>', 'getsmscode': '<?= Url::to(['register/getsmscode'])?>'};
 
</script>
   
