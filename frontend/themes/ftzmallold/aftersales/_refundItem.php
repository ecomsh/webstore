<?php
use yii\helpers\Url;
use frontend\helpers\Tools;
?>

<?php
    $statusMap = Yii::$app->params['sm']['refund']['statusMap'];
?>

<tr>
    <td><a href = "<?=Url::to(['aftersales/detail','refundId'=> $model['id'] ]) ?>" class = "font-blue"><?=$model['OrderNo']?></a></td>
    <td class = "textcenter"><?=\Yii::$app->user->identity->getUserName() ?></td>
    <td class = "textcenter"><?= \Yii::$app->formatter->asDate($model['Createts'], 'yyyy-MM-dd hh:mm:ss')?></td>
    <td class = "textcenter">
        <?= $statusMap[$model['Status']]  ?>
    </td>
    <td class = "textcenter">
        <a href = "<?=Url::to(['aftersales/detail','refundId'=> $model['id'] ]) ?>" class = "font-blue">查看</a>
    </td>
</tr>