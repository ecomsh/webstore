<?php use common\helpers\Tools; ?>

<!-- 热门品牌广告位 -->
<p class="brand-title clearfix" id="hot-brand">热门品牌　|　<span class="brand-eng">HOT BRANDS</span> <span class="more">查看更多&gt;&gt;</span></p>
<ul class="clearfix hotbrand-div">
    <?php $items = $advertisement->getItems(); ?>
    <?php for($i=0; $i<count($items); $i++): ?>
        <li><a href="<?=$items[$i]->href?>" target="_blank"><img src="<?=Tools::qnImg($items[$i]->logoSrc, 99, 59)?>"></a></li>
    <?php endfor;?>
</ul>
<!-- 热门品牌广告位 end -->