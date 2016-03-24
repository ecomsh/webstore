<?php use common\helpers\Tools; ?>

<!-- 楼层推荐广告位 -->

<ul class="clearfix newpro-list-ul">
    <?php $items = $advertisement->getItems(); ?>
    <?php for($i=0; $i<count($items); $i++): ?>
    <li class="newpro-list pull-left">
        <a href="<?=$items[$i]->href?>" target="_blank">
            <img src="<?=Tools::qnImg($items[$i]->productImage, 246, 256)?>" class="newpro-img">
            <div class="newpro-text">
                <div class="newpro-text-p">  
                    <p class="newpro-name"><?=$items[$i]->title?></p>
                    <p>
                        <?php if ($items[$i]->zhijiang > 0): ?>
                        <span class="down-label">直降</span>
                        <span class="font-color1">立省<?=$items[$i]->zhijiang?>元</span>
                        <?php endif; ?>
                    </p>
                </div>
                <span class="newpro-priceq">￥</span>
                <span class="newpro-price"><?=$items[$i]->price?> </span>
                <span class="price-line font-color2">￥<?=$items[$i]->listPrice?></span>
            </div>
        </a>
    </li>
    <?php endfor;?>  
</ul>
<!-- 楼层推荐广告位 end -->