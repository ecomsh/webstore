<?php

use frontend\modules\actadmin\assets\CmsAsset;
use yii\grid\GridViewAsset;
use yii\widgets\ListView;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use frontend\widgets\Alert;
use yii\widgets\Pjax;

CmsAsset::register($this);
GridViewAsset::register($this);

$this->title = 'Buylimits';
?>
<!-- Main section-->
<section class="ng-scope">
    <div ui-view="" autoscroll="false" class="content-wrapper ng-scope ng-fadeInUp">
        <div class="row">
            <div class="col-md-8"><h3 class="ng-binding ng-scope"><?= \Yii::t('app', '限购商品管理'); ?><small></small></h3></div>
        </div>
    </div>
    
    <div class="panel panel-default ng-scope">
        <div class="panel-heading">
            <?= \Yii::t('app', '限购商品管理'); ?>
        </div>
        <div class="panel-body">
            <?= Alert::widget(); ?>
            <div ng-controller="SalesController" class="ng-scope">
            	<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                	<div class="dataTables_length" id="DataTables_Table_0_length">
                    </div>
                    <div id="DataTables_Table_0_filter" class="dataTables_filter">
                    </div>
                    <table datatable="ng" class="row-border hover ng-isolate-scope dataTable no-footer" style="display: table;" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                        <thead>
                            <tr role="row">
                                <th><?= \Yii::t('app', '限购商品数量'); ?></th>
                                <th><?= \Yii::t('app', '操作'); ?></th>
                            </tr>
                            <tr class="ng-scope odd" role="row">
                            	<td class="ng-binding"><?= \Yii::t('app', $itemData['count']); ?></td>
                                <td class="ng-binding"><?= Html::a(Yii::t('app','编辑'), ['buylimits/update', 'id' => $itemData['limits_id']], ['data-pjax' => 0]); ?></td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>