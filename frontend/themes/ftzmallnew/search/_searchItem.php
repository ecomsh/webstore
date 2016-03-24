<?php
    use yii\helpers\Url;
    use common\helpers\Tools;
    use yii\helpers\Html;
?>

<li class="search-pro pull-left show-detail">
    <a href="<?= Url::to(['product/view','id' => $model['id']]); ?>" >
    <div class="search-pro-label clearfix">
        <?php if ($model['tag'] && is_array($model['tag']))
        {
            foreach ($model['tag'] as $k => $arr){
                if($arr['name'] == '新品' && isset($arr['display']) && $arr['display']):
        ?>
            <span class="pro-label new-label pull-left">新品</span>
        <?php elseif($arr['name'] == '包邮' && isset($arr['display']) && $arr['display']):?>
                <span class="pro-label baoyou-label pull-left">包邮</span>
        <?php endif;}}?> 
        <?php if($model['salesType']==1||$model['salesType']==2):?>
            <span class="trade-label pull-right type-g">一般贸易</span>
        <?php endif; ?>
    </div>
<div class="search-pro-img">    
    <img src="<?= Html::encode($model['desc']['fullImage']) ?>" class="search-pro-img">
    <?php if($model['salesType']!=1 && $model['salesType']!=2):?>
        <p class="search-img-p show-msg" style="display:none">海外直采 正品保证 海关监管</p>
    <?php endif; ?>    
</div>
    <div class="search-pro-text">
        <div class="search-text-p">            
            <?php 
                $hastitle = 0;
                if ($model['tag'] && is_array($model['tag'])):
                    foreach ($model['tag'] as $k => $arr):                        
                        if($arr['name'] == '直降' && isset($arr['display']) && $arr['display']):
            ?>
                        <p class="search-pro-name2"><?= Html::encode($model['desc']['name']) ?></p>
                        <p>
                            <span class="down-label">直降</span>
                            <?php if(isset($model['offerPriceInfo'][0]['price']) && isset($model['promotionPriceInfo'][0]['price']) && $model['promotionPriceInfo'][0]['price']!="" && $model['offerPriceInfo'][0]['price']!=""):?>
                                <span class="font-color1">￥<?= Html::encode($model['offerPriceInfo'][0]['price'] - $model['promotionPriceInfo'][0]['price']) ?></span>
                            <?php endif; ?>
                        </p>
                    <?php elseif ( $hastitle == 0):
                        $hastitle = 1; 
                    ?>
                        <p class="search-pro-name"><?= Html::encode($model['desc']['name']) ?></p>                        
                    <?php endif;
                        endforeach;
                ?>
            <?php else: ?>
                <p class="search-pro-name"><?= Html::encode($model['desc']['name']) ?></p>
            <?php endif; ?>            
        </div>
        <p class="price"><span class="search-price">
            <?php if (isset($model['promotionPriceInfo'][0]['price']) && $model['promotionPriceInfo'][0]['price']!="" ): ?>
                ￥<?= Html::encode($model['promotionPriceInfo'][0]['price']) ?>
            <?php else: ?>
                ￥<?= Html::encode(isset($model['offerPriceInfo'][0]['price'])?$model['offerPriceInfo'][0]['price']:0) ?>
            <?php endif;?>
        </span><span class="price-line font-color2">市场价：￥<?= Html::encode(isset($model['listPriceInfo'][0]['price'])?$model['listPriceInfo'][0]['price']:0) ?></span></p>
        <?php //if ($model['tag'] && is_array($model['tag'])):?>
        <!--<div class="product-tip show-msg" style="display:none">-->
            <?php 
//                foreach ($model['tag'] as $k => $arr){
//                    if($arr['type'] == 'SP' && $arr['display'] && isset($arr['display'])):
            ?>            
                <!--<span>
            <?php //echo Html::encode($arr['name']) ?>
                </span>-->
            <?php //endif;}?>           
        <!--</div>-->
        <?php //endif;?>
        <button class="addcar-btn show-msg" style="display:none"></button>
        <p class="shop"><a href="#">阿尼玛官方旗舰店进店看看》</a></p>
        <!--<span class="search-none"></span>-->
    </div>
    </a>
</li>
       