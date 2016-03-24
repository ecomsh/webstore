
<?php
use yii\helpers\Url;
use yii\helpers\Html;
use mobile\assets\ftzmallmobilenew\WxpayAsset;
WxpayAsset::register($this);
?>
    <script type="text/javascript">
	//调用微信JS api 支付
        var jsApiParameters = <?php echo $jsApiParameters; ?>;
        var _editAddress = <?php echo $editAddress; ?>;
        var _return_url = "<?php echo $returnUrl; ?>";
    </script>
    <header class="ui-header ui-header-positive">
	<ul class="ui-list">
            <li>
                <span class="ui-avatar"></span>
                    <div class="ui-list-info">	
                        <p class="ui-nowrap">微信安全支付</p>
                    </div>
            </li>
        </ul>	
	</header>
	<section class="ui-container">
		<div class="ui-row-flex ui-flex-ver ui-center">
			<div class="ui-col ui-col">支付详情</div>
                        <div class="ui-message"><?= $msg ?>共<?= $totalNum ?>件商品</div>
			<div class="ui-col ui-col-2 money">￥ <?= number_format($payInfo/100,2) ?></div>
		</div>
		<div class="ui-form-item ui-form-item-show ui-border-tb">
			<label>收款方</label>
			<input style="text-align:right;" type="text" name="" value="上海外高桥进口商品网" readonly />
		</div>
		<div class="ui-btn-wrap">
			<button id ="go-to-pay" class="ui-btn-lg ui-btn-primary" onclick="callpay()">立即支付</button>
		</div>
                <div class="ui-btn-wrap">
                    <a class="ui-btn-lg ui-btn-primary" href="<?= Url::to(['/order/index']) ?>">取消</a>
		</div>
	</section>
