<?php
use yii\helpers\Url;
use common\helpers\Tools;
use yii\helpers\Html;
?>

<tr>
    <td>
        <?=$model['orderId']?>
    </td>
    <td>
        <?=$model['totalAmount']?>
    </td>
    <td>
        <?= Tools::showDate('Y-m-d H:i:s',$model['createTimestamp']); ?>
    </td>
    <td>
         <a href="<?=Url::to(['printer/printorder', 'orderId'=> $model['orderId']])?>">补打小票</a>
    </td>
</tr>