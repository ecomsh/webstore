<?php
use yii\helpers\Url;
use frontend\helpers\Tools;
?>

<?php
    $statusMap = Yii::$app->params['sm']['refund']['statusMap'];
?>

<tr>
    <td class="text-center" ><a href = "<?=isset($statusMap[$model['Status']])?Url::to(['aftersales/detail','refundId'=> $model['id'] ]):"#" ?>"><?=$model['OrderNo']?></a></td>
    <td class = "textcenter"><?=\Yii::$app->user->identity->getUserName() ?></td>
    <td class = "textcenter"><?= \Yii::$app->formatter->asDate($model['Createts'], 'yyyy-MM-dd hh:mm:ss')?></td>
    <td class = "textcenter">
        <?= isset($statusMap[$model['Status']])?$statusMap[$model['Status']]:"状态异常"  ?>
    </td>
    <td class = "textcenter">
        <a href = "<?=isset($statusMap[$model['Status']])?Url::to(['aftersales/detail','refundId'=> $model['id'] ]):"#" ?>" class = "font-blue">查看</a>
    </td>
</tr>

