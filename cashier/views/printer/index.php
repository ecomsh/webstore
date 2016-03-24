
<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use frontend\widgets\LinkPager;
use cashier\assets\PrinterAsset;

PrinterAsset::register($this);
$this->title = "补打小票";
?>
<style type="text/css">
	.container-fluid{height: 80%;}
</style>
<div class="zheng indexzheng">
	<div class="main indexmain">
		<h4 class="text-primary indextitle">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			 请输入会员手机号查询7日内支付成功的订单！
		</h4>
	</div>
<script>
	var URL = {
		queryUser: '<?= Url::to(['printer/queryuser']) ?>',
		orderUrl: '<?= Url::to(['printer/order']) ?>'
	}
</script>