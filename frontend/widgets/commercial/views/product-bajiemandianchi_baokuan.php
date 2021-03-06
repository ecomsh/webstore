<?php use yii\helpers\Url; ?>
<?php use common\helpers\Tools; ?>
<?php $items = $advertisement->getItems(); ?>
<!-- 商品 -->
<?php for ($i = 0; $i < count($items); $i++): ?>
<div class="goods_pd">
    <a target="_blank" href="<?=$items[$i]->href ?>">
        <img class="chaozhi" src="http://7xoo3k.com2.z0.glb.qiniucdn.com/nian-shi-chaozhi.png">
        <img src="<?=Tools::qnImg($items[$i]->productImage, 250, 250)?>" />
        <div class="goods_text">
            <p class="goods_text_p"><?= $items[$i]->title ?></p>
            <p class="goods_text_p"><?=$items[$i]->description?></p>
            <p class="qianggou">抢购价:
                <span class="goods_price"><span>￥</span><?= $items[$i]->price ?></span>
            </p>
        </div>
    </a>
</div>
<?php endfor; ?>