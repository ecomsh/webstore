<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<?= Html::beginForm(['order/pay'], 'post', ['id' => 'payForm', 'enctype' => 'multipart/form-data', 'target' => '_blank', 'isSubmit' => 'T']) ?>
    <input type="hidden" class="check_id" id='orderId' name="orderId" value="3057181388657743209" >
    <input type="hidden" id="payMethod" name="payMethod" value="AliPay" >
    <input type="hidden" id='subject' name="subject" value="3057181388657743209" >
    <input type="hidden" name="itemSum" value=4 >
    <input type="hidden" name="return_url_pay" value="<?= Url::to(['order/index'], true) ?>" >
    <button type="submit" class="btn btn-pay"  data-toggle="modal" data-target="#myModal" >去支付</button>
<?= Html::endForm() ?>