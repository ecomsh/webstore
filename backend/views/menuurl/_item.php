<?php

use yii\helpers\Html;
use yii\helpers\Url;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<tr class="ng-scope odd" role="row">
    <td class="ng-binding"><?= $index + 1; ?></td>
    <?php if(!empty($model->url)){?>
    <td class="ng-binding"><?= Html::encode($model->url)?></td>
    <?php }else{ ?>
    <td class="ng-binding"><?= Html::encode($model->cms_view)?></td>
    <?php } ?>
    <td class="ng-binding"><?= date('Y-m-d H:i:s',$model->stime); ?></td>
    <td class="ng-binding"><?= date('Y-m-d H:i:s',$model->etime); ?></td>
    <td class="ng-binding"><?= $model->is_default == 1 ? '是' : '否' ;?></td>
    <td calss="ng-binding">
        <?= Html::a(Yii::t('app','编辑'), ['menuurl/update', 'id' => $model->id], ['data-pjax' => 0]); ?>
        <?php if(!empty($model->cms_view)){ ?>
        &nbsp;&nbsp;
        <?= Html::a(Yii::t('app','预览'), ['cms/preview', 'view' => $model->cms_view, 'platform' => $platform], ['target' => '_blank' , 'data-pjax' => 0]); ?>
        <?php }elseif(!empty($model->url)){ ?>
        &nbsp;&nbsp;
        <?= Html::a(Yii::t('app','预览'), $model->url, ['target' => '_blank' , 'data-pjax' => 0]); ?>
        <?php } ?>
        
        <?php if($model->is_default != 1){ ?>
        &nbsp;&nbsp;
        <?= Html::a(Yii::t('app','删除'), ['menuurl/delete', 'id' => $model->id], ['data' => ['confirm' => Yii::t('app',"注意：删除后本时间段无法重建！！！ \r\n 确定删除?"),] , 'data-pjax' => 0]); ?>
        <?php } ?>
    </td>
</tr>