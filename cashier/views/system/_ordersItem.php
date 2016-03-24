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
        <?= Tools::showDate('Y-m-d H:i:s', $model['createTimestamp']); ?>
    </td>
    <td>
        <?= $model['orderStatus'] ?>
    </td>
    <td>
        <?= $model['buyerId'] ?>
    </td>
    <td>
        <?= $model['total'] ?>
    </td>
    <td>
        <?= $model['shippingAmount'] ?>
    </td>
    <td>
        <?= abs($model['adjustmentAmount']+($model['shippingOriginalAmount']-$model['shippingAmount'])); ?>
    </td>
    <td>
        <?= $model['taxAmount'] ?>
    </td>
    <td>
        <?= $model['totalAmount'] ?>
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