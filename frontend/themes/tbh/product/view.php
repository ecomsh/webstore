<?php

use frontend\assets\ftzmallnew\ProductAsset;
use yii\helpers\Html;
use yii\helpers\Url;
ProductAsset::register($this);
$this -> title = '欢迎来到英国-'.$desc['name'];
?>
<!--商品详情 start-->
<div class="wrapper bgf2">
    <div class="container">
            <!--二级导航 start-->
            <div class="con-nav">
                <div class="con-link">
                    <a href="<?= Url::to(['site/index']); ?>">首页</a><i class="iconfont icon-arrowright"></i>
                    <a href="javascript:void(0)">在线商店</a><i class="iconfont icon-arrowright"></i>
                    <a href="javascript:void(0)">厨房</a><i class="iconfont icon-arrowright"></i>
                    <a href="javascript:void(0)" class="active">品牌旗舰店</a>
                </div>
            </div>
            <!--二级导航 end-->
            <!-- 商品上半部分开始 -->
            <div class="goods clearfix">
                <!-- 放大镜开始 -->
                <div class="goods-pic">                  
                    <!-- 大图 -->
                    <div class="g-b-pic">
                        <a class="cloud-zoom" id="zoom1" href="<?= Html::encode($desc['fullImage']) ?>" rel="adjustX: 10, adjustY:-4, softFocus:false, showTitle:false"><img src="<?= isset($desc['bigImage'])?Html::encode($desc['bigImage']):"" ?>" title="" alt="" /></a>
                        <span class="search-none" style="display:none"></span>
                    </div>
                   <!-- 小图 -->
                    <ul id="scroll-box" class="thumb">
                        <div id="scroll">
                            <li id="first-li">
                                <a href='<?= Html::encode($desc['fullImage']) ?>' class='cloud-zoom-gallery' title='' rel="useZoom: 'zoom1', smallImage: '<?= isset($desc['bigImage'])?Html::encode($desc['bigImage']):"" ?>' "><img src="<?= isset($desc['thumbnail'])?Html::encode($desc['thumbnail']):"" ?>" alt = "" /></a>
                            </li>
                            <?php
                                if ($goodspic && is_array($goodspic))
                                {foreach ($goodspic as $k => $arr):
                            ?>
                                <li>
                                    <a href='<?= Html::encode($arr['fullImage']) ?>' class='cloud-zoom-gallery' title='' rel="useZoom: 'zoom1', smallImage: '<?= Html::encode($arr['bigImage']) ?>' "><img src="<?= Html::encode($arr['thumbnail']) ?>" alt = ""/></a>
                                </li>
                            <?php 
                                endforeach;}
                            ?>
                        </div>
                    </ul>
                    <!-- 正品保证。。。。 -->
                    <div class="share-bar">
                        <a href="javascript:void(0)"><i class="iconfont icon-iconzhengpin"></i>正品保证</a>
                        <a href="javascript:void(0)"><i class="iconfont icon-tuihuanhuoguize"></i>七天退换</a>
                        <a href="javascript:void(0)"><i class="iconfont icon-zhijianguanli"></i>权威质检</a>
                        <a href="javascript:void(0)"><i class="iconfont icon-fenxiang"></i>分享</a>
                        <a href="javascript:void(0)"><i class="iconfont icon-shoucang"></i>收藏商品</a>
                    </div>
                </div>
                <!-- 放大镜结束 -->

       

                <!-- 商品详情细节开始 -->
                <div class="goods-detail">
                    <h3><!--SPRINGFIELD 男士短袖-->
                        <?php if(isset($brand["countryid"]) && $brand["countryid"]!="" && file_exists('themes/ftzmallnew/src/images/country/'.$brand["countryid"].'.png')): ?>
                        <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/country/'.$brand["countryid"].'.png', true)?>" width="40">
                        <?php endif; ?>
                        <?php if(isset($brand["countryname"]) && $brand["countryname"]!=""): ?>
                        <span><?= Html::encode($brand['countryname']) ?></span>|
                        <?php endif; ?>
                        <?php if(isset($brand["name"]) && $brand["name"]!=""): ?>
                        <span class="brand-g"><?= Html::encode($brand['name']) ?></span>     
                        <?php endif; ?>
                    </h3>
                    <div class="goods-des">
                        <?= Html::encode($desc['name']) ?>
                    </div>

                    <div class="goods-attr">
                        <dl>
                            <dt class="spe">寺库价</dt>
                            <dd>
                                <i class="iconfont icon-rmb"></i>
                                <span class="now-price">
                                <!--  售价 -->
                                <?php
                                    if ($offerprice && is_array($offerprice) && $offerprice[0]){
                                        foreach ($offerprice as $k => $arr):
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
                                <!-- 售价-->
                                </span>
                                <!--折扣 售价/原价-->
                                <span class="goods-dis"> <!--JS写-->  折</span>
                                <span>市场价 
                                    <del><i class="iconfont icon-rmb"></i>
                                <!-- 原价-->
                                    <?php
                                        if ($listprice && is_array($listprice) && $listprice[0]){
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
                                <!-- 原价--> 
                                    </del>
                                </span>
                            </dd>
                        </dl>
                        <dl>
                            <dt>发货地</dt>
                            <dd>大陆 有货 预计下订单后2-4天内发货 全场包邮</dd>
                        </dl>
                        <dl>
                            <dt>温馨提示</dt>
                            <dd>无质量问题不支持退货换<br>不支持货到付款</dd>
                        </dl>
                        <dl class="goods-size skumap-bigbox">
                            
                                <?php if ($defining && is_array($defining) && $data['type']!="package")
            {
                foreach ($defining as $k => $arr):
                    ?>
                    
                        <dt><?= Html::encode($arr['name']) ?>：</dt>
                        <dd>
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

                       <?php elseif ($arr['assignedValue'] && is_array($arr['assignedValue']) && !$isProductSku && $data['type'] == "item"):?>                  
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
                    </dd>
            <?php
                endforeach;
            }
            ?>
                                
                            </dd>
                        </dl>
                        <div id="isbuyable">
                            <dl class="goods-num">
                                <dt class="font-12">购买数量：</dt>
                                <dd class="Numinput" id="goods-viewer">
                                    <a class="substract" href="javascript:void(0);"><i class="iconfont icon-minus"></i></a>
                                     <input type="text" value="1" size="5" name="goodsnum" min="0" class="Num" id="Num">
                                    <a class="plus" href="javascript:void(0);"><i class="iconfont icon-add"></i></a>
                                </dd>              
                            </dl> 
                            <div id="address-sh" style="display:none">
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

                    <div class="goods-action">
                        <a id="buynow" class="btn btn-block" href="javascript:void(0)">立即抢购</a>
                        <a id="addtocart" class="btn btn-solid" href="javascript:void(0)"><i class="iconfont icon-gouwuche"></i>加入购物车</a>
                    </div>
                </div>
            </div>
                <!-- 商品详情细节开始 -->
            



            <input type="hidden" name="skuMapValue" value="" id="skuMapValue">
            <input type="hidden" name="skuMapId" value="" id="skuMapId">
            <input type="hidden" name="skuMapContent" value="" id="skuMapContent">  
            <input type="hidden" name="code" id="stateCode" value="<?= Html::encode(isset($stateCode) ? $stateCode : "310000") ?>"/>
            <div id="inventory" style="display:none">0</div>
            <input type="hidden" name="offergoodsprice" id="offergoodsprice" value="<?= Html::encode(isset($offerprice[0]['price'])?$offerprice[0]['price']:0);?> ">
            <input type="hidden" name="listgoodsprice" id="listgoodsprice" value="<?= Html::encode(isset($listprice[0]['price'])?$listprice[0]['price']:0); ?> "> 
   






<!-- 商品介绍开始 -->
            <div class="goods-main clearfix">
                <div id="longdescription-bigbox" class="goods-main-r">
                    <div class="longdescription-tab" role="tablist" id="navtop">
                         <ul class="main-nav clearfix">
                            <li><a class="current" href="javascript:void(0)">商品详情</a></li>
                            <li><a href="javascript:void(0)">公司品牌</a></li>
                            <li><a href="javascript:void(0)">累计评价</a></li>
                            <li><a href="javascript:void(0)">月成交记录</a></li>
                            <li><a href="javascript:void(0)">购买须知</a></li>
                            <li><a href="javascript:void(0)">关于我们</a></li>
                        </ul>
                       <!--  <ul id="product_tag" class="main-nav clearfix">
                            <?php if($data['salesType']!=1 && $data['salesType']!=2):?>
                                <li class="active" id="li_gmxz"><a id="tab_gmxz" href="#gmxz" aria-controls="gmxz" role="tab" data-toggle="tab">购买须知</a></li>
                                <li id="li_spxx"><a id="tab_spxx" href="#spxx" aria-controls="spxx" role="tab" data-toggle="tab">商品信息</a></li>
                            <?php else:?>
                                <li style="display:none" id="li_gmxz"><a id="tab_gmxz" href="#gmxz" aria-controls="gmxz" role="tab" data-toggle="tab">购买须知</a></li>
                                <li id="li_spxx" class="active"><a id="tab_spxx" href="#spxx" aria-controls="spxx" role="tab" data-toggle="tab">商品信息</a></li>
                            <?php endif;?>           
                                <li id="li_spxq"><a id="tab_spxq" href="#spxq" aria-controls="spxq" role="tab" data-toggle="tab">商品详情</a></li>
                            <?php if($shipaipic && is_array($shipaipic)):?>
                                <li id="li_spzs"><a id="tab_spzs" href="#spzs" aria-controls="spzs" role="tab" data-toggle="tab">商品实拍</a></li>
                            <?php else:?>
                                <li id="li_spzs" style="display:none"><a id="tab_spzs" href="#spzs" aria-controls="spzs" role="tab" data-toggle="tab">商品实拍</a></li>
                            <?php endif;?>
                            <?php if($data['salesType']!=1 && $data['salesType']!=2):?>    
                                <li id="li_aboutus"><a id="tab_aboutus" href="#aboutus" aria-controls="aboutus" role="tab" data-toggle="tab">关于我们</a></li>
                            <?php else:?>
                                <li id="li_aboutus" style="display:none"><a id="tab_aboutus" href="#aboutus" aria-controls="aboutus" role="tab" data-toggle="tab">关于我们</a></li>
                            <?php endif;?>    
                        </ul> -->
                    </div>
                    <div id="spxx" name="spxx" role="tabpanel" class="active">
                            <img data-original="http://image.kjt.com/ueditor_upload_files/Original/2015/0825/ed674f21-0fc3-4306-be2b-a8205f77619f.jpg"><!--产品信息-->
                            <p><span class="spxx_left">商品名称</span><span class="spxx_right"><?= Html::encode($desc['name']) ?> </span></p>
                        <?php if ($brand && is_array($brand)):?>   
                            <p><span class="spxx_left">品牌</span><span  class="spxx_right"><?= Html::encode($brand['name']) ?> </span></p>
                        <?php endif; ?>
                        <?php if($descriptive && is_array($descriptive)){
                                foreach ($descriptive as $k => $arr): ?>      
                            <p><span class="spxx_left"><?= Html::encode($arr['name']) ?></span><span  class="spxx_right"><?= Html::encode($arr['value']) ?> </span></p>
                        <?php endforeach;}?>
                        <img data-original="<?= isset($desc['bigImage'])?Html::encode($desc['bigImage']):"" ?>" width="254px">
                    </div>                
                    <div id="gmxz" role="tabpanel" class="active">
                    <?php if($data['salesType']!=1 && $data['salesType']!=2):?>    
                        <img data-original="http://image.kjt.com/ueditor_upload_files/Original/2015/0825/6ac8b505-de2a-4c4e-a17d-1887b2dddb06.jpg"><!--购买须知-->
                    <?php endif;?>
                    </div>
            
                    <div id="spxq" role="tabpanel" class="active">
                        <?= $desc['longDescription'] ?>   
                    </div>        
                    <div id="spzs" role="tabpanel" class="active">
                    <?php if($shipaipic && is_array($shipaipic)){
                            foreach($shipaipic as $k=>$arr):?>
                        <p><img data-original="<?= Html::encode($arr['path']) ?>"></p>
                    <?php endforeach;}?>
                    </div>        
                    <div id="aboutus" role="tabpanel" class="active">
                    <?php if($data['salesType']!=1 && $data['salesType']!=2):?>    
                        <p><img data-original="http://image.kjt.com/ueditor_upload_files/Original/2015/0825/ee232d49-617a-49cd-b2e4-897e9e10d1c1.jpg"></p><!--关于我们-->
                        <p><img data-original="http://image.kjt.com/ueditor_upload_files/Original/2015/0825/4a8b9b89-78f6-4d41-a110-a567f7c2b2af.jpg"></p><!--快递-->
                        <p><img data-original="http://image.kjt.com/ueditor_upload_files/Original/2015/0825/289f6e0a-1bdc-4d91-b7d9-ed63ca158127.jpg"></p><!--海关-->
                    <?php endif;?>
                    </div>
                    <div id="longdescription-bigboxend"></div>
                </div>



                <div class="goods-main-l">
                    <h4>同品牌推荐</h4>                  
                    <?php if (isset($data['brand']['fullimage']) && $data['brand']['fullimage']!=""): ?>    
                        <img src="<?= Html::encode($data['brand']['fullimage']) ?>" width="246px;">
                    <?php endif;?>                          
                    <ul class="main-list">
                        <li>
                              <?php foreach($brandRecommend as $k => $arr): ?>
                           <a href=<?= Url::to(['product/view', 'id' => $arr['id']]); ?> >
                            <!--<a href="javascript:void(0)">-->
                                <img src=" <?= Html::encode($arr['fullImage']) ?>">
                                <p><?= Html::encode($arr['desc']['name']) ?></p>
                                <strong>￥<?= Html::encode(isset($arr['offerPriceInfo'][0]['price'])?$arr['offerPriceInfo'][0]['price']:0);?></strong>
                            </a>
                            <?php endforeach; ?>
                        </li>
                    </ul>
                    <?php if (isset($categoryRecommend) && $categoryRecommend && is_array($categoryRecommend) && $data['type']!="package" ):?>
                    <h4 class="list-down">同类型推荐</h4>
                    <ul class="main-list">
                        <li>
                            <?php foreach($categoryRecommend as $k => $arr): ?>
                            <a href=<?= Url::to(['product/view', 'id' => $arr['id']]); ?> >
                                <img src="<?= Html::encode($arr['fullImage']) ?>">
                                <p><?= Html::encode($arr['desc']['name']) ?></p>
                                <strong>￥<?= Html::encode(isset($arr['offerPriceInfo'][0]['price'])?$arr['offerPriceInfo'][0]['price']:0);?></strong>
                            </a>
                            <?php endforeach; ?>
                        </li>
                    <?php endif; ?>
                    </ul>
                </div>
            </div>


            <!--感兴趣的专场 start-->
            <div class="guess bgff clearfix">
                <h3>您可能感兴趣的专场</h3>
                <ul>
                    <li>
                        <a href="javascript:void(0)">
                            <img src="http://static.tbh.dev/yingyuan/static/test/cai1.jpg" alt=""/>
                            <p><时尚环保>Orange家居收纳专场满500减100</p>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <img src="http://static.tbh.dev/yingyuan/static/test/cai2.jpg" alt=""/>
                            <p><点亮激情>Zippo打火机专场3折起</p>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <img src="http://static.tbh.dev/yingyuan/static/test/cai3.jpg" alt=""/>
                            <p><卓越工艺>精品笔具专场2.4折起</p>
                        </a>
                    </li>
                </ul>
            </div>
            <!--感兴趣的专场 end-->
            <!--最近浏览 start-->
            <div class="goods-tabs bgff clearfix">
                <ul class="goods-tabs-menu">
                    <li class="active"><a href="javascript:void(0)">最近浏览</a></li>
                    <li><a href="javascript:void(0)">畅销排行榜</a></li>
                </ul>
                <div class="goods-tabs-box">
                    <ul>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="http://static.tbh.dev/yingyuan/static/test/goods.jpg" alt=""/>
                                <p class="goods-name">INDEFINIE 无硅油精油香氛香氛系列洗护套装(洗发香波500ml+护发素500ml) 10种植物提取 COSME大赏洗护</p>
                                <div class="goods-price">
                                    <i class="iconfont icon-rmb"></i>
                                    <span class="now-price">98</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="http://static.tbh.dev/yingyuan/static/test/goods.jpg" alt=""/>
                                <p class="goods-name">INDEFINIE 无硅油精油香氛香氛系列洗护套装(洗发香波500ml+护发素500ml) 10种植物提取 COSME大赏洗护</p>
                                <div class="goods-price">
                                    <i class="iconfont icon-rmb"></i>
                                    <span class="now-price">98</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="http://static.tbh.dev/yingyuan/static/test/goods.jpg" alt=""/>
                                <p class="goods-name">INDEFINIE 无硅油精油香氛香氛系列洗护套装(洗发香波500ml+护发素500ml) 10种植物提取 COSME大赏洗护</p>
                                <div class="goods-price">
                                    <i class="iconfont icon-rmb"></i>
                                    <span class="now-price">98</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="http://static.tbh.dev/yingyuan/static/test/goods.jpg" alt=""/>
                                <p class="goods-name">INDEFINIE 无硅油精油香氛香氛系列洗护套装(洗发香波500ml+护发素500ml) 10种植物提取 COSME大赏洗护</p>
                                <div class="goods-price">
                                    <i class="iconfont icon-rmb"></i>
                                    <span class="now-price">98</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="http://static.tbh.dev/yingyuan/static/test/goods.jpg" alt=""/>
                                <p class="goods-name">INDEFINIE 无硅油精油香氛香氛系列洗护套装(洗发香波500ml+护发素500ml) 10种植物提取 COSME大赏洗护</p>
                                <div class="goods-price">
                                    <i class="iconfont icon-rmb"></i>
                                    <span class="now-price">98</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="http://static.tbh.dev/yingyuan/static/test/goods.jpg" alt=""/>
                                <p class="goods-name">INDEFINIE 无硅油精油香氛香氛系列洗护套装(洗发香波500ml+护发素500ml) 10种植物提取 COSME大赏洗护</p>
                                <div class="goods-price">
                                    <i class="iconfont icon-rmb"></i>
                                    <span class="now-price">98</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="http://static.tbh.dev/yingyuan/static/test/goods.jpg" alt=""/>
                                <p class="goods-name">INDEFINIE 无硅油精油香氛香氛系列洗护套装(洗发香波500ml+护发素500ml) 10种植物提取 COSME大赏洗护</p>
                                <div class="goods-price">
                                    <i class="iconfont icon-rmb"></i>
                                    <span class="now-price">98</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="http://static.tbh.dev/yingyuan/static/test/goods.jpg" alt=""/>
                                <p class="goods-name">INDEFINIE 无硅油精油香氛香氛系列洗护套装(洗发香波500ml+护发素500ml) 10种植物提取 COSME大赏洗护</p>
                                <div class="goods-price">
                                    <i class="iconfont icon-rmb"></i>
                                    <span class="now-price">98</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="http://static.tbh.dev/yingyuan/static/test/goods.jpg" alt=""/>
                                <p class="goods-name">INDEFINIE 无硅油精油香氛香氛系列洗护套装(洗发香波500ml+护发素500ml) 10种植物提取 COSME大赏洗护</p>
                                <div class="goods-price">
                                    <i class="iconfont icon-rmb"></i>
                                    <span class="now-price">98</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--最近浏览 end-->          
        
    </div>

</div>
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
    var userId = "<?= Yii::$app->user->getId(); ?>";
    var loginurl = "<?= Url::to(['login/']); ?>";
    var addtocarturl = "<?= Url::to(['cart/ajaxcreate']); ?>";
    var cartcheckouturl = "<?= Url::to(['cart/checkout']); ?>";
    var addtowishlisturl = "<?= Url::to(['wishlist/ajaxcreate']); ?>";
    var checkurl = "<?= Url::to(['product/checknobuy']); ?>";
    var skuMap = <?=json_encode($skumap)?>;
    var taxRate = "<?= Html::encode(isset($tax['taxRate']) ? $tax['taxRate'] * 100 : "0") ?>";
    var _maxbuy = "<?= Yii::$app->params['cart']['maxbuy'];?>";
    var goodstype = "<?= Html::encode($data['type']) ?>";
    var _buynum_min = <?= Html::encode(isset($data['minBuyCount']) && $data['minBuyCount']> 1 ? $data['minBuyCount'] : 1) ?>; //起订数量 必然存在 不存在则定为 1 
    var _buynum_max = <?= Html::encode(isset($data['maxBuyCount']) && $data['maxBuyCount']> 0 ? $data['maxBuyCount'] : 50) ?>;//限购数量
    var stateCode = <?= Html::encode(isset($stateCode) && $stateCode !="" ? $stateCode : 310000) ?>;
    var cityCode = "";
    var districtCode = "";
    var pricelist = "";
</script>