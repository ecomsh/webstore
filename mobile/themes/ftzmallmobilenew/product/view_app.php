<?php
use yii\helpers\Url;
use yii\helpers\Html;
use mobile\assets\ftzmallmobilenew\ProductAsset;
ProductAsset::register($this);
//use mobile\widgets\Alert;
/* @var $this \yii\web\View */
/* @var $content string */
$this -> title = '上海外高桥进口商品网-'.$desc['name'];
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <meta name="description" content="">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="full-screen" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta name="format-detection" content="telephone=no"/>
        <meta name="format-detection" content="address=no"/>
        <?php $this->head() ?>
        <link href="/mobileapp/css/app.product.css" rel="stylesheet">
    </head>
    <body>
    	<?php $this->beginBody() ?>
        <header class="ui-header ui-header-positive ui-border-b">
            <div class="topbar-bigbox">
                <i class="ui-icon-return float-left" onclick="history.back()"></i>
                <div class="topbar-fontbox">
                    <marquee>
                        <?= Html::encode($desc['name']) ?>
                    </marquee>
                </div>
                <a class="ui-icon-home  float-r font-32" href="<?= Url::to(['site/index']); ?>"></a>
            </div>
        </header>
        <footer class="ui-footer ui-footer-btn">
            <ul class="ui-tiled ui-border-t">
                <li class="ui-border-r bg-black" style="width:35%"><a id="cart-price" href="<?= Url::to(['cart/app']); ?>"><img src="<?=Url::to('@web/mobileapp/images/not_selected.png', true)?>" height="50" style="margin-top:0.3em;height: 25px;"></a></li>
                <li class="bg-red ui-border-r" style="width:65%" id="addtocart_box_1"><a href="javascript:void(0);" class="buynow show-skumapbox">加入购物车</a></li>
                <li class="bg-red ui-border-r" style="width:80%;display:none;background-color:#ccc" id="xiajia"><a href="javascript:void(0);" class="buynow" style="color:#fff;font-size:1em;">已下架</a></li>
            </ul>
        </footer>

		<!-- 轮播 start-->
        <section class="ui-container">
            <section id="slider">
                <div class="demo-item">               
                    <div class="demo-block">
                        <div class="ui-slider">
                            <ul class="ui-slider-content" style="width: 600%; transition-property: transform; transition-timing-function: cubic-bezier(0.1, 0.57, 0.1, 1); transition-duration: 0ms; transform: translate(-1875px, 0px) translateZ(0px);" id="picscroll">
                                <li class=""><span style="background-image:url(<?= isset($desc['bigImage'])?Html::encode($desc['bigImage']):"" ?>)"></span></li>
                                <?php
                                    if ($goodspic && is_array($goodspic))
                                    {
                                        foreach ($goodspic as $k => $arr):
                                ?>
                                    <li><span style="background-image:url(<?= isset($arr['bigImage'])?Html::encode($arr['bigImage']):"" ?>)"></span></li>
                                <?php
                                        endforeach;
                                    }
                                ?>
                            </ul>
                            <ul class="ui-slider-indicators">
                            	<?php
                                    if ($goodspic && is_array($goodspic))
                                    {
										
                                        foreach ($goodspic as $k => $arr):
                                ?>
                            	<li class="<?php if(count($goodspic)==$k+1){echo 'current';}?>"><?=$k+1?></li>
                                <?php
                                        endforeach;
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!--轮播 end--> 
            
            <!-- 页面中部-商品价格-编号信息panel区域start-->
            <section id="layout">                
                <div class="demo-item">                    
                    <div class="demo-block"> 
                        <div class="product-detail-box">
                            <p style="color:#999;margin-top:0.5em">
                            	<?php if(isset($brand["countryname"]) && $brand["countryname"]!=""): ?>
                                <span id="country"><?= Html::encode($brand['countryname']) ?></span><span>&nbsp;|&nbsp;</span>
                            	<?php endif;?>
                                <span id="brand-name" class="brand-g"><?= Html::encode($data['brand']['name']) ?></span>
                            </p>
                            <p class="product-title-g"><?= Html::encode($desc['name']) ?></p>
                            <p style="color:#999;" class="shortdescription-g"><?= Html::encode($desc['shortDescription']) ?></p>
                            <p><span id="offer-price" class="goodsprice">
                            <?php
                                if ($offerprice && is_array($offerprice) && $offerprice[0])
                                {
                                    foreach ($offerprice as $k => $arr):
                                        if ($arr['currency'] == '' || $arr['currency'] == 'CNY')
                                            if ($arr['minPrice'] && $arr['maxPrice'] && $arr['minPrice'] != $arr['maxPrice']):
                            ?>
                            ¥<?= Html::encode($arr['minPrice']) ?> - <?= Html::encode($arr['maxPrice']) ?>
                            <?php elseif ($arr['price']): ?>
                                <?= Html::encode($arr['price']) ?>                                      
                            <?php   
                                endif;
                                    endforeach;}
                            ?></span>
                            <span class="font-del offerprice-g" id="jiangjia-yuanjia" style="display:none"></span><!--为了直降效果，显示offerprice，有直降价格才显示-->
                            <span class="font-del">&nbsp;&nbsp;国内参考价<span><span id="list-price" class="listprice-g">&nbsp;¥
                            <?php
                                if ($listprice && is_array($listprice) && $listprice[0])
                                {
                                    foreach ($listprice as $k => $arr):
                                        if ($arr['currency'] == '' || $arr['currency'] == 'CNY')
                                            if ($arr['minPrice'] && $arr['maxPrice'] && $arr['minPrice'] != $arr['maxPrice']):
                            ?>
                            <?= Html::encode($arr['minPrice']) ?> - <?= Html::encode($arr['maxPrice']) ?>
                            <?php elseif ($arr['price']): ?>
                                <?= Html::encode($arr['price']) ?>
                            <?php   
                                endif;
                                    endforeach;}
                            ?>
                            </span></p>
                            <p <?php if($data['salesType']==1||$data['salesType']==2):?>style="display:none"<?php endif;?> style="font-size:0.75em;">
                                <?php if($data['type']=="package"):?>
                                    <span class="tax-free">组合</span><span>税费加入购物车后可见</span>
                                <?php else:?>
                                    <span class="tax-free">免</span><span>进口税</span><span  class="tax">￥</span><span>元/件， 进口税小于等于50元免征</span>                                            
                                <?php endif;?>                           
                            </p>                                                            
                        </div>                    
                        <?php if( isset($tag['PR']) && is_array($tag['PR'])):?> 
                            <div class="product-detail-box">                        
                            <?php
                                foreach ($tag['PR'] as $k => $arr) {
                                    if($arr['name'] == "直降"):?>
                                        <p><span id="zhijiang">直降</span>
                                        <?php if(isset($data['offerPriceInfo'][0]['price']) && isset($data['promotionPriceInfo'][0]['price']) && $data['promotionPriceInfo'][0]['price']!="" && $data['offerPriceInfo'][0]['price']!=""):?>
                                            直降<span class="font-red">￥<?= Html::encode($data['offerPriceInfo'][0]['price'] - $data['promotionPriceInfo'][0]['price']) ?></span>块钱</p>
                                        <?php else:?>
                                            该商品正在打折，买到就是赚到
                                        <?php endif; ?>
                                    <?php elseif ($arr['name'] == "包邮"): ?>
                                        <p><span id="baoyou">包邮</span>上海保税仓 至 全国 免邮费</p>
                                    <?php elseif ($arr['name'] == "满减"): ?>
                                        <p><span id="zhijiang">满减</span>该商品正在打折，买到就是赚到</p>
                                    <?php endif; 
                                }?>
                            </div>
                        <?php endif; ?>
                        <?php if( isset($tag['NM']) && is_array($tag['NM'])):?><!-- 因原来说好只有PR标签为活动标签的，后来加了NM，所以代码略丑-->
                            <div class="product-detail-box">                        
                            <?php
                                foreach ($tag['NM'] as $k => $arr) :?>
                                    <p><span id="zhijiang">N元任选</span><?= Html::encode($arr['name']) ?></p>                                       
                             <?php  endforeach;?>
                            </div>
                        <?php endif; ?>
                        <div class="sku-box">
                            <div class="font-red">选择商品规格数量<a class="show-skumapbox" id="show-skumapbox">﹀</a></div>                           
                        </div>
                    </div>
                </div>               
            </section>

            <section id="tab">
                <div class="demo-item">                   
                    <div class="demo-block">
                        <div class="ui-tab">
                            <ul class="ui-tab-nav ui-border-b" style="width:94%;margin:0 auto">
                                <li class="current">商品详情</li>                               
                                <li>购物须知</li>
                            </ul>
                            <ul class="ui-tab-content" style="width:200%">
                                <li>
                                    <h2 style="margin:0 auto;padding-top:2em;font-size:1em; text-align:center;border-bottom:1px solid #000;width:94%; padding-bottom:0.75em"><i class="icon-tag font-24 font-red"></i>&nbsp;&nbsp;商品参数&nbsp;&nbsp;</h2>
                                    <div style="margin-left:3%;width:94%;padding-top:1em;display:inline-block">
                                            <p><span style="float: left;width: 28%;display: block; color:#ed145b">商品名称</span><span style="float: left;width: 70%;display: block; color:#999"><?= Html::encode($desc['name']) ?></span></p>
                                        <?php if ($brand && is_array($brand)):?>   
                                            <p><span style="float: left;width: 28%;display: block; color:#ed145b">品牌</span><span style="float: left;width: 70%;display: block; color:#999"><?= Html::encode($brand['name']) ?></span></p>
                                        <?php endif; ?>
                                        <?php if($descriptive && is_array($descriptive)){
                                            foreach ($descriptive as $k => $arr): ?>      
                                            <p><span style="float: left;width: 28%;display: block; color:#ed145b"><?= Html::encode($arr['name']) ?></span><span style="float: left;width: 70%;display: block; color:#999"><?= Html::encode($arr['value']) ?></span></p>
                                       <?php endforeach;}?>
                                    </div>
                                    <h2 style="margin:0 auto;padding-top:2em;font-size:1em; text-align:center;border-bottom:1px solid #000; width:94%; padding-bottom:0.75em"><i class="icon-tag font-24 font-red"></i>&nbsp;&nbsp;商品信息&nbsp;&nbsp;</h2>
                                    <div style="line-height:0;width:94%;margin-left:3%;padding-top:1em;display:inline-block">
                                        <?php echo($desc['longDescription']); ?>
                                    </div>
                                </li>
                                <li>                               
                                    <div style="line-height:0;width:94%;margin:0 auto;padding-top:1em;text-align:center">
                                        <div class="img-box"><img data-restrictwidth="320" data-img="<?=Url::to('@web/themes/wxnew/images/gmxz/gmxz1.jpg', true)?>"></div>
                                        <div class="img-box"><img data-restrictwidth="320" data-img="<?=Url::to('@web/themes/wxnew/images/gmxz/gmxz2.jpg', true)?>"></div>
                                        <div class="img-box"><img data-restrictwidth="320" data-img="<?=Url::to('@web/themes/wxnew/images/gmxz/gmxz3.jpg', true)?>"></div>
                                        <div class="img-box"><img data-restrictwidth="320" data-img="<?=Url::to('@web/themes/wxnew/images/gmxz/gmxz4.jpg', true)?>"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>                    
                </div>
            </section>

            <!-- 页面中部-同品牌商品推荐-居中版图片链接panel区域start-->
            <?php if ($brandRecommend && is_array($brandRecommend)):?> 
            <section class="ui-panel">
                <div class="center-black">
                    <i class="icon-tags"></i>
                    &nbsp;&nbsp;同品牌商品推荐
                </div>
                <div class="text-center position-r">
                    <i class="icon-caret-down"></i>
                </div>
                <ul class="ui-grid-halve-nopadding">
                    <?php foreach($brandRecommend as $k => $arr):?>
                    <li>
                        <a href="<?= Url::to(['product/view','id' => $arr['id']]); ?>">
                            <div class="ui-border">
                                <div class="ui-grid-halve-img"><img src="<?= Html::encode($arr['fullImage']) ?>"></div>
                                <div class="product-np">
                                    <a class="ui-nowrap-multi" href="<?= Url::to(['product/view','id' => $arr['id']]); ?>"><?= Html::encode($arr['desc']['name']) ?></a>
                                    <p class="ui-nowrap">
                                        <span class="price-offer">¥<?= Html::encode(isset($arr['offerPriceInfo'][0]['price'])?$arr['offerPriceInfo'][0]['price']:0);?></span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <?php endforeach;?>
                </ul>
            </section>
            <?php endif;?>
            <!-- 页面中部-同品牌商品推荐-居中版图片链接panel区域end-->
            
            <section id="dialog">
                <div class="demo-item">
                    <div class="demo-block">
                        <div class="ui-dialog box-align-end">
                            <div class="ui-dialog-cnt">
                                <div class="ui-dialog-hd ui-border-b">
                                    <div class="skumap-topbox"><span class="font-red goodsprice">
                                        <?php
                                            if ($offerprice && is_array($offerprice) && $offerprice[0])
                                            {
                                                foreach ($offerprice as $k => $arr):
                                                    if ($arr['currency'] == '' || $arr['currency'] == 'CNY')
                                                        if ($arr['minPrice'] && $arr['maxPrice'] && $arr['minPrice'] != $arr['maxPrice']):
                                        ?>
                                        ¥<?= Html::encode($arr['minPrice']) ?> - <?= Html::encode($arr['maxPrice']) ?>
                                        <?php elseif ($arr['price']): ?>
                                            ¥<?= Html::encode($arr['price']) ?>                                      
                                        <?php   
                                            endif;
                                                endforeach;}
                                        ?>
                                    </span>
                                    <?php if($data['minBuyCount'] && $data['minBuyCount'] > 1): ?>
                                        <span class="minbuy-g">(</span><span class="font-red minbuy-g" id="minbuy"><?= Html::encode($data['minBuyCount']) ?>件起售</span><span class="minbuy-g">)</span>
                                    <?php else: ?>
                                        <span class="minbuy-g" style="display:none">(</span><span class="font-red minbuy-g" id="minbuy" style="display:none"><?= Html::encode($data['minBuyCount']) ?>件起售</span><span class="minbuy-g" style="display:none">)</span>
                                    <?php endif; ?>
                                    <?php if($data['maxBuyCount'] && $data['maxBuyCount'] > 0): ?>
                                        <span class="maxbuy-g" >(</span><span class="font-red maxbuy-g" id="maxbuy">限购<?= Html::encode($data['maxBuyCount']) ?>件</span><span class="maxbuy-g" >)</span>
                                    <?php else: ?>
                                        <span style="display:none" class="maxbuy-g" >(</span><span class="font-red maxbuy-g" id="maxbuy" style="display:none">限购<?= Html::encode($data['maxBuyCount']) ?>件</span><span class="maxbuy-g" style="display:none">)</span>
                                    <?php endif; ?>                
                                        <span class="kcjz" style="display:none">(</span><span class="font-red kcjz" style="display:none">库存紧张</span><span class="kcjz" style="display:none">)</span>
                                    </div>
                                    <i class="ui-dialog-close" data-role="button"></i>
                                </div>
                                <div class="skumap-bigbox">
                                <?php
                                    if ($defining && is_array($defining))
                                    {
                                        foreach ($defining as $k => $arr):
                                            ?>
                                            <div class="skumap-smallbox">
                                                <span class="sku-name"><?= Html::encode($arr['name']) ?>：</span>
                                                <?php
                                                if ($arr['possibleValues'] && is_array($arr['possibleValues'])):
                                                {                                                                    
                                                    if ($arr['assignedValue'] == null) //后台没有传默认值的情况下，现在默认选中第一个
                                                    {
                                                        foreach ($arr['possibleValues'] as $k => $possiblearr)
                                                        {
                                                            if ($k == 0):
                                                                ?>                                                                                                        
                                                                    <a href="javascript:void(0);" id="<?= Html::encode($possiblearr['key']) ?>" class="<?= Html::encode($arr['key']) ?> active"> 
                                                                <?php if ($possiblearr['image'] != NULL) : ?>
                                                                    <img src="<?= Html::encode($possiblearr['image']) ?>" style="margin-right:0px; margin-top:0px;" alt="<?= Html::encode($possiblearr['displayValue']) ?>" title="<?= Html::encode($possiblearr['displayValue']) ?>" width="30" height="30">  
                                                                <?php else : ?> 
                                                                    <?= Html::encode($possiblearr['displayValue']) ?>
                                                                <?php
                                                                    endif;
                                                                ?>                                                          
                                                                    </a>
                                                                    <input type="hidden" name="<?= Html::encode($arr['key']) ?>" value="<?= Html::encode($possiblearr['key']) ?>" id="defining"><!--value为$arr['assignedValue']现在没有-->
                                                                <?php else: ?>                                                                                                
                                                                    <a href="javascript:void(0);" id="<?= Html::encode($possiblearr['key']) ?>" class="<?= Html::encode($arr['key']) ?>"> 
                                                                <?php if ($possiblearr['image'] != NULL) : ?>
                                                                    <img src="<?= Html::encode($possiblearr['image']) ?>" style="margin-right:0px; margin-top:0px;" alt="<?= Html::encode($possiblearr['displayValue']) ?>" title="<?= Html::encode($possiblearr['displayValue']) ?>" width="30" height="30">  
                                                                <?php else : ?> 
                                                                    <?= Html::encode($possiblearr['displayValue']) ?>
                                                                <?php
                                                                endif;
                                                                ?>                                                          
                                                                    </a>
                                                            <?php
                                                            endif;
                                                        }
                                                    }

                                                    else
                                                    {
                                                        foreach ($arr['possibleValues'] as $k => $possiblearr)
                                                        {                                                                          
                                                            if ($arr['assignedValue']['key'] == $possiblearr['key']):
                                                                ?>                                                        
                                                                    <a href="javascript:void(0);" id="<?= Html::encode($possiblearr['key']) ?>" class="<?= Html::encode($arr['key']) ?> active"> 
                                                                <?php if ($possiblearr['image'] != NULL) : ?>
                                                                    <img src="<?= Html::encode($possiblearr['image']) ?>" style="margin-right:0px; margin-top:0px;" alt="<?= Html::encode($possiblearr['displayValue']) ?>" title="<?= Html::encode($possiblearr['displayValue']) ?>" width="30" height="30">  
                                                                <?php else : ?> 
                                                                    <?= Html::encode($possiblearr['displayValue']) ?>     
                                                                <?php
                                                                endif;
                                                                ?>                                                          
                                                                    </a>
                                                                    <input type="hidden" name="<?= Html::encode($arr['key']) ?>" value="<?= Html::encode($possiblearr['key']) ?>" id="defining"><!--value为$arr['assignedValue']现在没有-->
                                                                <?php else: ?>                                      
                                                                    <a href="javascript:void(0);" id="<?= Html::encode($possiblearr['key']) ?>" class="<?= Html::encode($arr['key']) ?>"> 
                                                                <?php if ($possiblearr['image'] != NULL) : ?>
                                                                    <img src="<?= Html::encode($possiblearr['image']) ?>" style="margin-right:0px; margin-top:0px;" alt="<?= Html::encode($possiblearr['displayValue']) ?>" title="<?= Html::encode($possiblearr['displayValue']) ?>" width="30" height="30">  
                                                                <?php else : ?> 
                                                                    <?= Html::encode($possiblearr['displayValue']) ?>
                                                                <?php
                                                                endif;
                                                                ?>                                                          
                                                                    </a>
                                                            <?php
                                                            endif;
                                                        }
                                                    }
                                                }?>

                                                <?php elseif ($arr['assignedValue'] && is_array($arr['assignedValue']) && !$isProductSku):?>                  
                                                    <a href="javascript:void(0);" id="<?= Html::encode($arr['assignedValue']['key']) ?>" class="<?= Html::encode($arr['assignedValue']['key']) ?> active"> 
                                                    <?php if ($arr['assignedValue']['image'] != NULL) : ?>
                                                        <img src="<?= Html::encode($arr['assignedValue']['image']) ?>" style="margin-right:0px; margin-top:0px;" alt="<?= Html::encode($arr['assignedValue']['displayValue']) ?>" title="<?= Html::encode($arr['assignedValue']['displayValue']) ?>" width="30" height="30">  
                                                    <?php else : ?> 
                                                        <?= Html::encode($arr['assignedValue']['displayValue']) ?>     
                                                    <?php
                                                    endif;
                                                    ?>
                                                    </a>                           
                                                <?php endif;?>

                                            </div>
                                    <?php
                                        endforeach;
                                        }
                                    ?>
                                </div>
                                <div class="ui-form-item ui-border-t">
                                    <div class="buynum">购买数量
                                        <div class="Numinput" id="goods-viewer">
                                            <a class="substract" href="javascript:void(0);"><img src="<?=Url::to('@web/themes/wxnew/images/substract.png', true)?>"></a>
                                            <a class="plus" href="javascript:void(0);"><img src="<?=Url::to('@web/themes/wxnew/images/plus.png', true)?>"></a>
                                            <input type="text" value="1" size="5" name="goodsnum" class="Num" id="Num">
                                        </div>
                                    </div>                                   
                                </div>
                                
                                <div class="ui-form-item ui-border-t"  <?php if($data['salesType']!=1 && $data['salesType']!=2):?>style="display:none;"<?php endif;?>>
                                    <div class="buynum">
                                        <span style="display:block;float:left">配&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;送</span>
                                        <div id="address-sh" style="float:left;margin-left:2em">
                                            <span class="font-12">上海市至</span>
                                            <select id="addressapi-statecode"></select>
                                            <select id="addressapi-citycode" style="display:none">
                                                <option>请输入城市</option>
                                            </select>
                                            <select id="addressapi-districtcode" style="display:none">
                                                <option>请输入区县</option>
                                            </select>
                                        </div>               
                                    </div>                                   
                                </div>
                                <div class="ui-form-item ui-border-t">
                                    <div class="tax-box">
                                        <?php if($data['type']=="package"):?>
                                            <span class="tax-free" style="line-height:2.3em;margin-top:.5em;border-radius: 0.325em;">组合</span><span>税费加入购物车后可见</span>
                                        <?php else:?> 
                                            <span class="tax-free" style="line-height:2.3em;margin-top:.5em;border-radius: 0.325em;">免</span><span>进口税</span><span class="tax" style="text-decoration: line-through;">￥49.50</span><span>元/件， 进口税小于等于50元免征</span>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <input type="hidden" name="skuMapValue" value="" id="skuMapValue">
                                <input type="hidden" name="skuMapId" value="" id="skuMapId">
                                <input type="hidden" name="skuMapContent" value="" id="skuMapContent">  
                                <input type="hidden" name="code" id="stateCode" value="<?= Html::encode(isset($stateCode) ? $stateCode : "310000") ?>"/>
                                <div id="inventory" style="display:none">0</div>
                                <input type="hidden" name="offergoodsprice" id="offergoodsprice" value="<?= Html::encode(isset($offerprice[0]['price'])?$offerprice[0]['price']:0);?> ">
                                <input type="hidden" name="listgoodsprice" id="listgoodsprice" value="<?= Html::encode(isset($listprice[0]['price'])?$listprice[0]['price']:0); ?> ">
                                <ul class="ui-tiled ui-border-t skumap-bottom">
                                	<li class="ui-border-r bg-black" style="width:35%"><a id="cart-price" href="<?= Url::to(['cart/app']); ?>"><img src="<?=Url::to('@web/mobileapp/images/not_selected.png', true)?>" height="50" style="margin-top:0.3em;height: 25px;" class=""></a></li>
                                    <li class="ui-border-r bg-red" style="width: 65%; display: none;" id="addtocart_box"><a id="addtocart_app" style="color:#fff;font-size:1em;;line-height:45px">加入购物车</a></li>
                                    <li class="ui-border-r bg-red" style="width: 65%; display: block;" id="buynow_box"><a id="buynow_app">立即购买</a></li>
                                    <!--<li class="ui-border-r bg-red" style="width: 65%; display: none;" id="addunabled_box"><a id="addunabled" style="color:#fff;font-size:1em;;line-height:45px">加入购物车</a></li>-->
                                    
                                    <li class="ui-border-r bg-red" style="width:65%;background-color:#ccc" id="addunabled_box"><a id="addunabled" style="color:#fff;font-size:1em;;line-height:45px">加入购物车</a></li>
                                    
                                    <li class="ui-border-r" style="width:65%;display:none;background-color:#ccc" id="adding_box"><a id="adding" style="color:#fff;font-size：1em;line-height:45px">正在加入购物车</a></li>
                                    <li class="ui-border-r" style="width:80%;display:none;background-color:#ccc" id="xiajia2"><a style="color:#fff;font-size：1em;line-height:45px">已下架</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>                    
                </div>
            </section>
        </section>       

        <script>
            var _csrf ="<?= Html::encode($_csrf) ?>";
            var fatheritemPartNumber = "<?= Html::encode($data['partNumber']) ?>"; //为了价格接口的缓存，切sku的时候不让子类itempartnumber覆盖父类的
            var itemPartNumber = "<?= Html::encode($data['partNumber']) ?>";
            var itemId = "<?= Html::encode($data['id']) ?>";
            var buyable = "<?= Html::encode($data['buyable']) ?>";
            var shop ="<?= Html::encode($data['memberId']) ?>";
            var inventoryposturl = "<?= Url::to(['product/getinventory']); ?>";
            var priceposturl = "<?= Url::to(['product/getproductprice']); ?>";  
            var _maxbuy = <?= Yii::$app->params['cart']['maxbuy'];?>;
            var salestype = "<?= Html::encode($data['salesType']) ?>";
            var userId = "<?= Yii::$app->mobileUser->getId(); ?>";
            var loginurl = "<?= Url::to(['passport/login', 'sc'=> Yii::$app->request->get('ci')]); ?>";
            var addtocarturl = "<?= Url::to(['cart/ajaxcreate']); ?>";
            var cartcheckouturl = "<?= Url::to(['cart/checkoutapp']); ?>";
            var addtowishlisturl = "<?= Url::to(['wishlist/ajaxcreate']); ?>";
            var checkurl = "<?= Url::to(['product/checknobuy']); ?>";
            var skuMap = <?=json_encode($skumap)?>;
            var taxRate = "<?= Html::encode(isset($tax['taxRate']) ? $tax['taxRate'] * 100 : "0") ?>";
            var goodstype = "<?= Html::encode($data['type']) ?>";
            var _buynum_min = <?= Html::encode(isset($data['minBuyCount']) && $data['minBuyCount']> 1 ? $data['minBuyCount'] : 1) ?>; //起订数量 必然存在 不存在则定为 1 
            var _buynum_max = <?= Html::encode(isset($data['maxBuyCount']) && $data['maxBuyCount']> 0 ? $data['maxBuyCount'] : Yii::$app->params['cart']['maxbuy']) ?>;//限购数量
            var stateCode = "310000";
            var cityCode = "310100";
            var districtCode = "310101";
            var longdescription = '<?php echo(Html::encode($desc['longDescription'])); ?>';
            var pricelist = "";
            var is_cart = "<?= Html::encode($is_cart) ?>";
            var channelId = "<?= isset($_GET['ci']) ? $_GET['ci'] : 'ftzmall' ?>";
        </script>   
		<?php $this->endBody() ?>
	</body>
</html>
<?php $this->endPage() ?>