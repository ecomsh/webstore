<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '浏览历史_上海外高桥进口商品网';
?>

<div class="header-wrap">
    <div class="menu ppsc-main-menu clb">
        <div class="w1200 clearfix">
            <!--  <div class="span-auto catalog-main  " id="catalog_main"> -->
            <div class="span-auto catalog-main" id="catalog_main"></div>
            <div class="span-auto nav_main">
                <ul class="clb js_menu_4021">
                    <li class="js_menu_1">
                        <a href="<?= Yii::$app->params['baseUrl'] ?>index.php">首页</a>
                        <!-- <a class="menu_index" href="<?= Yii::$app->params['baseUrl'] ?>index.php" >首页</a> -->

                    </li>
                    <li class="js_menu_1">
                        <a href="<?= Yii::$app->params['baseUrl'] ?>bksg.html">爆款闪购</a>
                        <!-- <a class="menu_index" href="<?= Yii::$app->params['baseUrl'] ?>bksg.html" >爆款闪购</a> -->

                    </li>
                    <li class="js_menu_1">
                        <a href="<?= Yii::$app->params['baseUrl'] ?>article-huodongzhuanqu-218.html">海外直邮</a>
                        <!-- <a class="menu_index" href="<?= Yii::$app->params['baseUrl'] ?>article-huodongzhuanqu-218.html" >海外直邮</a> -->

                    </li>
                </ul>

                <script>
                    $ES('.js_menu_1').each(function(item, index) {
                        item.addEvent('mouseenter', function() {
                            if (item.getElement('.js_menu_2')) {
                                item.getElement('.js_menu_2').setStyle('display', '');
                            }
                        });

                        item.addEvent('mouseleave', function() {
                            if (item.getElement('.js_menu_2')) {
                                item.getElement('.js_menu_2').setStyle('display', 'none');
                            }
                        });

                    });

                    $ES('.js_menu_2').each(function(item, index) {
                        item.getElements('.js_menu_2e').each(function(item2, index2) {
                            item2.addEvent('mouseenter', function() {
                                if (item2.getElement('.js_menu_3')) {
                                    item2.getElement('.js_menu_3').setStyle('display', '');
                                }
                            });

                            item2.addEvent('mouseleave', function() {
                                if (item2.getElement('.js_menu_3')) {
                                    item2.getElement('.js_menu_3').setStyle('display', 'none');
                                }
                            });

                        });
                    });

                    if ($('index_menu_more_4021')) {

                        $('index_menu_more_4021').addEvent('mouseenter', function() {
                            $('index_menu_more_view_4021').setStyle('display', '');
                        });
                        $('index_menu_more_4021').addEvent('mouseleave', function() {
                            $('index_menu_more_view_4021').setStyle('display', 'none');
                        });
                    }


                    window.addEvent('domready', function() {
                        var hrf = location.href.split('/').getLast(), n = hrf.lastIndexOf('-'),
                                menulist = $$('.js_menu_4021 li');

                        //if(n>-1)hrf=hrf.substring(0,n);
                        if (!hrf.trim().length)
                            hrf = 'index.html';

                        var reg = new RegExp('\/' + hrf, 'i');
                        menulist.each(function(el) {
                            var link = el.getElement('a');
                            if (link && link.href.test(reg))
                                el.addClass('menu_index');

                        });

                    });

                </script>
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
            $('right_bar_user_info').setHTML(' <div class="right_cart_show_box_close" onclick="$(\'right_bar_user_info\').setStyle(\'display\',\'none\')">&times;</div><img src="themes/simple/images/right_bar_account_03.jpg" width="67" height="65" /><p class="userp">您好！ 请 <a href="passport-login.html"><span style="color:#ff4b00">登录</span></a> | <a href="passport-signup.html"><span style="color:#ff4b00">注册</span></a> </p><ul><li class="right_bar_account_order"><a href="member-orders.html"><img src="themes/simple/images/right_bar_account_11.png" width="23" height="30" /></a><p><a href="member-orders.html">我的订单</a></p></li><li class="right_bar_account_separator"><div class="right_bar_account_line"></div></li><li class="right_bar_account_mail"><div class="right_bar_mail_number" style="display:none"><p></p></div><a href="msg-my_msg.html"><img style="margin:25px 0 0 0;" src="themes/simple/images/right_bar_account_14.png" width="29" height="21" /></a><p><a href="msg-my_msg.html">我的消息</a></p></li></ul>');
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
<div class="main w1200">
    <div class="mTB">
        <div class="memberwrap">
            <!-- title-->
            <!-- title-->
            <div class="clearfix">
                <!-- left-->
                <div style="width: 210px;" class="member-sidebar">
                    <div class="member-menu">
                        <h2 class="left_top">会员中心</h2>
                        <ul class="body">
                            <input value="" type="hidden">
                            <li class="member-menu-list">
                                <div class="list-title-bg noborder">
                                    <h2 class="list-title-icon m-0">我的收藏夹</h2></div>
                                <ul>
                                    <li>
                                        <a href="<?= Yii::$app->params['baseUrl'] ?>member-favorite.html">商品收藏</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->params['baseUrl'] ?>favorite-sfavorite.html">店铺收藏</a>
                                    </li>
                                </ul>
                            </li>
                            <input value="1" type="hidden">
                            <li class="member-menu-list">
                                <div class="list-title-bg">
                                    <h2 class="list-title-icon m-0">我的咨询</h2></div>
                                <ul>
                                    <li>
                                        <a href="<?= Yii::$app->params['baseUrl'] ?>member-comment.html">我的评论</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->params['baseUrl'] ?>member-ask.html">我的咨询</a>
                                    </li>
                                    <li class="current">
                                        <a href="<?= Yii::$app->params['baseUrl'] ?>member-view_history.html">浏览历史</a>
                                    </li>
                                </ul>
                            </li>
                            <input value="2" type="hidden">
                            <li class="member-menu-list">
                                <div class="list-title-bg">
                                    <h2 class="list-title-icon m-0">我的购买</h2></div>
                                <ul>
                                    <li>
                                        <a href="<?= Yii::$app->params['baseUrl'] ?>member-buy.html">最近购买的商品</a>
                                    </li>
                                </ul>
                            </li>
                            <input value="3" type="hidden">
                            <li class="member-menu-list">
                                <div class="list-title-bg">
                                    <h2 class="list-title-icon m-0">交易管理</h2></div>
                                <ul>
                                    <li>
                                        <a href="<?= Yii::$app->params['baseUrl'] ?>member-orders.html">我的订单</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->params['baseUrl'] ?>member-coupon.html">我的优惠券</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->params['baseUrl'] ?>member-balance.html">我的预存款</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->params['baseUrl'] ?>member-deposit.html">预存款充值</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->params['baseUrl'] ?>aftersales-return_list.html">退款退货管理</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->params['baseUrl'] ?>msg-my_msg.html">站内信(0)</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->params['baseUrl'] ?>member-emails.html">邮件订阅</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->params['baseUrl'] ?>cart-1.html">我的购物车</a>
                                    </li>
                                </ul>
                            </li>
                            <input value="4" type="hidden">
                            <li class="member-menu-list">
                                <div class="list-title-bg">
                                    <h2 class="list-title-icon m-0">账户中心</h2></div>
                                <ul>
                                    <li>
                                        <a href="<?= Yii::$app->params['baseUrl'] ?>member-setting.html">账户信息</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->params['baseUrl'] ?>member-recordinfo.html">实名认证</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->params['baseUrl'] ?>member-security.html">修改密码</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->params['baseUrl'] ?>member-receiver.html">收货地址</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->params['baseUrl'] ?>member-my_point.html">我的积分</a>
                                    </li>
                                </ul>
                            </li>
                            <input value="5" type="hidden">
                            <li class="member-menu-list">
                                <div class="list-title-bg">
                                    <h2 class="list-title-icon m-0">维权管理</h2></div>
                                <ul>
                                    <li>
                                        <a href="<?= Yii::$app->params['baseUrl'] ?>bcomplain-main.html">投诉管理</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->params['baseUrl'] ?>breports-reports_main.html">举报管理</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- left-->

                <!-- right-->
                <link href="css/member.css" rel="stylesheet" type="text/css" media="screen, projection"><title>会员中心_上海外高桥进口商品网</title>
                <meta name="keywords" content="会员中心__上海外高桥进口商品网">
                <meta name="description" content="会员中心__上海外高桥进口商品网">
                <link href="css/b2c.css" rel="stylesheet" type="text/css" media="screen, projection"><link href="css/member.css" rel="stylesheet" type="text/css" media="screen, projection"><script type="text/javascript" src="<?= Yii::$app->params['baseimgUrl'] ?>lang.js"></script><link href="css/lang.css" rel="stylesheet" type="text/css" media="screen, projection"><script type="text/javascript" src="<?= Yii::$app->params['baseimgUrl'] ?>shoptools_min.js"></script>
                <script>
                    var Shop = {"url": {"shipping": "http:\/\/www.ftzmall.com.cn\/cart-shipping.html", "total": "http:\/\/www.ftzmall.com.cn\/cart-total.html", "region": "http:\/\/www.ftzmall.com.cn\/tools-selRegion.html", "payment": "http:\/\/www.ftzmall.com.cn\/cart-payment.html", "purchase_shipping": "http:\/\/www.ftzmall.com.cn\/cart-purchase_shipping.html", "purchase_def_addr": "http:\/\/www.ftzmall.com.cn\/cart-purchase_def_addr.html", "purchase_payment": "http:\/\/www.ftzmall.com.cn\/cart-purchase_payment.html", "get_default_info": "http:\/\/www.ftzmall.com.cn\/cart-get_default_info.html", "diff": "http:\/\/www.ftzmall.com.cn\/product-diff.html", "fav_url": "http:\/\/www.ftzmall.com.cn\/member-ajax_fav.html"}, "base_url": ""};
                </script>
                <script>
                </script>
                <!-- right-->
                <div style="width: 960px;" class="member-main">
                    <div class="title title2">我的浏览历史</div>
                    <div id="tab-favorite" class="section switch">
                        <ul class="switchable-triggerBox tab_member clearfix">
                            <li class="active"><a href="#">宝贝历史</a></li>
                            <li><a href="<?= Yii::$app->params['baseUrl'] ?>member-store_view_history.html">店铺历史</a></li>
                        </ul>
                        <form action="<?= Yii::$app->params['baseUrl'] ?>member-del_view_history.html" method="post" id="return-form">
                            <div class="GoodsSearchWrap" id="mbc-my-fav">
                                <div class="ItemsWarp clearfix">
                                    <div id="b2c-member-fav-list">
                                        <table class="gridlist gridlist_member border-left border-right" border="0" cellpadding="0" cellspacing="0" width="100%">

                                            <tbody><tr><th class="blrn" width="66">&nbsp;</th>
                                                    <th>商品编号</th>
                                                    <th>商品名称</th>
                                                    <th>商品单价</th>
                                                    <th>收藏时间</th>
                                                    <th>操作</th>
                                                </tr>
                                                <tr id="goods_1512" class="itemsList" product="1512">
                                                    <td class="no_bk"><input name="gid[]" value="1512" type="checkbox"></td>
                                                    <td><a target="_blank" href="<?=Yii::$app->params['baseUrl']?>product-1512.html">0023481001</a></td>
                                                    <td style="white-space:normal" class="horizontal-m">
                                                        <div class="member-gift-pic goodpic"><a target="_blank" style="" href="<?=Yii::$app->params['baseUrl']?>product-1512.html">
                                                                <img src="<?= Yii::$app->params['baseimgUrl'] ?>79be119f36b6300a5c3f73b18ae23d0902a.jpg" alt="瑞士 萨克莱斯勃朗机械黑男S1112">

                                                            </a></div>
                                                        <div class="goods-main">
                                                            <div class="goodinfo">
                                                                <h6><a class="font-blue" href="<?=Yii::$app->params['baseUrl']?>product-1512.html" title="瑞士 萨克莱斯勃朗机械黑男S1112">瑞士 萨克莱斯勃朗机械黑男S1112</a></h6>
                                                                <p class="font-gray"></p></div>
                                                        </div>
                                                    </td>
                                                    <td class="price-button" align="center">
                                                        <ul>
                                                            <li><span class="point">￥0.00</span></li>
                                                        </ul>
                                                    </td>
                                                    <td>2015-06-11 14:53:12</td>
                                                    <td style="vertical-align:middle" class="member-fav" align="left">
                                                        <ul class="fav-Operator">
                                                            <li></li><li>
                                                                <a href="<?= Yii::$app->params['baseUrl'] ?>cart-add-goods-1512-2026-1.html" type="g" buy="1512" class="btn-bj-hover operate-btn" target="_dialog_minicart" title="加入购物车" rel="nofollow"><span>加入购物车</span></a>
                                                            </li>
                                                            <li star="1512" data-type="on" title="加入收藏" class="star-off">
                                                                <a href="javascript:void(0)" rel="_fav_" class="btn-a">
                                                                    <i class="has-icon"></i><span><div class="fav">收　藏</div><div class="nofav">已收藏</div></span></a>
                                                            </li>

                                                            <li class="icon2" style="clear:both"><a class="btn-bj-hover operate-btn" gid="1512" onclick="ajax_del_fav($(this), event);"><span>删除</span></a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr id="goods_1505" class="itemsList" product="1505">
                                                    <td class="no_bk"><input name="gid[]" value="1505" type="checkbox"></td>
                                                    <td><a target="_blank" href="<?=Yii::$app->params['baseUrl']?>product-1505.html">0023480001</a></td>
                                                    <td style="white-space:normal" class="horizontal-m">
                                                        <div class="member-gift-pic goodpic"><a target="_blank" style="" href="<?=Yii::$app->params['baseUrl']?>product-1505.html">
                                                                <img src="<?= Yii::$app->params['baseimgUrl'] ?>5d2f9ccb059de731bbedbeae1c2f8f4d49f.jpg" alt="瑞士 萨克莱斯罗莎石英黑女S1334">

                                                            </a></div>
                                                        <div class="goods-main">
                                                            <div class="goodinfo">
                                                                <h6><a class="font-blue" href="<?=Yii::$app->params['baseUrl']?>product-1505.html" title="瑞士 萨克莱斯罗莎石英黑女S1334">瑞士 萨克莱斯罗莎石英黑女S1334</a></h6>
                                                                <p class="font-gray"></p></div>
                                                        </div>
                                                    </td>
                                                    <td class="price-button" align="center">
                                                        <ul>
                                                            <li><span class="point">￥0.00</span></li>
                                                        </ul>
                                                    </td>
                                                    <td>2015-06-11 14:51:35</td>
                                                    <td style="vertical-align:middle" class="member-fav" align="left">
                                                        <ul class="fav-Operator">
                                                            <li></li><li>
                                                                <a href="<?= Yii::$app->params['baseUrl'] ?>cart-add-goods-1505-2019-1.html" type="g" buy="1505" class="btn-bj-hover operate-btn" target="_dialog_minicart" title="加入购物车" rel="nofollow"><span>加入购物车</span></a>
                                                            </li>
                                                            <li star="1505" data-type="on" title="加入收藏" class="star-off">
                                                                <a href="javascript:void(0)" rel="_fav_" class="btn-a">
                                                                    <i class="has-icon"></i><span><div class="fav">收　藏</div><div class="nofav">已收藏</div></span></a>
                                                            </li>

                                                            <li class="icon2" style="clear:both"><a class="btn-bj-hover operate-btn" gid="1505" onclick="ajax_del_fav($(this), event);"><span>删除</span></a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr id="goods_1539" class="itemsList" product="1539">
                                                    <td class="no_bk"><input name="gid[]" value="1539" type="checkbox"></td>
                                                    <td><a target="_blank" href="<?=Yii::$app->params['baseUrl']?>product-1539.html">0012683001</a></td>
                                                    <td style="white-space:normal" class="horizontal-m">
                                                        <div class="member-gift-pic goodpic"><a target="_blank" style="" href="<?=Yii::$app->params['baseUrl']?>product-1539.html">
                                                                <img src="<?= Yii::$app->params['baseimgUrl'] ?>88cab482f0844ca99daac87b7f73c43a7ea.jpg" alt="比利时 贝得嘉太妃味松露形巧克力 500g">

                                                            </a></div>
                                                        <div class="goods-main">
                                                            <div class="goodinfo">
                                                                <h6><a class="font-blue" href="<?=Yii::$app->params['baseUrl']?>product-1539.html" title="比利时 贝得嘉太妃味松露形巧克力 500g">比利时 贝得嘉太妃味松露形巧克力 500g</a></h6>
                                                                <p class="font-gray"></p></div>
                                                        </div>
                                                    </td>
                                                    <td class="price-button" align="center">
                                                        <ul>
                                                            <li><span class="point">￥0.00</span></li>
                                                        </ul>
                                                    </td>
                                                    <td>2015-06-11 14:51:05</td>
                                                    <td style="vertical-align:middle" class="member-fav" align="left">
                                                        <ul class="fav-Operator">
                                                            <li></li><li>
                                                                <a href="<?= Yii::$app->params['baseUrl'] ?>cart-add-goods-1539-2054-1.html" type="g" buy="1539" class="btn-bj-hover operate-btn" target="_dialog_minicart" title="加入购物车" rel="nofollow"><span>加入购物车</span></a>
                                                            </li>
                                                            <li star="1539" data-type="on" title="加入收藏" class="star-off">
                                                                <a href="javascript:void(0)" rel="_fav_" class="btn-a">
                                                                    <i class="has-icon"></i><span><div class="fav">收　藏</div><div class="nofav">已收藏</div></span></a>
                                                            </li>

                                                            <li class="icon2" style="clear:both"><a class="btn-bj-hover operate-btn" gid="1539" onclick="ajax_del_fav($(this), event);"><span>删除</span></a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr id="goods_1462" class="itemsList" product="1462">
                                                    <td class="no_bk"><input name="gid[]" value="1462" type="checkbox"></td>
                                                    <td><a target="_blank" href="<?=Yii::$app->params['baseUrl']?>product-1462.html">0000145001</a></td>
                                                    <td style="white-space:normal" class="horizontal-m">
                                                        <div class="member-gift-pic goodpic"><a target="_blank" style="" href="<?=Yii::$app->params['baseUrl']?>product-1462.html">
                                                                <img src="<?= Yii::$app->params['baseimgUrl'] ?>4cf6b9dde3fab8c71384fec90be64a366c3.jpg" alt="澳大利亚 苹果番石榴复合果汁 400ml">

                                                            </a></div>
                                                        <div class="goods-main">
                                                            <div class="goodinfo">
                                                                <h6><a class="font-blue" href="<?=Yii::$app->params['baseUrl']?>product-1462.html" title="澳大利亚 苹果番石榴复合果汁 400ml">澳大利亚 苹果番石榴复合果汁 400ml</a></h6>
                                                                <p class="font-gray"></p></div>
                                                        </div>
                                                    </td>
                                                    <td class="price-button" align="center">
                                                        <ul>
                                                            <li><span class="point">￥0.00</span></li>
                                                        </ul>
                                                    </td>
                                                    <td>2015-06-11 14:40:33</td>
                                                    <td style="vertical-align:middle" class="member-fav" align="left">
                                                        <ul class="fav-Operator">
                                                            <li></li><li>
                                                                <a href="<?= Yii::$app->params['baseUrl'] ?>cart-add-goods-1462-1976-1.html" type="g" buy="1462" class="btn-bj-hover operate-btn" target="_dialog_minicart" title="加入购物车" rel="nofollow"><span>加入购物车</span></a>
                                                            </li>
                                                            <li star="1462" data-type="on" title="加入收藏" class="star-on">
                                                                <a href="javascript:void(0)" rel="_fav_" class="btn-a">
                                                                    <i class="has-icon"></i><span><div class="fav">收　藏</div><div class="nofav">已收藏</div></span></a>
                                                            </li>

                                                            <li class="icon2" style="clear:both"><a class="btn-bj-hover operate-btn" gid="1462" onclick="ajax_del_fav($(this), event);"><span>删除</span></a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr id="goods_1333" class="itemsList" product="1333">
                                                    <td class="no_bk"><input name="gid[]" value="1333" type="checkbox"></td>
                                                    <td><a target="_blank" href="<?=Yii::$app->params['baseUrl']?>product-1333.html">0011086001</a></td>
                                                    <td style="white-space:normal" class="horizontal-m">
                                                        <div class="member-gift-pic goodpic"><a target="_blank" style="" href="<?=Yii::$app->params['baseUrl']?>product-1333.html">
                                                                <img src="<?= Yii::$app->params['baseimgUrl'] ?>c95a3bfce40b6b0e4a0b8234f5d98ac5234.jpg" alt="菲律宾 FIESTA嘉年华热带椰子水330ML">

                                                            </a></div>
                                                        <div class="goods-main">
                                                            <div class="goodinfo">
                                                                <h6><a class="font-blue" href="<?=Yii::$app->params['baseUrl']?>product-1333.html" title="菲律宾 FIESTA嘉年华热带椰子水330ML">菲律宾 FIESTA嘉年华热带椰子水330ML</a></h6>
                                                                <p class="font-gray"></p></div>
                                                        </div>
                                                    </td>
                                                    <td class="price-button" align="center">
                                                        <ul>
                                                            <li><span class="point">￥0.00</span></li>
                                                        </ul>
                                                    </td>
                                                    <td>2015-06-11 14:40:22</td>
                                                    <td style="vertical-align:middle" class="member-fav" align="left">
                                                        <ul class="fav-Operator">
                                                            <li></li><li>
                                                                <a href="<?= Yii::$app->params['baseUrl'] ?>cart-add-goods-1333-1846-1.html" type="g" buy="1333" class="btn-bj-hover operate-btn" target="_dialog_minicart" title="加入购物车" rel="nofollow"><span>加入购物车</span></a>
                                                            </li>
                                                            <li star="1333" data-type="on" title="加入收藏" class="star-on">
                                                                <a href="javascript:void(0)" rel="_fav_" class="btn-a">
                                                                    <i class="has-icon"></i><span><div class="fav">收　藏</div><div class="nofav">已收藏</div></span></a>
                                                            </li>

                                                            <li class="icon2" style="clear:both"><a class="btn-bj-hover operate-btn" gid="1333" onclick="ajax_del_fav($(this), event);"><span>删除</span></a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        <div style="padding-left:28px;background:#f9f9f9;height:31px;line-height:31px;"><label><input id="all" type="checkbox">&nbsp;&nbsp;全选</label>&nbsp;&nbsp;<a href="javascript:removeSel();">删除</a></div>
                                    </div>
                                </div>
                                <input id="b2c-fav-current-page" value="" type="hidden">
                            </div>
                        </form>
                       <!--<script type="text/javascript" src="/app/b2c/statics/js/goodscupcake.js?static"></script>-->
                        <script>
                            function removeSel() {
                                var reqs = $$('input[name^=gid]:checked').length;
                                if (reqs == 0) {
                                    Ex_Dialog.alert('请选择要删除的选项！');
                                } else {
                                    Ex_Dialog.confirm('确定要删除所选项吗？', function(e) {
                                        if (!e)
                                            return;
                                        new Request({
                                            url: '<?= Yii::$app->params['baseUrl'] ?>member-del_view_history.html',
                                            method: 'post',
                                            data: $('return-form'),
                                            onComplete: function(res) {
                                                res = JSON.decode(res);
                                                if (res.error) {
                                                    MessageBox.error(res.error);
                                                    return;
                                                }
                                                location.reload();
                                            }
                                        }).send();
                                    });
                                }
                            }
                            var ajax_del_fav = function(el, e) {
                                var gid = el.get('gid');
                                Ex_Dialog.confirm('确定删除?', function(e) {
                                    if (!e)
                                        return false;
                                    new Request({
                                        url: '<?= Yii::$app->params['baseUrl'] ?>member-del_view_history.html',
                                        method: 'post',
                                        data: 't=' + (+new Date()) + '&gid=' + gid + '&current=' + $('b2c-fav-current-page').value,
                                        onComplete: function(res) {
                                            res = JSON.decode(res);
                                            if (res.error) {
                                                MessageBox.error(res.error);
                                                return;
                                            }
                                            location.reload();
                                        }
                                    }).send();
                                    $('goods_' + gid).setOpacity(.5);
                                    return false;
                                });
                            };

                            window.addEvent('domready', function() {
                                $('all').addEvent('click', function() {

                                    $$('input[name^=gid]').each(function(item) {
                                        if ($('all').checked == true) {
                                            item.checked = true;
                                        } else {
                                            item.checked = false;
                                        }
                                    });


                                })

                            });

                        </script>

                    </div>
                </div>
                <!-- right-->
            </div>
        </div>
    </div>



    <div style="display:none;">
        <div class="gridlist-tip">
            <div class="tip">
                <div class="tip-title"></div>
                <div class="tip-text"></div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- <div class="sidebar-right">
    <a rel="nofllow" href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&amp;key=XzkzODAwNTIxMF8xNjMxNTlfNDAwMTg4NTE3OV8yXw;" target="_blank" class="qtalk"></a>
    <a href="javascript:void(0)" class="sidebar-backtop"></a>
    <a href="javascript:void(0)" class="sidebar-close"></a>
</div> -->
<script>
    (function() {
        $$('.sidebar-backtop').addEvent('click', function() {
            $(window).scrollTo(0, 0)
        });
        $$('.sidebar-close').addEvent('click', function() {
            $$('.sidebar-right').setStyle('display', 'none')
        })
    })();
</script>
