<?php
    use frontend\assets\ftzmallnew\LoginAsset;
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\captcha\Captcha;
	LoginAsset::register($this);
	$this -> title = '登录页';
?>
<div class="container">
    <div class="login-leftbox">
        <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/login-left2.png', true)?>">
    </div>

    <div class="login-rightbigbox">
        <div class="login-rightbox">
            <div class="login-right-topbox">
                <span class="font-20 font-red">登录</span>
                <span class="font-12 font-gray pd-130">还没有账号？</span>
                <a href="<?= Url::to(['login/']); ?>" class="font-red">30秒注册</a>
            </div>
            <div class="login-nav">
                <div class="radio margin-r30">
                    <label class="checked">
                        <input type="radio" id="mobile-login">手机动态密码登录
                    </label>
                </div>
                <div class="radio margin-r0">
                    <label>
                        <input type="radio" id="common-login">普通登录
                    </label>
                </div>
            </div>
            <div class="form-box" id="mobile-login-box">
                <?php
                    $options = [];
                    $options['enableClientValidation'] = true;
                    $options['fieldConfig'] = ['template' => "{input}{error}", 'horizontalCssClasses' => ['label' => 'control-label']];
                    $form = ActiveForm::begin($options);
                ?>                
                <?= $form->field($model, 'mobile')->textInput([ 'class' => 'input-box login-member', 'size' => 30, 'placeholder' => '已注册的手机号码']) ?>
                <?= $form->field($model, 'verifycode')->textInput([ 'class' => 'input-box-short2', 'size' => 15, 'placeholder' => '验证码']) ?>
                <div class="getverifycode-box">
                    <?php 
                    echo Captcha::widget(['name'=>'captchaimg','captchaAction'=>'logintest/captcha','imageOptions'=>['id'=>'captchaimg', 'title'=>'换一个', 'alt'=>'换一个' ],'template'=>'{image}']);?>
                </div>               
                
                <div class="getverifycode-a">
                    <a class="font-red font-12" href="javascript:void(0);">换一张</a>
                </div>
                <?= $form->field($model, 'smsCode')->textInput([ 'class' => 'input-box-short2 login-password', 'size' => 15, 'placeholder' => '短信校验码']) ?>
                <div class="getValiCode-box"><a id="btn-vcode" class="getValiCode" href="javascript:void(0);">获取手机动态密码</a></div>
                <?= $form->field($model, 'auto_login')->checkboxList(['0'=>'自动登录']) ?>               
                <div class="control-group2">
                    <?= Html::submitButton('登录', ['class' => 'btn red']) ?>                            
                </div>
                <?php ActiveForm::end(); ?> 
            </div>
            
             <div class="form-box" id="common-login-box" style="display:none">
                <?php
                    $options = [];
                    $options['enableClientValidation'] = true;
                    $options['fieldConfig'] = ['template' => "{input}{error}", 'horizontalCssClasses' => ['label' => 'control-label']];
                    $form = ActiveForm::begin($options);
                ?>                
                <?= $form->field($model, 'mobile')->textInput([ 'class' => 'input-box login-member', 'size' => 30, 'placeholder' => '已注册的手机号码']) ?>
                <?= $form->field($model, 'password')->passwordInput([ 'class' => 'input-box login-password', 'size' => 30, 'placeholder' => '登录密码']) ?>
                <?= $form->field($model, 'verifycode')->textInput([ 'class' => 'input-box-short2', 'size' => 15, 'placeholder' => '验证码']) ?>
                <div class="getverifycode-box">
                    <?php 
                    echo Captcha::widget(['name'=>'captchaimg','captchaAction'=>'logintest/captcha','imageOptions'=>['id'=>'captchaimg', 'title'=>'换一个', 'alt'=>'换一个' ],'template'=>'{image}']);?>
                </div>
                <div class="getverifycode-a">
                    <a class="font-red font-12" href="javascript:void(0);">换一张</a>
                </div>
                <?= $form->field($model, 'auto_login')->checkboxList(['0'=>'自动登录']) ?>               
                <div class="control-group2">
                    <?= Html::submitButton('登录', ['class' => 'btn red']) ?>                            
                </div>
                <?php ActiveForm::end(); ?> 
            </div>
   
            <div class="iconAccout">
                <div>你也可以使用以下账号登录</div>
                <p>
                    <a href="#" class="a1" title="QQ">QQ</a>
                    <a href="#" class="a2" title="支付宝">支付宝</a>
                    <a href="#" class="a3" title="新浪微博">新浪微博</a>
                    <a href="#" class="a4" title="360">360</a>
                    <a href="#" class="a5" title="百度">百度</a>
                    <span>更多<i id="arrow-down"></i></span>
                </p>
                <p class="icon-p" style="display:none;">
                    <a href="#" class="a6" title="微信">微信</a>
                    <a href="#" class="a7" title="人人">人人</a>
                    <a href="#" class="a8" title="蘑菇街">蘑菇街</a>
                    <a href="#" class="a9" title="团800">团800</a>
                    <a href="#" class="a10" title="迅雷">迅雷</a>
                </p>
            </div>            
        </div>
    </div>
</div>
