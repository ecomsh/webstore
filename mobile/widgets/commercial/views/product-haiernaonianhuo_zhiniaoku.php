<?php use yii\helpers\Url; ?>
<?php use common\helpers\Tools; ?>
<?php $items=$advertisement->getItems();?>
<!-- 商品 -->
<?php for ($i=0;$i<count($items);$i++): ?>
<div class="goods_pd">
    <a target="_blank" href="<?=$items[$i]->href?>">
        <img class="shang" src="<?=Tools::qnImg($items[$i]->productImage, 195, 195)?>" />
        <div class="goods_text">
            <p class="goods_text_p"><?=$items[$i]->title?></p>
            <p class="goods_text_p"><?=$items[$i]->description?></p>
            <p class="qianggou">抢购价:
                <span class="goods_price"><span>￥</span><?=$items[$i]->price?></span>
            </p>
        </div>
    </a>
</div>
<?php endfor; ?>