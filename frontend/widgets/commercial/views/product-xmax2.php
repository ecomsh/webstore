<?php $items = $advertisement->getItems(); ?>
<!-- 商品 -->
<?php for ($i = 0; $i < count($items); $i++): ?>
    <div class="goods_pd">
        <a target="_blank" href="<?=$items[$i]->href?>">
            <div class="guding"><i class="er_biaoqian"></i></div>
            <div class="goods_img_b">
            <img  class="goods_img" src="<?=$items[$i]->productImage?>" />
            </div>
            <div class="goods_text">
                <p class="goods_text_p"><?=$items[$i]->title?></p>
                <span class="goods_price"><span>￥</span><?=$items[$i]->price?></span>
                <del class="goods_line"><?=$items[$i]->listPrice?></del>
                <button class="goods_see">去看看</button>
            </div>
        </a>
    </div>
<?php endfor; ?>