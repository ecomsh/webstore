<?php
use yii\helpers\Url;
use common\helpers\Tools;
use yii\helpers\Html;
?>
<table>
    <?php /*if(isset($model['productskj'])&&!empty($model['productskj'])):?>
    <thead>
        <tr><th style="padding-top:10px;"><span style="font: 19px/30px &#39;Microsoft YaHei&#39;;background-color: #612316;color: #fff;padding-left: 15px; padding-right: 15px;">跨境商品</span></th>
        </tr>
    </thead>
    <?php endif; */?>
    <tbody>
        <tr>
            <td>
                <ul>
                    <?php foreach($model['productskj'] as $k => $arr):?>                                       
                    <li class="items-gallery  itemsList items-gallery-gride" product="<?= Html::encode($arr['id']) ?>">
                        <!--商品图片-->
                        <div class="goodpic" style=" width:216px;position:relative; margin:0 auto;height:216px;">
                            <!--标签图片-->
                            <!--商品图片-->
                            <a data-pjax="0" target=_blank  href="<?= Url::to(['/product/view','id'=>$arr['id']]);?>" style=" width:216px; display: table-cell; vertical-align: middle; text-align: center; margin:0 auto;*font-size:105px;height:216px;">
                                <img src="<?= Html::encode($arr['desc']['fullImage']) ?>" app="b2c" class="lazyload" alt="<?= Html::encode($arr['desc']['name']) ?>">          </a>
                        </div>
                        <div class="goods-main">
                            <div class="price-wrap">
                                <ul class="price-item">
                                    <li style="float:left;">
                                        <em class="sell-price">
                                            ￥<?= Html::encode(isset($arr['offerPriceInfo'][0]['price'])?$arr['offerPriceInfo'][0]['price']:0) ?></em>
                                    </li>
                                    <!--市场价
                                    <li style="float:right;color: #CBCBCB;">
                                        <del style="color: #CBCBCB;">
                                            ￥<?= Html::encode(isset($arr['offerPriceInfo'][0]['price'])?$arr['offerPriceInfo'][0]['price']:0) ?>             </del>
                                    </li>-->
                                </ul>
                            </div>
                            <div class="goodinfo" style="padding:5px 0 0;">
                                <ul>
                                    <li>
                                        <span class="tag-label" style="background-color:#336600;color:#fff; padding:3px;margin-right: -4px;">产地直销</span>
                                        <span class="tag-label" style="background-color:#ffbf00;color:#fff; padding: 3px 13px;">自贸</span>
                                    </li>
                                </ul>
                            </div>  
                            <div class="goodinfo" style="padding:5px 0 0;">
                                <h3>
                                    <a data-pjax="0" target=_blank href="<?= Url::to(['/product/view','id'=>$arr['id']]);?>" title="<?= Html::encode($arr['desc']['name']) ?>" class="entry-title"><?= Html::encode($arr['desc']['name']) ?></a>
                                </h3>
                            </div>

                        </div>
                        <div class="productShop" style="height:0px">

                        </div>
                        <!--<div class="productStatus">
                            <div class="sell_month">
                                <em><?= Html::encode($arr['salesVolumn']) ?></em>月销量                </div>
                            <div class="say_month">
                            </div>
                        </div>-->
                    </li>
                    <?php endforeach;?>      
                    <?php foreach($model['productsyb'] as $k => $arr):?>        
                    <li class="items-gallery  itemsList items-gallery-gride" product="<?= Html::encode($arr['id']) ?>">    <!--商品图片-->
                        <div class="goodpic" style=" width:216px;position:relative; margin:0 auto;height:216px;">
                            <!--标签图片-->
                            <!--商品图片-->
                            <a data-pjax="0" target=_blank href="<?= Url::to(['/product/view','id'=>$arr['id']]);?>" style=" width:216px; display: table-cell; vertical-align: middle; text-align: center; margin:0 auto;*font-size:105px;height:216px;">
                                <img src="<?= Html::encode($arr['desc']['fullImage']) ?>" app="b2c" class="lazyload" alt="<?= Html::encode($arr['desc']['name']) ?>">          </a>
                        </div>
                        <div class="goods-main">
                            <div class="price-wrap">
                                <ul class="price-item">
                                    <li style="float:left;">
                                        <em class="sell-price">
                                            ￥<?= Html::encode(isset($arr['offerPriceInfo'][0]['price'])?$arr['offerPriceInfo'][0]['price']:0) ?></em>
                                    </li>
                                    <!--市场价
                                    <li style="float:right;color: #CBCBCB;">
                                        <del style="color: #CBCBCB;">
                                            ￥<?= Html::encode(isset($arr['offerPriceInfo'][0]['price'])?$arr['offerPriceInfo'][0]['price']:0) ?>             </del>
                                    </li>-->
                                </ul>
                            </div>
                            <div class="goodinfo" style="padding:5px 0 0;">
                                <h3>
                                    <a data-pjax="0" target=_blank href="<?= Url::to(['/product/view','id'=>$arr['id']]);?>" title="<?= Html::encode($arr['desc']['name']) ?>" class="entry-title"><?= Html::encode($arr['desc']['name']) ?></a>
                                </h3>
                            </div>

                        </div>
                        <div class="productShop">
                            <!--<a class="productShop-name" target="_blank" href="<?= Yii::$app->params['baseUrl'] ?>shop-view-77.html">
                                进口商品直销中心            </a>-->
                        </div>
                        <!--<div class="productStatus">
                            <div class="sell_month">
                                <em><?= Html::encode($arr['salesVolumn']) ?></em>月销量</div>
                            <div class="say_month">
                            </div>
                        </div>-->
                    </li>         
                    <?php endforeach;?>
                </ul>
            </td>
        </tr>
    </tbody>
</table>
                    
<?php /*<table>
if(isset($model['productsyb'])&&!empty($model['productsyb'])):?>
    <thead>
        <tr><th style="padding-top:10px;"><span style="font: 19px/30px &#39;Microsoft YaHei&#39;;background-color: #612316;color: #fff;padding-left: 15px; padding-right: 15px;">一般贸易</span></th>
        </tr>
    </thead>
     <?php endif;
    <tbody>   
        <tr>
            <td>
                <ul>
                    
                </ul>
            </td>
        </tr>
    </tbody>
</table>*/?>

                                        