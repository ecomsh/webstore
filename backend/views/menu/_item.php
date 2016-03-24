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
    <td class="ng-binding"><?= Html::encode($model->name)?></td>
    <td calss="ng-binding">
        <?= Html::a(Yii::t('app','编辑导航'), ['menu/update', 'id' => $model->id], ['data-pjax' => 0]); ?>
        &nbsp;&nbsp;
        <?= Html::a(Yii::t('app','编辑URL'), ['menuurl/index', 'MenuUrlSearch[menu_id]' => $model->id] , ['data-pjax' => 0]); ?>
        &nbsp;&nbsp;
        <?= Html::a(Yii::t('app','删除'), ['menu/delete', 'id' => $model->id], ['data' => ['confirm' => Yii::t('app','确定删除?'),] , 'data-pjax' => 0]); ?>
    </td>
</tr>