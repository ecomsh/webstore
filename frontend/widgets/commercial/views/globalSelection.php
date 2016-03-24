<?php use common\helpers\Tools; ?>

<!-- 全球精选广告位 -->
<p class="globalproduct-title" id="global-selection">全球精选　|　<span class="eng">GLOBAL SELECTION</span></p>
<ul class="row clearfix">
    <?php $items = $advertisement->getItems(); ?>
    <?php for($i=0; $i<count($items); $i++): ?>
    <li class="global-product pull-left">
        <a href="<?=$items[$i]->href?>" target="_blank">
            <div class="pro-label">
                <?php if ($items[$i]->newPro == 1): ?>
                <span class="glo-label new-label">新品尝鲜</span>
                <?php endif; ?>
                <?php if ($items[$i]->baoyou == 1): ?>
                <span class="glo-label baoyou-label">包邮商品</span>
                <?php endif; ?>
                <?php if ($items[$i]->emergency == 1): ?>
                <span class="glo-label emergency-label">库存告急</span>
                <?php endif; ?>   
            </div>
            <img src="<?=Tools::qnImg($items[$i]->productImage, 316, 316)?>" class="globalpro-img">
            <p class="global-img-p">海外直采 正品保证 海关监管</p>
            <div class="global-text">
                <p class="global-text-p"><?=$items[$i]->description?></p>
                <span class="global-price">￥<?=$items[$i]->price?></span>
                <span class="price-line font-color2">￥<?=$items[$i]->listPrice?></span>  
                <?php if ($items[$i]->soldout == 1): ?>
                    <button class="notice"></button>
                <?php endif; ?>
                <?php if ($items[$i]->soldout == 1): ?>
                    <span class="pro-none"></span>
                <?php else: ?>
                    <button class="addcar-btn">去看看</button>
                <?php endif; ?>
            </div>
        </a>
    </li>
    <?php endfor;?>
</ul>
<script>
(function(){
    var load = function(){
        $(".globalproduct-item").hover(
            function(){
                $(this).children(".global-img-p").show();
            },
            function(){
                $(this).children(".global-img-p").hide();
            }
        );
    };

    if (window.attachEvent) { 
        window.attachEvent("onload", load); 
    } else if (window.addEventListener) { 
        window.addEventListener("load", load, false);   
    }
}());
</script>
<!-- 全球精选广告位 end -->