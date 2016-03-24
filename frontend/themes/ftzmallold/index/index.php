<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '上海外高桥进口商品网';
?>


<div class="header-wrap">
    <div class="menu ppsc-main-menu clb">
        <div class="w1200 clearfix">
            <!--  <div class="span-auto catalog-main  active" id="catalog_main"> -->
            <div class="span-auto catalog-main" id="catalog_main"></div>
            <div class="span-auto nav_main">
                <ul class="clb js_menu_4021">
                    <li class="js_menu_1 menu_index">
                        <a href="<?=  Url::to(['index/']);?>">首页</a>
                        <!-- <a class="menu_index" href="http://www.ftzmall.com.cn/index.php" >首页</a> -->

                    </li>
                    <li class="js_menu_1">
                        <a href="<?=  Url::to(['bksg/']);?>">爆款闪购</a>
                        <!-- <a class="menu_index" href="http://www.ftzmall.com.cn/bksg.html" >爆款闪购</a> -->

                    </li>
                    <li class="js_menu_1">
                        <a href="<?=  Url::to(['hwzg/']);?>">海外直邮</a>
                        <!-- <a class="menu_index" href="http://www.ftzmall.com.cn/article-huodongzhuanqu-218.html" >海外直邮</a> -->

                    </li>
                </ul>

                <script>
                    $ES('.js_menu_1').each(function(item, index){
                    item.addEvent('mouseenter', function(){
                    if (item.getElement('.js_menu_2')){
                    item.getElement('.js_menu_2').setStyle('display', '');
                    }
                    });
                            item.addEvent('mouseleave', function(){
                            if (item.getElement('.js_menu_2')){
                            item.getElement('.js_menu_2').setStyle('display', 'none');
                            }
                            });
                    });
                            $ES('.js_menu_2').each(function(item, index){
                    item.getElements('.js_menu_2e').each(function(item2, index2){
                    item2.addEvent('mouseenter', function(){
                    if (item2.getElement('.js_menu_3')){
                    item2.getElement('.js_menu_3').setStyle('display', '');
                    }
                    });
                            item2.addEvent('mouseleave', function(){
                            if (item2.getElement('.js_menu_3')){
                            item2.getElement('.js_menu_3').setStyle('display', 'none');
                            }
                            });
                    });
                    });
                            if ($('index_menu_more_4021')){

                    $('index_menu_more_4021').addEvent('mouseenter', function(){
                    $('index_menu_more_view_4021').setStyle('display', '');
                    });
                            $('index_menu_more_4021').addEvent('mouseleave', function(){
                    $('index_menu_more_view_4021').setStyle('display', 'none');
                    });
                    }


                    window.addEvent('domready', function(){
                    var hrf = location.href.split('/').getLast(), n = hrf.lastIndexOf('-'),
                            menulist = $$('.js_menu_4021 li');
                            //if(n>-1)hrf=hrf.substring(0,n);
                            if (!hrf.trim().length) hrf = 'index.html';
                            var reg = new RegExp('\/' + hrf, 'i');
                            menulist.each(function(el){
                            var link = el.getElement('a');
                                    if (link && link.href.test(reg))
                                    el.addClass('menu_index');
                            });
                    });</script>
            </div>
            <div class="fr bottom">

            </div>
        </div>
    </div>
</div>
<!--  -->
<script>
            /*
             $('catalog_main').addEvents({
             mouseenter:function(){
             this.addClass('active');
             },mouseleave:function(){
             this.removeClass('active');
             }
             });
             */

            $$('.tool_arrow_t').addEvents({mouseover:function(){
    $$('.tool_arrow_t .tool_arrow_dis').setStyle('display', 'block');
    }, mouseout:function(){
    $$('.tool_arrow_t .tool_arrow_dis').setStyle('display', 'none');
    }
    });
            //right_bar_show_weixin_all 显示微信
            $('right_bar_show_weixin').addEvents({click:function(){
    if ($('right_bar_show_weixin_all').getStyle('display') == 'block')
            $('right_bar_show_weixin_all').setStyle('display', 'none');
            else
            $('right_bar_show_weixin_all').setStyle('display', 'block');
    },
    });
            //右边栏鼠标放上去效果
                    function rightAction(o, newClass, oldClass, newImg)
                    {
                    o.removeClass(oldClass);
                            o.addClass(newClass);
                            o.getElements('img')[0].setProperty('src', newImg);
                            if (newClass == 'rbli2')
                    {
                    $('right_cart_number_divid').removeClass('circle_cart_box_over');
                            $('right_cart_number_divid').addClass('circle_cart_box');
                            //$('right_cart_detail_id').setStyle('display','none');

                    }
                    else if (newClass == 'rbli2_over')
                    {
                    $('right_cart_number_divid').removeClass('circle_cart_box');
                            $('right_cart_number_divid').addClass('circle_cart_box_over');
                            //$('right_cart_detail_id').setStyle('display','block');

                    }

                    }
            $('right_bar_show_cart').addEvent('click', function(e) {
            if ($('right_cart_detail_id').getStyle('display') == 'none')
                    $('right_cart_detail_id').setStyle('display', 'inline');
                    else
                    $('right_cart_detail_id').setStyle('display', 'none');
                    var req = new Request({url: "http://www.ftzmall.com.cn/cart-showAjaxMiniCart.html",
                            method:'get',
                            evalScripts:true,
                            onSuccess: function(responseText) {
                            $('right_cart_detail_id').set('HTML', responseText);
                            },
                            //Our request will most likely succeed, but just in case, we'll add an
                            //onFailure method which will let the user know what happened.
                            onFailure: function() {
                            $('right_cart_detail_id').set('text', 'The request failed.');
                            }
                    }).send(); });
                    $('right_bar_show_account').addEvent('click', function(e) {
            if ($('right_bar_user_info').getStyle('display') == 'none')
                    $('right_bar_user_info').setStyle('display', 'inline');
                    else
                    $('right_bar_user_info').setStyle('display', 'none');
                    var e = Cookie.read('UNAME')?Cookie.read('UNAME'):'';
                    if (!e)
            {
            $('right_bar_user_info').setHTML(' <div class="right_cart_show_box_close" onclick="$(\'right_bar_user_info\').setStyle(\'display\',\'none\')">&times;</div><img src="themes/simple/images/right_bar_account_03.jpg" width="67" height="65" /><p class="userp">您好！ 请 <a href="passport-login.html"><span style="color:#ff4b00">登录</span></a> | <a href="passport-signup.html"><span style="color:#ff4b00">注册</span></a> </p><ul><li class="right_bar_account_order"><a href="member-orders.html"><img src="themes/simple/images/right_bar_account_11.png" width="23" height="30" /></a><p><a href="member-orders.html">我的订单</a></p></li><li class="right_bar_account_separator"><div class="right_bar_account_line"></div></li><li class="right_bar_account_mail"><div class="right_bar_mail_number" style="display:none"><p></p></div><a href="msg-my_msg.html"><img style="margin:25px 0 0 0;" src="themes/simple/images/right_bar_account_14.png" width="29" height="21" /></a><p><a href="msg-my_msg.html">我的消息</a></p></li></ul>');
                    return;
            }
            var req = new Request({url: "http://www.ftzmall.com.cn/member-getRightBarAccountInfo.html",
                    method:'get',
                    evalScripts:true,
                    onSuccess: function(responseText) {
                    $('right_bar_user_info').set('HTML', responseText);
                    },
                    //Our request will most likely succeed, but just in case, we'll add an
                    //onFailure method which will let the user know what happened.
                    onFailure: function() {
                    $('right_bar_user_info').set('text', 'Failure'); }
            }).send(); });</script>
<div class="ppsc-banner">



    <div class="ex-slide1-box" style="width:100%;height:300px;">
        <div id="ex_slide_4080" class="ex-slide1" style="width:100%;">
            <ol class="switchable-content clearfix">
                <li class="switchable-panel" style="width: 100%; opacity: 0; position: absolute; z-index: 1;">
                    <a href="<?=  Url::to(['activity/']);?>" target="_blank">   
                        <div class="pic" style="background-image:url(http://ecomgq-images.oss.aliyuncs.com/54/97/c9/a7def3cfef6d90fcd10f81df54d01b8c4c3.jpg?1433400681#w)" title="">
                        </div>        
                    </a>
                </li>
                <li class="switchable-panel" style="width: 100%; opacity: 1; position: absolute; z-index: 9; visibility: visible;">
                    <a href="<?=  Url::to(['activity/']);?>" target="_blank">   
                        <div class="pic" style="background-image:url(http://ecomgq-images.oss.aliyuncs.com/e8/28/1a/f9e43a9f2a4434967fdb1492245e07dfce9.jpg?1431421477#w)" title="">
                        </div>        
                    </a>
                </li>
                <li class="switchable-panel" style="width: 100%; opacity: 0; position: absolute; z-index: 1;">
                    <a href="<?=  Url::to(['gallery/']);?>" target="_blank">   
                        <div class="pic" style="background-image:url(//ecomgq-images.oss.aliyuncs.com/bc/b4/f9/c9bef3662254bdfad6891c8e463c3c0a2f7.jpg?1429118642#w)" title="">
                        </div>        
                    </a>
                </li>
            </ol>
            <ul class="switchable-triggerBox slide-trigger">
                <li class=""></li> 
                <li class="active"></li> 
                <li></li> 

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
    <div class="conter w1200 clb" id="J_screen">
        <div class="page-section">

            <div class="index_content_all_baokuan">
                <p class="mianshui_title">今日爆款<span></span></p>
                <div class="index_content_all_baokuan_ul center_section">


                    <div class="index_content_all_baokuan_today">
                        <!-- 图片地址http://ecomgq-images.oss.aliyuncs.com/34/51/52/70ba2539667a364ae3b736f6523444db551.jpg?1429147420#h-->
                        <div class="index_content_all_baokuan_today" style="background:url(http://ecomgq-images.oss.aliyuncs.com/53/6d/a7/0189985e5715b060aded189d60f2743dd47.jpg?1429099316#h)" onclick="location.href = '<?=  Url::to(['product/']);?>';">
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
                        <div class="index_content_all_baokuan_today" style="background:url(http://ecomgq-images.oss.aliyuncs.com/73/9d/6d/0ece6723f592314fcb3f8867eba397ece13.jpg?1433488440#h)" onclick="location.href = '<?=  Url::to(['product/']);?>';">
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
                        <!-- 图片地址http://ecomgq-images.oss.aliyuncs.com/4e/b3/59/993461834e12285c269204d64624501af88.jpg?1429855464#h-->
                        <div class="index_content_all_baokuan_today" style="background:url(http://ecomgq-images.oss.aliyuncs.com/c3/c0/22/99627331ee1c2cb2b39741ad3ecf42b5776.jpg?1429149231#h)" onclick="location.href = ' <?=Yii::$app->params['baseUrl']?>product-1486.html&#39;">
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
                                        <a href="<?=  Url::to(['product/']);?>">
                                            <img src="css/8722c284e2654ce8927f1c3be7d055c19f9.jpg" title="">
                                        </a>
                                    </li>

                                    <li class="switchable-panel" style="float: left;">
                                        <a href="<?=  Url::to(['product/']);?>">
                                            <img src="css/a409eee8a9a439f085779020b664eea2039.jpg" class="lazyload" title="">
                                        </a>
                                    </li>

                                    <li class="switchable-panel" style="float: left;">
                                        <a href="<?=  Url::to(['product/']);?>">
                                            <img src="css/5bae8c5d0bbe853a23ca87dba54220e1cce.jpg" class="lazyload" title="">
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
                            <div class="mianshui_left"><img src="css/c1d7677b6fa5394bee11cfd32cf0cefd565.jpg" class="lazyload" alt="" width="76" height="100">
      <!-- <img src='http://ecomgq-images.oss.aliyuncs.com/c8/94/10/c1d7677b6fa5394bee11cfd32cf0cefd565.jpg?1429097851#h' alt="" width='76'height='100' /> -->
                            </div>
                            <p class="mianshui_t1">自贸区直购专场</p>
                            <p class="mianshui_t2">你爱的品牌都在这里</p>
                            <p class="mianshui_t3"><span></span>国际范儿</p>
                        </div>
                        <div class="mianshui_1_pic"><a href="<?=  Url::to(['gallery/']);?>" target="_blank"><img src="css/a41c385808e3bb74c62bcbcf935b8328173.jpg" class="lazyload" alt="" width="710" height="300">
      <!-- <img src='http://ecomgq-images.oss.aliyuncs.com/19/d5/53/a41c385808e3bb74c62bcbcf935b8328173.jpg?1429097963#w' alt="" width='710'height='300' /> -->
                            </a></div>  

                    </li>
                    <li class="baokuan_space"></li>

                    <li class="baokuan_goods" onmouseover="this.removeClass( ' baokuan_goods ' ); this.addClass( ' baokuan_goods2 ' );" onmouseout="this.removeClass( ' baokuan_goods2 ' ); this.addClass( ' baokuan_goods ' );">

                        <div class="mianshui_1">
                            <div class="mianshui_left"><img src="css/64be6e86bab58d354e737f6742c6e9cb159.jpg" class="lazyload" alt="" width="76" height="100">
      <!-- <img src='http://ecomgq-images.oss.aliyuncs.com/f6/9d/c0/64be6e86bab58d354e737f6742c6e9cb159.jpg?1429097496#h' alt="" width='76'height='100' /> -->
                            </div>
                            <p class="mianshui_t1">冰岛海鲜专场</p>
                            <p class="mianshui_t2">鲜见奇虾传 礼孝肴煮宴</p>
                            <p class="mianshui_t3"><span>满99包邮</span>全程黑猫冷链</p>
                        </div>
                        <div class="mianshui_1_pic"><a href="<?=  Url::to(['gallery/']);?>" target="_blank"><img src="css/4c56111231d85f2a33b2069d61e26601f3b.jpg" class="lazyload" alt="" width="710" height="300">
      <!-- <img src='http://ecomgq-images.oss.aliyuncs.com/51/1f/dc/4c56111231d85f2a33b2069d61e26601f3b.jpg?1429097611#w' alt="" width='710'height='300' /> -->
                            </a></div>  

                    </li>
                    <li class="baokuan_space"></li>

                    <li class="baokuan_goods" onmouseover="this.removeClass( ' baokuan_goods ' ); this.addClass( ' baokuan_goods2 ' );" onmouseout="this.removeClass( ' baokuan_goods2 ' ); this.addClass( ' baokuan_goods ' );">

                        <div class="mianshui_1">
                            <div class="mianshui_left"><img src="css/a3654b1fcddf6f84e227df2f7a96d2731ea.jpg" class="lazyload" alt="" width="76" height="100">
      <!-- <img src='http://ecomgq-images.oss.aliyuncs.com/02/18/0a/a3654b1fcddf6f84e227df2f7a96d2731ea.jpg?1429098124#h' alt="" width='76'height='100' /> -->
                            </div>
                            <p class="mianshui_t1">新西兰牛羊肉专场</p>
                            <p class="mianshui_t2">新西兰 天蓝蓝 风吹草低靓牛羊</p>
                            <p class="mianshui_t3"><span></span>穹顶之下 顶级牛羊</p>
                        </div>
                        <div class="mianshui_1_pic"><a href="<?=  Url::to(['gallery/']);?>" target="_blank"><img src="css/cdd5656431d0925e2d8a54f844287b46e31.jpg" class="lazyload" alt="" width="710" height="300">
      <!-- <img src='http://ecomgq-images.oss.aliyuncs.com/b8/cb/49/cdd5656431d0925e2d8a54f844287b46e31.jpg?1429097898#w' alt="" width='710'height='300' /> -->
                            </a></div>

                    </li>
                    <li class="baokuan_space"></li>

                    <li class="baokuan_goods" onmouseover="this.removeClass( ' baokuan_goods ' ); this.addClass( ' baokuan_goods2 ' );" onmouseout="this.removeClass( ' baokuan_goods2 ' ); this.addClass( ' baokuan_goods ' );">

                        <div class="mianshui_1">
                            <div class="mianshui_left"><img src="css/f27af36a11eef47bdab0fa06eb30af89bda.jpg" class="lazyload" alt="" width="76" height="100">
      <!-- <img src='http://ecomgq-images.oss.aliyuncs.com/13/78/ee/f27af36a11eef47bdab0fa06eb30af89bda.jpg?1429097769#h' alt="" width='76'height='100' /> -->
                            </div>
                            <p class="mianshui_t1">进口红酒专场</p>
                            <p class="mianshui_t2">39°经纬美酒巡展  B格指南</p>
                            <p class="mianshui_t3"><span>5</span>折 巨献 美酒佳酿</p>
                        </div>
                        <div class="mianshui_1_pic"><a href="<?=  Url::to(['gallery/']);?>" target="_blank"><img src="css/8399df31156933626fa9ab80734f77111ed.jpg" class="lazyload" alt="" width="710" height="300">
      <!-- <img src='http://ecomgq-images.oss.aliyuncs.com/6b/38/74/8399df31156933626fa9ab80734f77111ed.jpg?1429097925#w' alt="" width='710'height='300' /> -->
                            </a></div>  

                    </li>
                    <li class="baokuan_space"></li>

                    <li class="baokuan_goods" onmouseover="this.removeClass( ' baokuan_goods ' ); this.addClass( ' baokuan_goods2 ' );" onmouseout="this.removeClass( ' baokuan_goods2 ' ); this.addClass( ' baokuan_goods ' );">

                        <div class="mianshui_1">
                            <div class="mianshui_left"><img src="css/9246ee25c45026b55f17c920afc0d218157.jpg" class="lazyload" alt="" width="76" height="100">
      <!-- <img src='http://ecomgq-images.oss.aliyuncs.com/05/7c/60/9246ee25c45026b55f17c920afc0d218157.jpg?1429097800#h' alt="" width='76'height='100' /> -->
                            </div>
                            <p class="mianshui_t1">瑞士手表专场</p>
                            <p class="mianshui_t2">瑞士名表  畅想优仕生活</p>
                            <p class="mianshui_t3"><span>5</span>月 不见不散</p>
                        </div>
                        <div class="mianshui_1_pic"><a href="<?=  Url::to(['gallery/']);?>" target="_blank"><img src="css/913cccde5dc28ae769b419a7e0409141ff3.jpg" class="lazyload" alt="" width="710" height="300">
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