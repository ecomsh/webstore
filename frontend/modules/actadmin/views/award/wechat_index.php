<?php

use backend\assets\CmsAsset;
use yii\grid\GridViewAsset;
use yii\widgets\ListView;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use frontend\widgets\Alert;
use yii\widgets\Pjax;

CmsAsset::register($this);
GridViewAsset::register($this);

$this->title = 'Wechat List';
?>
<!-- Main section-->
<section class="ng-scope">
    <div ui-view="" autoscroll="false" class="content-wrapper ng-scope ng-fadeInUp">
        <div class="row">
            <div class="col-md-8"><h3 class="ng-binding ng-scope"><?= \Yii::t('app', '微信红包'); ?><small></small></h3></div>
        </div>
    </div>
    
    <div class="panel panel-default ng-scope">
        <div class="panel-heading">
            <?= \Yii::t('app', '微信红包'); ?>
        </div>
        <div class="panel-body">
            <?= Html::a(\Yii::t('app', '返回'), ['award/index'], ['class' => 'btn btn-primary mb-sm']) ?>
            <?= Alert::widget(); ?>
            <?php Pjax::begin(['options' => ['id' => 'DataTables_Table_0_wrapper']]); ?>
            <div ng-controller="SalesController" class="ng-scope">
            	<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                	<table datatable="ng" class="row-border hover ng-isolate-scope dataTable no-footer" style="display: table;" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                        <tbody>
                        	<tr role="row">
                                <th><?= \Yii::t('app', '已发出红包总数'); ?></th>
                                <th><?= \Yii::t('app', '已发出红包总金额'); ?></th>
                                <th><?= \Yii::t('app', '未发出红包总金额'); ?></th>      
                            </tr>
                            <tr class="ng-scope odd" role="row">
                            	<td class="ng-binding"><?= \Yii::t('app', $wechatCount['num_total']); ?></td>
                                <td class="ng-binding"><?= \Yii::t('app', $wechatCount['use_total_amount']); ?></td>
                                <td class="ng-binding"><?= \Yii::t('app', $wechatCount['not_use_total_amount']); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>