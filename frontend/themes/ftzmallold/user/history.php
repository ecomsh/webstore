<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '浏览历史_上海外高桥进口商品网';
?>
<!--right-->
<div style = "width: 960px;" class = "member-main">
    <div class = "title title2">我的浏览历史</div>
    <div id = "tab-favorite" class = "section switch">
        <ul class = "switchable-triggerBox tab_member clearfix">
            <li class = "active"><a href = "#">宝贝历史</a></li>
            <li><a href = "<?= Yii::$app->params['baseUrl'] ?>member-store_view_history.html">店铺历史</a></li>
        </ul>
        <form action = "<?= Yii::$app->params['baseUrl'] ?>member-del_view_history.html" method = "post" id = "return-form">
            <div class = "GoodsSearchWrap" id = "mbc-my-fav">
                <div class = "ItemsWarp clearfix">
                    <div id = "b2c-member-fav-list">
                        <table class = "gridlist gridlist_member border-left border-right" border = "0" cellpadding = "0" cellspacing = "0" width = "100%">

                            <tbody><tr><th class = "blrn" width = "66">&nbsp;
                                    </th>
                                    <th>商品编号</th>
                                    <th>商品名称</th>
                                    <th>商品单价</th>
                                    <th>收藏时间</th>
                                    <th>操作</th>
                                </tr>
                                <tr id = "goods_1486" class = "itemsList" product = "1486">
                                    <td class = "no_bk"><input name = "gid[]" value = "1486" type = "checkbox"></td>
                                    <td><a target = "_blank" href = "<?= Yii::$app->params['baseUrl'] ?>product-1486.html">102USB019700002</a></td>
                                    <td style = "white-space:normal" class = "horizontal-m">
                                        <div class = "member-gift-pic goodpic"><a target = "_blank" style = "" href = "<?= Yii::$app->params['baseUrl'] ?>product-1486.html">
                                                <img src="<?= Yii::$app->params['baseimgUrl'] ?>2b2a9469839a51be65103ebc924993432e4.jpg" alt = "美国 CeraVe补水保湿滋润洗面奶237ml">

                                            </a></div>
                                        <div class = "goods-main">
                                            <div class = "goodinfo">
                                                <h6><a class = "font-blue" href = "<?= Yii::$app->params['baseUrl'] ?>product-1486.html" title = "美国 CeraVe补水保湿滋润洗面奶237ml">美国 CeraVe补水保湿滋润洗面奶237ml</a></h6>
                                                <p class = "font-gray"></p></div>
                                        </div>
                                    </td>
                                    <td class = "price-button" align = "center">
                                        <ul>
                                            <li><span class = "point">¥0.00</span></li>
                                        </ul>
                                    </td>
                                    <td>2015-06-03 13:43:50</td>
                                    <td style = "vertical-align:middle" class = "member-fav" align = "left">
                                        <ul class = "fav-Operator">
                                            <li></li><li>
                                                <a href = "<?= Yii::$app->params['baseUrl'] ?>cart-add-goods-1486-2000-1.html" type = "g" buy = "1486" class = "btn-bj-hover operate-btn" target = "_dialog_minicart" title = "加入购物车" rel = "nofollow"><span>加入购物车</span></a>
                                            </li>
                                            <li star = "1486" data-type = "on" title = "加入收藏" class = "star-off">
                                                <a href = "javascript:void(0)" rel = "_fav_" class = "btn-a">
                                                    <i class = "has-icon"></i><span><div class = "fav">收　藏</div><div class = "nofav">已收藏</div></span></a>
                                            </li>

                                            <li class = "icon2" style = "clear:both"><a class = "btn-bj-hover operate-btn" gid = "1486" onclick = "ajax_del_fav($(this), event);"><span>删除</span></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr id = "goods_1491" class = "itemsList" product = "1491">
                                    <td class = "no_bk"><input name = "gid[]" value = "1491" type = "checkbox"></td>
                                    <td><a target = "_blank" href = "<?= Yii::$app->params['baseUrl'] ?>product-1491.html">102CA39740001</a></td>
                                    <td style = "white-space:normal" class = "horizontal-m">
                                        <div class = "member-gift-pic goodpic"><a target = "_blank" style = "" href = "<?= Yii::$app->params['baseUrl'] ?>product-1491.html">
                                                <img src="<?= Yii::$app->params['baseimgUrl'] ?>32d1445eca8a5183073ba3c93e22550e51f.jpg" alt = "加拿大 皇家御品 新一代液体钙100粒">

                                            </a></div>
                                        <div class = "goods-main">
                                            <div class = "goodinfo">
                                                <h6><a class = "font-blue" href = "<?= Yii::$app->params['baseUrl'] ?>product-1491.html" title = "加拿大 皇家御品 新一代液体钙100粒">加拿大 皇家御品 新一代液体钙100粒</a></h6>
                                                <p class = "font-gray"></p></div>
                                        </div>
                                    </td>
                                    <td class = "price-button" align = "center">
                                        <ul>
                                            <li><span class = "point">¥0.00</span></li>
                                        </ul>
                                    </td>
                                    <td>2015-06-03 11:37:48</td>
                                    <td style = "vertical-align:middle" class = "member-fav" align = "left">
                                        <ul class = "fav-Operator">
                                            <li></li><li>
                                                <a href = "<?= Yii::$app->params['baseUrl'] ?>cart-add-goods-1491-2005-1.html" type = "g" buy = "1491" class = "btn-bj-hover operate-btn" target = "_dialog_minicart" title = "加入购物车" rel = "nofollow"><span>加入购物车</span></a>
                                            </li>
                                            <li star = "1491" data-type = "on" title = "加入收藏" class = "star-off">
                                                <a href = "javascript:void(0)" rel = "_fav_" class = "btn-a">
                                                    <i class = "has-icon"></i><span><div class = "fav">收　藏</div><div class = "nofav">已收藏</div></span></a>
                                            </li>

                                            <li class = "icon2" style = "clear:both"><a class = "btn-bj-hover operate-btn" gid = "1491" onclick = "ajax_del_fav($(this), event);"><span>删除</span></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr id = "goods_1462" class = "itemsList" product = "1462">
                                    <td class = "no_bk"><input name = "gid[]" value = "1462" type = "checkbox"></td>
                                    <td><a target = "_blank" href = "<?= Yii::$app->params['baseUrl'] ?>product-1462.html">0000145001</a></td>
                                    <td style = "white-space:normal" class = "horizontal-m">
                                        <div class = "member-gift-pic goodpic"><a target = "_blank" style = "" href = "<?= Yii::$app->params['baseUrl'] ?>product-1462.html">
                                                <img src="<?= Yii::$app->params['baseimgUrl'] ?>4cf6b9dde3fab8c71384fec90be64a366c3.jpg" alt = "澳大利亚 苹果番石榴复合果汁 400ml">

                                            </a></div>
                                        <div class = "goods-main">
                                            <div class = "goodinfo">
                                                <h6><a class = "font-blue" href = "<?= Yii::$app->params['baseUrl'] ?>product-1462.html" title = "澳大利亚 苹果番石榴复合果汁 400ml">澳大利亚 苹果番石榴复合果汁 400ml</a></h6>
                                                <p class = "font-gray"></p></div>
                                        </div>
                                    </td>
                                    <td class = "price-button" align = "center">
                                        <ul>
                                            <li><span class = "point">¥0.00</span></li>
                                        </ul>
                                    </td>
                                    <td>2015-06-02 15:48:56</td>
                                    <td style = "vertical-align:middle" class = "member-fav" align = "left">
                                        <ul class = "fav-Operator">
                                            <li></li><li>
                                                <a href = "<?= Yii::$app->params['baseUrl'] ?>cart-add-goods-1462-1976-1.html" type = "g" buy = "1462" class = "btn-bj-hover operate-btn" target = "_dialog_minicart" title = "加入购物车" rel = "nofollow"><span>加入购物车</span></a>
                                            </li>
                                            <li star = "1462" data-type = "on" title = "加入收藏" class = "star-off">
                                                <a href = "javascript:void(0)" rel = "_fav_" class = "btn-a">
                                                    <i class = "has-icon"></i><span><div class = "fav">收　藏</div><div class = "nofav">已收藏</div></span></a>
                                            </li>

                                            <li class = "icon2" style = "clear:both"><a class = "btn-bj-hover operate-btn" gid = "1462" onclick = "ajax_del_fav($(this), event);"><span>删除</span></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr id = "goods_1333" class = "itemsList" product = "1333">
                                    <td class = "no_bk"><input name = "gid[]" value = "1333" type = "checkbox"></td>
                                    <td><a target = "_blank" href = "<?= Yii::$app->params['baseUrl'] ?>product-1333.html">0011086001</a></td>
                                    <td style = "white-space:normal" class = "horizontal-m">
                                        <div class = "member-gift-pic goodpic"><a target = "_blank" style = "" href = "<?= Yii::$app->params['baseUrl'] ?>product-1333.html">
                                                <img src="<?= Yii::$app->params['baseimgUrl'] ?>c95a3bfce40b6b0e4a0b8234f5d98ac5234.jpg" alt = "菲律宾 FIESTA嘉年华热带椰子水330ML">

                                            </a></div>
                                        <div class = "goods-main">
                                            <div class = "goodinfo">
                                                <h6><a class = "font-blue" href = "<?= Yii::$app->params['baseUrl'] ?>product-1333.html" title = "菲律宾 FIESTA嘉年华热带椰子水330ML">菲律宾 FIESTA嘉年华热带椰子水330ML</a></h6>
                                                <p class = "font-gray"></p></div>
                                        </div>
                                    </td>
                                    <td class = "price-button" align = "center">
                                        <ul>
                                            <li><span class = "point">¥0.00</span></li>
                                        </ul>
                                    </td>
                                    <td>2015-06-02 15:23:55</td>
                                    <td style = "vertical-align:middle" class = "member-fav" align = "left">
                                        <ul class = "fav-Operator">
                                            <li></li><li>
                                                <a href = "<?= Yii::$app->params['baseUrl'] ?>cart-add-goods-1333-1846-1.html" type = "g" buy = "1333" class = "btn-bj-hover operate-btn" target = "_dialog_minicart" title = "加入购物车" rel = "nofollow"><span>加入购物车</span></a>
                                            </li>
                                            <li star = "1333" data-type = "on" title = "加入收藏" class = "star-off">
                                                <a href = "javascript:void(0)" rel = "_fav_" class = "btn-a">
                                                    <i class = "has-icon"></i><span><div class = "fav">收　藏</div><div class = "nofav">已收藏</div></span></a>
                                            </li>

                                            <li class = "icon2" style = "clear:both"><a class = "btn-bj-hover operate-btn" gid = "1333" onclick = "ajax_del_fav($(this), event);"><span>删除</span></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr id = "goods_1487" class = "itemsList" product = "1487">
                                    <td class = "no_bk"><input name = "gid[]" value = "1487" type = "checkbox"></td>
                                    <td><a target = "_blank" href = "<?= Yii::$app->params['baseUrl'] ?>product-1487.html">102USB019700003</a></td>
                                    <td style = "white-space:normal" class = "horizontal-m">
                                        <div class = "member-gift-pic goodpic"><a target = "_blank" style = "" href = "<?= Yii::$app->params['baseUrl'] ?>product-1487.html">
                                                <img src="<?= Yii::$app->params['baseimgUrl'] ?>50dbe183f4613c2c93e64fe2f9a0b661a6b.jpg" alt = "美国 CeraVe 补水保湿滋润洗面奶  87ml">

                                            </a></div>
                                        <div class = "goods-main">
                                            <div class = "goodinfo">
                                                <h6><a class = "font-blue" href = "<?= Yii::$app->params['baseUrl'] ?>product-1487.html" title = "美国 CeraVe 补水保湿滋润洗面奶  87ml">美国 CeraVe 补水保湿滋润洗面奶 87ml</a></h6>
                                                <p class = "font-gray"></p></div>
                                        </div>
                                    </td>
                                    <td class = "price-button" align = "center">
                                        <ul>
                                            <li><span class = "point">¥0.00</span></li>
                                        </ul>
                                    </td>
                                    <td>2015-05-25 10:44:41</td>
                                    <td style = "vertical-align:middle" class = "member-fav" align = "left">
                                        <ul class = "fav-Operator">
                                            <li></li><li>
                                                <a href = "<?= Yii::$app->params['baseUrl'] ?>cart-add-goods-1487-2001-1.html" type = "g" buy = "1487" class = "btn-bj-hover operate-btn" target = "_dialog_minicart" title = "加入购物车" rel = "nofollow"><span>加入购物车</span></a>
                                            </li>
                                            <li star = "1487" data-type = "on" title = "加入收藏" class = "star-off">
                                                <a href = "javascript:void(0)" rel = "_fav_" class = "btn-a">
                                                    <i class = "has-icon"></i><span><div class = "fav">收　藏</div><div class = "nofav">已收藏</div></span></a>
                                            </li>

                                            <li class = "icon2" style = "clear:both"><a class = "btn-bj-hover operate-btn" gid = "1487" onclick = "ajax_del_fav($(this), event);"><span>删除</span></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr id = "goods_1489" class = "itemsList" product = "1489">
                                    <td class = "no_bk"><input name = "gid[]" value = "1489" type = "checkbox"></td>
                                    <td><a target = "_blank" href = "<?= Yii::$app->params['baseUrl'] ?>product-1489.html">102USB039700007</a></td>
                                    <td style = "white-space:normal" class = "horizontal-m">
                                        <div class = "member-gift-pic goodpic"><a target = "_blank" style = "" href = "<?= Yii::$app->params['baseUrl'] ?>product-1489.html">
                                                <img src="<?= Yii::$app->params['baseimgUrl'] ?>bc51d3f54805f61a30dcf334057adfb7de1.jpg" alt = "美国 CeraVe 补水保湿润肤霜 56ml">

                                            </a></div>
                                        <div class = "goods-main">
                                            <div class = "goodinfo">
                                                <h6><a class = "font-blue" href = "<?= Yii::$app->params['baseUrl'] ?>product-1489.html" title = "美国 CeraVe 补水保湿润肤霜 56ml">美国 CeraVe 补水保湿润肤霜 56ml</a></h6>
                                                <p class = "font-gray"></p></div>
                                        </div>
                                    </td>
                                    <td class = "price-button" align = "center">
                                        <ul>
                                            <li><span class = "point">¥0.00</span></li>
                                        </ul>
                                    </td>
                                    <td>2015-05-22 14:36:36</td>
                                    <td style = "vertical-align:middle" class = "member-fav" align = "left">
                                        <ul class = "fav-Operator">
                                            <li></li><li>
                                                <a href = "<?= Yii::$app->params['baseUrl'] ?>cart-add-goods-1489-2003-1.html" type = "g" buy = "1489" class = "btn-bj-hover operate-btn" target = "_dialog_minicart" title = "加入购物车" rel = "nofollow"><span>加入购物车</span></a>
                                            </li>
                                            <li star = "1489" data-type = "on" title = "加入收藏" class = "star-off">
                                                <a href = "javascript:void(0)" rel = "_fav_" class = "btn-a">
                                                    <i class = "has-icon"></i><span><div class = "fav">收　藏</div><div class = "nofav">已收藏</div></span></a>
                                            </li>

                                            <li class = "icon2" style = "clear:both"><a class = "btn-bj-hover operate-btn" gid = "1489" onclick = "ajax_del_fav($(this), event);"><span>删除</span></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr id = "goods_1357" class = "itemsList" product = "1357">
                                    <td class = "no_bk"><input name = "gid[]" value = "1357" type = "checkbox"></td>
                                    <td><a target = "_blank" href = "<?= Yii::$app->params['baseUrl'] ?>product-1357.html">0008411001</a></td>
                                    <td style = "white-space:normal" class = "horizontal-m">
                                        <div class = "member-gift-pic goodpic"><a target = "_blank" style = "" href = "<?= Yii::$app->params['baseUrl'] ?>product-1357.html">
                                                <img src="<?= Yii::$app->params['baseimgUrl'] ?>bc8977603a36b2bc01a71498e3d99f6813e.jpg" alt = "美国 地扪玉米粒 432g">

                                            </a></div>
                                        <div class = "goods-main">
                                            <div class = "goodinfo">
                                                <h6><a class = "font-blue" href = "<?= Yii::$app->params['baseUrl'] ?>product-1357.html" title = "美国 地扪玉米粒 432g">美国 地扪玉米粒 432g</a></h6>
                                                <p class = "font-gray"></p></div>
                                        </div>
                                    </td>
                                    <td class = "price-button" align = "center">
                                        <ul>
                                            <li><span class = "point">¥0.00</span></li>
                                        </ul>
                                    </td>
                                    <td>2015-05-22 13:30:20</td>
                                    <td style = "vertical-align:middle" class = "member-fav" align = "left">
                                        <ul class = "fav-Operator">
                                            <li></li><li>
                                                <a href = "<?= Yii::$app->params['baseUrl'] ?>cart-add-goods-1357-1870-1.html" type = "g" buy = "1357" class = "btn-bj-hover operate-btn" target = "_dialog_minicart" title = "加入购物车" rel = "nofollow"><span>加入购物车</span></a>
                                            </li>
                                            <li star = "1357" data-type = "on" title = "加入收藏" class = "star-off">
                                                <a href = "javascript:void(0)" rel = "_fav_" class = "btn-a">
                                                    <i class = "has-icon"></i><span><div class = "fav">收　藏</div><div class = "nofav">已收藏</div></span></a>
                                            </li>

                                            <li class = "icon2" style = "clear:both"><a class = "btn-bj-hover operate-btn" gid = "1357" onclick = "ajax_del_fav($(this), event);"><span>删除</span></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr id = "goods_1412" class = "itemsList" product = "1412">
                                    <td class = "no_bk"><input name = "gid[]" value = "1412" type = "checkbox"></td>
                                    <td><a target = "_blank" href = "<?= Yii::$app->params['baseUrl'] ?>product-1412.html">0014017001</a></td>
                                    <td style = "white-space:normal" class = "horizontal-m">
                                        <div class = "member-gift-pic goodpic"><a target = "_blank" style = "" href = "<?= Yii::$app->params['baseUrl'] ?>product-1412.html">
                                                <img src="<?= Yii::$app->params['baseimgUrl'] ?>e40a8b9a5c39cb0ea5e7ebf980492d6f8cf.jpg" alt = "菲律宾 SEAHARVEST盐水浸金枪鱼罐头 185g">

                                            </a></div>
                                        <div class = "goods-main">
                                            <div class = "goodinfo">
                                                <h6><a class = "font-blue" href = "<?= Yii::$app->params['baseUrl'] ?>product-1412.html" title = "菲律宾 SEAHARVEST盐水浸金枪鱼罐头 185g">菲律宾 SEAHARVEST盐水浸金枪鱼罐头 185g</a></h6>
                                                <p class = "font-gray"></p></div>
                                        </div>
                                    </td>
                                    <td class = "price-button" align = "center">
                                        <ul>
                                            <li><span class = "point">¥0.00</span></li>
                                        </ul>
                                    </td>
                                    <td>2015-05-22 13:30:17</td>
                                    <td style = "vertical-align:middle" class = "member-fav" align = "left">
                                        <ul class = "fav-Operator">
                                            <li></li><li>
                                                <a href = "<?= Yii::$app->params['baseUrl'] ?>cart-add-goods-1412-1926-1.html" type = "g" buy = "1412" class = "btn-bj-hover operate-btn" target = "_dialog_minicart" title = "加入购物车" rel = "nofollow"><span>加入购物车</span></a>
                                            </li>
                                            <li star = "1412" data-type = "on" title = "加入收藏" class = "star-off">
                                                <a href = "javascript:void(0)" rel = "_fav_" class = "btn-a">
                                                    <i class = "has-icon"></i><span><div class = "fav">收　藏</div><div class = "nofav">已收藏</div></span></a>
                                            </li>

                                            <li class = "icon2" style = "clear:both"><a class = "btn-bj-hover operate-btn" gid = "1412" onclick = "ajax_del_fav($(this), event);"><span>删除</span></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody></table>
                        <div style = "padding-left:28px;background:#f9f9f9;height:31px;line-height:31px;"><label><input id = "all" type = "checkbox">&nbsp;
                                &nbsp;
                                全选</label>&nbsp;
                            &nbsp;
                            <a href = "javascript:removeSel();">删除</a></div>
                    </div>
                </div>
                <input id = "b2c-fav-current-page" value = "" type = "hidden">
            </div>
        </form>
        <!--<script type = "text/javascript" src = "/app/b2c/statics/js/goodscupcake.js?static"></script>-->
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