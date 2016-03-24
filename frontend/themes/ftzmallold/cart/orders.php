<?php

use yii\helpers\Url;
use yii\helpers\Html;
//use frontend\assets\CartAsset; todo by caoqi

//CartAsset::register($this);
/* @var $this yii\web\View */
$this->title = '合并支付_上海外高桥进口商品网';
?>

<div class="main w1200">
    <div class="mTB">
        <div class="orderpay" style="width: 1200px;">
            <form id="zu_he" method="post">
                <span><input id="selector1" target="_blank" type="checkbox">全选（注：只支持相同的支付方式的订单合并支付）
                </span>
                <span>
                    <input type="hidden" name="all_num" id="allnum">
                    <input type="button" value="合并支付" id="he_bin" class="btn btn_secondary" style="margin-bottom:4px;">    
                </span>
            </form>
            <form id="2015070214178965" target="_blank" action="<?= Yii::$app->params['baseUrl'] ?>paycenter-all_dopayment-order.html" method="post">
                <input type="hidden" class="check_id" name="payment[0][order_id]" value="2015070214178965">
                <input type="hidden" name="payment[0][money]" value="249.87" id="hidden_money">
                <input type="hidden" name="payment[0][currency]" value="CNY">
                <input type="hidden" name="payment[0][cur_money]" value="249.87" id="hidden_cur_money">
                <input type="hidden" name="payment[0][cur_rate]" value="1.0000">
                <input type="hidden" name="payment[0][cur_def]" value="￥">
                <input type="hidden" class="all_pay_" id="all_pay_2015070214178965" name="payment[0][pay_app_id]" value="alipayinstance">
                <input type="hidden" name="payment[0][cost_payment]" value="0.000">
                <input type="hidden" name="payment[0][cur_amount]" value="249.87">
                <input type="hidden" name="payment[0][memo]" value="">
                <table class="gridlist table-goods-list gridlist_member " style="border-bottom:none" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody><tr>
                            <th class="first">订单号</th>
                            <th>订单商品</th>
                            <th>单价（元）</th>

                            <th>数量</th>
                            <th>运费</th>
                            <th>实付款（元）</th>
                            <th>支付方式</th>
                            <th>操作</th>
                        </tr>
                    </tbody><tbody>

                        <tr class="order-list-tr">
                            <td class="vt">
                                <input class="selector" type="checkbox" value="2015070214178965" name="order[]">

                                <a href="<?= Yii::$app->params['baseUrl'] ?>member-orderdetail-2015070214178965.html" class="operate-btn">2015070214178965</a>
                            </td>
                            <td class="horizontal-m">
                                <div class="clearfix">
                                    <div class="product-list-img member-gift-pic goodpic"><a href="<?= Yii::$app->params['baseUrl'] ?>product-1302.html"> <img src="<?= Yii::$app->params['baseimgUrl'] ?>f1ee9a0f847c26555405e34807d5ab0659a.jpg"> </a></div>
                                    <div class="goods-main clearfix">
                                        <div class="goodinfo">
                                            <h3>                                  <a target="_blank" class="font-blue" href="<?= Yii::$app->params['baseUrl'] ?>product-1302.html">
                                                    马来西亚 妈咪牌泰式东阴功风味杯面 72g </a>
                                            </h3>
                                        </div>

                                    </div>
                                </div>

                                <!-- adjunct -->
                                <div class="clearfix">
                                    <div class="product-list-img member-gift-pic goodpic"><a href="<?= Yii::$app->params['baseUrl'] ?>product-1333.html"> <img src="<?= Yii::$app->params['baseimgUrl'] ?>7d984cdc964d10d8fe8452acc92b0b41ffb.jpg"> </a></div>
                                    <div class="goods-main clearfix">
                                        <div class="goodinfo">
                                            <h3>                                  <a target="_blank" class="font-blue" href="<?= Yii::$app->params['baseUrl'] ?>product-1333.html">
                                                    菲律宾 FIESTA嘉年华热带椰子水330ML </a>
                                            </h3>
                                        </div>

                                    </div>
                                </div>

                                <!-- adjunct -->
                                <div class="clearfix">
                                    <div class="product-list-img member-gift-pic goodpic"><a href="<?= Yii::$app->params['baseUrl'] ?>product-1420.html"> <img src="<?= Yii::$app->params['baseimgUrl'] ?>149fef850552efc121bdd0a75cb1ba4f593.jpg"> </a></div>
                                    <div class="goods-main clearfix">
                                        <div class="goodinfo">
                                            <h3>                                  <a target="_blank" class="font-blue" href="<?= Yii::$app->params['baseUrl'] ?>product-1420.html">
                                                    马来西亚 贝鲁斯鲜虾棒 60g </a>
                                            </h3>
                                        </div>

                                    </div>
                                </div>

                                <!-- adjunct -->
                                <div class="clearfix">
                                    <div class="product-list-img member-gift-pic goodpic"><a href="<?= Yii::$app->params['baseUrl'] ?>product-325.html"> <img src="<?= Yii::$app->params['baseimgUrl'] ?>5031535af4ba34441b34956a16767ac4292.jpg"> </a></div>
                                    <div class="goods-main clearfix">
                                        <div class="goodinfo">
                                            <h3>                                  <a target="_blank" class="font-blue" href="<?= Yii::$app->params['baseUrl'] ?>product-325.html">
                                                    英国 麦维他纯巧克力消化饼 200g </a>
                                            </h3>
                                        </div>

                                    </div>
                                </div>

                                <!-- adjunct -->
                                <div class="clearfix">
                                    <div class="product-list-img member-gift-pic goodpic"><a href="<?= Yii::$app->params['baseUrl'] ?>product-555.html"> <img src="<?= Yii::$app->params['baseimgUrl'] ?>575492695d7691359846082a2a7a4c83b4f.jpg"> </a></div>
                                    <div class="goods-main clearfix">
                                        <div class="goodinfo">
                                            <h3>                                  <a target="_blank" class="font-blue" href="<?= Yii::$app->params['baseUrl'] ?>product-555.html">
                                                    新加坡 明治 熊猫巧克力夹心饼干 50g </a>
                                            </h3>
                                        </div>

                                    </div>
                                </div>

                                <!-- adjunct -->
                                <div class="clearfix">
                                    <div class="product-list-img member-gift-pic goodpic"><a href="<?= Yii::$app->params['baseUrl'] ?>product-653.html"> <img src="<?= Yii::$app->params['baseimgUrl'] ?>2bd9fef17185b372d071da5e59b298d299a.jpg"> </a></div>
                                    <div class="goods-main clearfix">
                                        <div class="goodinfo">
                                            <h3>                                  <a target="_blank" class="font-blue" href="<?= Yii::$app->params['baseUrl'] ?>product-653.html">
                                                    德国 百乐顺巧克力威化饼干 125g  </a>
                                            </h3>
                                        </div>

                                    </div>
                                </div>

                                <!-- adjunct -->
                                <div class="clearfix">
                                    <div class="product-list-img member-gift-pic goodpic"><a href="<?= Yii::$app->params['baseUrl'] ?>product-663.html"> <img src="<?= Yii::$app->params['baseimgUrl'] ?>90b506879aef2b44f29ac2d44705b22f0ef.jpg"> </a></div>
                                    <div class="goods-main clearfix">
                                        <div class="goodinfo">
                                            <h3>                                  <a target="_blank" class="font-blue" href="<?= Yii::$app->params['baseUrl'] ?>product-663.html">
                                                    波兰 百乐顺迷你可可夹心饼干 130g </a>
                                            </h3>
                                        </div>

                                    </div>
                                </div>

                                <!-- adjunct -->
                                <!-- gift -->
                            </td>

                            <td class="horizontal-m">
                                <div class="clearfix">
                                    <div class="goodinfo" style="width:72px;height:72px;">
                                        <ul>
                                            <li>￥9.50</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="clearfix">
                                    <div class="goodinfo" style="width:72px;height:72px;">
                                        <ul>
                                            <li>￥9.90</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="clearfix">
                                    <div class="goodinfo" style="width:72px;height:72px;">
                                        <ul>
                                            <li>￥5.90</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="clearfix">
                                    <div class="goodinfo" style="width:72px;height:72px;">
                                        <ul>
                                            <li>￥15.90</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="clearfix">
                                    <div class="goodinfo" style="width:72px;height:72px;">
                                        <ul>
                                            <li>￥8.30</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="clearfix">
                                    <div class="goodinfo" style="width:72px;height:72px;">
                                        <ul>
                                            <li>￥24.97</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="clearfix">
                                    <div class="goodinfo" style="width:72px;height:72px;">
                                        <ul>
                                            <li>￥13.01</li>
                                        </ul>
                                    </div>
                                </div>

                            </td>
                            <td class="horizontal-m">
                                <div class="clearfix">
                                    <div class="goodinfo" style="width:72px;height:72px;">
                                        <ul> 
                                            <li>6</li>
                                        </ul>
                                    </div>
                                </div>


                                <div class="clearfix">
                                    <div class="goodinfo" style="width:72px;height:72px;">
                                        <ul> 
                                            <li>1</li>
                                        </ul>
                                    </div>
                                </div>


                                <div class="clearfix">
                                    <div class="goodinfo" style="width:72px;height:72px;">
                                        <ul> 
                                            <li>1</li>
                                        </ul>
                                    </div>
                                </div>


                                <div class="clearfix">
                                    <div class="goodinfo" style="width:72px;height:72px;">
                                        <ul> 
                                            <li>1</li>
                                        </ul>
                                    </div>
                                </div>


                                <div class="clearfix">
                                    <div class="goodinfo" style="width:72px;height:72px;">
                                        <ul> 
                                            <li>1</li>
                                        </ul>
                                    </div>
                                </div>


                                <div class="clearfix">
                                    <div class="goodinfo" style="width:72px;height:72px;">
                                        <ul> 
                                            <li>7</li>
                                        </ul>
                                    </div>
                                </div>


                                <div class="clearfix">
                                    <div class="goodinfo" style="width:72px;height:72px;">
                                        <ul> 
                                            <li>2</li>
                                        </ul>
                                    </div>
                                </div>




                            </td>

                            <td class="point textcenter">
                    <ui>
                        <li>
                            ￥0.00                                </li>
                    </ui>
                    </td>

                    <td class="point textcenter">
                    <ui>
                        <li>
                            ￥249.87                                </li>

                    </ui>
                    </td>

                    <td>
                        <ul>
                            <li>
                                <select name="paytype" id="select_2015070214178965">
                                    <option value="deposit">预存款支付</option>                                                  <option value="doubletenpay">腾讯财付通</option>                                                  <option value="dig">DIG 网上支付</option>                                                  <option value="alipayinstance" selected="selected">支付宝即时支付</option>          
                                </select>
                            </li>
                        </ul>
                    </td>
                    <td>
                        <button type="submit" class="btn order-btn lijizhifu btn-has-icon btn-has-icon"><span><span><i class="btn-icon"><img src="<?= Yii::$app->params['baseimgUrl'] ?>set-arrow.gif"></i>立刻支付</span></span></button>                              </td>
                    </tr>


                    </tbody>
                </table>
                <script>

                    (function() {
                        $('select_2015070214178965').addEvent('change', function(e) { //将付款金额放入all_pay value
                            var value = this.value;
                            $('all_pay_2015070214178965').set('value', value);
                            update_dis_money();
                        });

                    })();

                </script>  

            </form>
            <form id="2015070214570436" target="_blank" action="<?= Yii::$app->params['baseUrl'] ?>paycenter-all_dopayment-order.html" method="post">
                <input type="hidden" class="check_id" name="payment[1][order_id]" value="2015070214570436">
                <input type="hidden" name="payment[1][money]" value="59.00" id="hidden_money">
                <input type="hidden" name="payment[1][currency]" value="CNY">
                <input type="hidden" name="payment[1][cur_money]" value="59.00" id="hidden_cur_money">
                <input type="hidden" name="payment[1][cur_rate]" value="1.0000">
                <input type="hidden" name="payment[1][cur_def]" value="￥">
                <input type="hidden" class="all_pay_" id="all_pay_2015070214570436" name="payment[1][pay_app_id]" value="alipayinstance">
                <input type="hidden" name="payment[1][cost_payment]" value="0.000">
                <input type="hidden" name="payment[1][cur_amount]" value="59.00">
                <input type="hidden" name="payment[1][memo]" value="">
                <table class="gridlist table-goods-list gridlist_member " style="border-bottom:none" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody><tr>
                            <th class="first">订单号</th>
                            <th>订单商品</th>
                            <th>单价（元）</th>

                            <th>数量</th>
                            <th>运费</th>
                            <th>实付款（元）</th>
                            <th>支付方式</th>
                            <th>操作</th>
                        </tr>
                    </tbody><tbody>

                        <tr class="order-list-tr">
                            <td class="vt">
                                <input class="selector" type="checkbox" value="2015070214570436" name="order[]">

                                <a href="<?= Yii::$app->params['baseUrl'] ?>member-orderdetail-2015070214570436.html" class="operate-btn">2015070214570436</a>
                            </td>
                            <td class="horizontal-m">
                                <div class="clearfix">
                                    <div class="product-list-img member-gift-pic goodpic"><a href="<?= Yii::$app->params['baseUrl'] ?>product-1482.html"> <img src="<?= Yii::$app->params['baseimgUrl'] ?>da5ff871b2234960b84b71e8ad76cdfb25b.jpg"> </a></div>
                                    <div class="goods-main clearfix">
                                        <div class="goodinfo">
                                            <h3>                                  <a target="_blank" class="font-blue" href="<?= Yii::$app->params['baseUrl'] ?>product-1482.html">
                                                    新西兰 牛腩 500g </a>
                                            </h3>
                                        </div>

                                    </div>
                                </div>

                                <!-- adjunct -->
                                <!-- gift -->
                            </td>

                            <td class="horizontal-m">
                                <div class="clearfix">
                                    <div class="goodinfo" style="width:72px;height:72px;">
                                        <ul>
                                            <li>￥49.00</li>
                                        </ul>
                                    </div>
                                </div>

                            </td>
                            <td class="horizontal-m">
                                <div class="clearfix">
                                    <div class="goodinfo" style="width:72px;height:72px;">
                                        <ul> 
                                            <li>1</li>
                                        </ul>
                                    </div>
                                </div>




                            </td>

                            <td class="point textcenter">
                    <ui>
                        <li>
                            ￥10.00                                </li>
                    </ui>
                    </td>

                    <td class="point textcenter">
                    <ui>
                        <li>
                            ￥59.00                                </li>

                    </ui>
                    </td>

                    <td>
                        <ul>
                            <li>
                                <select name="paytype" id="select_2015070214570436">
                                    <option value="deposit">预存款支付</option>                                                  <option value="doubletenpay">腾讯财付通</option>                                                  <option value="dig">DIG 网上支付</option>                                                  <option value="alipayinstance" selected="selected">支付宝即时支付</option>          
                                </select>
                            </li>
                        </ul>
                    </td>
                    <td>
                        <button type="submit" class="btn order-btn lijizhifu btn-has-icon btn-has-icon"><span><span><i class="btn-icon"><img src="<?= Yii::$app->params['baseimgUrl'] ?>set-arrow.gif"></i>立刻支付</span></span></button>                              </td>
                    </tr>


                    </tbody>
                </table>
                <script>

                    (function() {

                        $('select_2015070214570436').addEvent('change', function(e) { //将付款金额放入all_pay value

                            var value = this.value;

                            $('all_pay_2015070214570436').set('value', value);

                            update_dis_money();

                        });

                    })();

                </script>  

            </form>
            <ul>
                <li class="deposit_action_jiang" style="display:none;">

                    <input type="hidden" name="payment[combination_pay]" value="false">
                    <span class="form-act">预存款余额：<b class="price">￥0.00</b> </span>

                </li>
            </ul>           
        </div>
        <script>
            window.addEvent('domready', function() {

                $$('input[name^=order[]]').each(function(item) {
                    if (item.checked != true) {
                        item.checked = true;
                    }

                });

                $('selector1').addEvent('click', function() { //全选支付

                    $$('input[name^=order[]]').each(function(item) {
                        if ($('selector1').checked == true) {
                            item.checked = true;
                        } else {
                            item.checked = false;
                        }

                        update_dis_money();//计算付款金额
                    });


                });

                $$('.action-other-payment').addEvent('click', function(e) {


                    $$('.popup-content').setStyle('display', this.checked ? '' : 'none');


                });


                $$('input[name^=order[]]').each(function(item) {

                    item.addEvent('click', function() {

                        update_dis_money();

                    });
                });


                $('he_bin').addEvent('click', function() { //合并支付提交

                    var string = '';
                    $$('input[name^=order[]]').each(function(item) {
                        if (item.checked == true) {
                            var order_id = item.value;

                            string += $(order_id).toQueryString() + '&';

                        }
                    });

                    $$('.action-other-payment').each(function(item) {
                        if (item.checked == true) {
                            string += $$('.deposit_action_jiang').toQueryString();
                        }
                    });

                    $('allnum').set('value', string);

                    var form = $('zu_he');
                    var url = "<?= Yii::$app->params['baseUrl'] ?>paycenter-all_dopayment-order.html";





                    form.action = url;
                    form.submit();


                });
            });

            function update_dis_money() { //计算实际应付款金额
                var old_cur_amount = '';
                $$('input[name^=order[]]').each(function(item) {

                    if (item.checked == true) {
                        var order_id_check = item.value;

                        var string2 = $(order_id_check).toQueryString();
                        var p_1 = string2.indexOf('cur_amount%5D=');
                        var part_1 = string2.substr(p_1 + 14, string2.length);
                        var array_1 = part_1.split('&');
                        var p_2 = string2.indexOf('pay_app_id%5D=');
                        var part_2 = string2.substr(p_2 + 14, string2.length);
                        var array_2 = part_2.split('&');
                        if (array_2[0] == 'deposit') {
                            old_cur_amount = Number(old_cur_amount) + Number(array_1[0]);
                        }

                    }



                });

                var deposit_check_monery = 0.000;

                if (deposit_check_monery - old_cur_amount < 0) {
                    $$('.deposit_action_jiang').setStyle('display', '');
                    $$(".other_online_cur_money").set('value', old_cur_amount - deposit_check_monery);
                    $$(".update-remain-amount").set('html', '￥' + (old_cur_amount - deposit_check_monery));
                } else {
                    $$('.deposit_action_jiang').setStyle('display', 'none');
                }
            }

        </script>

    </div>
</div>
<!-- <div class="sidebar-right">
    <a rel="nofllow" href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&amp;key=XzkzODAwNTIxMF8xNjMxNTlfNDAwMTg4NTE3OV8yXw;" target="_blank" class="qtalk"></a>
    <a href="javascript:void(0)" class="sidebar-backtop"></a>
    <a href="javascript:void(0)" class="sidebar-close"></a>
</div> -->
<script>
    (function() { //回到顶部，不是每个页面都有的
        $$('.sidebar-backtop').addEvent('click', function() {
            $(window).scrollTo(0, 0)
        });
        $$('.sidebar-close').addEvent('click', function() {
            $$('.sidebar-right').setStyle('display', 'none')
        })
    })();
</script>