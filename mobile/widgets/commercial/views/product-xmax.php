<?php

use common\helpers\Tools; ?>

<!-- 楼层推荐广告位 -->
<div class="hezi">
    <?php $items = $advertisement->getItems(); ?>
    <?php for ($i = 0; $i < count($items); $i++): ?>
        <div class="goods_pd">
            <a href="<?= $items[$i]->href ?>">
                <img class="small_goods" src="<?= Tools::qnImg($items[$i]->productImage, 163, 156) ?>">
                <div class="goods_img_b">
                    <img  class="goods_img" src="<?= Tools::qnImg($items[$i]->productImage, 163, 156) ?>" />
                </div>
                <div class="goods_text">
                    <p class="goods_text_p"><?= $items[$i]->title ?>
                    </p>
                    <span class="goods_price"><span>￥</span><?= number_format($items[$i]->price, 0) ?></span>
                    <del class="goods_line"><?= number_format($items[$i]->listPrice, 0) ?></del>
                    <button class="goods_see">去看看</button>
                </div>
            </a>
        </div>
    <?php endfor; ?>
</div>