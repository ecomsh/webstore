<?php use common\helpers\Tools; ?>

<!-- 品牌团广告位 -->
<p class="brand-title clearfix" id="brand-beal">品牌团　|　<span class="brand-eng">BRAND'S BEAL</span>
    <!-- <span class="more">查看更多>></span> -->
</p>
<ul class="clearfix">
<?php $items = $advertisement->getItems(); ?>
    <?php for($i=0; $i<count($items); $i++): ?>
    <li class="brand-product pull-left">
        <a href="<?=$items[$i]->href?>" target="_blank">
            <img src="<?=Tools::qnImg($items[$i]->imageUrl, 346, 185)?>" class="brandpro-img">
            <h3 class="brand-name"><?=$items[$i]->title?></h3>
            <p class="brand-text"><?=$items[$i]->description?></p>
            <p class="brand-text1"><?=$items[$i]->proText?></p>
            <img src="<?=Tools::qnImg($items[$i]->logoSrc, 99, 59)?>" class="brandpro-logo">
        </a>
    </li>
    <?php endfor;?>
</ul>
<!-- 品牌团广告位 end -->