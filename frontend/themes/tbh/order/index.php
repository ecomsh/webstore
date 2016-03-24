<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
use frontend\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use frontend\widgets\Alert;
use frontend\assets\ftzmallnew\UserAsset;

UserAsset::register($this);


/* @var $this yii\web\View */
$this->title = '我的订单_上海外高桥进口商品网';
$getData = Yii::$app->request->get('orderSearch');
?>
<div class="container user-color">
    <?= $this->render('../layouts/_user-nav-left') ?>
    <div class="member-right-order">
        <div class="orderlist-warp">
            <h3>我的订单</h3>
            <div class="plate">
                <h4>
                    <?php
                    if (!isset($getData['orderStatus']) || empty($getData['orderStatus']))
                    {
                        $displayClass = 'current';
                    } else
                    {
                        $displayClass = '';
                    }
                    ?>
                    <a href="<?= Url::to(['order/index']) ?>" class="<?= $displayClass ?>" >全部<!--(3)--></a>
                    <a href="javascript:void(0);" args="1" onclick="tosearch(this)" <?= $getData['orderStatus'] == 1 ? 'class = "current"' : '' ?>>待付款<!--(3)--></a>
                    <a href="javascript:void(0);" args="2" onclick="tosearch(this)" <?= $getData['orderStatus'] == 2 ? 'class = "current"' : '' ?>>待发货<!--(3)--></a>
                    <a href="javascript:void(0);" args="3" onclick="tosearch(this)" <?= $getData['orderStatus'] == 3 ? 'class = "current"' : '' ?>>待确认<!--(0)--></a>
                    <a href="javascript:void(0);" args="4" onclick="tosearch(this)" <?= $getData['orderStatus'] == 4 ? 'class = "current"' : '' ?>>已完成<!--(2)--></a>
                    <a href="javascript:void(0);" args="5" onclick="tosearch(this)" <?= $getData['orderStatus'] == 5 ? 'class = "current"' : '' ?>>已关闭<!--(9)--></a>

                </h4>
            </div>
            <div class="order-search">
                <?= Html::beginForm(['order/index'], 'get', ['enctype' => 'multipart/form-data' , 'id' => 'frm']) ?>
                订&nbsp;单&nbsp;号：<input autocomplete="off" class="form-control order-input" type="text" name="orderSearch[orderId]" value="<?= $getData['orderId'] ?>" size="10" id="search_order_id" vtype="text">&nbsp;&nbsp;
                商品名称:<input autocomplete="off" class="form-control order-input " type="text" name="orderSearch[itemDisplayText]" value="<?= $getData['itemDisplayText'] ?>" size="10" id="search_goods_name" vtype="text">&nbsp;&nbsp;      
                商品货号:<input autocomplete="off" class="form-control order-input" type="text" name="orderSearch[itemPartnumber]" value="<?= $getData['itemPartnumber'] ?>" size="10" id="search_goods_bn" vtype="text">&nbsp;&nbsp;
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
                    'class' => 'form-control order-select',
                    'required' => '1',
                        ]
                );
                ?>&nbsp;&nbsp;
                <input type="hidden" id="args" name="orderSearch[orderStatus]" value="<?= $getData['orderStatus'] ?>">
                <button type="submit" class="btn btn-success order-btn">搜索</button>
                <?= Html::endForm() ?>
                
            </div>
            <div class="order-table-warp">
                <table class="table table-bordered order-table">
                    <thead>
                        <tr>
                            <th class="text-center">订单号</th>
                            <th class="text-center">订单商品</th>
                            <th class="text-center">订单金额</th>
                            <th class="text-center">下单日期</th>
                            <th class="text-center">卖家</th>
                            <th class="text-center">状态</th>
                            <th class="text-center">操作</th>
                        </tr>
                    </thead>
                    <tbody>
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
                                'packageChildren' => $packageChildren,
                            ]
                        ]);
                        ?>
                    </tbody>
                </table>
            </div>
            <nav>
                <?=
                LinkPager::widget([
                    'pagination' => $dataProvider->getPagination(),
                    'options' => ['class' => 'pagination pagination-sm'],
                    'activePageCssClass' => 'active',
                    'internalPageCssClass' => '',
                    'prevPageCssClass' => 'prevOrder',
                    'nextPageCssClass' => 'nextOrder',
                    'disabledPageCssClass' => '',
                    'nextPageLabel' => '下一页',
                    'prevPageLabel' => '上一页',
                ]);
                ?>
                
            </nav>
        </div>
    </div>
</div>
<script>
    function tosearch(a) {
        var form = $('#frm');
        var args = $(a).attr('args');

        $('#args').val(args);
        form.submit();
    }
</script>