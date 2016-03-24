<?php
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use cashier\assets\PayAsset;
PayAsset::register($this);
$this->title = "系统收银";
$thisPay = Yii::$app->params['payMethod'][$payMethod];
$otherPayurl = 'cashier/' . $otherMethod;
$otherPay = Yii::$app->params['payMethod'][$otherMethod];
$scanMsg = "请打开" . $thisPay . "扫码支付";
$paidMsg = "该订单已支付!";
?>



<body>

<div  id="qrcode" style="text-algin:center; padding:200px 0;max-width: 500px;margin: auto;">
    <?php if(!$isPaied):?>
    <img style="display:block; height:264px; margin:5px auto;" src="<?= $qrcode?>">
    <?php endif;?>
    <h4 style="text-align:center;"><?= $isPaied?$paidMsg:$scanMsg ?></h4>
    <div class="row">
        <div class="col-xs-12">
            <a  href="<?=Url::to(['cashier/index']) ?>" class="btn btn-success" style="display:block;margin:5px auto;" >完成</a>
        </div>
        <?php if(!$isPaied):?>
        <div class="col-xs-12">
            <a  href="<?=Url::to([$otherPayurl]) ?>"  class="btn btn-default btn-block" id="alipay-btn" >使用<?= $otherPay?>支付</a>
        </div>
        <?php endif; ?>
        <div class="col-xs-12">
            <a  href="<?=Url::to(['cashier/index', 'Isnext' => true]) ?>" class="btn btn-success" style="display:block;margin:5px auto;" >下一个子订单</a>
        </div>
        <div class="col-xs-12">
            <button id="printReceipt" class="btn btn-primary" style="width:100%;display:block;margin:5px auto;" >补打小票</button>
        </div>
    </div>
</div>
</body>

<script>
<?php $this->beginBlock('js_end'); ?>
  var paymentUrl = "<?=Url::to(['cashier/paymentstatus']); ?>";
  var printorderUrl = "<?=Url::to(['printer/printorder']); ?>";
  var ispaied = "<?= $isPaied;?>";
<?php $this->endBlock() ?>
</script>

<?php $this->registerJs($this->blocks['js_end'], \yii\web\View::POS_END); ?>
