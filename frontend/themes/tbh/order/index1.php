<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
use frontend\widgets\LinkPager;
use yii\widgets\Pjax;
use frontend\assets\OrderAsset;

/* @var $this yii\web\View */
$this->title = '我的订单_上海外高桥进口商品网';
$getData = Yii::$app->request->get('orderSearch');
OrderAsset::register($this);
?>

<!--right-->
<div class="member-main" id="J_DataTable" style="width: 960px;">
    <div class="orderlist-warp">
        <div class="title title2">我的订单</div>
        <div class="Plate">
            <h4>
                <?php
                    if(!isset($getData['orderStatus']) || empty($getData['orderStatus'])){
                        $displayClass = 'current';
                    }else{
                        $displayClass = '';
                    }
                    
                ?>
                <a href="<?=Url::to(['order/index'])?>" class="<?=$displayClass?>" >全部<!--(3)--></a>
                <a href="javascript:void(0);" args="1" onclick="tosearch(this)" <?= $getData['orderStatus'] == 1 ? 'class = "current"' : ''?>>待付款<!--(3)--></a>
                <a href="javascript:void(0);" args="2" onclick="tosearch(this)" <?= $getData['orderStatus'] == 2 ? 'class = "current"' : ''?>>待发货<!--(3)--></a>
                <a href="javascript:void(0);" args="3" onclick="tosearch(this)" <?= $getData['orderStatus'] == 3 ? 'class = "current"' : ''?>>待确认<!--(0)--></a>
                <a href="javascript:void(0);" args="4" onclick="tosearch(this)" <?= $getData['orderStatus'] == 4 ? 'class = "current"' : ''?>>已完成<!--(2)--></a>
                <a href="javascript:void(0);" args="5" onclick="tosearch(this)" <?= $getData['orderStatus'] == 5 ? 'class = "current"' : ''?>>已关闭<!--(9)--></a>
            </h4>
        </div>  

        <div class="lineh b4">
            <span>
                <form action="<?= Url::to(['order/index']) ?>" method="get" id="frm">
                    <?= Html::beginForm(['order/index'], 'get', ['enctype' => 'multipart/form-data']) ?>
                    订&nbsp;单&nbsp;号：<input autocomplete="off" class="x-input " type="text" name="orderSearch[orderId]" value="<?= $getData['orderId'] ?>" size="10" id="search_order_id" vtype="text">
                    商品名称:<input autocomplete="off" class="x-input " type="text" name="orderSearch[itemDisplayText]" value="<?= $getData['itemDisplayText'] ?>" size="10" id="search_goods_name" vtype="text">      
                    商品货号:<input autocomplete="off" class="x-input " type="text" name="orderSearch[itemPartnumber]" value="<?= $getData['itemPartnumber'] ?>" size="10" id="search_goods_bn" vtype="text">
                    <?=
                    Html::dropDownList(
                            'orderSearch[order_time]', $getData['order_time'], [
                        'all' => '全部时间',
                        '3th' => '三个月内',
                        '6th' => '半年内',
                        'nowYear' => '今年内',
                        '1yearsAgo' => '1年以前',
                            ], [
                        'id' => 'ot',
                        'class' => ' x-input-select inputstyle',
                        'required' => '1',
                            ]
                    );
                    ?>
                    <input type="hidden" id="args" name="orderSearch[orderStatus]" value="<?= $getData['orderStatus'] ?>">
                    <button type="button" class="btn btn-secondary" id="btnsearch"><span><span>搜索</span></span></button>               
                    <?= Html::endForm() ?>
                    <?= Html::beginForm(['order/payment'], 'get', ['enctype' => 'multipart/form-data', 'id' => 'frm_pay', 'target' => '_blank']) ?>
                    <input type="hidden" id="orderIds" name="orderIds" value="">
                    <?= Html::endForm() ?>
                    <?php
                    $js = "jQuery(\"[name='payment']\").click(function(){
                    jQuery('#orderIds').val(jQuery(this).attr('orderId'));
                    jQuery('#frm_pay').submit();
                    });";
                    $this->registerJs($js);
                    ?>
                    </span>
                    </div>

                    <!--        <div class="lineh b4">
                                <span>
                                    <span class="lineall">
                                        <input class="all-selector" type="checkbox" style="margin-left:0"><label>全选</label>
                                    </span>
                                </span>
                            </div>-->

                    <?php Pjax::begin(['options' => ['id' => 'order_list']]); ?>
                    <table id="order_list" class="gridlist table-goods-list gridlist_member " style="border-bottom:none" width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody><tr>
                                <th class="first">订单号</th>
                                <th>订单商品</th>
                                <th>订单金额</th>
                                <th>下单日期</th>
                                <th>卖家</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                        </tbody><tbody>
                            <?php
                            echo ListView::widget([
                                'dataProvider' => $dataProvider,
                                'itemView' => '_ordersItem', //子视图
                                'options' => [
                                    'class' => 'dataTables_info',
                                    'id' => 'DataTables_Table_0_info',
                                    'role' => 'status',
                                    'aria-live' => 'polite',
                                ],
                                'layout' => '{items}',
                                'viewParams' => [
                                    'conditions' => $conditions,
                                ]
                            ]);
                            ?>

                        </tbody>
                    </table>
                    <div class="pager">
                    <!--<span title="已经是第一页" class="unprev">已经是第一页</span>
                    <strong class="pagecurrent">1</strong>
                    <a class="pagernum" href="<?= Yii::$app->params['baseUrl'] ?>member-orders-------2.html">2</a>
                    <a href="<?= Yii::$app->params['baseUrl'] ?>member-orders-------2.html" class="next last" title="下一页">下一页»</a>-->
                        <?=
                        LinkPager::widget([
                            'pagination' => $dataProvider->getPagination(),
                            'options' => ['style' => 'margin:0', 'class' => 'pagination'],
                            'activePageCssClass' => 'pagecurrent',
                            'internalPageCssClass' => 'pagernum',
                            'prevPageCssClass' => 'prevOrder',
                            'nextPageCssClass' => 'nextOrder',
                            'disabledPageCssClass' => '',
                        ]);
                        ?>
                    </div>
                    <?php Pjax::end(); ?> 
                    </div>
                    <!-- right-->

                    <script>
                        /*小图mouseenter效果*/
                        window.addEvent('domready', function () {

                            var cart_product_img_viewer = new Element('div', {styles: {'position': 'absolute', 'zIndex': 500, 'opacity': 0, 'border': '1px #666 solid'}}).inject(document.body);

                            var cpiv_show = function (img, event) {

                                if (!img)
                                    return;
                                cart_product_img_viewer.empty().adopt($(img).clone().removeProperties('width', 'height').setStyle('border', '1px #fff solid')).fade(1);

                                var size = window.getSize(), scroll = window.getScroll();
                                var tip = {x: cart_product_img_viewer.offsetWidth, y: cart_product_img_viewer.offsetHeight};
                                var props = {x: 'left', y: 'top'};
                                for (var z in props) {
                                    var pos = event.page[z] + 10;
                                    if ((pos + tip[z] - scroll[z]) > size[z])
                                        pos = event.page[z] - 10 - tip[z];
                                    cart_product_img_viewer.setStyle(props[z], pos);
                                }

                            };
<?php /**   ?>
                            $$('.gridlist .product-list-img').each(function (i) {

                                new Asset.image(i.get('isrc'), {onload: function (img) {
                                        if (!img)
                                            return;
                                        var _img = img.zoomImg(70, 70);
                                        if (!_img)
                                            return;
                                        _img.setStyle('cursor', 'pointer').addEvents({
                                            'mouseenter': function (e) {
                                                cpiv_show(_img, e);
                                            },
                                            'mouseleave': function (e) {
                                                cart_product_img_viewer.fade(0);
                                            }
                                        });
                                        i.empty().adopt(new Element('a', {href: i.get('ghref'), target: '_blank', styles: {border: 0}}).adopt(_img));
                                    }, onerror: function () {
                                        i.empty();

                                    }});

                            });
<?php **/?>
                        });



                        $('btnsearch').addEvent('click', function () {
                            go_url();
                        });

                        function go_url() {

                            $('btnsearch').disabled = true;
                            set_value();

                        }

                        $('ot').addEvent('change', function () {
                            set_value();
                        });

                        function tosearch(a) {
                            var form = $('frm');
                            var args = a.getAttribute('args');

                            $('args').value = args;
                            form.submit();

                        }

                        function set_value() {
                            var form = $('frm');
                            form.submit();

                        }
                        function cancel(order_id) {
                            Ex_Dialog.confirm('确定要取消该订单吗？', function (e) {
                                if (!e)
                                    return;
                                new Request.JSON({
                                    url: "<?= Yii::$app->params['baseUrl'] ?>member-docancel.html",
                                    data: 'order_id=' + order_id,
                                    method: 'POST',
                                    onSuccess: function (rs) {

                                        Ex_Dialog.alert(rs);

                                        window.location.reload();
                                    }
                                }).send();
                            });

                        }

                        function remind(order_id) {
                            Ex_Dialog.confirm('卖家将会收到发货提醒，确定发送提醒吗？', function (e) {
                                if (!e)
                                    return;
                                new Request.JSON({
                                    url: "<?= Yii::$app->params['baseUrl'] ?>member-remind.html",
                                    data: 'order_id=' + order_id,
                                    method: 'POST',
                                    onSuccess: function (rs) {

                                        Ex_Dialog.alert(rs);

                                        window.location.reload();
                                    }
                                }).send();
                            });

                        }
                    </script>


                    <script>
                        var item = $$('#J_DataTable input[name^=order[]') || [];
                        var all = $$('#J_DataTable .all-selector') || [];
                        window.addEvent('domready', function () {
                            if (item) {
                                item.set('checked', !!$ES('#J_DataTable .all-selector').checked);
                                item.removeEvents('click').addEvent('click', function (e) {
                                    var target = $(e.target);
                                    if (!target.checked && all)
                                        all.set('checked', false);
                                    $ES('#switchable input[name^=operate]').set('value', false);
                                });
                            }
                            if (all)
                                all.removeEvents('click').addEvent('click', function (e) {
                                    var target = $(e.target);
                                    all.set('checked', !!target.checked);
                                    if (item)
                                        item.set('checked', !!target.checked);
                                    $ES('#switchable input[name^=operate]').set('value', !!target.checked);
                                });
                        });
                        function isSelected() {
                            if (!item)
                                return false;
                            for (i = 0; i < item.length; i++) {
                                if (item[i].checked) {
                                    return true;
                                }
                            }
                            if (!all)
                                return false;
                            for (i = 0; i < all.length; i++) {
                                if (all[i].checked) {
                                    return true;
                                }
                            }
                            return false;
                        }

                        function isPayment() {
                            var order_ids = '';
                            $$('#J_DataTable input[name^="order[]"]:checked').each(function (item, index) {
                                if (index == 0) {
                                    order_ids = order_ids + item.value;
                                } else {
                                    order_ids = order_ids + ',' + item.value;
                                }
                            })
                            var tag;
                            new Request.JSON({
                                url: '<?= Yii::$app->params['baseUrl'] ?>member-check_payments.html',
                                method: 'post',
                                secure: false,
                                async: false,
                                data: 'order_id=' + order_ids,
                                onComplete: function (res, text) {
                                    if (res == '1') {
                                        tag = '1';
                                    } else {
                                        tag = '0';
                                    }
                                }
                            }).send();
                            if (tag == '1') {
                                return true;
                            } else {
                                return false;
                            }
                        }

                        function all_pay() {
                            if (!isSelected()) {
                                Ex_Dialog.alert('请选中需要合并付款的订单！');
                                return false;
                            }
                            if (!isPayment()) {
                                Ex_Dialog.alert('合并支付暂时不支持跨境订单的支付，或者包含已支付订单，无法合并支付！');
                                return false;
                            }
                            Ex_Dialog.confirm('确认合并付款？', function (e) {
                                if (!e)
                                    return false;
                                new Request.JSON({
                                    url: '<?= Yii::$app->params['baseUrl'] ?>member-all_orderPayments.html',
                                    method: 'post',
                                    secure: false,
                                    data: $('J_DataTable'),
                                    onComplete: function (res, text) {
                                        console.log(111);
                                        console.log(res);
                                        if (res.error) {
                                            Message.error(res.error);
                                        } else {
                                            console.log(111);
                                            if (!res.data && res.reload != null) {
                                                location.href = res.reload;
                                            } else {
                                                var js = '';
                                                var html = res.data.stripScripts(function (script) {
                                                    js = script;
                                                });

                                                $E('.memberwrap .clearfix').innerHTML = html;
                                                Browser.exec(js);
                                                return;
                                            }
                                        }
                                    }
                                }).send();
                            });
                        }
                    </script>
                    </div>