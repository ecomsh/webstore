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

$this->title = 'Award List';
?>
<!-- Main section-->
<section class="ng-scope">
    <div ui-view="" autoscroll="false" class="content-wrapper ng-scope ng-fadeInUp">
        <div class="row">
            <div class="col-md-8"><h3 class="ng-binding ng-scope"><?= \Yii::t('app', '摇一摇奖品管理'); ?><small></small></h3></div>
        </div>
    </div>
    
    <div class="panel panel-default ng-scope">
        <div class="panel-heading">
            <?= \Yii::t('app', '摇一摇奖品管理'); ?>
        </div>
        <div class="panel-body">
        	<?= Html::a(\Yii::t('app', '添加摇一摇奖品'), ['create'], ['class' => 'btn btn-primary mb-sm']) ?>
            <?= Html::a(\Yii::t('app', '微信红包'), ['wechat'], ['class' => 'btn btn-primary mb-sm']) ?>
            <?= Alert::widget(); ?>
            <?php Pjax::begin(['options' => ['id' => 'DataTables_Table_0_wrapper']]); ?>
            <div ng-controller="SalesController" class="ng-scope">
            	<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                	<div class="dataTables_length" id="DataTables_Table_0_length">
                        <label>
                            <?= \Yii::t('app', '显示'); ?>
                            <?=
                            Html::dropDownList(
                                    'pagesize', $pagesize, [
                                '1' => 1,
                                '10' => 10,
                                '25' => 25,
                                '50' => 50,
                                '100' => 100,
                                    ]
                            );
                            ?>
                            <?= \Yii::t('app', '条'); ?>
                        </label>
                    </div>
                    <div id="DataTables_Table_0_filter" class="dataTables_filter">
                        <label>
                            <?= \Yii::t('app', '搜索'); ?>:
                            <?= Html::activeTextInput($searchModel, 'award_name'); ?>
                        </label>
                    </div>
                    <table datatable="ng" class="row-border hover ng-isolate-scope dataTable no-footer" style="display: table;" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                        <thead>
                            <tr role="row"><!--<th class="sorting_asc  sorting"  ...-->
                                <th tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="catalogId: activate to sort column descending"></th>
                                <th  tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="name: activate to sort column ascending"><?= \Yii::t('app', '类型'); ?></th>
                                <th  tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="shortdescription: activate to sort column ascending"><?= \Yii::t('app', '名称'); ?></th>
                                <th  tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="shortdescription: activate to sort column ascending"><?= \Yii::t('app', '编号'); ?></th>
                                <th  tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="shortdescription: activate to sort column ascending"><?= \Yii::t('app', '库存'); ?></th>
                                <th  tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="shortdescription: activate to sort column ascending"><?= \Yii::t('app', '中奖率'); ?>%</th>
                                <th tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="shortdescription: activate to sort column ascending"><?= \Yii::t('app', '状态'); ?></th>                                
                                <th tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="shortdescription: activate to sort column ascending"><?= \Yii::t('app', '操作'); ?></th>        
                            </tr>
                        </thead>
                        <tbody>
							<?php
                            echo ListView::widget([
                                'dataProvider' => $dataProvider,
                                'itemView' => '_item', //子视图
                                'options' => [
                                    'class' => 'dataTables_info',
                                    'id' => 'DataTables_Table_0_info',
                                    'role' => 'status',
                                    'aria-live' => 'polite',
                                ],
                                'layout' => '{items}',
                                'showOnEmpty' => true,
                            ]);
                            ?>
                        </tbody>
                    </table>
                    <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
						<?php
                        echo ListView::widget([
                            'dataProvider' => $dataProvider,
                            'layout' => '{summary}',
                        ]);
                        ?>
                    </div>
                    <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
						<?=
                        LinkPager::widget([
                            'pagination' => $dataProvider->getPagination(),
                            'options' => ['style' => 'margin:0', 'class' => 'pagination'],
                        ]);
                        Pjax::end();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->registerJs("jQuery('#DataTables_Table_0_wrapper').yiiGridView($options);"); ?>