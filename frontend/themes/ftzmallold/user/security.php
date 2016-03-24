<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\widgets\Alert;

/* @var $this yii\web\View */
$this->title = '修改密码_上海外高桥进口商品网';
?>
<style>
.c-l{width:70px;}

.help-block-error{
	margin-left: 80px;
}
.form-group{
	height:65px;
}
</style>

<div class="member-main" style="width: 960px;">
    
      <?php 
                            $options = [];
                            $options['enableClientValidation'] = true;
                          $options['fieldConfig'] = ['errorOptions' => ['class'=>'help-block help-block-error'], 'template' => " <div class='c-g' > {label} <span class='x1'>  {input} </span><div style='clear:both;'></div>{error} </div>", 'labelOptions' => ['class' => 'c-l']];
                            $options['options'] = ['method' => 'post',  'class'=> 'form'];
                             $form = ActiveForm::begin( $options); ?>
                        <?= $form->field($model, 'oldPassword')->textInput([ 'class' => 'inputstyle', 'type'=>'password', 'placeholder' => '原始密码']) ?>
                        <?= $form->field($model, 'password')->textInput([ 'class'=> 'inputstyle', 'type'=>'password', 'placeholder'=>"新密码", 'data-caution'=>"密码栏不能为空"]) ?>
                                <?= $form->field($model, 'confirmPassword')->textInput([ 'class'=> 'inputstyle', 'type'=>'password', 'placeholder'=>"确认密码", 'data-caution'=>"密码栏不能为空"]) ?>
        			 <div class="division" style="border:none;padding-top:0; border-bottom:1px dashed #ddd">
                        <table class="forform" width="100%" border="0" cellspacing="0" cellpadding="0">
                        </table>
                  	  </div>
                    <div>
                        <button class="btn submit-btn" type="submit" style="margin-left:300px"> <span><span>修改</span></span>
                        </button>
                    </div>
	 <?= Alert::widget(); ?>
     <?php ActiveForm::end(); ?>
    </div>
            