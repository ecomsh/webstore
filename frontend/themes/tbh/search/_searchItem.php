<?php
    use yii\helpers\Url;
    use common\helpers\Tools;
    use yii\helpers\Html;
?>


    <!--商品展示模板-->
        <a href="<?= Url::to(['product/view','id' => $model['id']]); ?>">
            <div class="mask">
                <img class="goods-img" src="<?= Html::encode($model['desc']['fullImage']) ?>">
            </div>

            <div class="goods-txt">
                <p class="goods-label"><span>直降</span></p>
                <p class="goods-name"><?= Html::encode($model['desc']['name']) ?></p>
            </div>
            <div class="goods-price">
                <i class="fa fa-jpy"></i>
                
                
                <?php if (isset($model['promotionPriceInfo'][0]['price']) && $model['promotionPriceInfo'][0]['price']!="" ): ?>
                <span class="now-price">
                <?= Html::encode($model['promotionPriceInfo'][0]['price']) ?>
                </span>
               
                <span class="goods-dis">【
                <!-- 折扣 = 售价/原价 -->
                <?= number_format(((Html::encode($model['promotionPriceInfo'][0]['price'])) / (Html::encode(isset($model['listPriceInfo'][0]['price'])?$model['listPriceInfo'][0]['price']:1)))*100,0) ?>
                折】</span>

                <?php else: ?>
                <span class="now-price">
                <?= Html::encode(isset($model['offerPriceInfo'][0]['price'])?$model['offerPriceInfo'][0]['price']:0) ?>
                </span>
                <span class="goods-dis">【<!-- 折扣 = 售价/原价 -->
                <?= number_format(((Html::encode(isset($model['offerPriceInfo'][0]['price'])?$model['offerPriceInfo'][0]['price']:0)) / (Html::encode(isset($model['listPriceInfo'][0]['price'])?$model['listPriceInfo'][0]['price']:1)))*100,0) ?>
                折】</span>
                <?php endif;?>


                <span class="sales-num">销量：0件</span>
            </div>
            <div class="goods-action">
                <button class="add-cart">加入购物车</button>
                <span class="goods-collect"><i class="fa fa-heart-o"></i> 收藏</span>
            </div>
        </a>
    
       