<!-- 全球精选广告位 -->
<?php use yii\helpers\Url; ?>
<p class="newpro-title">全球精选<span>GLOBAL SELECTION</span></p>
<ul class="clearfix recompro-list-ul">
    <?php $items = $advertisement->getItems(); ?>
    <?php for($i=0; $i<count($items); $i++): ?>
    <li class="recompro-list pull-left">
        <a href="<?=$items[$i]->href?>" target="_blank">
            <img src="<?=$items[$i]->productImage?>" class="newpro-img">
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
                <span class="newpro-price"><?=$items[$i]->price?> </span><span class="price-line font-color2">￥<?=$items[$i]->listPrice?></span>
            </div>
        </a>
    </li>
    <?php endfor;?>
</ul>
<!-- 全球精选广告位 end -->