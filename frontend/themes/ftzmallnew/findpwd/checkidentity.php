<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\assets\ftzmallnew\FindpwdAsset;

FindpwdAsset::register($this);
?>
	<div class="forgotpw-container">
		<div class="forgotpw-progress">
			<h3 class="font-color4">找回密码</h3>
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/progress-img2.png', true)?>">
		</div>
		<div class="forgotpw-div">
		
		
		 <?php 
			$hiddenUsername = empty($model->username)? "hidden": "";
			$hiddenMobile = empty($model->mobile)? "hidden": "";
			$hiddenEmail = empty($model->email)? "hidden": "";
		
		
                            $options = [];
                            $options['enableClientValidation'] = true;
                          $options['fieldConfig'] = ['template' => " <div class='forgotpw-item-no-border' > {label} {input} {error} </div>",'errorOptions' => ['class' => 'help-block help-block-error']];
                             $form = ActiveForm::begin( $options); ?>
                             
                             
                              <?= $form->field($model, 'verifyMethod')->textInput([ 'class' => 'pw-input', 'disabled'=>'disabled', 'placeholder'=>"找回密码途径" ]) ?>
                  			<?= $form->field($model, 'username',['options' => ['class' => $hiddenUsername]])->textInput(['disabled'=>'disabled','class' => '', 'placeholder'=>"没有用户名" ]) ?>
                  			<?= $form->field($model, 'mobile' ,['options' => ['class' => $hiddenMobile]])->textInput(['disabled'=>'disabled', 'class' => '', 'placeholder'=>"没有手机号" ]) ?>
							<?= $form->field($model, 'email',['options' => ['class' => $hiddenEmail]])->textInput(['disabled'=>'disabled', 'class' => '', 'placeholder'=>"没有提供邮箱" ]) ?>
                  			
                  			<?php
							 $template = '';
							 $hidden = '';
							 $fieldName = 'msgVerifyCode';
                  			if($isMobile){
                  				$template = ' <div class="forgotpw-item" > {label} {input} <button type="button" class="btn btn-obtain" id="dynamic-vcode">免费获取短信校验码</button>{error}</div>';
                  			}else{
                  				$hidden = 'hidden';
                  				$fieldName = 'emailVerifyCode';
                  				$template = ' <div class="forgotpw-item" > {label} {input} <button type="button" class="btn btn-obtain" id="dynamic-vcode-email">发送重置密码链接到邮箱</button>{error}</div>';
                  			}
                  			?>
                  			 <?= $form->field($model, $fieldName, [ 'enableAjaxValidation' => true, 'template' => $template])->textInput(['class'=>$hidden ,'size' => 15, 'placeholder' => '请输入六位短信校验码']) ?>
                                    
                  <div class="btn-group" role="group">
				 <?= Html::button('上一步', ['class' => $hidden. ' btn btn-prev', 'id'=>'back']) ?>
				 <?= Html::submitButton('下一步', ['class' => $hidden . ' btn btn-next']) ?>
			</div>       
			<div class="customer-service font-color4">如有问题请拨打客服热线：400-188-5179</div>
                           
                            
                            	<?php ActiveForm::end(); ?>
                            	</div>
                            	</div>
<script type="text/javascript">
var urlArray = {
				'back': '<?= Yii::$app->request->referrer ?>',
				'getsmscode': '<?= Url::to(['findpwd/getsmscode'])?>',
				'getemaillink': '<?= Url::toRoute('findpwd/sendemail', true)?>',
				'checkidentity': '<?= Url::toRoute('findpwd/checkidentity', true)?>',
				'checkemail': '<?= Url::toRoute('findpwd/checkemail', true)?>'};
                             
</script>
