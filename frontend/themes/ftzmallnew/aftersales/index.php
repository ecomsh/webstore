<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\LinkPager;
use frontend\assets\ftzmallnew\UserAsset;


UserAsset::register($this);

/* @var $this yii\web\View */
$this->title = '退款退货管理_上海外高桥进口商品网';
?>

<style type="text/css">
    #w0{
        display: none;
    }
</style>




<div class="container user-color">
 <?= $this->render('../layouts/_user-nav-left') ?>
    <div class="member-right-order">
        <div class="orderlist-warp">
            <h3>退货退款管理</h3>
            <div class="order-return">
                <ul>
                    <li><a class="current" href="">我发起的退货退款</a></li>
                </ul>
            </div>
            <!--<div class="alert alert-success" role="alert">没有找到数据。</div>-->
            <div class="order-table-warp">
                <table class="table table-bordered order-table aftersales-table">
                    <thead>
                    <tr>
                        <th class="text-center">订单号</th>
                        <th class="text-center">申请人</th>
                        <th class="text-center">申请时间</th>
                        <th class="text-center">处理状态</th>
                        <th class="text-center">操作</th>
                    </tr>
                    </thead>

                    <tbody>

<!--                    <tr>
                        <td class="text-center">
                            <a href="">7538623679634564268</a>
                        </td>
                        <td class="text-center">zap259</td>
                        <td class="text-center">2015-09-24 11:55:47</td>
                        <td class="text-center">已完成</td>
                        <td class="text-center"><a href="">查看</a></td>
                    </tr>-->

                    <?php
                    echo ListView::widget([
                        'dataProvider' => $refundDataProvider,
                        'itemView' => '_refundItem',//子视图
                        'layout' => '{items}'
                    ]);
                    ?>



                    </tbody>
                </table>
            <?php    
            echo LinkPager::widget([
            'pagination' => $refundDataProvider->getPagination(),
            ]);
            ?>
            </div>
        </div>
    </div>
</div>


