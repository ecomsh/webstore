<?php

use yii\helpers\Url;
use common\helpers\Tools;
use yii\helpers\Html;
?>

<tr>
    <td>
        <?= $model['userId'] ?>
    </td>
    <td>
        <?= $model['mobile'] ?>
    </td>
    <td>
        <?php
        if(empty($model['realName'])){
            echo "未认证";
        } 
        else{
            echo "已认证";
        }?>
    </td>
    <td>
        <?= $model['realName'] ?>
    </td>
    <td>
        <?= $model['regDate']?>
    </td>
</tr>