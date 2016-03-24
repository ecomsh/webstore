<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Menu;
use frontend\assets\IndexAsset;

IndexAsset::register($this);
/* @var $this yii\web\View */
$this->title = '上海外高桥进口商品网';
?>

<div class="ppsc-banner">
    <div class="ex-slide1-box" style="width:100%;height:300px;">
        <div id="ex_slide_4080" class="ex-slide1" style="width:100%;">
            <ol class="switchable-content clearfix">
                <li class="switchable-panel" style="width: 100%; opacity: 1; position: absolute; z-index: 9;">
                    <a href="<?=Url::to(['product/view','id'=>10001])?>" target="_blank">   
                        <div class="pic" style="background-image:url(http://ecomgq-images.oss.aliyuncs.com/98/59/ed/0b51b644f7941317ada39a32b571cdf2bf9.jpg?1435817613#w)" title="">
                        </div>        
                    </a>
                </li>
            </ol>
            <ul class="switchable-triggerBox slide-trigger">
                <li class="active"></li> 
            </ul>
        </div>
    </div>
    <script>
        new Switchable('ex_slide_4080', {
        effect:'fade',
                autoplay:true
        });</script>
</div> 
<div id="index_m4_show_background">
    <div class="conter w1200 clb" id="J_screen" style="width:1000px">
        <div class="page-section">

            <div class="index_content_all_baokuan">
                <p class="mianshui_title">今日爆款<span></span></p>
                <div class="index_content_all_baokuan_ul center_section">


                    <div class="index_content_all_baokuan_today">
                        <!-- 图片地址http://ecomgq-images.oss.aliyuncs.com/6b/53/48/e5d18740440af847d92a456ac502ca209aa.jpg?1435646212#h-->
                        <div class="index_content_all_baokuan_today" style="background:url(http://ecomgq-images.oss.aliyuncs.com/53/6d/a7/0189985e5715b060aded189d60f2743dd47.jpg?1429099316#h)" onclick="location.href ='<?=Yii::$app->params['baseUrl']?>product-1333.html&#39;">
                            <!--
                                <div class="baokuan_flag"><img src="http://test.ftzmall.com.cn/themes/simple/images/flag_flb.png" width="34" height="23" /></div>
                                <div class="baokuan_a_flv_1">菲律宾直供 <span>上海保税区发货</span></div>
                            -->
                            <p class="baokuan_a_flv_2">菲律宾 FIESTA嘉年华热带椰子水330ML</p>
                            <p class="baokuan_a_flv_3">
                                <span class="baokuan_a_flv_3_yuan">¥</span>
                                <span class="baokuan_a_flv_3_price">9.9</span>
                                <span class="baokuan_a_flv_3_zhe"><span>8.3折</span></span>
                            </p>
                            <p class="baokuan_a_flv_4">
                                <span class="baokuan_a_flv_4_text">国内参考价：</span><span class="baokuan_a_flv_4_cprice">¥11.900</span>
                            </p>
                        </div>
                    </div>
                    <div class="index_content_all_baokuan_today">
                        <!-- 图片地址http://ecomgq-images.oss.aliyuncs.com/b4/7b/d2/88cab482f0844ca99daac87b7f73c43a7ea.jpg?1433405917#h-->
                        <div class="index_content_all_baokuan_today" style="background:url(http://ecomgq-images.oss.aliyuncs.com/73/9d/6d/0ece6723f592314fcb3f8867eba397ece13.jpg?1433488440#h)" onclick="location.href ='<?=Yii::$app->params['baseUrl']?>product-1539.html&#39;">
                            <!--
                                <div class="baokuan_flag"><img src="http://test.ftzmall.com.cn/themes/simple/images/flag_flb.png" width="34" height="23" /></div>
                                <div class="baokuan_a_flv_1">菲律宾直供 <span>上海保税区发货</span></div>
                            -->
                            <p class="baokuan_a_flv_2">比利时 贝得嘉太妃味松露形巧克力 500g</p>
                            <p class="baokuan_a_flv_3">
                                <span class="baokuan_a_flv_3_yuan">¥</span>
                                <span class="baokuan_a_flv_3_price">118</span>
                                <span class="baokuan_a_flv_3_zhe"><span>8.3折</span></span>
                            </p>
                            <p class="baokuan_a_flv_4">
                                <span class="baokuan_a_flv_4_text">国内参考价：</span><span class="baokuan_a_flv_4_cprice">¥141.600</span>
                            </p>
                        </div>
                    </div>
                    <div class="index_content_all_baokuan_today">
                        <!-- 图片地址http://ecomgq-images.oss.aliyuncs.com/a1/39/76/be6a4c265d85f28db7b1b2cc069f6faaa2a.jpg?1435743576#h-->
                        <div class="index_content_all_baokuan_today" style="background:url(http://ecomgq-images.oss.aliyuncs.com/c3/c0/22/99627331ee1c2cb2b39741ad3ecf42b5776.jpg?1429149231#h)" onclick="location.href ='<?=Yii::$app->params['baseUrl']?>product-1486.html&#39;">
                            <!--
                                <div class="baokuan_flag"><img src="http://test.ftzmall.com.cn/themes/simple/images/flag_flb.png" width="34" height="23" /></div>
                                <div class="baokuan_a_flv_1">菲律宾直供 <span>上海保税区发货</span></div>
                            -->
                            <p class="baokuan_a_flv_2">美国 CeraVe补水保湿滋润洗面奶237ml</p>
                            <p class="baokuan_a_flv_3">
                                <span class="baokuan_a_flv_3_yuan">¥</span>
                                <span class="baokuan_a_flv_3_price">99</span>
                                <span class="baokuan_a_flv_3_zhe"><span>6.7折</span></span>
                            </p>
                            <p class="baokuan_a_flv_4">
                                <span class="baokuan_a_flv_4_text">国内参考价：</span><span class="baokuan_a_flv_4_cprice">¥148.000</span>
                            </p>
                        </div>
                    </div>
                    <div class="index_content_all_baokuan_tomorrow">



                        <div class="ex-slide1-box" style="width:199px;height:350px;">
                            <div id="ex_slide_4034" class="ex-slide1" style="position: relative;">
                                <ol class="switchable-content clearfix" style="position: absolute; width: 597px;">

                                    <li class="switchable-panel" style="float: left;">
                                        <a href="<?=Yii::$app->params['baseUrl']?>product-1412.html">
                                            <img src="<?= Yii::$app->params['baseimgUrl'] ?>8722c284e2654ce8927f1c3be7d055c19f9.jpg" title="">
                                        </a>
                                    </li>

                                    <li class="switchable-panel" style="float: left;">
                                        <a href="<?=Yii::$app->params['baseUrl']?>product-1489.html">
                                            <img src="<?= Yii::$app->params['baseimgUrl'] ?>a409eee8a9a439f085779020b664eea2039.jpg" class="lazyload" title="">
                                        </a>
                                    </li>

                                    <li class="switchable-panel" style="float: left;">
                                        <a href="<?=Yii::$app->params['baseUrl']?>product-1482.html">
                                            <img src="<?= Yii::$app->params['baseimgUrl'] ?>5bae8c5d0bbe853a23ca87dba54220e1cce.jpg" class="lazyload" title="">
                                        </a>
                                    </li>
                                </ol>
                                <ul class="switchable-triggerBox slide-trigger">
                                    <li class="active"></li> 
                                    <li class=""></li> 
                                    <li class=""></li> 

                                </ul>
                            </div>
                        </div>
                        <script>
                                    new Switchable('ex_slide_4034', {
                                    effect:'scrollx',
                                            autoplay:true
                                    });</script>
                    </div>

                </div>
            </div>





            <div class="index_content_all_mianshui">
                <p class="mianshui_title">免税专场<span>/底价疯抢</span></p>
                <ul class="center_section">
                    <li class="baokuan_goods" onmouseover="this.removeClass('baokuan_goods'); this.addClass('baokuan_goods2');" onmouseout="this.removeClass('baokuan_goods2'); this.addClass('baokuan_goods');">

                        <div class="mianshui_1">
                            <div class="mianshui_left"><img src="<?= Yii::$app->params['baseimgUrl'] ?>c1d7677b6fa5394bee11cfd32cf0cefd565.jpg" class="lazyload" alt="" width="76" height="100">
      <!-- <img src='http://ecomgq-images.oss.aliyuncs.com/c8/94/10/c1d7677b6fa5394bee11cfd32cf0cefd565.jpg?1429097851#h' alt="" width='76'height='100' /> -->
                            </div>
                            <p class="mianshui_t1">自贸区直购专场</p>
                            <p class="mianshui_t2">你爱的品牌都在这里</p>
                            <p class="mianshui_t3"><span></span>国际范儿</p>
                        </div>
                        <div class="mianshui_1_pic"><a href="<?=Yii::$app->params['baseUrl']?>gallery-268--1-0-1--grid-g.html" target="_blank"><img src="<?= Yii::$app->params['baseimgUrl'] ?>a41c385808e3bb74c62bcbcf935b8328173.jpg" class="lazyload" alt="" width="710" height="300">
      <!-- <img src='http://ecomgq-images.oss.aliyuncs.com/19/d5/53/a41c385808e3bb74c62bcbcf935b8328173.jpg?1429097963#w' alt="" width='710'height='300' /> -->
                            </a></div>  

                    </li>
                    <li class="baokuan_space"></li>
                    <li class="baokuan_goods" onmouseover="this.removeClass('baokuan_goods'); this.addClass('baokuan_goods2');" onmouseout="this.removeClass('baokuan_goods2'); this.addClass('baokuan_goods');">

                        <div class="mianshui_1">
                            <div class="mianshui_left"><img src="<?= Yii::$app->params['baseimgUrl'] ?>transparent.gif" lazyload="//ecomgq-images.oss.aliyuncs.com/13/78/ee/f27af36a11eef47bdab0fa06eb30af89bda.jpg?1429097769#h" class="lazyload" alt="" width="76" height="100">
      <!-- <img src='//ecomgq-images.oss.aliyuncs.com/13/78/ee/f27af36a11eef47bdab0fa06eb30af89bda.jpg?1429097769#h' alt="" width='76'height='100' /> -->
                            </div>
                            <p class="mianshui_t1">大牌洗护专场</p>
                            <p class="mianshui_t2">回归自然从一片绿叶开始</p>
                            <p class="mianshui_t3"><span></span>来自台湾</p>
                        </div>
                        <div class="mianshui_1_pic"><a href="<?=Yii::$app->params['baseUrl']?>article-zhuantiye-227.html" target="_blank"><img src="<?= Yii::$app->params['baseimgUrl'] ?>transparent.gif" lazyload="http://ecomgq-images.oss.aliyuncs.com/45/e5/3d/78365df1981feb1847976ca4c6afd9eb729.jpg?1435739610#w" class="lazyload" alt="" width="710" height="300">
      <!-- <img src='http://ecomgq-images.oss.aliyuncs.com/45/e5/3d/78365df1981feb1847976ca4c6afd9eb729.jpg?1435739610#w' alt="" width='710'height='300' /> -->
                            </a></div>  

                    </li>

                    <li class="baokuan_space"></li>
                    <li class="baokuan_goods" onmouseover="this.removeClass('baokuan_goods'); this.addClass('baokuan_goods2');" onmouseout="this.removeClass('baokuan_goods2'); this.addClass('baokuan_goods');">

                        <div class="mianshui_1">
                            <div class="mianshui_left"><img src="<?= Yii::$app->params['baseimgUrl'] ?>transparent.gif" lazyload="//ecomgq-images.oss.aliyuncs.com/02/18/0a/a3654b1fcddf6f84e227df2f7a96d2731ea.jpg?1429098124#h" class="lazyload" alt="">
      <!-- <img src='//ecomgq-images.oss.aliyuncs.com/02/18/0a/a3654b1fcddf6f84e227df2f7a96d2731ea.jpg?1429098124#h' alt=""  /> -->
                            </div>
                            <p class="mianshui_t1">D.I.G.周年庆专场</p>
                            <p class="mianshui_t2">进口食品 组合包邮</p>
                            <p class="mianshui_t3"><span>2</span>折起</p>
                        </div>
                        <div class="mianshui_1_pic"><a href="<?=Yii::$app->params['baseUrl']?>article-huodongzhuanqu-226.html#" target="_blank"><img src="<?= Yii::$app->params['baseimgUrl'] ?>transparent.gif" lazyload="http://ecomgq-images.oss.aliyuncs.com/d4/c4/32/45e93e89257a0c4d5c14a1f93755166c77d.jpg?1435804436#w" class="lazyload" alt="">
      <!-- <img src='http://ecomgq-images.oss.aliyuncs.com/d4/c4/32/45e93e89257a0c4d5c14a1f93755166c77d.jpg?1435804436#w' alt=""  /> -->
                            </a></div>  

                    </li>

                    <li class="baokuan_space"></li>
                    <li class="baokuan_goods" onmouseover="this.removeClass('baokuan_goods'); this.addClass('baokuan_goods2');" onmouseout="this.removeClass('baokuan_goods2'); this.addClass('baokuan_goods');">

                        <div class="mianshui_1">
                            <div class="mianshui_left"><img src="<?= Yii::$app->params['baseimgUrl'] ?>transparent.gif" lazyload="//ecomgq-images.oss.aliyuncs.com/2d/2b/a7/23ed1ed1c0d7a953a467b465a870d16ef5e.jpg?1429097727#h" class="lazyload" alt="">
      <!-- <img src='//ecomgq-images.oss.aliyuncs.com/2d/2b/a7/23ed1ed1c0d7a953a467b465a870d16ef5e.jpg?1429097727#h' alt=""  /> -->
                            </div>
                            <p class="mianshui_t1">进口牛奶专场</p>
                            <p class="mianshui_t2">海关监管 安全无忧</p>
                            <p class="mianshui_t3"><span></span>满180立减20</p>
                        </div>
                        <div class="mianshui_1_pic"><a href="<?=Yii::$app->params['baseUrl']?>article-huodongzhuanqu-221.html" target="_blank"><img src="<?= Yii::$app->params['baseimgUrl'] ?>transparent.gif" lazyload="http://ecomgq-images.oss.aliyuncs.com/b7/d4/7e/1f79dab21bc8467fb71256f86e0fdbfff0d.jpg?1435804511#w" class="lazyload" alt="" width="710" height="300">
      <!-- <img src='http://ecomgq-images.oss.aliyuncs.com/b7/d4/7e/1f79dab21bc8467fb71256f86e0fdbfff0d.jpg?1435804511#w' alt="" width='710'height='300' /> -->
                            </a></div>  

                    </li>


                    <li class="baokuan_space"></li>

                    <li class="baokuan_goods" onmouseover="this.removeClass('baokuan_goods'); this.addClass('baokuan_goods2');" onmouseout="this.removeClass('baokuan_goods2'); this.addClass('baokuan_goods');">

                        <div class="mianshui_1">
                            <div class="mianshui_left"><img src="<?= Yii::$app->params['baseimgUrl'] ?>transparent.gif" lazyload="http://ecomgq-images.oss.aliyuncs.com/f6/9d/c0/64be6e86bab58d354e737f6742c6e9cb159.jpg?1429097496#h" class="lazyload" alt="" width="76" height="100">
      <!-- <img src='http://ecomgq-images.oss.aliyuncs.com/f6/9d/c0/64be6e86bab58d354e737f6742c6e9cb159.jpg?1429097496#h' alt="" width='76'height='100' /> -->
                            </div>
                            <p class="mianshui_t1">冰岛海鲜专场</p>
                            <p class="mianshui_t2">鲜见奇虾传 礼孝肴煮宴</p>
                            <p class="mianshui_t3">满99包邮</p>
                        </div>
                        <div class="mianshui_1_pic"><a href="<?=Yii::$app->params['baseUrl']?>gallery-index-264.html" target="_blank"><img src="<?= Yii::$app->params['baseimgUrl'] ?>transparent.gif" lazyload="http://ecomgq-images.oss.aliyuncs.com/51/1f/dc/4c56111231d85f2a33b2069d61e26601f3b.jpg?1429097611#w" class="lazyload" alt="" width="710" height="300">
      <!-- <img src='http://ecomgq-images.oss.aliyuncs.com/51/1f/dc/4c56111231d85f2a33b2069d61e26601f3b.jpg?1429097611#w' alt="" width='710'height='300' /> -->
                            </a></div>  

                    </li>
                    <li class="baokuan_space"></li>

                    <li class="baokuan_goods" onmouseover="this.removeClass('baokuan_goods'); this.addClass('baokuan_goods2');" onmouseout="this.removeClass('baokuan_goods2'); this.addClass('baokuan_goods');">

                        <div class="mianshui_1">
                            <div class="mianshui_left"><img src="<?= Yii::$app->params['baseimgUrl'] ?>transparent.gif" lazyload="http://ecomgq-images.oss.aliyuncs.com/02/18/0a/a3654b1fcddf6f84e227df2f7a96d2731ea.jpg?1429098124#h" class="lazyload" alt="" width="76" height="100">
      <!-- <img src='http://ecomgq-images.oss.aliyuncs.com/02/18/0a/a3654b1fcddf6f84e227df2f7a96d2731ea.jpg?1429098124#h' alt="" width='76'height='100' /> -->
                            </div>
                            <p class="mianshui_t1">新西兰牛羊肉专场</p>
                            <p class="mianshui_t2">新西兰 天蓝蓝 风吹草低靓牛羊</p>
                            <p class="mianshui_t3"><span></span>穹顶之下 顶级牛羊</p>
                        </div>
                        <div class="mianshui_1_pic"><a href="<?=Yii::$app->params['baseUrl']?>gallery-index-265.html" target="_blank"><img src="<?= Yii::$app->params['baseimgUrl'] ?>transparent.gif" lazyload="http://ecomgq-images.oss.aliyuncs.com/b8/cb/49/cdd5656431d0925e2d8a54f844287b46e31.jpg?1429097898#w" class="lazyload" alt="" width="710" height="300">
      <!-- <img src='http://ecomgq-images.oss.aliyuncs.com/b8/cb/49/cdd5656431d0925e2d8a54f844287b46e31.jpg?1429097898#w' alt="" width='710'height='300' /> -->
                            </a></div>

                    </li>
                    <li class="baokuan_space"></li>

                    <li class="baokuan_goods" onmouseover="this.removeClass('baokuan_goods'); this.addClass('baokuan_goods2');" onmouseout="this.removeClass('baokuan_goods2'); this.addClass('baokuan_goods');">

                        <div class="mianshui_1">
                            <div class="mianshui_left"><img src="<?= Yii::$app->params['baseimgUrl'] ?>transparent.gif" lazyload="http://ecomgq-images.oss.aliyuncs.com/13/78/ee/f27af36a11eef47bdab0fa06eb30af89bda.jpg?1429097769#h" class="lazyload" alt="" width="76" height="100">
      <!-- <img src='http://ecomgq-images.oss.aliyuncs.com/13/78/ee/f27af36a11eef47bdab0fa06eb30af89bda.jpg?1429097769#h' alt="" width='76'height='100' /> -->
                            </div>
                            <p class="mianshui_t1">进口红酒专场</p>
                            <p class="mianshui_t2">39°经纬美酒巡展  B格指南</p>
                            <p class="mianshui_t3"><span>5</span>折 巨献 美酒佳酿</p>
                        </div>
                        <div class="mianshui_1_pic"><a href="<?=Yii::$app->params['baseUrl']?>gallery-index-267.html" target="_blank"><img src="<?= Yii::$app->params['baseimgUrl'] ?>transparent.gif" lazyload="http://ecomgq-images.oss.aliyuncs.com/6b/38/74/8399df31156933626fa9ab80734f77111ed.jpg?1429097925#w" class="lazyload" alt="" width="710" height="300">
      <!-- <img src='http://ecomgq-images.oss.aliyuncs.com/6b/38/74/8399df31156933626fa9ab80734f77111ed.jpg?1429097925#w' alt="" width='710'height='300' /> -->
                            </a></div>  

                    </li>
                    <li class="baokuan_space"></li>

                    <li class="baokuan_goods" onmouseover="this.removeClass('baokuan_goods'); this.addClass('baokuan_goods2');" onmouseout="this.removeClass('baokuan_goods2'); this.addClass('baokuan_goods');">

                        <div class="mianshui_1">
                            <div class="mianshui_left"><img src="<?= Yii::$app->params['baseimgUrl'] ?>transparent.gif" lazyload="http://ecomgq-images.oss.aliyuncs.com/05/7c/60/9246ee25c45026b55f17c920afc0d218157.jpg?1429097800#h" class="lazyload" alt="" width="76" height="100">
      <!-- <img src='http://ecomgq-images.oss.aliyuncs.com/05/7c/60/9246ee25c45026b55f17c920afc0d218157.jpg?1429097800#h' alt="" width='76'height='100' /> -->
                            </div>
                            <p class="mianshui_t1">瑞士手表专场</p>
                            <p class="mianshui_t2">瑞士名表  畅想优仕生活</p>
                            <p class="mianshui_t3"><span>7</span>月 不见不散</p>
                        </div>
                        <div class="mianshui_1_pic"><a href="<?=Yii::$app->params['baseUrl']?>gallery-index-266.html" target="_blank"><img src="<?= Yii::$app->params['baseimgUrl'] ?>transparent.gif" lazyload="http://ecomgq-images.oss.aliyuncs.com/30/b8/1e/913cccde5dc28ae769b419a7e0409141ff3.jpg?1429097944#w" class="lazyload" alt="" width="710" height="300">
      <!-- <img src='http://ecomgq-images.oss.aliyuncs.com/30/b8/1e/913cccde5dc28ae769b419a7e0409141ff3.jpg?1429097944#w' alt="" width='710'height='300' /> -->
                            </a></div>  

                    </li>
                    <li class="baokuan_space"></li>



                </ul>
            </div>




        </div>

        <script>
            // 基于Jquery的交互效果
            jQuery('.ex_ad_side img,.v2-goods-list li img,.tg-wrap .tg-item .group-img img').hover(function(){
            jQuery(this).animate({'left':'-5px'}, 300);
            }, function(){
            jQuery(this).animate({'left':'0px'}, 300);
            });
            jQuery('.v2-goods-ad img').hover(function(){
            jQuery(this).addClass('active');
            }, function(){
            jQuery(this).removeClass('active');
            });</script></div></div>
<!-- <div class="sidebar-right">
<a rel="nofllow" href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&amp;key=XzkzODAwNTIxMF8xNjMxNTlfNDAwMTg4NTE3OV8yXw;" target="_blank" class="qtalk"></a>
<a href="javascript:void(0)" class="sidebar-backtop"></a>
<a href="javascript:void(0)" class="sidebar-close"></a>
</div> -->
<script>
            (function(){
            $$('.sidebar-backtop').addEvent('click', function(){
            $(window).scrollTo(0, 0)
            });
                    $$('.sidebar-close').addEvent('click', function(){
            $$('.sidebar-right').setStyle('display', 'none')
            })
            })();
</script>
