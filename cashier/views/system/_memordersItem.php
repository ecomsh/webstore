<?php

use yii\helpers\Url;
use common\helpers\Tools;
use yii\helpers\Html;
?>

<tr>
    <td>
        <?= $model['orderId'] ?>
    </td>
    <td>
        <?= Tools::showDate('Y-m-d H:i:s', $model['orderCreateTimestamp']); ?>
    </td>
    <td>
        <?= $model['orderStatus'] ?>
    </td>
    <td>
        <?= $model['buyerId'] ?>
    </td>
    <td>
        <?= number_format($model['orderAmount'], 2); ?>
    </td>
    <td>
        <?= number_format($model['shippingAmount'],2); ?>
    </td>
    <td>
        <?= abs($model['adjustment']); ?>
    </td>
    <td>
        <?= number_format($model['taxAmount'],2); ?>
    </td>
    <td>
        <?= $model['payAmount'] ?> 
    </td>
    <td>
        <?= $model['rateAmount'] ?> 
    </td>
    <td>
       <?= $model['itemDisplayText'] ?>  
    </td>
    <td>
        <?= $model['shippingReceiverName'] ?>
    </td>
    <td>
        <?= $model['shippingReceiverMobile'] ?>
    </td>
    <td>
        <?= $model['shippingAddress'] ?>
    </td>
</tr>