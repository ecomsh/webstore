<?php
    use frontend\assets\ftzmallnew\LoginAsset;
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
    use yii\helpers\Url;
	LoginAsset::register($this);
	$this -> title = '注册页';
?>
<div class="container">
    <div class="login-leftbox">
        <?php echo"11111";?>
        <img src="http://7xoo3k.com2.z0.glb.qiniucdn.com/pc-static-member-left.jpg">
    </div>
    <div class="login-rightbigbox">
        <div class="login-rightbox">
            <div class="login-right-topbox">
                <span class="font-20 font-red">用户注册</span>
                <span class="font-12 font-gray pd-130">已有账号</span>
                <a href="<?= Url::to(['login/']); ?>" class="font-red">在此登录</a>
            </div>
            <div class="form-box">
                <?php
                    $options = [];
                    $options['enableClientValidation'] = true;
                    $options['fieldConfig'] = ['template' => "{input}{error}", 'horizontalCssClasses' => ['label' => 'control-label']];
                    $form = ActiveForm::begin($options);
                ?>                
                <?= $form->field($model, 'mobile_id')->textInput([ 'class' => 'input-box', 'size' => 30, 'placeholder' => '手机号']) ?>
                <?= $form->field($model, 'sex')->radioList(['1'=>'先生','0'=>'女士']) ?>
                <?= $form->field($model, 'smscode')->textInput([ 'class' => 'input-box-short', 'size' => 15, 'placeholder' => '短信校验码']) ?>
                <div class="getValiCode-box"><a id="btn-vcode" class="getValiCode" href="javascript:void(0);">获取验证码</a></div>
                <?= $form->field($model, 'password')->passwordInput([ 'class' => 'input-box', 'size' => 30, 'placeholder' => '密码']) ?>
                <!--密码强度，最后根据取到的密码强度属性决定id为哪个的div框显示，目前由于要测试样式，先显示最弱的，1=>弱，2=>中，3=>强-->
                <div class="passwordpower" id="passwordpower1"><span class="active"></span><span></span><span></span><font>弱</font></div>
                <div class="passwordpower" id="passwordpower2" style="display:none"><span></span><span class="active"></span><span></span><font>中</font></div>
                <div class="passwordpower" id="passwordpower3" style="display:none"><span></span><span></span><span class="active"></span><font>强</font></div>
                <!--密码强度end-->
                <?= $form->field($model, 'confirmPassword')->passwordInput([ 'class' => 'input-box', 'size' => 30, 'placeholder' => '重复密码']) ?> 
                <div class="control-group2">
                    <?= Html::submitButton('同意协议并注册', ['class' => 'btn red']) ?>                            
                </div>
            </div>
            <?php ActiveForm::end(); ?>            
            <div class="login-right-bottombox">
                <a class="font-red font-12" href="<?= Url::to(['login/']); ?>">《上海外高桥进口网用户协议》</a>
            </div>            
        </div>
    </div>
</div>
