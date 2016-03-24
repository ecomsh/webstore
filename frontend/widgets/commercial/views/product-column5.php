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
	$discount = $items[$i]->price / $items[$i]->listPrice;
	$discount = number_format($discount, 2)*10;
    ?>
    <li class="recompro-list pull-left">
        <a href="<?=$items[$i]->href?>" target="_blank" style="text-decoration:none;">
            <img src="<?=Tools::qnImg($items[$i]->productImage, 197, 203)?>" class="newpro-img">
            <img src="http://7xoo3k.com2.z0.glb.qiniucdn.com/pc-static-flag-1222-<?=$country[0]?>.png" class="flag-img" onerror="this.style.display='none'">
            <div class="show-msg">海外直采 正品保证 海关监管<i></i></div>
            <div class="newpro-text">
                <div class="newpro-text-p">
                    <p class="newpro-name"><?=$items[$i]->title?></p>
                    <p class="newpro-tips"><?=$items[$i]->description?></p>
                    <p class="newpro-label">
                        <span><?=$discount?>折</span>
                        <!--<span>包邮</span>-->
                    </p>
                </div>
				<span style="padding: 0px;" class="newpro-priceq">￥</span>
				<span style="margin: -8px 0px 0px -8px;" class="newpro-price"><?=$items[$i]->price?> </span>
				<span style="margin-left: -5px;" class="price-line font-color2">￥<?=$items[$i]->listPrice?></span>
                <button class="goods_see">去看看</button>
            </div>
        </a>
    </li>
<?php endfor; ?>