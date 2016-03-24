<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use frontend\assets\ftzmallnew\FindpwdAsset;

FindpwdAsset::register($this);
?>
<div class="forgotpw-container">
		<div class="forgotpw-progress">
			<h3 class="font-color4">找回密码</h3>
                        <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/progress-img1.png', true)?>">
		</div>
		<div class="forgotpw-div">
			<div class="forgotpw-text">请输入您的登录名，您的登录名可能是您的用户名/手机号/邮箱</div>
			
			 <?php 
                            $options = [];
                            $options['enableClientValidation'] = true;
                          $options['fieldConfig'] = [
                          		
                          		'template' => " <div class='form-group' > {label} <div class='col-sm-10'>  {input} </div>{error} </div>", 'labelOptions' => ['class' => 'col-sm-2'], 'errorOptions' => ['class' => 'help-block help-block-error']];
                          $options['options'] = ['class' => 'form-horizontal'];
                          $form = ActiveForm::begin( $options);
                             
                             ?>
                              <?= $form->field($model, 'username', ['enableAjaxValidation' => true])->textInput([ 'class' => 'form-control login-name', 'placeholder'=>"用户名/手机号/邮箱" ]) ?>
                  			<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), ['options' =>['class' => 'form-control verification-code'],  
                  					'imageOptions' => ['alt' => '点击换一张', 'title' => '点击换一张', 'style' => 'cursor:pointer;position:absolute;top:0;left:170px;']]) ?>
     		
     			 <div class="form-group">
					<label for="net-btn" class="col-sm-2"></label>
					<div id="realname-btngroup">
                            <?= Html::submitButton('下一步', ['class' => 'btn btn-next']) ?>
                            
                            	<?php ActiveForm::end(); ?>
                            <div class="forgotpw-text">如果您忘记了登录名，将无法找回您的账户信息，您还可以<a href="<?= Url::to(['register/index']); ?>" class="font-color4"  target="_Blank">重新注册</a></div>
                            </div></div>
     			
			
		</div>
		</div>
		
		
