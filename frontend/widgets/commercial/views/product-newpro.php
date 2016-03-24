<?php use common\helpers\Tools; ?>

<!-- 新品推荐广告位 -->
<div class="new-product">
    <p class="new-title">新品推荐　|　New Product</p>
    <ul class="clearfix">
        <?php $items = $advertisement->getItems(); ?>
        <?php for($i=0; $i<count($items); $i++): ?>
        <li class="new-product-top">
            <a href="<?=$items[$i]->href?>" target="_blank">
                <img src="<?=Tools::qnImg($items[$i]->productImage, 216, 216)?>">
                <p class="new-product-name"><?=$items[$i]->title?></p>
                
                <p class="product-price">￥<?=$items[$i]->price?></p>
                <p class="china-price">国内参考价￥<?=$items[$i]->listPrice?></p>
            </a>
        </li>
        <?php endfor;?>
    </ul>
</div>
<!-- 新品推荐广告位 end -->