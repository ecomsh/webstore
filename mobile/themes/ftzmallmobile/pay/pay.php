
<?php
use yii\helpers\Url;
use yii\helpers\Html;
use mobile\assets\PayAsset;
PayAsset::register($this);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<title>支付详情</title>
	<link rel="stylesheet" type="text/css" href="frozen.css">
	<style type="text/css">
		body{background:#f5f5f5;}
		.ui-header-positive{background:#3a393d;}
		.ui-avatar{background-image:none;margin:0px!important;}
		.ui-list-info{text-align: center;line-height: 1;margin-right: 65px;}
		.ui-header .ui-list{background:none;height:100%;}
		.ui-list-info{padding: 0px;}
		.ui-list-info h4{margin-top:-3px;margin-bottom: 3px;}
		.ui-list-info p{font-size: 10px;color:#ffffff;}
		.ui-center{height:100px;}
		.ui-row-flex .ui-col{width:100%;margin-top: 20px;font-weight: bold;}
		.money{margin-top: 0px!important;font-size: xx-large;}
		.ui-form-item{background:#ffffff;}
		.ui-btn-primary{background: #06be04;}
		.ui-btn-primary:not(.disabled):not(:disabled):active, .ui-btn-primary.active {
  			background: #06be04;
			color: rgba(255, 255, 255, 0.5);
		}
	</style>
    <script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);
                               // if()
			//	alert(res.err_code+res.err_desc+res.err_msg);
                       // alert('成功！<a href="1.php">返回</a>');
                        history.go(-1);
                                
			}
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
	//获取共享地址
	function editAddress()
	{
		WeixinJSBridge.invoke(
			'editAddress',
			<?php echo $editAddress; ?>,
			function(res){
				var value1 = res.proviceFirstStageName;
				var value2 = res.addressCitySecondStageName;
				var value3 = res.addressCountiesThirdStageName;
				var value4 = res.addressDetailInfo;
				var tel = res.telNumber;
				
				alert(value1 + value2 + value3 + value4 + ":" + tel);
			}
		);
	}
	
	window.onload = function(){
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', editAddress, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', editAddress); 
		        document.attachEvent('onWeixinJSBridgeReady', editAddress);
		    }
		}else{
			editAddress();
		}
	};
	
	</script>
</head>
<body ontouchstar>
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
			<div class="ui-col ui-col-2 money">￥ <?= number_format($payInfo/100,2) ?></div>
		</div>
		<div class="ui-form-item ui-form-item-show ui-border-tb">
			<label>收款方</label>
			<input style="text-align:right;" type="text" name="" value="上海外高桥进口商品网" readonly />
		</div>
		<div class="ui-btn-wrap">
			<button class="ui-btn-lg ui-btn-primary" onclick="callpay()">立即支付</button>
		</div>
	</section>
</body>
</html>