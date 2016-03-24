<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use mobile\widgets\Alert;
use mobile\assets\ftzmallmobilenew\AddressAsset;

/* @var $this yii\web\View */
$this->title = '添加地址_上海外高桥进口商品网';

$id = isset($editData['addraaaessId']) ? $editData['addraaaessId'] : ''; //时刻警惕参数是否有可能未定义或者缺失
//$model->isExists($editData['addraaaessId']);
$stateCode = isset($editData['stateCode']) ? $editData['stateCode'] : '0';
$cityCode = isset($editData['cityCode']) ? $editData['cityCode'] : '0';
$districtCode = isset($editData['districtCode']) ? $editData['districtCode'] : '0';
$request = Yii::$app->request; //另外一种获取get参数的示意
$action = $request->get('action');
/**
 * 1.active form 当中的field不能自己定义id，否则会失去客户端验证效果
 * 2.必要时，可以先把enableClientValidation=false 来调节关闭客户端验证后的效果
 * 3.tools_min.js和submit有冲突，添加了额外的disable事件阻止提交
 * 
 */
AddressAsset::register($this);
?>

        <div class="m-page" style="min-height: 605px;">
            <div class="full-screen">
                <div class="top-holder">
                    <div class="fixed-top">
                        <div class="m-header">
                            <div class="header-left-btn">
                                <span onclick="history.back()" class="icon-back"></span>
                            </div>
                            <h2>添加收货地址</h2>
                            <div class="header-right-btn">
                                <a href="<?= Url::to(['user/index'])?>" class="icon-home"></a>
                            </div>
                        </div>
                    </div>
                </div>
             
        
        
        
<header class="ui-header ui-header-positive ui-border-b">
		<div class="topbar-bigbox">
			<i class="ui-icon-return fl"></i>
			<div class="topbar-fontbox"><?= Html::encode($this->title);?></div>
			<i class="ui-icon-home fr font-32"></i>
		</div>
	</header> 
<section class="ui-container">
	<?php
		$options = [];
		if ($id)
			$options['options'] = ['id' => $id];
			$options['enableClientValidation'] = true;
			$options['fieldConfig'] = ['template' => "<li class='address-info'> <div class='item-name'>{label}</div> {input}{error} </li>",
			'labelOptions' => ['class' => 'address-label'], 
			'errorOptions' => ['style' => '']];
			$form = ActiveForm::begin($options);
		if ($model->isDefault) {
		$model->isDefault = 'true';
		}
	?>
	<div class="address-infos">		
		<?= $form->field($model, 'stateCode')->dropDownList(['' => '请输入省份'], [ 'class'=> 'province item-option add-static', 'data-level-index' => 0, ]) ?>
		<?= $form->field($model, 'cityCode')->dropDownList(['' => '请输入城市'], [ 'class'=> 'province item-option add-static', 'data-level-index' => 0, 'id'=>'addressapi-citycode']) ?>
		<?= $form->field($model, 'districtCode')->dropDownList(['' => '请输入区县'], [ 'class'=> 'province item-option add-static', 'data-level-index' => 0,]) ?>
   
		<div class="form-group field-addressapi-statename" style="display:none">
			<li class="address-info"> <div class="item-name"><label class="address-label" style="display:none" for="provice1"></label></div> <input type="hidden" id="provice1" class="form-control" name="AddressApi[stateName]" value="北京市"><p class="help-block help-block-error" style="display:none"></p> </li>
		</div>
		<div class="form-group field-addressapi-cityname"  style="display:none">
			<li class="address-info"> <div class="item-name" style="display:none"><label class="address-label" style="display:none" for="city1"></label></div> <input type="hidden" id="city1" class="form-control" name="AddressApi[cityName]"><p class="help-block help-block-error" style="display:none"></p> </li>
		</div>
			<div class="form-group field-addressapi-districtname"  style="display:none">
		<li class="address-info"> <div class="item-name"><label class="address-label" style="display:none" for="district1"></label></div> <input type="hidden" id="district1" class="form-control" name="AddressApi[districtName]"><p class="help-block help-block-error" style="display:none"></p> </li>
		</div>

		<?= $form->field($model, 'address')->textArea([ 'class' => 'text']) ?>
		<?= $form->field($model, 'postcode')->textInput(['class' =>'text', 'size' => 15]) ?>                               
		<?= $form->field($model, 'receiverName')->textInput([ 'class' => 'text', 'size' => 15]) ?>
		<?= $form->field($model, 'receiverMobile')->textInput(['class' => 'text', 'size' => 15]) ?>                                
		<?= $form->field($model, 'receiverPhone')->textInput(['class' => 'text', 'size' => 15]) ?>
     	<?= $form->field($model, 'isDefault')->checkbox(['label' => '设为默认地址', 'uncheck' => 'false', 'value' => 'true', 'template' => '<li class="checkbox-info"><div class="check-box">{input}</div>{label}</div>'])?>
         
	</div>
	<div class="btn-div">
		<?= Html::submitButton('保存地址', [ 'class' => 'new-address']); ?>

	</div>
	<?php ActiveForm::end(); ?> 
 <a href="<?= Url::to(['passport/mobilebind']) ?>" class="skip-text">跳过，暂时不填写</a> 
</section>
<script>
    var addr = {'stateCode': '<?= $model->stateCode ?>', 'cityCode': '<?= $model->cityCode; ?>', 'districtCode': '<?= $model->districtCode; ?>'};
</script>

   