<?php use common\helpers\Tools; ?>
<?php $items = $advertisement->getItems();?>
<!-- 商品 -->
<?php for ($i = 0; $i < count($items); $i++): ?>
<div class="goods_pd">
    <a target="_blank" href="<?=$items[$i]->href?>">
        <img class="small_goods" src="http://7xoo3k.com2.z0.glb.qiniucdn.com/mnxuan-mn-two.png">
        <div class="goods_img_b">
            <img  class="goods_img" src="<?= Tools::qnImg($items[$i]->productImage, 162, 160) ?>" />
        </div>
        <div class="goods_text">
            <p class="goods_text_p"><?=$items[$i]->title?></p>
            <p class="text-left">
                <span class="goods_price"><span>￥</span><?=$items[$i]->price?></span>
                <del class="goods_line">￥<?=$items[$i]->listPrice?></del>
            </p>
            <button class="goods_see">去看看</button>
        </div>
    </a>
</div>
<?php endfor; ?>