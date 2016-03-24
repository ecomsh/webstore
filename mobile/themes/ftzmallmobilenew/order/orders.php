<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
use frontend\widgets\LinkPager;
use yii\widgets\Pjax;

use mobile\assets\ftzmallmobilenew\OrderAsset;
OrderAsset::register($this);

/* @var $this yii\web\View */
$this->title = '我的订单';
$getData = Yii::$app->request->get('orderSearch');
?>
<section class="ui-container">

                <div class="ui-tab">
                    <ul class="ui-tab-nav ui-border-b">
                        <li class="<?php if($getData['orderStatus'] == 1 || !isset($getData['orderStatus'])){ echo 'current'; }?>"><a href="<?=  Url::to(['order/index','orderSearch[orderStatus]' => '1'])?>">待付款</a></li>
                        <li class="<?= $getData['orderStatus'] == 2 ? 'current' : ''?>"><a href="<?=  Url::to(['order/index','orderSearch[orderStatus]' => '2'])?>">配送中</a></li>
                        <li class="<?= $getData['orderStatus'] == 3 ? 'current' : ''?>"><a href="<?=  Url::to(['order/index','orderSearch[orderStatus]' => '3'])?>">已完成</a></li>
                        <li class="<?= $getData['orderStatus'] == 4 ? 'current' : ''?>"><a href="<?=  Url::to(['order/index','orderSearch[orderStatus]' => '4'])?>">已关闭</a></li>
                        <li class="<?= $getData['orderStatus'] == 5 ? 'current' : ''?>"><a href="<?=  Url::to(['order/index','orderSearch[orderStatus]' => '5'],true)?>">退换货</a></li>
                    </ul>
                    <ul class="ui-tab-content">
                        <!--待付款-->
                        <?php Pjax::begin(['options' => ['id' => 'order_list','class'=>'order-list']]); ?>
                  

                                <?php
                                echo ListView::widget([
                                    'dataProvider' => $dataProvider,
                                    'itemView' => '_ordersItem', //子视图
                                    'layout' => '{items}',
                                    'viewParams' => [
                                        'conditions' => $conditions,
                                        'packageChildren' => $packageChildren,
                                    ],
                                    'emptyText' => '暂无订单',
                                ]);
                                ?>
                        
                        <?=
                        LinkPager::widget([
                            'pagination' => $dataProvider->getPagination(),
                            'options' => ['class' => 'pagination-group'],
                            'activePageCssClass' => 'page-active',
                            'internalPageCssClass' => 'pagination-item',
                            'prevPageCssClass' => 'prevOrder',
                            'nextPageCssClass' => 'nextOrder',
                            'disabledPageCssClass' => '',
                            'maxButtonCount'=>5,
                        ]);
                        ?>
                        <?php Pjax::end(); ?> 
                        <?= Html::beginForm(['order/pay'], 'post', ['id' => 'payForm', 'enctype' => 'multipart/form-data', 'target' => '_blank', 'isSubmit' => 'T']) ?>
                            <input type="hidden" class="check_id" id='orderId' name="orderId" value="" >
                            <input type="hidden" id="payMethod" name="payMethod" value="AliPay" >
                            <input type="hidden" id='subject' name="subject" value="" >
                            <input type="hidden" name="itemSum" value=4 >
                            <input type="hidden" name="return_url_pay" value="<?= Url::to(['order/index'], true) ?>" >
                        <?= Html::endForm() ?>
                    </div>
                </div>
                
</section>
