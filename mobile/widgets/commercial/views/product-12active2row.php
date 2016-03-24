<?php

use common\helpers\Tools; ?>

<!-- 楼层推荐广告位 -->
<ul class="ui-grid-halve">
<?php $items = $advertisement->getItems(); ?>
<?php for ($i = 0; $i < count($items); $i++): ?>
        <li class="pro-p">
            <label class="full-cut">满199减100</label>
            <span class="mask"></span>
            <a href="<?=$items[$i]->href?>">
            <div class="ui-grid-halve-img img-p">
                <span style="background-image:url(<?= Tools::qnImg($items[$i]->productImage, 163, 156) ?>)"></span>
            </div>
            </a>
            <div class="food-pri">
                <p>
                    <label><?= $items[$i]->title ?></label>
                    <i>狂欢价：￥<b><?= number_format($items[$i]->price, 0) ?></b></i>
                </p>
                <a class="join-c" href="<?=$items[$i]->href?>"><img src="http://img.ftzmall.com/wap_themes/default/images/mobile/img/shake/now-buy.png"></a>
            </div>
        </li>
<?php endfor; ?>
</ul>
<!-- 楼层推荐广告位 end -->