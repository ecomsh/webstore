<?php
use yii\helpers\Url;
use common\helpers\Tools;
use yii\helpers\Html;
?>
<style type="text/css">
    .am-active .am-btn-default.am-dropdown-toggle, .am-btn-default.am-active, .am-btn-default:active{
        border-radius:20px 20px;
        background:-webkit-linear-gradient(top,#fff 0,#e0e0e0 100%);
        background:-o-linear-gradient(to bottom, #fff 0px, #e0e0e0 100%);
    }
    .am-btn{padding:.2em 1em;}
    .am-btn-sm,.am-selected-list{font-size: 1.1rem;}
    .ordsta-btn{margin-top: 1rem;line-height: 2rem;max-height: 3rem;height:auto;}
</style>
<li class="mem-order-item">
    <div class="icon orange">
        <?=   isset(Yii::$app->params['sm']['order']['status'][$model['orderStatus']])?Yii::$app->params['sm']['order']['status'][$model['orderStatus']]:''?>
    </div>
    <div class="gb" onclick="window.location.href='<?=Url::to(['order/orderdetail','orderId' => $model['orderId']])?>'">
        <div class="col2">
            <div class="col">
                <div class="order-item">
                    <span class="l-k">订单编号：<?=$model['orderId']?></span>
                    <!-- <span class="l-v"></span> -->
                </div>
                <div class="order-item">
                    <span class="l-k">应付金额：<span class="price">￥<?= $model['totalAmount']?></span></span>
                    
                </div>
                <div class="order-item">
                    <span class="l-k">订单时间：<?= Tools::showDate('Y-m-d H:i:s',$model['createTimestamp']); ?></span>
                   <!--  <span class="l-v"></span> -->
                </div>
            </div>

            <div class="col d-line">
                <div class="t-r">
                    <a href="#">
                      <span class="to-span"></span>
                       <!--  <i class="arr right"></i> -->
                    </a>
                </div>
            </div>
        </div>
    </div>

    <ul class="mem-order-pt c-fix">
        <?php foreach($model['orderLineList'] as $val){ ?>
        <li class="mem-pt-item">
            <a href="<?=Url::to(['product/view','id'=>$val['itemId']])?>" title="<?=$val['quantity']?>--<?=$val['itemDisplayText']?>">
                <img src="<?php echo json_decode($val['itemImageLink'],true)['img'];?>">
            </a>
            <i class="num"><?=$val['quantity']?></i>
        </li>
        <?php } ?>
    </ul>
    <div class="section pay-section">
        <div class="pay-list" id="J_pay_list">
            <!--<select type="select">-->
            <?php if(in_array($model['orderStatus'], $conditions['payment'])){ ?>
            <select data-am-selected="{btnWidth:'70%',maxHeight:'60',btnSize:'sm'}">
                <option value="a" selected>请选择支付方式</option>
                <option value="b">微信</option>
                <!-- <option value="a">支付宝</option>
                <option value="c">财付通</option>
                <option value="d">银行卡</option> -->
            </select>
            <?php } ?>
            <div class="d-line c-fix clearfix ordsta-btn">
                <?php if(in_array($model['orderStatus'], $conditions['payment'])){ ?> <!-- <span style="float:left;display:inline-block;" class="clearfix">已选支付方式：<span style="color:#b60009;">微信支付</span></span> --> <?php } ?>
                <span style="float:left;display:inline-block;" class="clearfix">
                    
                    <?php if(in_array($model['orderStatus'], $conditions['payment'])){ ?>
                    
                    <a class="am-btn am-btn-default am-round am-btn-xs" style="display:inline-block;float:left;margin-right:1rem;" href="<?= Url::to(['pay/wx','orderId'=> $model['orderId']])?>" >去支付</a>
                    
                    <?php } ?>
                    <?php if(in_array($model['orderStatus'], $conditions['confirmreceived'])){ 
                        echo Html::a(Html::encode('确认收货'), ['order/confirmreceived', 'id' => $model['orderId']], ['data' => ['confirm' => '确定已收到货物?'] , 'data-pjax' => 0,'class' => 'paymoney_btn operate-btn am-btn am-btn-success am-round am-btn-xs','style' => 'display:inline-block;float:left;margin-right:1rem;']);
                     } ?>
                    <!--订单的取消-->
                    <?php if(in_array($model['orderStatus'], $conditions['cancelorder'])){ 
                    echo Html::a(Html::encode('取消订单'), ['order/cancelorder', 'id' => $model['orderId']], ['data' => ['confirm' => '确定取消订单?'] , 'data-pjax' => 0,'class' => 'font-blue operate-btn am-btn am-btn-default am-round am-btn-xs','style' => 'display:inline-block;float:left;margin-right:1rem;']);
                    } ?>
                    <?php if(in_array($model['orderStatus'], $conditions['aftersales'])){ ?>
                    <a href="<?= Url::to(['aftersales/add', 'orderId'=>$model['orderId']])?>" data-pjax="0" class="font-blue operate-btn">申请退货</a>
                    <?php } ?>
                </span>
            </div>
        </div>
    </div>
</li>