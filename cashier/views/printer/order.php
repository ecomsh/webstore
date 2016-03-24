
<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use frontend\widgets\LinkPager;
use cashier\assets\PrinterAsset;

PrinterAsset::register($this);

$this->title = "补打小票";
?>

<div class="zheng">
    <div class="main">
        <h4 class="text-primary">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            &nbsp;当前会员：
            <span id="uname"><?= $realname?></span>
        </h4>
        <table border="1" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th>订单编号</th>
                    <th>金额</th>
                    <th>下单时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php
                echo ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_ordersItem', //子视图
                    'layout' => '{items}',
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
<script>
    var URL = {
        queryUser: '<?= Url::to(['printer/queryuser']) ?>',
        orderUrl: '<?= Url::to(['printer/order']) ?>'
    }
</script>