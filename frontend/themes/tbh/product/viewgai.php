<?php

use frontend\assets\ftzmallnew\ProductAsset;
use yii\helpers\Html;
use yii\helpers\Url;
ProductAsset::register($this);
$this -> title = '上海外高桥进口商品网-'.$product['name'];
?>
<div class="container">

    <div>
        <ol class="breadcrumb">
            <li><a href="<?= Url::to(['site/index']); ?>" target="_blank">FTZMALL</a></li>
            <li class="active product-title-g"><?= Html::encode($product['name']) ?></li>
        </ol>
    </div>
    <div class="fangdajing">
        <div class="fangdajing-thumb">
            <a href="javascript:void(0);" id="arrow-top"><img id="arrow-top-img" src="<?=Url::to('@web/themes/ftzmallnew/src/images/arrow-top.png', true)?>"></a>
            <a href="javascript:void(0);" id="arrow-down"><img id="arrow-down-img" src="<?=Url::to('@web/themes/ftzmallnew/src/images/arrow-down.png', true)?>"></a>
            <ul id="scroll-box">
                <div id="scroll" class="scroll-bigbox">
                    <li id="first-li">
                        <a href='<?= Html::encode($product['fullImage']) ?>' class='cloud-zoom-gallery' title='' rel="useZoom: 'zoom1', smallImage: '<?= isset($product['bigImage'])?Html::encode($product['bigImage']):"" ?>' "><img src="<?= isset($product['thumbnail'])?Html::encode($product['thumbnail']):"" ?>" alt = "" /></a>
                    </li>
                    <?php
                        if ($product['pic']['goodspic'] && is_array($product['pic']['goodspic']))
                        {
                            foreach ($product['pic']['goodspic'] as $k => $arr):
                    ?>
                            <li>
                                <a href='<?= Html::encode($arr['fullImage']) ?>' class='cloud-zoom-gallery' title='' rel="useZoom: 'zoom1', smallImage: '<?= Html::encode($arr['bigImage']) ?>' "><img src="<?= Html::encode($arr['thumbnail']) ?>" alt = ""/></a>
                            </li>
                    <?php
                            endforeach;
                        }
                    ?>
                </div>
            </ul>
        </div>
        <div class="fangdajing-bigimg">
            <a class="cloud-zoom" id="zoom1" href="<?= Html::encode($product['fullImage']) ?>" rel="adjustX: 10, adjustY:-4, softFocus:false, showTitle:false"><img src="<?= isset($product['bigImage'])?Html::encode($product['bigImage']):"" ?>" title="" alt="" /></a>
            <span class="search-none" style="display:none"></span>
        </div>
        <?php if( isset($product['tag']['SP']) && is_array($product['tag']['SP'])):?>
            <div class="tag-bigbox tag-g">
                <?php
                    foreach ($product['tag']['SP'] as $k => $arr)
                    { if(isset($arr['name']) && $arr['name'] !=""): ?>                                       
                        <span><?= Html::encode($arr['name']) ?></span>
                <?php endif;}?>
            </div>
        <?php endif;?>
    </div>
    <div class="product-detail">
        <div class="country-bigbox">
            <?php if(isset($product['brand']["countryid"]) && $product['brand']["countryid"]!="" && file_exists('themes/ftzmallnew/src/images/country/'.$product['brand']["countryid"].'.png')): ?>
                <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/country/'.$product["brand"]["countryid"].'.png', true)?>" width="40">
            <?php endif; ?>
            <?php if(isset($product["brand"]["countryname"]) && $product["brand"]["countryname"]!=""): ?>
                <span><?= Html::encode($product["brand"]['countryname']) ?></span>|
            <?php endif; ?>
            <?php if(isset($product["brand"]["name"]) && $product["brand"]["name"]!=""): ?>
                <span class="brand-g"><?= Html::encode($product["brand"]['name']) ?></span>     
            <?php endif; ?>
        </div>
        <div class="itempartnumber-box">商品编号： <span  class="partnumber-g"><?= Html::encode($product['partNumber']) ?></span></div>
        <div class="product-title product-title-g"><?= Html::encode($product['name']) ?></div>
        <?php if($product['shortDescription']): ?>
            <div class="shortdescription shortdescription-g"><?= Html::encode($product['shortDescription']) ?></div>
        <?php endif;?>
        <div class="line"></div>
        <div class="price-bigbox">
            <span class="font-13">价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;格：</span>
            <span class="font-red font-18 font-weight">￥</span><span class="font-red font-32 font-weight goodsprice">            
            <?php 
                if (isset($product['offerprice']) && is_array($product['offerprice'])) {
                    if ($product['offerprice']['currency'] == '' || $product['offerprice']['currency'] == 'CNY') {
                        if (isset($product['offerprice']['minPrice']) && isset($product['offerprice']['minPrice']) && $product['offerprice']['minPrice'] != $product['offerprice']['maxPrice']):
            ?>
            <?= Html::encode($product['offerprice']['minPrice']) ?> - <?= Html::encode($product['offerprice']['maxPrice']) ?>
            <?php elseif ($product['offerprice']['price']): ?>
                <?= Html::encode($product['offerprice']['price']) ?>                                      
            <?php   
                endif;}}
            ?>
            </span>     
            <span class="font-13">
                <del class="offerprice-g" style="display:none" id="jiangjia-yuanjia"></del><!--为了直降效果，显示offerprice，有直降价格才显示-->
            </span>
            <?php if( isset($product['tag']['PR']) && is_array($product['tag']['PR']))
            {
                foreach ($product['tag']['PR'] as $k => $arr) {
                    if($arr['name'] == "直降"):?>
                        <span class="zhijiang">直降</span>
                    <?php elseif ($arr['name'] == "包邮"): ?>
                        <span class="baoyou">包邮</span>
                    <?php elseif ($arr['name'] == "满减"): ?>
                        <span class="zhijiang">满减</span>
                    <?php endif; 
                }
            }
            ?>
            <span class="font-13">国内参考价
            <del class="font-13 listprice-g">
            <?php 
                if (isset($product['listprice']) && is_array($product['listprice'])) {
                    if ($product['listprice']['currency'] == '' || $product['listprice']['currency'] == 'CNY') {
                        if (isset($product['listprice']['minPrice']) && isset($product['listprice']['minPrice']) && $product['listprice']['minPrice'] != $product['listprice']['maxPrice']):
            ?>
            <?= Html::encode($product['listprice']['minPrice']) ?> - <?= Html::encode($product['listprice']['maxPrice']) ?>
            <?php elseif ($product['listprice']['price']): ?>
                <?= Html::encode($product['listprice']['price']) ?>                                      
            <?php   
                endif;}}
            ?>
            </del>
            </span>
        </div>
        <div class="line"></div>
        <div class="tax-bigbox" <?php if($product['salesType']==1||$product['salesType']==2):?>style="display:none"<?php endif;?>>
            <?php if($product['type']=="package"):?>
                <img id="taximg" src="<?=Url::to('@web/themes/ftzmallnew/src/images/group.jpg', true)?> " >
                <span class="font-12">&nbsp;税费加入购物车后可见</span>                
            <?php else:?>
                <img id="taximg" src="<?=Url::to('@web/themes/ftzmallnew/src/images/taxfree.jpg', true)?> " >
                <span class="font-12">&nbsp;进口税 <span id="tax">25.00</span>元/件， 进口税小于等于50元免征【</span>
                <a class="font-12" href="<?= Url::to(['article/page', 'view' => 'sl']); ?>" target="_blank">进口税细则</a>
                <span class="font-12">】</span>
            <?php endif;?>
        </div>
        <div class="line" <?php if($product['salesType']==1||$product['salesType']==2):?>style="display:none"<?php endif;?>></div>
        <div class="skumap-bigbox">
            <?php if ($product['definingAttributes'] && is_array($product['definingAttributes']) && $product['type']!="package")
            {
                foreach ($product['definingAttributes'] as $k => $arr):
                    ?>
                    <div class="skumap-smallbox">
                        <span class="font-12"><?= Html::encode($arr['name']) ?>：</span>
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

                       <?php elseif ($arr['assignedValue'] && is_array($arr['assignedValue']) && !$isProductSku && $product['type'] == "item"):?>                  
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
        <div id="isbuyable">
            <div class="buyinfo-bigcbox">
                <span class="font-12">数&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;量：</span>
                <div class="Numinput" id="goods-viewer">
                    <a class="substract" href="javascript:void(0);"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/substract.png', true)?>"></a>
                    <a class="plus" href="javascript:void(0);"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/plus.png', true)?>"></a>
                    <input type="text" value="1" size="5" name="goodsnum" min="0" class="Num" id="Num">
                </div>
                <?php if($product['minBuyCount'] && $product['minBuyCount'] > 1): ?>               
                    <span class="font-12 minbuy-g">（</span><span class="font-12 font-red minbuy-g" id="minbuy"><?= Html::encode($product['minBuyCount']) ?>件起售</span><span class="font-12 minbuy-g">）</span>
                <?php else: ?>
                    <span class="font-12 minbuy-g" style="display:none">（</span><span class="font-12 font-red minbuy-g" id="minbuy" style="display:none"><?= Html::encode($product['minBuyCount']) ?>件起售</span><span class="font-12 minbuy-g" style="display:none">）</span>
                <?php endif; ?>
                <?php if($product['maxBuyCount'] && $product['maxBuyCount'] > 0): ?>
                    <span class="font-12 maxbuy-g">（</span><span class="font-12 font-red maxbuy-g" id="maxbuy">限购<?= Html::encode($product['maxBuyCount']) ?>件</span><span class="font-12 maxbuy-g">）</span>
                <?php else: ?>
                    <span class="font-12 maxbuy-g" style="display:none">（</span><span class="font-12 font-red maxbuy-g" id="maxbuy" style="display:none">限购<?= Html::encode($product['maxBuyCount']) ?>件</span><span class="font-12 maxbuy-g" style="display:none">）</span>
                <?php endif; ?>
                    <span class="font-12 kcjz" style="display:none">（</span><span class="font-12 font-red kcjz" style="display:none">库存紧张</span><span class="font-12 kcjz" style="display:none">）</span>               
            </div>            
            <div class="buyinfo-bigcbox" <?php if($product['salesType']!=1 && $product['salesType']!=2):?>style="display:none;"<?php endif;?>>
                <span class="font-12">配&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;送：</span>
                <div id="address-sh">
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
            
            <div class="addtocart-bigcbox">
                <input type="button" id="addtocart" href="javascript:void(0);" value="加入购物车" class="btn-buy" style="background-color:#ccc" disabled="true">
				<input type="button" id="buynow" href="javascript:void(0);" value="立即购买" style="display:none" class="btn-buy">
                <?php /*<a id="collect" href="javascript:void(0);"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/collect.png', true)?>"></a>*/?>
            </div>
        </div>
        <div id="isbuyable2" style="display:none">
            <p>此商品已下架</p>
        </div>
    </div>
    <input type="hidden" name="skuMapValue" value="" id="skuMapValue">
    <input type="hidden" name="skuMapId" value="" id="skuMapId">
    <input type="hidden" name="skuMapContent" value="" id="skuMapContent">  
    <input type="hidden" name="code" id="stateCode" value="<?= Html::encode(isset($stateCode) ? $stateCode : "310000") ?>"/>
    <div id="inventory" style="display:none">0</div>
    <input type="hidden" name="offergoodsprice" id="offergoodsprice" value="<?= Html::encode(isset($offerprice[0]['price'])?$offerprice[0]['price']:0);?> ">
    <input type="hidden" name="listgoodsprice" id="listgoodsprice" value="<?= Html::encode(isset($listprice[0]['price'])?$listprice[0]['price']:0); ?> ">
</div>
<div class="container">
    <div id="longdescription-bigbox" class="longdescription-bigbox">
        <div class="longdescription-tab" role="tablist" id="navtop">
            <ul id="product_tag">
                <?php if($product['salesType']!=1 && $product['salesType']!=2):?>
                    <li class="active" id="li_gmxz"><a id="tab_gmxz" href="#gmxz" aria-controls="gmxz" role="tab" data-toggle="tab">购买须知</a></li>
                    <li id="li_spxx"><a id="tab_spxx" href="#spxx" aria-controls="spxx" role="tab" data-toggle="tab">商品信息</a></li>
                <?php else:?>
                    <li style="display:none" id="li_gmxz"><a id="tab_gmxz" href="#gmxz" aria-controls="gmxz" role="tab" data-toggle="tab">购买须知</a></li>
                    <li id="li_spxx" class="active"><a id="tab_spxx" href="#spxx" aria-controls="spxx" role="tab" data-toggle="tab">商品信息</a></li>
                <?php endif;?>           
                    <li id="li_spxq"><a id="tab_spxq" href="#spxq" aria-controls="spxq" role="tab" data-toggle="tab">商品详情</a></li>
                <?php if(isset($product['pic']['shipaipic']) && is_array($product['pic']['shipaipic'])):?>
                    <li id="li_spzs"><a id="tab_spzs" href="#spzs" aria-controls="spzs" role="tab" data-toggle="tab">商品实拍</a></li>
                <?php else:?>
                    <li id="li_spzs" style="display:none"><a id="tab_spzs" href="#spzs" aria-controls="spzs" role="tab" data-toggle="tab">商品实拍</a></li>
                <?php endif;?>
                <?php if($product['salesType']!=1 && $product['salesType']!=2):?>    
                    <li id="li_aboutus"><a id="tab_aboutus" href="#aboutus" aria-controls="aboutus" role="tab" data-toggle="tab">关于我们</a></li>
                <?php else:?>
                    <li id="li_aboutus" style="display:none"><a id="tab_aboutus" href="#aboutus" aria-controls="aboutus" role="tab" data-toggle="tab">关于我们</a></li>
                <?php endif;?>    
            </ul>
        </div>
        <div id="gmxz" role="tabpanel" class="active">
        <?php if($product['salesType']!=1 && $product['salesType']!=2):?>    
            <img data-original="http://image.kjt.com/ueditor_upload_files/Original/2015/0825/6ac8b505-de2a-4c4e-a17d-1887b2dddb06.jpg">
        <?php endif;?>
        </div>
        <div id="spxx" name="spxx" role="tabpanel" class="active">
                <img data-original="http://image.kjt.com/ueditor_upload_files/Original/2015/0825/ed674f21-0fc3-4306-be2b-a8205f77619f.jpg">
                <p><span class="spxx_left">商品名称</span><span class="spxx_right"><?= Html::encode($product['name']) ?> </span></p>
            <?php if ($product['brand'] && is_array($product['brand'])):?>   
                <p><span class="spxx_left">品牌</span><span  class="spxx_right"><?= Html::encode($product['name']) ?> </span></p>
            <?php endif; ?>
            <?php if(isset($product['descriptive']) && is_array($product['descriptive'])){
                    foreach ($product['descriptive'] as $k => $arr): ?>      
                <p><span class="spxx_left"><?= Html::encode($arr['name']) ?></span><span  class="spxx_right"><?= Html::encode($arr['value']) ?> </span></p>
            <?php endforeach;}?>
            <img data-original="<?= isset($product['bigImage'])?Html::encode($product['bigImage']):"" ?>" width="254px">
        </div>        
        <div id="spxq" role="tabpanel" class="active">
            <?= $product['longDescription'] ?>   
        </div>        
        <div id="spzs" role="tabpanel" class="active">
        <?php if(isset($product['pic']['shipaipic']) && is_array($product['pic']['shipaipic'])){
                foreach($product['pic']['shipaipic'] as $k=>$arr):?>
            <p><img data-original="<?= Html::encode($arr['path']) ?>"></p>
        <?php endforeach;}?>
        </div>        
        <div id="aboutus" role="tabpanel" class="active">
        <?php if($product['salesType']!=1 && $product['salesType']!=2):?>    
            <p><img data-original="http://image.kjt.com/ueditor_upload_files/Original/2015/0825/ee232d49-617a-49cd-b2e4-897e9e10d1c1.jpg"></p>
            <p><img data-original="http://image.kjt.com/ueditor_upload_files/Original/2015/0825/4a8b9b89-78f6-4d41-a110-a567f7c2b2af.jpg"></p>
            <p><img data-original="http://image.kjt.com/ueditor_upload_files/Original/2015/0825/289f6e0a-1bdc-4d91-b7d9-ed63ca158127.jpg"></p>
        <?php endif;?>
        </div>
        <div id="longdescription-bigboxend"></div>
    </div>
    <div class="right-bigbox">
        <?php if (isset($product['brandRecommend']) && is_array($product['brandRecommend']) && $product['type']!="package" ):?>                    
        <div class="brand-bigbox">
            <div class="brand-topbox">
                <p>同品牌推荐</p>
            </div>
            <?php if (isset($product['brand']['fullimage']) && $product['brand']['fullimage']!=""): ?>            
            <div class="brand-middlebox">
                <img src="<?= Html::encode($product['brand']['fullimage']) ?>" width="246px;">
            </div>
            <?php endif;?>
            <?php foreach($product['brandRecommend'] as $k => $arr): ?>
            <a href=<?= Url::to(['product/view', 'id' => $arr['id']]); ?> >
                <dl>
                    <dt>
                        <img src="<?= Html::encode($arr['fullImage']) ?>">
                    </dt>
                    <dd>
                        <p class="font-12"><?= Html::encode($arr['desc']['name']) ?></p>
                        <p class="font-12 font-red">￥<?= Html::encode(isset($arr['offerPriceInfo'][0]['price'])?$arr['offerPriceInfo'][0]['price']:0);?></p>
                    </dd>
                </dl>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php if (isset($product['categoryRecommend']) && is_array($product['categoryRecommend']) && $product['type']!="package" ):?>           
        <div class="brand-bigbox">
            <div class="brand-topbox">
                <p>同类型推荐</p>
            </div>
            <?php foreach($product['categoryRecommend'] as $k => $arr): ?>
            <a href=<?= Url::to(['product/view', 'id' => $arr['id']]); ?> >
                <dl>
                    <dt>
                        <img src="<?= Html::encode($arr['fullImage']) ?>">
                    </dt>
                    <dd>
                        <p class="font-12"><?= Html::encode($arr['desc']['name']) ?></p>
                        <p class="font-12 font-red">￥<?= Html::encode(isset($arr['offerPriceInfo'][0]['price'])?$arr['offerPriceInfo'][0]['price']:0);?></p>
                    </dd>
                </dl>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php if (isset($product['packageRecommend']) && is_array($product['packageRecommend'])):?>           
        <div class="brand-bigbox">
            <div class="brand-topbox">
                <p>其他组合推荐</p>
            </div>
            <?php foreach($product['packageRecommend'] as $k => $arr): ?>
            <a href=<?= Url::to(['product/view', 'id' => $arr['id']]); ?> >
                <dl>
                    <dt>
                        <img src="<?= Html::encode($arr['fullImage']) ?>">
                    </dt>
                    <dd>
                        <p class="font-12"><?= Html::encode($arr['desc']['name']) ?></p>
                        <p class="font-12 font-red">￥<?= Html::encode(isset($arr['offerPriceInfo'][0]['price'])?$arr['offerPriceInfo'][0]['price']:0);?></p>
                    </dd>
                </dl>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php /*<div class="container margin-top20" >
    <div class="cart-container-bottom ">
        <ul class="nav nav-tabs ">
            <li class="active">
                <a href="#alsobuy" data-toggle="tab">购买的还买了</a>
            </li>
            <li>
                <a href="#todaywel" data-toggle="tab">今日最受欢迎</a>
            </li>
            <li>
                <a href="#recentview" data-toggle="tab">最近查看过</a>
            </li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <ul class="row clearfix tab-pane fade in active" id="alsobuy">                
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
            </ul>
            <ul class="row clearfix tab-pane fade" id="todaywel">
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
            </ul>
            <ul class="row clearfix tab-pane fade" id="recentview">
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
                <li class="final-product pull-left ">
                    <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/finalpro.png', true)?>" class="finalpro-img final-img">
                    <p class="final-text pull-left final-m">Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色</p>
                    <span class="final-price pull-right final-price">￥28.99</span>
                </li>
            </ul>
        </div>
    </div>
</div> */?>

<script>
	var _csrf ="<?= Html::encode($_csrf) ?>";
    var fatheritemPartNumber = "<?= Html::encode($product['partNumber']) ?>"; //为了价格接口的缓存，切sku的时候不让子类itempartnumber覆盖父类的
	var itemPartNumber = "<?= Html::encode($product['partNumber']) ?>";
	var itemId = "<?= Html::encode($product['id']) ?>";
	var buyable = "<?= Html::encode($product['buyable']) ?>";
	var shop ="<?= Html::encode($product['memberId']) ?>";
	var inventoryposturl = "<?= Url::to(['product/getinventory']); ?>";
	var priceposturl = "<?= Url::to(['product/getproductprice']); ?>";	
	var _maxbuy = <?= Yii::$app->params['cart']['maxbuy'];?>;
	var salestype = "<?= Html::encode($product['salesType']) ?>";
	var userId = "<?= Yii::$app->user->getId(); ?>";
	var loginurl = "<?= Url::to(['login/']); ?>";
	var addtocarturl = "<?= Url::to(['cart/ajaxcreate']); ?>";
    var cartcheckouturl = "<?= Url::to(['cart/checkout']); ?>";
    var addtowishlisturl = "<?= Url::to(['wishlist/ajaxcreate']); ?>";
	var skuMap = <?=json_encode($product['skumap'])?>;
    var taxRate = "<?= Html::encode(isset($tax['taxRate']) ? $tax['taxRate'] * 100 : "0") ?>";
    var _maxbuy = "<?= Yii::$app->params['cart']['maxbuy'];?>";
	var goodstype = "<?= Html::encode($product['type']) ?>";
    var _buynum_min = <?= Html::encode(isset($product['minBuyCount']) && $product['minBuyCount']> 1 ? $product['minBuyCount'] : 1) ?>; //起订数量 必然存在 不存在则定为 1 
    var _buynum_max = <?= Html::encode(isset($product['maxBuyCount']) && $product['maxBuyCount']> 0 ? $product['maxBuyCount'] : 50) ?>;//限购数量
    var stateCode = <?= Html::encode(isset($stateCode) && $stateCode !="" ? $stateCode : 310000) ?>;
    var cityCode = "";
    var districtCode = "";
    var pricelist = "";
</script>