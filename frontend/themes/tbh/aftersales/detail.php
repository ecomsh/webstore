<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;

use frontend\assets\ftzmallnew\UserAsset;

UserAsset::register($this);

/* @var $this yii\web\View */
$this->title = '退货维权_上海外高桥进口商品网';
?>






<div class="container user-color">


<?= $this->render('../layouts/_user-nav-left') ?>



    <div class="member-right-order">
        <div class="member-main">
            <div class="title">退款退货管理</div>

            <div class="mod_progress clearfix">
                <div class="process">
                    <dl>
                        <dt class="<?= $statusBar[0] ?>">1</dt>
                        <dd>
                            <span>提交申请</span>
                        </dd>
                    </dl>
                    <dl>
                        <dt class="<?= $statusBar[1] ?>">2</dt>
                        <dd>
                            <span>审核</span>
                        </dd>
                    </dl>
                    <dl>
                        <dt class="<?= $statusBar[2] ?>">3</dt>
                        <dd>
                            <span>寄回商品</span>
                        </dd>
                    </dl>
                    <dl>
                        <dt class="<?= $statusBar[3] ?>">4</dt>
                        <dd>
                            <span>退货完成</span>
                        </dd>
                    </dl>
                </div>
            </div>


            <div class = "note clearfix">
                <h3></h3>
                <div class = "clearfix">
                    <div class = "span-auto colborder pl10">退单编号：<span><?= $detail['OrderNo'] ?></span></div>
                    <div class = "span-auto colborder">退单状态： <span><?= $detail['Status'] ?></span></div>
                    <div class = "span-auto last">申请时间：<span><?= \Yii::$app->formatter->asDate($detail['Createts'], 'yyyy-MM-dd HH:mm:ss') ?></span></div>
                </div>
            </div>

            <h4 class = "lineheight-30">退款金额：<span class = "color1 font14px"><?=$detail['OverallTotals']['GrandTotal'] ?> </span></h4>
            <h4 class = "lineheight-30">退款原因：<span class = "color1 font14px"><?=$detail['ReturnType'] ?> </span></h4>
            <h4 class = "lineheight-30">需要退货的商品</h4>

            <table class = "gridlist border-all gridlist_member aftersales-table" cellpadding = "3" cellspacing = "0" width = "100%">
                <colgroup><col class = "span-4">
                    <col class = "span-auto">
                    <col class = "span-4">
                </colgroup><thead>
                <tr>
                    <th class = "first">货号</th>
                    <th>商品名称</th>
                    <th>退货数量</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach($detail['OrderLines']['OrderLine'] as $item ): ?>

                    <tr>
                        <td class = "textcenter"><?=$item['Item']['ItemID']?></td>
                        <td class = "textcenter"><?=$item['Item']['ItemShortDesc']?></td>
                        <td class = "textcenter"><?=(int)$item['OrderedQty']?></td>
                    </tr>

                <?php endforeach;?>

                </tbody>
            </table>


            <h4 class="lineheight-30">详细说明</h4>
            <div class = "division">
                <?=$detail['Comment']?>
            </div>

            <?php if($detail['Status']=='审批已通过'):?>
                <h4 class = "lineheight-30">补充快递信息</h4>
                <div class = "division">

                    <?php

                    if(Yii::$app->session->hasFlash('ship-error')){

                        Alert::begin([
                            'options' => [
                                'class' => 'alert-danger',
                            ],
                        ]);

                        echo Yii::$app->session->getFlash('ship-error');

                        Alert::end();

                    }

                    ?>


                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'shipping-form',
                        'method' => 'post'
                    ]); ?>

                    <?= $form->field($model, 'carrier_name')->textInput([ 'class' => 'form-control x-input inputstyle', 'size' => 30 , 'value'=> isset($detail['CarrierAccountNo'])?$detail['CarrierAccountNo']:''  ])->label('快递公司  ') ?>
                    <?= $form->field($model, 'carrier_number')->textInput([ 'class' => 'form-control x-input inputstyle', 'size' => 30, 'value'=> isset($detail['CarrierServiceCode'])?$detail['CarrierServiceCode']:'' ])->label('快递单号  ') ?>
    
                    <?= Html::submitButton('提交',['class'=>'btn btn-primary']) ?>
                    <?php ActiveForm::end(); ?>
                </div>

            <?php elseif($detail['Status']!='已创建' ):?>
                <h4 class = "lineheight-30">快递信息</h4>
                <div class = "division">
                    <p>快递公司:<span><?=$detail['CarrierAccountNo']?></span></p>
                    <p>快递单号:<span><?=$detail['CarrierServiceCode']?></span></p>
                </div>
            <?php endif;?>


            <h4 class = "lineheight-30">退款记录</h4>
            <div class = "division">
                <ul class="log">

                    <?php for($i = count($refundLog)-1;$i>=0;$i--): ?>
                        <li class="log-item">
                            <div class="time">
                                <span><?= \Yii::$app->formatter->asDate($refundLog[$i]['Timestamp'], 'yyyy-MM-dd') ?></span>
                                <span><?= \Yii::$app->formatter->asDate($refundLog[$i]['Timestamp'], ' hh:mm:ss') ?></span>
                            </div>
                            <div class="info">
                                <div class="text">
                                    <span><?=$refundLog[$i]['LogText']?></span>
                                </div>
                            </div>
                        </li>
                    <?php endfor; ?>

                </ul>
            </div>
        </div>
    </div>
</div>

