<?php use common\helpers\Tools; ?>

<!-- 楼层推荐广告位 -->
<ul class="group-item clear">
    <?php $items = $advertisement->getItems(); ?>
    <?php for($i=0; $i<count($items); $i++): ?>
    <li class="product-item fl">
    	<a href="<?=$items[$i]->href?>" target="_blank">
	        <img src="<?=Tools::qnImg($items[$i]->productImage, 120, 120)?>" class="product-img">
	        <div class="product-name"><?=$items[$i]->title?></div>
	        <div class="product-price">￥<?=number_format($items[$i]->price,2)?></div>
	    </a>
    </li>
    <?php endfor;?>
</ul>
<!-- 楼层推荐广告位 end -->