<?php
/**
 * order提交成功后，通过本页面将orderId传给payment页
 */
use yii\helpers\Html;
?>

<?= Html::beginForm(['order/payment'], 'post', ['enctype' => 'multipart/form-data', 'id' => 'orderFrom']) ?>
<?=Html::hiddenInput('orderIds',implode(',',$orderIds))?>
<?= Html::endForm()?>

<script>
jQuery("#orderFrom").submit();
</script>