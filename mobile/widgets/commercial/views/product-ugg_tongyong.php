<?php use yii\helpers\Url; ?>
<?php use common\helpers\Tools; ?>
<?php $items=$advertisement->getItems();?>
<!-- 商品 -->
<?php for ($i=0;$i<count($items);$i++): ?>
<?php
if (!empty($items[$i]->title)) {
	$title = explode(' ',$items[$i]->title);
	$des = $title[count($title)-1];
	unset($title[count($title)-1]);
	$title_str = implode(' ',$title);
}
?>
<div class="goods_pd">
    <a target="_blank" href="<?=$items[$i]->href?>">
        <div class="goods_img_b">
            <img class="goods_img" src="<?=Tools::qnImg($items[$i]->productImage, 202, 194)?>" />
        </div>
        <div class="miaoshu">
            <p class="biaoti"><?=$title_str?></p>
            <p class="chicun"><?=$des?></p>
            <p class="price">RMB:￥<span><?=$items[$i]->price?></span></p>
            <p class="buy">立即抢购</p>
        </div>
    </a>
</div>
<?php endfor; ?>