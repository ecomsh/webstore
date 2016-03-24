<?php use yii\helpers\Url; ?>
<?php use common\helpers\Tools; ?>
<?php $items = $advertisement->getItems(); ?>
<!-- 商品 -->
<?php for ($i = 0; $i < count($items); $i++): ?>
	<?php
    if (!empty($items[$i]->product)) {
        $brand = json_decode($items[$i]->product->brand, true);
        $country = explode('_', $brand['country']);
    }
    ?>
    <div class="goods_pd">
        <a target="_blank" href="<?=$items[$i]->href ?>">
            <img class="small_goods" src="http://7xoo3k.com2.z0.glb.qiniucdn.com/pc-static-flag-<?=$country[0]?>.png" width="81" onerror="this.style.display='none'">
            <div class="goods_img_b">
                <img class="goods_img" src="<?=Tools::qnImg($items[$i]->productImage, 371, 364)?>"/>
            </div>
            <div class="goods_text">
                <p class="goods_text_p"><?= $items[$i]->title ?></p>
                <span class="goods_price"><span>￥</span><?= $items[$i]->price ?></span>
                <del class="goods_line"><?= $items[$i]->listPrice ?></del>
                <button class="goods_see">去看看</button>
            </div>
        </a>
    </div>
<?php endfor; ?>