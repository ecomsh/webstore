<?php

use backend\assets\CmsAsset;
use yii\grid\GridViewAsset;
use yii\widgets\ListView;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use frontend\widgets\Alert;
use yii\widgets\Pjax;

CmsAsset::register($this);
GridViewAsset::register($this);

$this->title = 'Report Data';
?>
<!-- Main section-->
<section class="ng-scope">
    <div ui-view="" autoscroll="false" class="content-wrapper ng-scope ng-fadeInUp">
        <div class="row">
            <div class="col-md-8"><h3 class="ng-binding ng-scope"><?= \Yii::t('app', '摇一摇数据统计'); ?><small></small></h3></div>
        </div>
    </div>
    
    <div class="panel panel-default ng-scope">
        <div class="panel-heading">
            <?= \Yii::t('app', '摇一摇数据统计'); ?>
        </div>
        <div class="panel-body">
            <?= Alert::widget(); ?>
            <?php Pjax::begin(['options' => ['id' => 'DataTables_Table_0_wrapper']]); ?>
            <?php $form = ActiveForm::begin();?>
            日期：<input type="text" id="date" name="date" value="<?= \Yii::t('app', $today); ?>">
            <div ng-controller="SalesController" class="ng-scope">
            	<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                	<table datatable="ng" class="row-border hover ng-isolate-scope dataTable no-footer" style="display: table;" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                        <tbody>
                            <tr class="ng-scope odd" role="row">
                            	<td class="ng-binding"><?= \Yii::t('app', '参与人数'); ?></td>
                                <td class="ng-binding"><?= \Yii::t('app', $reportData['draw_count']); ?></td>
                            </tr>
                            <tr class="ng-scope odd" role="row">
                            	<td class="ng-binding"><?= \Yii::t('app', '中奖人数'); ?></td>
                                <td class="ng-binding"><?= \Yii::t('app', $reportData['win_count']); ?></td>
                            </tr>
                            <tr class="ng-scope odd" role="row">
                            	<td class="ng-binding"><?= \Yii::t('app', '抽奖4次的人数'); ?></td>
                                <td class="ng-binding"><?= \Yii::t('app', $reportData['draw4_count']); ?></td>
                            </tr>
                            <tr class="ng-scope odd" role="row">
                            	<td class="ng-binding"><?= \Yii::t('app', '抽奖5次的人数'); ?></td>
                                <td class="ng-binding"><?= \Yii::t('app', $reportData['draw5_count']); ?></td>
                            </tr>
                            <tr class="ng-scope odd" role="row">
                            	<td class="ng-binding"><?= \Yii::t('app', '抽奖6次的人数'); ?></td>
                                <td class="ng-binding"><?= \Yii::t('app', $reportData['draw6_count']); ?></td>
                            </tr>
                            <tr class="ng-scope odd" role="row">
                            	<td class="ng-binding"><?= \Yii::t('app', '抽奖7次的人数'); ?></td>
                                <td class="ng-binding"><?= \Yii::t('app', $reportData['draw7_count']); ?></td>
                            </tr>
                            <tr class="ng-scope odd" role="row">
                            	<td class="ng-binding"><?= \Yii::t('app', '抽奖8次的人数'); ?></td>
                                <td class="ng-binding"><?= \Yii::t('app', $reportData['draw8_count']); ?></td>
                            </tr>
                            <tr class="ng-scope odd" role="row">
                            	<td class="ng-binding"><?= \Yii::t('app', '抽奖多于8次的人数'); ?></td>
                                <td class="ng-binding"><?= \Yii::t('app', $reportData['draw_more_count']); ?></td>
                            </tr>
                            <tr class="ng-scope odd" role="row">
                            	<td class="ng-binding"><?= \Yii::t('app', '红包发放'); ?></td>
                                <td class="ng-binding"><?= \Yii::t('app', $reportData['packet_count'].'份('.$reportData['packet_total'].'元)'); ?></td>
                            </tr>
                            <tr class="ng-scope odd" role="row">
                            	<td class="ng-binding"><?= \Yii::t('app', '优惠券发放'); ?></td>
                                <td class="ng-binding"><?= \Yii::t('app', $reportData['coupon_count'].'份'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>