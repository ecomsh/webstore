<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '爆款闪购-上海外高桥进口商品网';
?>

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

    $$('.tool_arrow_t').addEvents({mouseover: function() {
            $$('.tool_arrow_t .tool_arrow_dis').setStyle('display', 'block');
        }, mouseout: function() {
            $$('.tool_arrow_t .tool_arrow_dis').setStyle('display', 'none');
        }
    });

    //right_bar_show_weixin_all 显示微信
    $('right_bar_show_weixin').addEvents({click: function() {
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
        var req = new Request({url: "<?= Yii::$app->params['baseUrl'] ?>cart-showAjaxMiniCart.html",
            method: 'get',
            evalScripts: true,
            onSuccess: function(responseText) {
                $('right_cart_detail_id').set('HTML', responseText);
            },
            //Our request will most likely succeed, but just in case, we'll add an
            //onFailure method which will let the user know what happened.
            onFailure: function() {
                $('right_cart_detail_id').set('text', 'The request failed.');
            }
        }).send();
    });

    $('right_bar_show_account').addEvent('click', function(e) {
        if ($('right_bar_user_info').getStyle('display') == 'none')
            $('right_bar_user_info').setStyle('display', 'inline');
        else
            $('right_bar_user_info').setStyle('display', 'none');

        var e = Cookie.read('UNAME') ? Cookie.read('UNAME') : '';
        if (!e)
        {
            $('right_bar_user_info').setHTML(' <div class="right_cart_show_box_close" onclick="$(\'right_bar_user_info\').setStyle(\'display\',\'none\')">&times;</div><img src="themes/ftzmallold/images/right_bar_account_03.jpg" width="67" height="65" /><p class="userp">您好！ 请 <a href="passport-login.html"><span style="color:#ff4b00">登录</span></a> | <a href="passport-signup.html"><span style="color:#ff4b00">注册</span></a> </p><ul><li class="right_bar_account_order"><a href="member-orders.html"><img src="themes/ftzmallold/images/right_bar_account_11.png" width="23" height="30" /></a><p><a href="member-orders.html">我的订单</a></p></li><li class="right_bar_account_separator"><div class="right_bar_account_line"></div></li><li class="right_bar_account_mail"><div class="right_bar_mail_number" style="display:none"><p></p></div><a href="msg-my_msg.html"><img style="margin:25px 0 0 0;" src="themes/ftzmallold/images/right_bar_account_14.png" width="29" height="21" /></a><p><a href="msg-my_msg.html">我的消息</a></p></li></ul>');
            return;
        }
        var req = new Request({url: "<?= Yii::$app->params['baseUrl'] ?>member-getRightBarAccountInfo.html",
            method: 'get',
            evalScripts: true,
            onSuccess: function(responseText) {
                $('right_bar_user_info').set('HTML', responseText);
            },
            //Our request will most likely succeed, but just in case, we'll add an
            //onFailure method which will let the user know what happened.
            onFailure: function() {
                $('right_bar_user_info').set('text', 'Failure');
            }
        }).send();
    });

</script>
<div style="width:1366px;margin-left:auto;margin-right:auto;"><img src="<?= Yii::$app->params['baseimgUrl'] ?>8d528e1f38171d1d1e03347c58b86629efd.jpg" class="lazyload" alt="" width="1366" height="300">
  <!-- <img src='http://ecomgq-images.oss.aliyuncs.com/a8/c0/18/8d528e1f38171d1d1e03347c58b86629efd.jpg?1429123656#w' alt="" width='1366'height='300' /> -->
</div>
<div class="main w1200">

    <div> <div class="fast_sales_1">
            <ul>
                <li class="fast_sales_1_goods">

                    <div class="fast_sales_1_pic"><!-- 图片地址http://ecomgq-images.oss.aliyuncs.com/b6/b3/d0/0d8cbf08be8a211495990f97303032ed884.jpg?1430497616#h ||| -->
                        <a href="<?=Yii::$app->params['baseUrl']?>product-1446.html">
                            <img src="<?= Yii::$app->params['baseimgUrl'] ?>dea4141511eaa2b07e99549b7c3a6bbb098.jpg" width="562" height="359" border="0">
                        </a>

                        <!--
                        <div class="fast_sales_1_sold_out">
                            <div class="fast_sales_1_sold_out_circle">
                                <p>已抢光<br><span>SOLD OUT</span></p>
                            </div>
                        </div>
                        -->

                    </div>
                    <div class="fast_sales_1_right">
                        <!--
                            <div class="fast_sales_1_flag">
                                    <img src="../../themes/ftzmallold/images/fast_sales/fast_sales_flag_rb.jpg" width="62" height="42" />
                            </div>
                            <div class="fast_sales_1_company">
                                    <p>Japan</p>
                                <p>日本品牌</p>
                            </div>
                            <div class="fast_sales_1_time">
                                    <div class="fast_sales_1_clock"></div>
                                <div class="fast_sales_1_datetime">
                                    距离结束还剩 <span id="fast_sales_1_1_day">00</span> 天 <span id="fast_sales_1_1_hour">00</span> 时  <span id="fast_sales_1_1_min">00</span> 分
                                </div>
                            </div>
                        -->
                        <div class="fast_sales_1_name">刺身优惠一 三文鱼组合 500±15g/3盒</div>
                        <div class="fast_sales_1_desc">
                            <span>6.0折 /</span>
                            有着“冰洋之王”的法罗群岛冰鲜三文鱼，看得见的新鲜，尝得到的美味，害怕你不方便，我们精挑细选、搭乘“火箭”全程冷链送货上门入户品尝；
                        </div>
                        <div class="fast_sales_1_price">
                            <span class="fast_sales_1_yen">¥</span>
                            <span class="fast_sales_1_rprice">128</span>
                            <span class="fast_sales_mprice">￥184.00</span>
                        </div>
                        <div class="fast_sales_1_cart">

                            <a href="<?=Yii::$app->params['baseUrl']?>product-1446.html">
                                <div class="fast_sales_1_circle">
                                    <p>立即<br>抢购</p>
                                <!--<img src="../../themes/ftzmallold/images/fast_sales/fast_sales_white_cart.png" width="32" height="30" />-->
                                </div>
                            </a>


                            <!--
                            <div class="fast_sales_1_sold_out_circle">
                                <p>开售<br />提醒</p>
                            </div>
                            -->

                        </div>
                        <!--<div class="fast_sales_1_buy"><span>22251</span> 人一购买 限时限量抢购</div>-->
                    </div>

                </li>
                <li class="fast_sales_1_separator"></li>
            </ul>

            <form id="fm_4071" name="fm_4071" method="post" action="<?= Yii::$app->params['baseUrl'] ?>fastbuy-add-goods-fastbuy.html">
                <input type="hidden" name="goods[goods_id]" id="goods_4071_id1" value="">
                <input type="hidden" name="goods[goods_id]" id="goods_4071_id2" value="">
                <input type="hidden" name="goods[num]" id="num" value="1">
                <input type="hidden" name="goods[product_id]" id="product_4071_id1" value="">
                <input type="hidden" name="goods[product_id]" id="product_4071_id2" value="">
            </form>

            <script>
                function ljSubmit(goods_id, product_id)
                {
                    $('goods_4071_id1').setProperty('value', goods_id);
                    $('product_4071_id1').setProperty('value', product_id);

                    $('goods_4071_id2').setProperty('value', goods_id);
                    $('product_4071_id2').setProperty('value', product_id);

                    $('fm_4071').submit();
                }
            </script>
        </div>
    </div>
    <div> <div class="fast_sales_1">
            <ul>
                <li class="fast_sales_1_goods">

                    <div class="fast_sales_1_pic"><!-- 图片地址http://ecomgq-images.oss.aliyuncs.com/de/68/14/69288166834341752628f8600b5b23c4306.jpg?1429148144#h ||| -->
                        <a href="<?=Yii::$app->params['baseUrl']?>product-99.html">
                            <img src="<?= Yii::$app->params['baseimgUrl'] ?>3825129790efdab7ba3c502381789a1e760.jpg" width="562" height="359" border="0">
                        </a>

                        <!--
                        <div class="fast_sales_1_sold_out">
                            <div class="fast_sales_1_sold_out_circle">
                                <p>已抢光<br><span>SOLD OUT</span></p>
                            </div>
                        </div>
                        -->

                    </div>
                    <div class="fast_sales_1_right">
                        <!--
                            <div class="fast_sales_1_flag">
                                    <img src="../../themes/ftzmallold/images/fast_sales/fast_sales_flag_rb.jpg" width="62" height="42" />
                            </div>
                            <div class="fast_sales_1_company">
                                    <p>Japan</p>
                                <p>日本品牌</p>
                            </div>
                            <div class="fast_sales_1_time">
                                    <div class="fast_sales_1_clock"></div>
                                <div class="fast_sales_1_datetime">
                                    距离结束还剩 <span id="fast_sales_1_1_day">00</span> 天 <span id="fast_sales_1_1_hour">00</span> 时  <span id="fast_sales_1_1_min">00</span> 分
                                </div>
                            </div>
                        -->
                        <div class="fast_sales_1_name">比利时进口 哈姆雷特Hamlet 什锦巧克力红色礼盒</div>
                        <div class="fast_sales_1_desc">
                            <span>6.0折 /</span>
                            为了让你早日结束单身的时光，精心为你准备进口比利时哈姆雷特巧克力礼盒装，红红火火，有“它”的日子天天都是情人节。
                        </div>
                        <div class="fast_sales_1_price">
                            <span class="fast_sales_1_yen">¥</span>
                            <span class="fast_sales_1_rprice">119</span>
                            <span class="fast_sales_mprice">￥160.51</span>
                        </div>
                        <div class="fast_sales_1_cart">

                            <a href="<?=Yii::$app->params['baseUrl']?>product-99.html">
                                <div class="fast_sales_1_circle">
                                    <p>立即<br>抢购</p>
                                <!--<img src="../../themes/ftzmallold/images/fast_sales/fast_sales_white_cart.png" width="32" height="30" />-->
                                </div>
                            </a>


                            <!--
                            <div class="fast_sales_1_sold_out_circle">
                                <p>开售<br />提醒</p>
                            </div>
                            -->

                        </div>
                        <!--<div class="fast_sales_1_buy"><span>22251</span> 人一购买 限时限量抢购</div>-->
                    </div>

                </li>
                <li class="fast_sales_1_separator"></li>
            </ul>

            <form id="fm_4072" name="fm_4072" method="post" action="<?= Yii::$app->params['baseUrl'] ?>fastbuy-add-goods-fastbuy.html">
                <input type="hidden" name="goods[goods_id]" id="goods_4072_id1" value="">
                <input type="hidden" name="goods[goods_id]" id="goods_4072_id2" value="">
                <input type="hidden" name="goods[num]" id="num" value="1">
                <input type="hidden" name="goods[product_id]" id="product_4072_id1" value="">
                <input type="hidden" name="goods[product_id]" id="product_4072_id2" value="">
            </form>

            <script>
                function ljSubmit(goods_id, product_id)
                {
                    $('goods_4072_id1').setProperty('value', goods_id);
                    $('product_4072_id1').setProperty('value', product_id);

                    $('goods_4072_id2').setProperty('value', goods_id);
                    $('product_4072_id2').setProperty('value', product_id);

                    $('fm_4072').submit();
                }
            </script>
        </div>
    </div>
    <div> <div class="fast_sales_1">
            <ul>
                <li class="fast_sales_1_goods">

                    <div class="fast_sales_1_pic"><!-- 图片地址http://ecomgq-images.oss.aliyuncs.com/64/ed/ae/f77a968be9985beb697f3b017749b0fd54b.jpg?1429148233#h ||| -->
                        <a href="<?=Yii::$app->params['baseUrl']?>product-1494.html">
                            <img src="<?= Yii::$app->params['baseimgUrl'] ?>80760c2e1f14a61b583c7a2dd2399b3b3bc.jpg" width="562" height="359" border="0">
                        </a>

                        <!--
                        <div class="fast_sales_1_sold_out">
                            <div class="fast_sales_1_sold_out_circle">
                                <p>已抢光<br><span>SOLD OUT</span></p>
                            </div>
                        </div>
                        -->

                    </div>
                    <div class="fast_sales_1_right">
                        <!--
                            <div class="fast_sales_1_flag">
                                    <img src="../../themes/ftzmallold/images/fast_sales/fast_sales_flag_rb.jpg" width="62" height="42" />
                            </div>
                            <div class="fast_sales_1_company">
                                    <p>Japan</p>
                                <p>日本品牌</p>
                            </div>
                            <div class="fast_sales_1_time">
                                    <div class="fast_sales_1_clock"></div>
                                <div class="fast_sales_1_datetime">
                                    距离结束还剩 <span id="fast_sales_1_1_day">00</span> 天 <span id="fast_sales_1_1_hour">00</span> 时  <span id="fast_sales_1_1_min">00</span> 分
                                </div>
                            </div>
                        -->
                        <div class="fast_sales_1_name">中国台湾 自然素材蔓越莓葡萄干 320g </div>
                        <div class="fast_sales_1_desc">
                            <span>6.0折 /</span>
                            自然素材只给天然不给“负担”，健康、美味，由严选的天然生长素材制作而成，踏春旅途中不一样的美食，给你与众不同的营养；
                        </div>
                        <div class="fast_sales_1_price">
                            <span class="fast_sales_1_yen">¥</span>
                            <span class="fast_sales_1_rprice">48</span>
                            <span class="fast_sales_mprice">￥55.00</span>
                        </div>
                        <div class="fast_sales_1_cart">

                            <a href="<?=Yii::$app->params['baseUrl']?>product-1494.html">
                                <div class="fast_sales_1_circle">
                                    <p>立即<br>抢购</p>
                                <!--<img src="../../themes/ftzmallold/images/fast_sales/fast_sales_white_cart.png" width="32" height="30" />-->
                                </div>
                            </a>


                            <!--
                            <div class="fast_sales_1_sold_out_circle">
                                <p>开售<br />提醒</p>
                            </div>
                            -->

                        </div>
                        <!--<div class="fast_sales_1_buy"><span>22251</span> 人一购买 限时限量抢购</div>-->
                    </div>

                </li>
                <li class="fast_sales_1_separator"></li>
            </ul>

            <form id="fm_4073" name="fm_4073" method="post" action="<?= Yii::$app->params['baseUrl'] ?>fastbuy-add-goods-fastbuy.html">
                <input type="hidden" name="goods[goods_id]" id="goods_4073_id1" value="">
                <input type="hidden" name="goods[goods_id]" id="goods_4073_id2" value="">
                <input type="hidden" name="goods[num]" id="num" value="1">
                <input type="hidden" name="goods[product_id]" id="product_4073_id1" value="">
                <input type="hidden" name="goods[product_id]" id="product_4073_id2" value="">
            </form>

            <script>
                function ljSubmit(goods_id, product_id)
                {
                    $('goods_4073_id1').setProperty('value', goods_id);
                    $('product_4073_id1').setProperty('value', product_id);

                    $('goods_4073_id2').setProperty('value', goods_id);
                    $('product_4073_id2').setProperty('value', product_id);

                    $('fm_4073').submit();
                }
            </script>
        </div>
    </div>
    <div style="z-index:2">
        <div class="fast_sales_2">
            <ul>


                <li class="fast_sales_2_goods">
                    <!--
                            <div class="fast_sales_2_title"><!-- 图片地址http:http://ecomgq-images.oss.aliyuncs.com/dd/de/b4/d87583f47e63297a0c2a9799dd5790a1b9b.jpg?1429166453#h- ->
                            <img src="../../themes/ftzmallold/images/fast_sales/fast_sales_flag_mg.jpg" width="62" height="42" />
                            <p>美国直供上海自贸区保税仓发货</p>
                        </div>
                    -->
                    <div class="fast_sales_2_pic">
                        <a href="<?=Yii::$app->params['baseUrl']?>product-1448.html">
                            <img src="<?= Yii::$app->params['baseimgUrl'] ?>d87583f47e63297a0c2a9799dd5790a1b9b.jpg" width="322" height="321" border="0">
                        </a>
                        <!-- 已售完，请加上下面到代码 
                        <div class="fast_sales_2_sold_out">
                                <p>已抢光<br><span>SOLD OUT</span></p>
                        </div>
                        -->
                    </div>
                    <div class="fast_sales_2_bottom"><!--
                        <p class="fast_sales_2_bottom_time">抢光于 : 
                                <span id="fast_sales_2_bottom_time_day_id">今</span> 天
                            <span id="fast_sales_2_bottom_time_hour_id">17</span> 时
                            <span id="fast_sales_2_bottom_time_min_id">25</span> 分
                            <span id="fast_sales_2_bottom_time_sec_id">45</span> 秒
                        </p>
                        <p class="fast_sales_2_bottom_time">距离结束还剩: 
                                <span id="fast_sales_2_bottom_time_day_id">00</span> 天
                            <span id="fast_sales_2_bottom_time_hour_id">17</span> 时
                            <span id="fast_sales_2_bottom_time_min_id">25</span> 分
                            <span id="fast_sales_2_bottom_time_sec_id">45</span> 秒
                        </p>-->
                        <p class="fast_sales_2_bottom_name"><span>5.6折/包邮</span>俄罗斯 特大牡丹虾 大于100g/对</p>
                        <p class="fast_sales_2_bottom_price">
                            <span class="fast_sales_2_bottom_yen">¥</span>
                            <span class="fast_sales_2_bottom_rprice">88</span>
                            <span class="fast_sales_2_bottom_mprice">国内参考价: ¥￥158.00</span>
                        </p>
                        <!--
                        <p class="fast_sales_2_people"><span>2258</span> 人已购买</p>
                        -->
                        <!--未售完 请加上下面的代码<?=Yii::$app->params['baseUrl']?>product-1448.html-->
                        <a href="<?=Yii::$app->params['baseUrl']?>product-1451.html">
                            <div class="fast_sales_2_bottom_cart">
                                <p>立即<br>抢购</p>
                               <!-- <img src="../../themes/ftzmallold/images/fast_sales/fast_sales_white_cart.png" width="32" height="30" />-->
                            </div>
                        </a>

                        <!--已售完，请加上下面到代码 
                        <div class="fast_sales_2_bottom_sold_out">
                            <p>开售<br />提醒</p>
                        </div>
                        -->
                    </div>
                </li>
                <li class="fast_sales_2_separator"></li>


                <li class="fast_sales_2_goods">
                    <!--<div class="fast_sales_2_title"><!-- 图片地址http:http://ecomgq-images.oss.aliyuncs.com/23/c7/f2/cef995a35f6b4c6f69f461228f379b77d78.jpg?1429166255#h -- >
                    <img src="../../themes/ftzmallold/images/fast_sales/fast_sales_flag_mg.jpg" width="62" height="42" />
                    <p>美国直供上海自贸区保税仓发货</p>
                </div>-->
                    <div class="fast_sales_2_pic">
                        <a href="<?=Yii::$app->params['baseUrl']?>product-1450.html">
                            <img src="<?= Yii::$app->params['baseimgUrl'] ?>cef995a35f6b4c6f69f461228f379b77d78.jpg" width="322" height="321" border="0">
                        </a>
                        <!-- 已售完，请加上下面到代码 
                        <div class="fast_sales_2_sold_out">
                                <p>已抢光<br><span>SOLD OUT</span></p>
                        </div>
                        -->
                    </div>
                    <div class="fast_sales_2_bottom"><!--
                        <p class="fast_sales_2_bottom_time">抢光于 : 
                                <span id="fast_sales_2_bottom_time_day_id">今</span> 天
                            <span id="fast_sales_2_bottom_time_hour_id">17</span> 时
                            <span id="fast_sales_2_bottom_time_min_id">25</span> 分
                            <span id="fast_sales_2_bottom_time_sec_id">45</span> 秒
                        </p>
                        <p class="fast_sales_2_bottom_time">距离结束还剩: 
                                <span id="fast_sales_2_bottom_time_day_id">00</span> 天
                            <span id="fast_sales_2_bottom_time_hour_id">17</span> 时
                            <span id="fast_sales_2_bottom_time_min_id">25</span> 分
                            <span id="fast_sales_2_bottom_time_sec_id">45</span> 秒
                        </p>-->
                        <p class="fast_sales_2_bottom_name"><span>7折/包邮</span>刺身优惠二 海鲜组合 450±20g/4盒</p>
                        <p class="fast_sales_2_bottom_price">
                            <span class="fast_sales_2_bottom_yen">¥</span>
                            <span class="fast_sales_2_bottom_rprice">138</span>
                            <span class="fast_sales_2_bottom_mprice">国内参考价: ¥￥196.00</span>
                        </p>
                        <!-- <p class="fast_sales_2_people"><span>2258</span> 人已购买</p> -->

                        <a href="<?=Yii::$app->params['baseUrl']?>product-1451.html">
                            <div class="fast_sales_2_bottom_cart">
                                <p>立即<br>抢购</p>
                               <!-- <img src="../../themes/ftzmallold/images/fast_sales/fast_sales_white_cart.png" width="32" height="30" /> -->
                            </div>
                        </a>

                        <!--已售完，请加上下面到代码 
                        <div class="fast_sales_2_bottom_sold_out">
                            <p>开售<br />提醒</p>
                        </div>
                        -->
                    </div>
                </li>
                <li class="fast_sales_2_separator"></li>
                <li class="fast_sales_2_goods">
                    <!--
                            <div class="fast_sales_2_title"><!-- 图片地址http:http://ecomgq-images.oss.aliyuncs.com/f3/5e/b4/2cba92dc29deacd22f95799fcc201277087.jpg?1429166391#h- ->
                            <img src="../../themes/ftzmallold/images/fast_sales/fast_sales_flag_mg.jpg" width="62" height="42" />
                            <p>美国直供上海自贸区保税仓发货</p>
                        </div>
                    -->
                    <div class="fast_sales_2_pic">
                        <a href="<?=Yii::$app->params['baseUrl']?>product-1451.html">
                            <img src="<?= Yii::$app->params['baseimgUrl'] ?>2cba92dc29deacd22f95799fcc201277087.jpg" width="322" height="321" border="0">
                        </a>
                        <!-- 已售完，请加上下面到代码 
                        <div class="fast_sales_2_sold_out">
                                <p>已抢光<br><span>SOLD OUT</span></p>
                        </div>
                        -->
                    </div>
                    <div class="fast_sales_2_bottom"><!--
                        <p class="fast_sales_2_bottom_time">抢光于 : 
                                <span id="fast_sales_2_bottom_time_day_id">今</span> 天
                            <span id="fast_sales_2_bottom_time_hour_id">17</span> 时
                            <span id="fast_sales_2_bottom_time_min_id">25</span> 分
                            <span id="fast_sales_2_bottom_time_sec_id">45</span> 秒
                        </p>
                        <p class="fast_sales_2_bottom_time">距离结束还剩: 
                                <span id="fast_sales_2_bottom_time_day_id">00</span> 天
                            <span id="fast_sales_2_bottom_time_hour_id">17</span> 时
                            <span id="fast_sales_2_bottom_time_min_id">25</span> 分
                            <span id="fast_sales_2_bottom_time_sec_id">45</span> 秒
                        </p>-->
                        <p class="fast_sales_2_bottom_name"><span>6.9折/包邮</span>刺身优惠三 海鲜拼盘 550±10g/拼盘</p>
                        <p class="fast_sales_2_bottom_price">
                            <span class="fast_sales_2_bottom_yen">¥</span>
                            <span class="fast_sales_2_bottom_rprice">168</span>
                            <span class="fast_sales_2_bottom_mprice">国内参考价: ¥￥244.00</span>
                        </p>
                        <!--<p class="fast_sales_2_people"><span>2258</span> 人已购买</p>-->

                        <a href="<?=Yii::$app->params['baseUrl']?>product-1451.html')">
                            <div class="fast_sales_2_bottom_cart">
                                <p>立即<br>抢购</p>
                                    <!-- <img src="../../themes/ftzmallold/images/fast_sales/fast_sales_white_cart.png" width="32" height="30" /> -->
                            </div>
                        </a>

                        <!--已售完，请加上下面到代码 
                        <div class="fast_sales_2_bottom_sold_out">
                            <p>开售<br />提醒</p>
                        </div>
                        -->
                    </div>
                </li><li>


                </li><li class="fast_sales_2_row_separator"></li> 

            </ul>
            <form id="fm_4074" name="fm_4074" method="post" action="<?= Yii::$app->params['baseUrl'] ?>fastbuy-addCheck-goods.html" target="frm_4074">
                <input type="hidden" name="goods[goods_id]" id="goods_4074_id1" value="">
                <input type="hidden" name="goods[goods_id]" id="goods_4074_id2" value="">
                <input type="hidden" name="goods[num]" id="num" value="1">
                <input type="hidden" name="goods[product_id]" id="product_4074_id1" value="">
                <input type="hidden" name="goods[product_id]" id="product_4074_id2" value="">
            </form>
            <iframe height="0" width="0" id="frm_4074" name="frm_4074"></iframe>
            <script>
                function ljSubmit(goods_id, product_id)
                {
                    $('goods_4074_id1').setProperty('value', goods_id);
                    $('product_4074_id1').setProperty('value', product_id);

                    $('goods_4074_id2').setProperty('value', goods_id);
                    $('product_4074_id2').setProperty('value', product_id);

                    $('fm_4074').submit();
                    $('fm_4074').setProperty('action', '/fastbuy-checkout-goods.html');
                    $('fm_4074').setProperty('target', 'parent');
                    $('fm_4074').submit();
                }
            </script>
        </div>
    </div>
    <div style="z-index:5;float:left;">
        <div class="fast_sales_2">
            <ul>


                <li class="fast_sales_2_goods">
                    <!--
                            <div class="fast_sales_2_title"><!-- 图片地址http:http://ecomgq-images.oss.aliyuncs.com/49/f7/62/23993c7fbcd5489fc7c13a687e222f950d0.jpg?1429168783#h- ->
                            <img src="../../themes/ftzmallold/images/fast_sales/fast_sales_flag_mg.jpg" width="62" height="42" />
                            <p>美国直供上海自贸区保税仓发货</p>
                        </div>
                    -->
                    <div class="fast_sales_2_pic">
                        <a href="<?=Yii::$app->params['baseUrl']?>product-1493.html">
                            <img src="<?= Yii::$app->params['baseimgUrl'] ?>23993c7fbcd5489fc7c13a687e222f950d0.jpg" width="322" height="321" border="0">
                        </a>
                        <!-- 已售完，请加上下面到代码 
                        <div class="fast_sales_2_sold_out">
                                <p>已抢光<br><span>SOLD OUT</span></p>
                        </div>
                        -->
                    </div>
                    <div class="fast_sales_2_bottom"><!--
                        <p class="fast_sales_2_bottom_time">抢光于 : 
                                <span id="fast_sales_2_bottom_time_day_id">今</span> 天
                            <span id="fast_sales_2_bottom_time_hour_id">17</span> 时
                            <span id="fast_sales_2_bottom_time_min_id">25</span> 分
                            <span id="fast_sales_2_bottom_time_sec_id">45</span> 秒
                        </p>
                        <p class="fast_sales_2_bottom_time">距离结束还剩: 
                                <span id="fast_sales_2_bottom_time_day_id">00</span> 天
                            <span id="fast_sales_2_bottom_time_hour_id">17</span> 时
                            <span id="fast_sales_2_bottom_time_min_id">25</span> 分
                            <span id="fast_sales_2_bottom_time_sec_id">45</span> 秒
                        </p>-->
                        <p class="fast_sales_2_bottom_name"><span>8.3折/包邮</span>中国台湾 自然素材无籽原味葡萄干 320g</p>
                        <p class="fast_sales_2_bottom_price">
                            <span class="fast_sales_2_bottom_yen">¥</span>
                            <span class="fast_sales_2_bottom_rprice">36</span>
                            <span class="fast_sales_2_bottom_mprice">国内参考价: ¥￥43.20</span>
                        </p>
                        <!--
                        <p class="fast_sales_2_people"><span>2258</span> 人已购买</p>
                        -->
                        <!--未售完 请加上下面的代码<?=Yii::$app->params['baseUrl']?>product-1493.html-->
                        <a href="<?=Yii::$app->params['baseUrl']?>product-1112.html">
                            <div class="fast_sales_2_bottom_cart">
                                <p>立即<br>抢购</p>
                               <!-- <img src="../../themes/ftzmallold/images/fast_sales/fast_sales_white_cart.png" width="32" height="30" />-->
                            </div>
                        </a>

                        <!--已售完，请加上下面到代码 
                        <div class="fast_sales_2_bottom_sold_out">
                            <p>开售<br />提醒</p>
                        </div>
                        -->
                    </div>
                </li>
                <li class="fast_sales_2_separator"></li>


                <li class="fast_sales_2_goods">
                    <!--<div class="fast_sales_2_title"><!-- 图片地址http:http://ecomgq-images.oss.aliyuncs.com/9f/e1/25/84e5869bce7805876ab656fb56d9694f942.jpg?1429168793#h -- >
                    <img src="../../themes/ftzmallold/images/fast_sales/fast_sales_flag_mg.jpg" width="62" height="42" />
                    <p>美国直供上海自贸区保税仓发货</p>
                </div>-->
                    <div class="fast_sales_2_pic">
                        <a href="<?=Yii::$app->params['baseUrl']?>product-1367.html">
                            <img src="<?= Yii::$app->params['baseimgUrl'] ?>84e5869bce7805876ab656fb56d9694f942.jpg" width="322" height="321" border="0">
                        </a>
                        <!-- 已售完，请加上下面到代码 
                        <div class="fast_sales_2_sold_out">
                                <p>已抢光<br><span>SOLD OUT</span></p>
                        </div>
                        -->
                    </div>
                    <div class="fast_sales_2_bottom"><!--
                        <p class="fast_sales_2_bottom_time">抢光于 : 
                                <span id="fast_sales_2_bottom_time_day_id">今</span> 天
                            <span id="fast_sales_2_bottom_time_hour_id">17</span> 时
                            <span id="fast_sales_2_bottom_time_min_id">25</span> 分
                            <span id="fast_sales_2_bottom_time_sec_id">45</span> 秒
                        </p>
                        <p class="fast_sales_2_bottom_time">距离结束还剩: 
                                <span id="fast_sales_2_bottom_time_day_id">00</span> 天
                            <span id="fast_sales_2_bottom_time_hour_id">17</span> 时
                            <span id="fast_sales_2_bottom_time_min_id">25</span> 分
                            <span id="fast_sales_2_bottom_time_sec_id">45</span> 秒
                        </p>-->
                        <p class="fast_sales_2_bottom_name"><span>8.3折/包邮</span>东园 盐焗夏威夷果 150克</p>
                        <p class="fast_sales_2_bottom_price">
                            <span class="fast_sales_2_bottom_yen">¥</span>
                            <span class="fast_sales_2_bottom_rprice">46.8</span>
                            <span class="fast_sales_2_bottom_mprice">国内参考价: ¥￥56.16</span>
                        </p>
                        <!-- <p class="fast_sales_2_people"><span>2258</span> 人已购买</p> -->

                        <a href="<?=Yii::$app->params['baseUrl']?>product-1112.html">
                            <div class="fast_sales_2_bottom_cart">
                                <p>立即<br>抢购</p>
                               <!-- <img src="../../themes/ftzmallold/images/fast_sales/fast_sales_white_cart.png" width="32" height="30" /> -->
                            </div>
                        </a>

                        <!--已售完，请加上下面到代码 
                        <div class="fast_sales_2_bottom_sold_out">
                            <p>开售<br />提醒</p>
                        </div>
                        -->
                    </div>
                </li>
                <li class="fast_sales_2_separator"></li>
                <li class="fast_sales_2_goods">
                    <!--
                            <div class="fast_sales_2_title"><!-- 图片地址http:http://ecomgq-images.oss.aliyuncs.com/5e/6a/c6/d359acad5fb07a0184ebc4c4f72d701eadf.jpg?1429168814#h- ->
                            <img src="../../themes/ftzmallold/images/fast_sales/fast_sales_flag_mg.jpg" width="62" height="42" />
                            <p>美国直供上海自贸区保税仓发货</p>
                        </div>
                    -->
                    <div class="fast_sales_2_pic">
                        <a href="<?=Yii::$app->params['baseUrl']?>product-1112.html">
                            <img src="<?= Yii::$app->params['baseimgUrl'] ?>d359acad5fb07a0184ebc4c4f72d701eadf.jpg" width="322" height="321" border="0">
                        </a>
                        <!-- 已售完，请加上下面到代码 
                        <div class="fast_sales_2_sold_out">
                                <p>已抢光<br><span>SOLD OUT</span></p>
                        </div>
                        -->
                    </div>
                    <div class="fast_sales_2_bottom"><!--
                        <p class="fast_sales_2_bottom_time">抢光于 : 
                                <span id="fast_sales_2_bottom_time_day_id">今</span> 天
                            <span id="fast_sales_2_bottom_time_hour_id">17</span> 时
                            <span id="fast_sales_2_bottom_time_min_id">25</span> 分
                            <span id="fast_sales_2_bottom_time_sec_id">45</span> 秒
                        </p>
                        <p class="fast_sales_2_bottom_time">距离结束还剩: 
                                <span id="fast_sales_2_bottom_time_day_id">00</span> 天
                            <span id="fast_sales_2_bottom_time_hour_id">17</span> 时
                            <span id="fast_sales_2_bottom_time_min_id">25</span> 分
                            <span id="fast_sales_2_bottom_time_sec_id">45</span> 秒
                        </p>-->
                        <p class="fast_sales_2_bottom_name"><span>6.3折/包邮</span>泰国 素玛哥香脆榴梿干 88克</p>
                        <p class="fast_sales_2_bottom_price">
                            <span class="fast_sales_2_bottom_yen">¥</span>
                            <span class="fast_sales_2_bottom_rprice">49</span>
                            <span class="fast_sales_2_bottom_mprice">国内参考价: ¥￥78.00</span>
                        </p>
                        <!--<p class="fast_sales_2_people"><span>2258</span> 人已购买</p>-->

                        <a href="<?=Yii::$app->params['baseUrl']?>product-1112.html')">
                            <div class="fast_sales_2_bottom_cart">
                                <p>立即<br>抢购</p>
                                    <!-- <img src="../../themes/ftzmallold/images/fast_sales/fast_sales_white_cart.png" width="32" height="30" /> -->
                            </div>
                        </a>

                        <!--已售完，请加上下面到代码 
                        <div class="fast_sales_2_bottom_sold_out">
                            <p>开售<br />提醒</p>
                        </div>
                        -->
                    </div>
                </li><li>


                </li><li class="fast_sales_2_row_separator"></li> 

            </ul>
            <form id="fm_4075" name="fm_4075" method="post" action="<?= Yii::$app->params['baseUrl'] ?>fastbuy-addCheck-goods.html" target="frm_4075">
                <input type="hidden" name="goods[goods_id]" id="goods_4075_id1" value="">
                <input type="hidden" name="goods[goods_id]" id="goods_4075_id2" value="">
                <input type="hidden" name="goods[num]" id="num" value="1">
                <input type="hidden" name="goods[product_id]" id="product_4075_id1" value="">
                <input type="hidden" name="goods[product_id]" id="product_4075_id2" value="">
            </form>
            <iframe height="0" width="0" id="frm_4075" name="frm_4075"></iframe>
            <script>
                function ljSubmit(goods_id, product_id)
                {
                    $('goods_4075_id1').setProperty('value', goods_id);
                    $('product_4075_id1').setProperty('value', product_id);

                    $('goods_4075_id2').setProperty('value', goods_id);
                    $('product_4075_id2').setProperty('value', product_id);

                    $('fm_4075').submit();
                    $('fm_4075').setProperty('action', '/fastbuy-checkout-goods.html');
                    $('fm_4075').setProperty('target', 'parent');
                    $('fm_4075').submit();
                }
            </script>
        </div>
    </div>
    <div style="z-index:7;float:left;">
        <div class="fast_sales_2">
            <ul>


                <li class="fast_sales_2_goods">
                    <!--
                            <div class="fast_sales_2_title"><!-- 图片地址http:http://ecomgq-images.oss.aliyuncs.com/64/4e/09/9b4c31e3430550e49e0814373f24a1c8d09.jpg?1429168896#h- ->
                            <img src="../../themes/ftzmallold/images/fast_sales/fast_sales_flag_mg.jpg" width="62" height="42" />
                            <p>美国直供上海自贸区保税仓发货</p>
                        </div>
                    -->
                    <div class="fast_sales_2_pic">
                        <a href="<?=Yii::$app->params['baseUrl']?>product-428.html">
                            <img src="<?= Yii::$app->params['baseimgUrl'] ?>9b4c31e3430550e49e0814373f24a1c8d09.jpg" width="322" height="321" border="0">
                        </a>
                        <!-- 已售完，请加上下面到代码 
                        <div class="fast_sales_2_sold_out">
                                <p>已抢光<br><span>SOLD OUT</span></p>
                        </div>
                        -->
                    </div>
                    <div class="fast_sales_2_bottom"><!--
                        <p class="fast_sales_2_bottom_time">抢光于 : 
                                <span id="fast_sales_2_bottom_time_day_id">今</span> 天
                            <span id="fast_sales_2_bottom_time_hour_id">17</span> 时
                            <span id="fast_sales_2_bottom_time_min_id">25</span> 分
                            <span id="fast_sales_2_bottom_time_sec_id">45</span> 秒
                        </p>
                        <p class="fast_sales_2_bottom_time">距离结束还剩: 
                                <span id="fast_sales_2_bottom_time_day_id">00</span> 天
                            <span id="fast_sales_2_bottom_time_hour_id">17</span> 时
                            <span id="fast_sales_2_bottom_time_min_id">25</span> 分
                            <span id="fast_sales_2_bottom_time_sec_id">45</span> 秒
                        </p>-->
                        <p class="fast_sales_2_bottom_name"><span>6.3折/包邮</span>德国 格兰特经典咖啡 200g </p>
                        <p class="fast_sales_2_bottom_price">
                            <span class="fast_sales_2_bottom_yen">¥</span>
                            <span class="fast_sales_2_bottom_rprice">68</span>
                            <span class="fast_sales_2_bottom_mprice">国内参考价: ¥￥108.00</span>
                        </p>
                        <!--
                        <p class="fast_sales_2_people"><span>2258</span> 人已购买</p>
                        -->
                        <!--未售完 请加上下面的代码<?=Yii::$app->params['baseUrl']?>product-428.html-->
                        <a href="<?=Yii::$app->params['baseUrl']?>product-1407.html">
                            <div class="fast_sales_2_bottom_cart">
                                <p>立即<br>抢购</p>
                               <!-- <img src="../../themes/ftzmallold/images/fast_sales/fast_sales_white_cart.png" width="32" height="30" />-->
                            </div>
                        </a>

                        <!--已售完，请加上下面到代码 
                        <div class="fast_sales_2_bottom_sold_out">
                            <p>开售<br />提醒</p>
                        </div>
                        -->
                    </div>
                </li>
                <li class="fast_sales_2_separator"></li>


                <li class="fast_sales_2_goods">
                    <!--<div class="fast_sales_2_title"><!-- 图片地址http:http://ecomgq-images.oss.aliyuncs.com/2d/5a/2c/6f72d5f955b3f48e42e804369ffed4816b4.jpg?1429168910#h -- >
                    <img src="../../themes/ftzmallold/images/fast_sales/fast_sales_flag_mg.jpg" width="62" height="42" />
                    <p>美国直供上海自贸区保税仓发货</p>
                </div>-->
                    <div class="fast_sales_2_pic">
                        <a href="<?=Yii::$app->params['baseUrl']?>product-311.html">
                            <img src="<?= Yii::$app->params['baseimgUrl'] ?>6f72d5f955b3f48e42e804369ffed4816b4.jpg" width="322" height="321" border="0">
                        </a>
                        <!-- 已售完，请加上下面到代码 
                        <div class="fast_sales_2_sold_out">
                                <p>已抢光<br><span>SOLD OUT</span></p>
                        </div>
                        -->
                    </div>
                    <div class="fast_sales_2_bottom"><!--
                        <p class="fast_sales_2_bottom_time">抢光于 : 
                                <span id="fast_sales_2_bottom_time_day_id">今</span> 天
                            <span id="fast_sales_2_bottom_time_hour_id">17</span> 时
                            <span id="fast_sales_2_bottom_time_min_id">25</span> 分
                            <span id="fast_sales_2_bottom_time_sec_id">45</span> 秒
                        </p>
                        <p class="fast_sales_2_bottom_time">距离结束还剩: 
                                <span id="fast_sales_2_bottom_time_day_id">00</span> 天
                            <span id="fast_sales_2_bottom_time_hour_id">17</span> 时
                            <span id="fast_sales_2_bottom_time_min_id">25</span> 分
                            <span id="fast_sales_2_bottom_time_sec_id">45</span> 秒
                        </p>-->
                        <p class="fast_sales_2_bottom_name"><span>6.3折/包邮</span>哈迈士D24榴莲酱夹心 80%黑巧克力138g</p>
                        <p class="fast_sales_2_bottom_price">
                            <span class="fast_sales_2_bottom_yen">¥</span>
                            <span class="fast_sales_2_bottom_rprice">66</span>
                            <span class="fast_sales_2_bottom_mprice">国内参考价: ¥￥105.60</span>
                        </p>
                        <!-- <p class="fast_sales_2_people"><span>2258</span> 人已购买</p> -->

                        <a href="<?=Yii::$app->params['baseUrl']?>product-1407.html">
                            <div class="fast_sales_2_bottom_cart">
                                <p>立即<br>抢购</p>
                               <!-- <img src="../../themes/ftzmallold/images/fast_sales/fast_sales_white_cart.png" width="32" height="30" /> -->
                            </div>
                        </a>

                        <!--已售完，请加上下面到代码 
                        <div class="fast_sales_2_bottom_sold_out">
                            <p>开售<br />提醒</p>
                        </div>
                        -->
                    </div>
                </li>
                <li class="fast_sales_2_separator"></li>
                <li class="fast_sales_2_goods">
                    <!--
                            <div class="fast_sales_2_title"><!-- 图片地址http:http://ecomgq-images.oss.aliyuncs.com/33/0d/53/5f7603dd27619cd9454de24c7e1a02c5923.jpg?1429168920#h- ->
                            <img src="../../themes/ftzmallold/images/fast_sales/fast_sales_flag_mg.jpg" width="62" height="42" />
                            <p>美国直供上海自贸区保税仓发货</p>
                        </div>
                    -->
                    <div class="fast_sales_2_pic">
                        <a href="<?=Yii::$app->params['baseUrl']?>product-1407.html">
                            <img src="<?= Yii::$app->params['baseimgUrl'] ?>5f7603dd27619cd9454de24c7e1a02c5923.jpg" width="322" height="321" border="0">
                        </a>
                        <!-- 已售完，请加上下面到代码 
                        <div class="fast_sales_2_sold_out">
                                <p>已抢光<br><span>SOLD OUT</span></p>
                        </div>
                        -->
                    </div>
                    <div class="fast_sales_2_bottom"><!--
                        <p class="fast_sales_2_bottom_time">抢光于 : 
                                <span id="fast_sales_2_bottom_time_day_id">今</span> 天
                            <span id="fast_sales_2_bottom_time_hour_id">17</span> 时
                            <span id="fast_sales_2_bottom_time_min_id">25</span> 分
                            <span id="fast_sales_2_bottom_time_sec_id">45</span> 秒
                        </p>
                        <p class="fast_sales_2_bottom_time">距离结束还剩: 
                                <span id="fast_sales_2_bottom_time_day_id">00</span> 天
                            <span id="fast_sales_2_bottom_time_hour_id">17</span> 时
                            <span id="fast_sales_2_bottom_time_min_id">25</span> 分
                            <span id="fast_sales_2_bottom_time_sec_id">45</span> 秒
                        </p>-->
                        <p class="fast_sales_2_bottom_name"><span>6.2折/包邮</span>日本 柳屋杏果护发油 60ml</p>
                        <p class="fast_sales_2_bottom_price">
                            <span class="fast_sales_2_bottom_yen">¥</span>
                            <span class="fast_sales_2_bottom_rprice">109</span>
                            <span class="fast_sales_2_bottom_mprice">国内参考价: ¥￥175.00</span>
                        </p>
                        <!--<p class="fast_sales_2_people"><span>2258</span> 人已购买</p>-->

                        <a href="<?=Yii::$app->params['baseUrl']?>product-1407.html')">
                            <div class="fast_sales_2_bottom_cart">
                                <p>立即<br>抢购</p>
                                    <!-- <img src="../../themes/ftzmallold/images/fast_sales/fast_sales_white_cart.png" width="32" height="30" /> -->
                            </div>
                        </a>

                        <!--已售完，请加上下面到代码 
                        <div class="fast_sales_2_bottom_sold_out">
                            <p>开售<br />提醒</p>
                        </div>
                        -->
                    </div>
                </li><li>


                </li><li class="fast_sales_2_row_separator"></li> 

            </ul>
            <form id="fm_4076" name="fm_4076" method="post" action="<?= Yii::$app->params['baseUrl'] ?>fastbuy-addCheck-goods.html" target="frm_4076">
                <input type="hidden" name="goods[goods_id]" id="goods_4076_id1" value="">
                <input type="hidden" name="goods[goods_id]" id="goods_4076_id2" value="">
                <input type="hidden" name="goods[num]" id="num" value="1">
                <input type="hidden" name="goods[product_id]" id="product_4076_id1" value="">
                <input type="hidden" name="goods[product_id]" id="product_4076_id2" value="">
            </form>
            <iframe height="0" width="0" id="frm_4076" name="frm_4076"></iframe>
            <script>
                function ljSubmit(goods_id, product_id)
                {
                    $('goods_4076_id1').setProperty('value', goods_id);
                    $('product_4076_id1').setProperty('value', product_id);

                    $('goods_4076_id2').setProperty('value', goods_id);
                    $('product_4076_id2').setProperty('value', product_id);

                    $('fm_4076').submit();
                    $('fm_4076').setProperty('action', '/fastbuy-checkout-goods.html');
                    $('fm_4076').setProperty('target', 'parent');
                    $('fm_4076').submit();
                }
            </script>
        </div>
    </div>
</div>

