<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '商品收藏_上海外高桥进口商品网';
?>

<!-- right-->
<div style="width: 960px;" class="member-main">
    <div class="title title2">我的收藏</div>
    <div id="tab-favorite" class="section switch">
        <ul class="switchable-triggerBox tab_member clearfix">
            <li class="active"><a href="#">宝贝收藏</a></li>
        </ul>


        <form action="/favorite-delSel.html" method="post" id="return-form">
            <div class="GoodsSearchWrap" id="mbc-my-fav">
                <div class="ItemsWarp clearfix">
                    <div id="b2c-member-fav-list">
                        <table class="gridlist gridlist_member border-left border-right" border="0" cellpadding="0" cellspacing="0" width="100%">

                            <tbody><tr><th class="blrn" width="66"></th>
                                    <th>商品编号</th>
                                    <th>商品名称</th>
                                    <th>商品单价</th>
                                    <th>收藏时间</th>
                                    <th>操作</th>
                                </tr>
                                <tr id="goods_1462" class="itemsList" product="1462">
                                    <td class="no_bk"><input name="chk[]" value="1462" type="checkbox"><br>
                                    </td>
                                    <td>0000145001</td>
                                    <td style="white-space:normal" class="horizontal-m">
                                        <div class="goodpic"><a target="_blank" style="" href="<?= Yii::$app->params['baseUrl'] ?>product-1462.html">
                                                <img style="width:50px; height:58px;" src="<?= Yii::$app->params['baseimgUrl'] ?>4cf6b9dde3fab8c71384fec90be64a366c3.jpg" alt="澳大利亚 苹果番石榴复合果汁 400ml">

                                            </a></div>
                                        <div class="goods-main">
                                            <div class="goodinfo">
                                                <h6><a class="font-blue" href="<?= Yii::$app->params['baseUrl'] ?>product-1462.html" title="澳大利亚 苹果番石榴复合果汁 400ml">澳大利亚 苹果番石榴复合果汁 400ml</a></h6>
                                                <p class="font-gray"></p></div>
                                        </div>
                                    </td>
                                    <td class="price-button" align="center">
                                        <ul>
                                            <li><span class="point">￥32.50</span></li>
                                        </ul>
                                    </td>
                                    <td>2015-06-11 14:40:36</td>
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
                                    <td class="no_bk"><input name="chk[]" value="1333" type="checkbox"><br>
                                    </td>
                                    <td>0011086001</td>
                                    <td style="white-space:normal" class="horizontal-m">
                                        <div class="goodpic"><a target="_blank" style="" href="<?= Yii::$app->params['baseUrl'] ?>product-1333.html">
                                                <img style="width:50px; height:58px;" src="<?= Yii::$app->params['baseimgUrl'] ?>c95a3bfce40b6b0e4a0b8234f5d98ac5234.jpg" alt="菲律宾 FIESTA嘉年华热带椰子水330ML">

                                            </a></div>
                                        <div class="goods-main">
                                            <div class="goodinfo">
                                                <h6><a class="font-blue" href="<?= Yii::$app->params['baseUrl'] ?>product-1333.html" title="菲律宾 FIESTA嘉年华热带椰子水330ML">菲律宾 FIESTA嘉年华热带椰子水330ML</a></h6>
                                                <p class="font-gray"></p></div>
                                        </div>
                                    </td>
                                    <td class="price-button" align="center">
                                        <ul>
                                            <li><span class="point">￥9.90</span></li>
                                        </ul>
                                    </td>
                                    <td>2015-06-11 14:40:30</td>
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
                        <div style="padding-left:28px;background:#f9f9f9;height:31px;line-height:31px;"><input id="all" type="checkbox">&nbsp;&nbsp;全选&nbsp;&nbsp;<a href="javascript:removeSel();">删除</a></div>

                        <script>

                            function removeSel() {
                                var reqs = $$('input[name^=chk]:checked').length;
                                if (reqs == 0) {
                                    Ex_Dialog.alert('请选择要删除的选项！');
                                } else {
                                    Ex_Dialog.confirm('确定要删除所选项吗？', function(e) {
                                        if (!e)
                                            return;
                                        $$('input[name^=chk]:checked').each(function(v, index) {

                                            var MEMBER = Cookie.read('S[MEMBER]');
                                            var FAVCOOKIE = new Cookie('S[GFAV][' + MEMBER + ']', {duration: 365});
                                            FAVCOOKIE.write(Array.from((FAVCOOKIE.read('S[GFAV]') || '').split(',')).erase(v.value).join(','));
                                        }
                                        );
                                        $('return-form').submit();
                                    });
                                }
                            }

                            window.addEvent('domready', function() {
                                $('all').addEvent('click', function() {

                                    $$('input[name^=chk]').each(function(item) {
                                        if ($('all').checked == true) {
                                            item.checked = true;
                                        } else {
                                            item.checked = false;
                                        }
                                    });
                                })

                            });</script>
                    </div>
                </div>
                <input id="b2c-fav-current-page" value="1" type="hidden">
            </div>
        </form>
        <div class="pager">
            <a class="prev" title="上一页" href="<?= Yii::$app->params['baseUrl'] ?>member-favorite--1.html">«上一页</a>
            <a class="pagernum" href="<?= Yii::$app->params['baseUrl'] ?>member-favorite--1.html">1</a>
            <strong class="pagecurrent">2</strong>
            <span class="unnext" title="已经是最后一页">已经是最后一页</span>
        </div>
               <!--<script type="text/javascript" src="/app/b2c/statics/js/goodscupcake.js?static"></script>-->
        <script>
            var ajax_del_fav = function(el, e) {
                var gid = el.get('gid');
                Ex_Dialog.confirm('确定删除?', function(e) {
                    if (!e)
                        return false;
                    new Request({
                        url: '/favorite-ajax_del_fav-goods.html',
                        method: 'post',
                        data: 't=' + (+new Date()) + '&gid=' + gid + '&current=' + $('b2c-fav-current-page').value,
                        onComplete: function(res) {
                            res = JSON.decode(res);
                            if (res.error) {
                                MessageBox.error(res.error);
                            } else {
                                if (!res.data && res.reload != null) {
                                    location.href = res.reload;
                                } else {
                                    $('b2c-member-fav-list').innerHTML = res.data;
                                }
                            }
                        }
                    }).send();
                    $('goods_' + gid).setOpacity(.5);
                    var MEMBER = Cookie.read('S[MEMBER]');
                    var FAVCOOKIE = new Cookie('S[GFAV][' + MEMBER + ']', {duration: 365});
                    FAVCOOKIE.write(Array.from((FAVCOOKIE.read('S[GFAV]') || '').split(',')).erase(gid).join(','));
                    return false;
                });
            };</script>

    </div>
</div>
<!-- right-->