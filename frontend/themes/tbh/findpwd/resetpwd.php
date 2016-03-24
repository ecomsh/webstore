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
        <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/progress-img3.png', true)?>">
    </div>
      <div class="forgotpw-div">
     <?php 
                            $options = [];
                            $options['enableClientValidation'] = true;
                          $options['fieldConfig'] = [
                          		'template' => " <div class='form-group' > {label} <div class='col-sm-8'>  {input} </div>{error} </div>", 
                          		'labelOptions' => ['class' => 'col-sm-4'], 'errorOptions' => ['class' => 'help-block help-block-error']];
							$options['options'] = ['class' => 'form-horizontal newpw-form'];
                          $form = ActiveForm::begin( $options); ?>
                              <?= $form->field($model, 'password')->passwordInput([ 'class' => 'form-control new-pw', 'placeholder'=>"请输入新登录密码" ]) ?>
                              <?= $form->field($model, 'confirmPassword')->passwordInput([ 'class' => 'form-control  re-newpw', 'placeholder'=>"请再次确认输入新登录密码" ]) ?>
     		
     			 <div class="form-group">
					<label for="net-btn" class="col-sm-4"></label>
					<div id="realname-btngroup">
                            <?= Html::submitButton('提交', ['class' => 'btn btn-submite']) ?>
                            
                </div>
            </div>
                            	<?php ActiveForm::end(); ?>
    </div>
    <div class="customer-service font-color4">如有问题请拨打客服热线：400-188-5179</div>
</div>

