<?php use yii\helpers\Url; ?>
<?php use common\helpers\Tools; ?>
<?php $items = $advertisement->getItems(); ?>
<!-- 商品 -->
<?php for ($i = 0; $i < count($items); $i++): ?>
<div class="otherg">
    <a target="_blank" href="<?=$items[$i]->href ?>">
        <div class="zhijiang">
            <img src="http://7xoo3k.com2.z0.glb.qiniucdn.com/mnian-shi-manjian.png">
        </div>
        <div class="goods_img_b">
            <img class="dazhe" src="<?=Tools::qnImg($items[$i]->productImage, 235, 235)?>" />
        </div>
        <div class="goods_text">
            <p class="twotext"><?=$items[$i]->title?></p>
            <span class="twogo"><span>￥</span><?=$items[$i]->price?></span>
            <del class="goods_line"><?=$items[$i]->listPrice?></del>
            <button class="goods_see">去看看</button>
        </div>
    </a>
</div>
<?php endfor; ?>