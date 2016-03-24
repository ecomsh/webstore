<?php use yii\helpers\Url; ?>
<?php use common\helpers\Tools; ?>
<?php $items=$advertisement->getItems();?>
<!-- 商品 -->
<?php for($i=0;$i<count($items);$i++):?>
<?php
if (!empty($items[$i]->product)) {
	$brand = json_decode($items[$i]->product->brand, true);
}
?>
<div class="goods_pd">
    <a href="<?=$items[$i]->href?>">
        <img class="spceeshi" src="<?=Tools::qnImg($items[$i]->productImage, 132, 124)?>" />
        <div class="goods_text">
            <p class="goods_text_p"><?=$brand['brand_id']?></p>
            <p class="goods_text_b"><?=$items[$i]->title?></p>
            <p class="qianggou">
                <span class="goods_price">￥</span><?=$items[$i]->price?></span>
                <del>￥<?=$items[$i]->listPrice?></del>
            </p>
        </div>
        <button class="now-buy">立即购买></button>
    </a>
</div>
<?php endfor;?>