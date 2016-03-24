<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use mobile\widgets\Alert;
use mobile\assets\ftzmallmobilenew\RealnameAsset;
RealnameAsset::register($this);//为了将activeForm的js代码依赖于mainasset
//use mobile\widgets\Alert;
/* @var $this \yii\web\View */
/* @var $content string */
$this->title = '实名认证';
?>
<section class="ui-container">
	<div class="realname-text">
		提示信息： 因涉及国家监管部门规定，需要对购买人信息实名备案，本网站不会保留相关个人隐私信息，请放心填写。
	</div>
	<?php
		$options = [];
		$options['enableClientValidation'] = true;//
		$options['fieldConfig'] = ['template' => "<div class='li-info'><div class='item-name'>{label}</div>{input}{error}</div>"];
		$form = ActiveForm::begin($options);
	?> 
	<?=
        Alert::widget(['alertTypes' => [
            'realname_success' => 'alert-success',
            'realname_error' => 'alert-danger',
            'realname_danger' => 'alert-danger',
            'realname_info' => 'alert-info',
            'realname_warning' => 'alert-warning'],
            'closeButton' => false]);
    ?>
	<div class="address-infos">
		<input type="hidden" id="realnameapi-type" name="RealnameApi[type]" value="1">
		<?= $form->field($model, 'realName')->textInput(['placeholder' => '请输入收件人姓名']) ?>
		<?= $form->field($model, 'mobile')->textInput(['placeholder' => '请输入收件人手机号码']) ?>
		<?= $form->field($model, 'email')->textInput(['placeholder' => '请输入常用Email']) ?>
		<?= $form->field($model, 'identityType')->dropDownList(['1' => '身份证'], ['prompt' => '请选择', 'style' => 'width:7rem;height:2rem;']) ?>
		<?= $form->field($model, 'identityNumber',['enableAjaxValidation'=>true])->textInput(['placeholder' => '请输入正确的证件号码']) ?>  
        <input type="hidden" name="returnUrl" value="<?= yii::$app->request->get('returnUrl')?>" />
	</div>
	<div class="submit-div">
		<?= Html::submitButton('确定', ['class' => 'btn btn-sub']) ?>
	</div>
	<?php ActiveForm::end(); ?>
</section>
				
