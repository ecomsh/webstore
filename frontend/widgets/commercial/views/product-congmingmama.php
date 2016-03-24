<?php use yii\helpers\Url; ?>
<?php use common\helpers\Tools; ?>
<?php $items = $advertisement->getItems();?>
<!-- 商品 -->
<?php for ($i = 0; $i < count($items); $i++): ?>
	<?php
    if (!empty($items[$i]->product)) {
        $brand = json_decode($items[$i]->product->brand, true);
		if($brand['brand_id']==$brand['brand_name'])
		{
			$brand['brand_name'] = '';
		}
    }
    ?>
    <div class="goods_pd"> 
        <a target="_blank" href="<?=$items[$i]->href?>"> 
            <img class="small_goods" src="http://7xoo3k.com2.z0.glb.qiniucdn.com/pc-static-flag-.png" width="45" onerror="this.style.display='none'" style="display:none;">
            <div class="goods_img_b"> 
                <img class="goods_img" src="<?=Tools::qnImg($items[$i]->productImage, 194, 172)?>" /> </div>
            <div class="goods_text">
                <p class="goods_text_p">
                    <span class="en-pro"><?=$brand['brand_id']?></span>
                    <span class="ch-pro"><?=$brand['brand_name']?></span>
                    <span class="pro-container"><?=$items[$i]->title?></span>
                 </p>
                <span class="goods_price"><em>活动价：</em><span>￥</span><?=$items[$i]->price?></span>
                <button class="goods_see">立即抢购</button>
            </div>
        </a>
    </div>
<?php endfor; ?>