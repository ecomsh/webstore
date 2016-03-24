<?php use yii\helpers\Url; ?>
<?php use common\helpers\Tools; ?>
<?php $items=$advertisement->getItems();?>
<!-- 商品 -->
<?php for ($i = 0; $i < count($items); $i++): ?>
<div class="goods_pd">
    <a target="_blank" href="<?=$items[$i]->href?>">
        <img class="shang" src="<?=Tools::qnImg($items[$i]->productImage, 195, 195)?>" />
        <div class="goods_text">
            <p class="twotext"><?=$items[$i]->title?></p>
            <span class="twogo"><span>￥</span><?=$items[$i]->price?></span>
            <del class="goods_line"><?=$items[$i]->listPrice?></del>
            <button class="goods_see">去看看</button>
        </div>
    </a>
</div>
<?php endfor; ?>