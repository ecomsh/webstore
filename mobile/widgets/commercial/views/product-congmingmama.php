<?php use yii\helpers\Url; ?>
<?php use common\helpers\Tools; ?>
<?php $items = $advertisement->getItems();?>
<!-- 商品 -->
<?php for ($i = 0; $i < count($items); $i++): ?>
<li class="newdeal_box">
	<a target="_blank" href="<?=$items[$i]->href?>">
		<img class="small_goods" src="http://7xoo3k.com2.z0.glb.qiniucdn.com/wap-static-flag-.png" width="40" onerror="this.style.display='none'" style="display:none;">
		<div class="goods_img_b">
			<img class="goods_img" src="<?=Tools::qnImg($items[$i]->productImage,144,147)?>" />
		</div>
		<div class="goods_text">
			<p class="goods_text_p"><?=$items[$i]->title?></p>
			<span class="goods_price"><span>￥</span><?=$items[$i]->price?></span>
			<del class="goods_line">￥<?=$items[$i]->listPrice?></del>
			<button class="goods_see">立即抢购</button>
		</div>
	</a>
</li>
<?php endfor; ?>