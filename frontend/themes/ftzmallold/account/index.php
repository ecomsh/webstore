<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '预存款_上海外高桥进口商品网';
?>

<!--right-->
<div style = "width: 960px;" class = "member-main">
    <div>
        <div class = "errorMsg">
            <ul>
            </ul>
        </div>
         <div class = "title title2">我的预存款</div>
        <p class = "admin-title admin-title2">您当前的预存款余额为：<span class = "point pr5"><?= $remain ?></span>|<a href = "<?= Url::to(['account/deposit']) ?>" class = "font-blue pl5">预存款充值 &gt;
                &gt;
            </a></p>
            <div class = "title-bg admin-title2"><div><span style = "float:left">预存款交易记录：</span></div></div>
        <table class = "gridlist border-all gridlist_member" cellpadding = "3" cellspacing = "0" width = "100%">
            <thead>
                <tr>
                    <th class = "first">时间</th>
                    <th>事件</th>
                    <th>存入金额</th>
                    <th>支出金额</th>
                    <th>当前余额</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($record && is_array($record))
                {
                    $tradetypemsg=[
                        '1' => '充值',
                        '2' => '扣款',
                        '3' => '退款'
                    ];
                    $totalAmount = 0;
                    foreach($record as $k=>$v):?>
                        <tr>
                        <td align = "center"><?= $v['tradeTime'] ?></td>
                        <td align = "center"> 
                        <?= $tradetypemsg[$v['tradeType']]?>
                        </td>
                        <?php if(($v['tradeType'] == 1) || ($v['tradeType'] == 3)){
                            $totalAmount += $v['amount'];?>
                        <td class = "textcenter font-orange">¥<?= $v['amount']?></td>
                        <td class = "textcenter">-</td>
                        <?php } else{ 
                            $totalAmount -= $v['amount'];?>
                        <td class = "textcenter font-orange">-</td>
                        <td class = "textcenter">¥<?= $v['amount']?></td>
                        <?php }?>
                        <td class = "fontbold textcenter font-red"><?= $totalAmount?></td>
                        </tr>
                    <?php endforeach;
                }?>
            </tbody>
        </table>
    </div>
</div>
<!--right-->

