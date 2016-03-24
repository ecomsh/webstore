<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use mobile\widgets\Alert;
use mobile\assets\ftzmallmobilenew\AddressAsset;

/* @var $this yii\web\View */
$this->title = '收货地址';


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

<section class="ui-container">
	<?php
		if ($data & is_array($data))
		{
			foreach ($data as $k => $v):
	?>
		<div class="address-item-group">
			<div class="item-top clear">
				<span class="item-top-l"><?= Html::encode($v['receiverName']) ?></span>
				<?= Html::encode($v['receiverMobile']) ?>
				<?= $v['isDefault'] ? Html::a('默认地址', 'javascript:void(0);', ['class' => 'isDefault fr']) : Html::a('设为默认', ['address/default', 'id' => isset($v['addressId']) ? $v['addressId'] : 0], ['class' => 'fr']) ?>
			</div>
			<div class="item-bottom">
				<?= Html::encode($v['address']) ?>
				<p class="clear">
					邮编：<?= Html::encode($v['postcode']) ?>
					<span class="fr">
					<?= Html::a('编辑', ['address/update', 'id' => isset($v['addressId']) ? $v['addressId'] : 0], ['class' => 'edit-addr']) ?>　|　
					<?= Html::a('删除', ['address/delete', 'id' => isset($v['addressId']) ? $v['addressId'] : 0], ['class' => 'del']) ?></span>
				</p>
			</div>
		</div>

	<?php
			endforeach;
		}
	?>
	
        
	<div class="btn-div">
            <?= Html::a('添加收货地址', ['address/create'], ['class' => 'red-btn new-address']) ?>
            <input type="hidden" value="<?= count($data)?>" id="address-count">
	</div>
        
</section>
<script>
    var addr = {'stateCode': '<?= $model->stateCode ?>', 'cityCode': '<?= $model->cityCode; ?>', 'districtCode': '<?= $model->districtCode; ?>'};
</script>
