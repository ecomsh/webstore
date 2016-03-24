<?php
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\ftzmallnew\IndexAsset;
IndexAsset::register($this);
$this -> title = '首页';
?>
<!-- 轮播start，使用的是bootstrap自带的 -->
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		<li data-target="#carousel-example-generic" data-slide-to="1"></li>
		<li data-target="#carousel-example-generic" data-slide-to="2"></li>
	</ol>
	<div class="carousel-inner" role="listbox">
		<div class="item active">
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/banner.png', true)?>" alt="banner图">
		</div>
		<div class="item">
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/banner1.jpg', true)?>"alt="banner图1">
		</div>
		<div class="item">
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/banner2.jpg', true)?>" alt="banner图2">
		</div>
	</div>
	<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	</a>
	<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	</a>
</div>
<!-- 轮播end -->
<div class="container">
	<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/topinfo.png', true)?>" class="topinfo-img">
	<div class="new-product">
		<p class="new-title">新品推荐　|　New Product</p>
		<ul class="clearfix">
			<li class="new-product-top">
				<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/newproduct1.png', true)?>">
				<p class="new-product-name">Teazen江南桑拿 9克/蓝色</p>
				<p class="product-price">￥49</p>
				<p class="china-price">国内参考价￥73.5</p>
			</li>
			<li class="new-product-top">
				<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/newproduct1.png', true)?>">
				<p class="new-product-name">Teazen江南桑拿 9克/蓝色</p>
				<p class="product-price">￥49</p>
				<p class="china-price">国内参考价￥73.5</p>
			</li>
			<li class="new-product-top">
				<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/newproduct1.png', true)?>">
				<p class="new-product-name">Teazen江南桑拿 9克/蓝色</p>
				<p class="product-price">￥49</p>
				<p class="china-price">国内参考价￥73.5</p>
			</li>
			<li class="new-product-top">
				<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/newproduct1.png', true)?>">
				<p class="new-product-name">Teazen江南桑拿 9克/蓝色</p>
				<p class="product-price">￥49</p>
				<p class="china-price">国内参考价￥73.5</p>
			</li>
			<li class="new-product-top">
				<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/newproduct1.png', true)?>">
				<p class="new-product-name">Teazen江南桑拿 9克/蓝色</p>
				<p class="product-price">￥49</p>
				<p class="china-price">国内参考价￥73.5</p>
			</li>
		</ul>
		<ul class="row clearfix">
			<li class="newpro-performance pull-left">
				<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/newproduct2.png', true)?>" class="pull-left">
				<div class="performance-text pull-left">
					<h3>美妆个护专场</h3>
					<p>海关监管 安全无忧</p>
					<span class="newproduct-num">1.9</span>折起
				</div>
			</li>
			<li class="newpro-performance pull-left">
				<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/newproduct2.png', true)?>" class="pull-left">
				<div class="performance-text pull-left">
					<h3>美妆个护专场</h3>
					<p>海关监管 安全无忧</p>
					<span class="newproduct-num">1.9</span>折起
				</div>
			</li>
			<li class="newpro-performance pull-left">
				<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/newproduct2.png', true)?>" class="pull-left">
				<div class="performance-text pull-left">
					<h3>美妆个护专场</h3>
					<p>海关监管 安全无忧</p>
					<span class="newproduct-num">1.9</span>折起
				</div>
			</li>
			<li class=" newpro-performance pull-left">
				<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/newproduct2.png', true)?>" class="pull-left">
				<div class="performance-text pull-left">
					<h3>美妆个护专场</h3>
					<p>海关监管 安全无忧</p>
					<span class="newproduct-num">1.9</span>折起
				</div>
			</li>		
		</ul>
	</div>
	<p class="mustbuy-title" id="mustbuy">每日必Buy　|　<span class="eng">MUST CHECK OUT</span></p>
	<ul class="clearfix">
		<li class="buy-product">
			<div class="buypro-left pull-left">
				<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/baoshui.png', true)?>" class="baoshui-btn">
				<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/buyproduct.png', true)?>" class="buypro-img">
			</div>
			<div class="buypro-right pull-left">
				<span class="end-time">距特卖结束 08：18：18：12</span>
				<!-- 每日必bug商品名称点击后链接到广告内容指定的链接 -->
				<a href="" class="buypro-name">韩国It 's skin晶钻蜗牛乳液1号清爽型乳液140ml</a>
				<p class="buypro-text"><span class="font-color1">官方授权</span>提取蜗牛原液，给你护肤界的软黄金————Its skin晶钻蜗牛乳液1号（清爽型）！爽哭的修复能力，敏感肌、痘痘肌、脱皮肌任性用！一瓶能满足你对乳液的要求，清爽保湿美美哒！</p>
				<span class="buypro-price">￥119</span>
				<span class="buypro-chinaprice">原价<span class="price-line">￥279</span>　　国内参考价：￥279</span>
				<span class="baoyou-btn">包邮</span>　限时限量抢购
				<a href="" class="go">去看看</a>
			</div>
		</li>
		<li class="buy-product">
			<div class="buypro-left pull-left">
				<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/baoshui.png', true)?>" class="baoshui-btn">
				<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/buyproduct.png', true)?>" class="buypro-img">
			</div>
			<div class="buypro-right pull-left">
				<span class="end-time">距特卖结束 08：18：18：12</span>
				<a href="" class="buypro-name">韩国It 's skin晶钻蜗牛乳液1号清爽型乳液140ml</a>
				<p class="buypro-text"><span class="font-color1">官方授权</span>提取蜗牛原液，给你护肤界的软黄金————Its skin晶钻蜗牛乳液1号（清爽型）！爽哭的修复能力，敏感肌、痘痘肌、脱皮肌任性用！一瓶能满足你对乳液的要求，清爽保湿美美哒！</p>
				<span class="buypro-price">￥119</span>
				<span class="buypro-chinaprice">原价<span class="price-line">￥279</span>　　国内参考价：￥279</span>
				<span class="baoyou-btn">包邮</span>　限时限量抢购
				<a href="" class="go">去看看</a>
			</div>
		</li>
	</ul>

	<p class="mustbuy-title" id="global-selection">全球精选　|　<span class="eng">GLOBAL SELECTION</span></p>
	<ul class="row clearfix">
		<li class="global-product pull-left">
			<div class="pro-label">
				<span class="glo-label new-label">新品尝鲜</span><span class="glo-label baoyou-label">包邮商品</span>
			</div>
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/global.png', true)?>" class="globalpro-img">
			<p class="global-img-p">海外直采 正品保证 海关监管</p>
			<div class="global-text">
				<p class="global-text-p">
					<span class="global-discount">6.4折/</span>美国4.8折/【满169减69】 沃思莱斯只能微震美胸仪，罩杯D密码，“挺”起来，“乳”此美丽动人！
				</p>
				<span class="global-price">￥299 </span><span class="price-line font-color2">国内参考价：￥480</span>
				<button class="addcar-btn"></button>
			</div>
		</li>
		<li class="global-product pull-left">
			<div class="pro-label">
				<span class="glo-label emergency-label">库存告急</span>
			</div>
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/global.png', true)?>" class="globalpro-img">
			<p class="global-img-p">海外直采 正品保证 海关监管</p>
			<div class="global-text">
				<p class="global-text-p">
					<span class="global-discount">6.4折/</span>美国4.8折/【满169减69】 沃思莱斯只能微震美胸仪，罩杯D密码，“挺”起来，“乳”此美丽动人！
				</p>
				<span class="global-price">￥299 </span><span class="price-line font-color2">国内参考价：￥480</span>
				<button class="notice"></button>
				<span class="pro-none"></span>
			</div>
		</li>
		<li class="global-product pull-left">
			<div class="pro-label">
				<span class="glo-label clearance-label">特价清仓</span>
			</div>
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/global.png', true)?>" class="globalpro-img">
			<p class="global-img-p">海外直采 正品保证 海关监管</p>
			<div class="global-text">
				<p class="global-text-p">
					<span class="global-discount">6.4折/</span>美国4.8折/【满169减69】 沃思莱斯只能微震美胸仪，罩杯D密码，“挺”起来，“乳”此美丽动人！
				</p>
				<span class="global-price">￥299 </span><span class="price-line font-color2">国内参考价：￥480</span>
				<button class="addcar-btn"></button>
			</div>
		</li>
		<li class="global-product pull-left">
			<div class="pro-label">
				<span class="glo-label new-label">新品尝鲜</span><span class="glo-label baoyou-label">包邮商品</span>
			</div>
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/global.png', true)?>" class="globalpro-img">
			<p class="global-img-p">海外直采 正品保证 海关监管</p>
			<div class="global-text">
				<p class="global-text-p">
					<span class="global-discount">6.4折/</span>美国4.8折/【满169减69】 沃思莱斯只能微震美胸仪，罩杯D密码，“挺”起来，“乳”此美丽动人！
				</p>
				<span class="global-price">￥299 </span><span class="price-line font-color2">国内参考价：￥480</span>
				<button class="addcar-btn"></button>
			</div>
		</li>
		<li class="global-product pull-left">
			<div class="pro-label">
				<span class="glo-label new-label">新品尝鲜</span><span class="glo-label baoyou-label">包邮商品</span>
			</div>
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/global.png', true)?>" class="globalpro-img">
			<p class="global-img-p">海外直采 正品保证 海关监管</p>
			<div class="global-text">
				<p class="global-text-p">
					<span class="global-discount">6.4折/</span>美国4.8折/【满169减69】 沃思莱斯只能微震美胸仪，罩杯D密码，“挺”起来，“乳”此美丽动人！
				</p>
				<span class="global-price">￥299 </span><span class="price-line font-color2">国内参考价：￥480</span>
				<button class="addcar-btn"></button>
			</div>
		</li>
		<li class="global-product pull-left">
			<div class="pro-label">
				<span class="glo-label new-label">新品尝鲜</span><span class="glo-label baoyou-label">包邮商品</span>
			</div>
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/global.png', true)?>" class="globalpro-img">
			<p class="global-img-p">海外直采 正品保证 海关监管</p>
			<div class="global-text">
				<p class="global-text-p">
					<span class="global-discount">6.4折/</span>美国4.8折/【满169减69】 沃思莱斯只能微震美胸仪，罩杯D密码，“挺”起来，“乳”此美丽动人！
				</p>
				<span class="global-price">￥299 </span><span class="price-line font-color2">国内参考价：￥480</span>
				<button class="addcar-btn"></button>
			</div>
		</li>
	</ul>
	<p class="mustbuy-title" id="final-sale">最后疯抢　|　<span class="eng">ON FINAL SALE</span></p>
	<ul class="row clearfix">
		<li class="final-product pull-left">
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img">
			<p class="final-end">最后：08小时18分18秒</p>
			<p class="final-text pull-left">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
			<span class="final-price pull-right">￥28.99</span>
		</li>
		<li class="final-product pull-left">
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img">
			<p class="final-end">最后：08小时18分18秒</p>
			<p class="final-text pull-left">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
			<span class="final-price pull-right">￥28.99</span>
		</li>
		<li class="final-product pull-left">
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img">
			<p class="final-end">最后：08小时18分18秒</p>
			<p class="final-text pull-left">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
			<span class="final-price pull-right">￥28.99</span>
		</li>
		<li class="final-product pull-left">
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img">
			<p class="final-end">最后：08小时18分18秒</p>
			<p class="final-text pull-left">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
			<span class="final-price pull-right">￥28.99</span>
		</li>
		<li class="final-product pull-left">
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img">
			<p class="final-end">最后：08小时18分18秒</p>
			<p class="final-text pull-left">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
			<span class="final-price pull-right">￥28.99</span>
		</li>
		<li class="final-product pull-left">
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img">
			<p class="final-end">最后：08小时18分18秒</p>
			<p class="final-text pull-left">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
			<span class="final-price pull-right">￥28.99</span>
		</li>
		<li class="final-product pull-left">
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img">
			<p class="final-end">最后：08小时18分18秒</p>
			<p class="final-text pull-left">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
			<span class="final-price pull-right">￥28.99</span>
		</li>
		<li class="final-product pull-left">
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img">
			<p class="final-end">最后：08小时18分18秒</p>
			<p class="final-text pull-left">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
			<span class="final-price pull-right">￥28.99</span>
		</li>
	</ul>
	<p class="brand-title clearfix" id="brand-beal">品牌团　|　<span class="brand-eng">BRAND'S BEAL</span>
		<!-- <span class="more">查看更多>></span> -->
	</p>
	<ul class="clearfix">
		<li class="brand-product pull-left">
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/brandpro.png', true)?>" class="brandpro-img">
			<h3 class="brand-name">雅漾品牌团</h3>
			<p class="brand-text">十年敏肌 百年雅漾</p>
			<p class="brand-text1">满<span class="brand-price">199</span>减<span class="brand-price">50</span> 上不封顶</p>
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/brand-logo.png', true)?>" class="brandpro-logo">
		</li>
		<li class="brand-product pull-left">
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/brandpro.png', true)?>" class="brandpro-img">
			<h3 class="brand-name">雅漾品牌团</h3>
			<p class="brand-text">十年敏肌 百年雅漾</p>
			<p class="brand-text1">满<span class="brand-price">199</span>减<span class="brand-price">50</span> 上不封顶</p>
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/brand-logo.png', true)?>" class="brandpro-logo">
		</li>
		<li class="brand-product pull-left">
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/brandpro.png', true)?>" class="brandpro-img">
			<h3 class="brand-name">雅漾品牌团</h3>
			<p class="brand-text">十年敏肌 百年雅漾</p>
			<p class="brand-text1">满<span class="brand-price">199</span>减<span class="brand-price">50</span> 上不封顶</p>
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/brand-logo.png', true)?>" class="brandpro-logo">
		</li>
		<li class="brand-product pull-left">
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/brandpro.png', true)?>" class="brandpro-img">
			<h3 class="brand-name">雅漾品牌团</h3>
			<p class="brand-text">十年敏肌 百年雅漾</p>
			<p class="brand-text1">满<span class="brand-price">199</span>减<span class="brand-price">50</span> 上不封顶</p>
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/brand-logo.png', true)?>" class="brandpro-logo">
		</li>
		<li class="brand-product pull-left">
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/brandpro.png', true)?>" class="brandpro-img">
			<h3 class="brand-name">雅漾品牌团</h3>
			<p class="brand-text">十年敏肌 百年雅漾</p>
			<p class="brand-text1">满<span class="brand-price">199</span>减<span class="brand-price">50</span> 上不封顶</p>
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/brand-logo.png', true)?>" class="brandpro-logo">
		</li>
		<li class="brand-product pull-left">
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/brandpro.png', true)?>" class="brandpro-img">
			<h3 class="brand-name">雅漾品牌团</h3>
			<p class="brand-text">十年敏肌 百年雅漾</p>
			<p class="brand-text1">满<span class="brand-price">199</span>减<span class="brand-price">50</span> 上不封顶</p>
			<img src="<?=Url::to('@web/themes/ftzmallnew/src/images/brand-logo.png', true)?>" class="brandpro-logo">
		</li>
	</ul>
	<p class="brand-title clearfix">热门品牌　|　<span class="brand-eng">HOT BRANDS</span> <span class="more">查看更多>></span></p>
	<ul class="clearfix hotbrand-div">
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<li><a href="" target="_blank"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/hotbrand.png', true)?>"></a></li>
		<!-- 因不知道这里品牌是否是可点击的，所以先放一张图 -->
	</ul>
</div>	
<?= $this->render('_left') ?>
