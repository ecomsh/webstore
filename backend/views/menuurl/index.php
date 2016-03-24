<?php

use backend\assets\CmsAsset;
use yii\grid\GridViewAsset;
use yii\widgets\ListView;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use frontend\widgets\Alert;
use yii\widgets\Pjax;
use yii\helpers\Url;

CmsAsset::register($this);
GridViewAsset::register($this);
?>
<!-- Main section-->
<section class="ng-scope">
    <div ui-view="" autoscroll="false" class="content-wrapper ng-scope ng-fadeInUp">
        <div class="row">
            <div class="col-md-8">
                <h3 class="ng-binding ng-scope">
                    <?= \Yii::t('app', 'URL管理'); ?>
                </h3>
            </div>
        </div>

        <div class="panel panel-default ng-scope">
            <div class="panel-heading">
                <?= \Yii::t('app', 'URL管理'); ?>
            </div>
            <div class="panel-body">
                <?= Html::a(\Yii::t('app', '创建URL'), ['create','menu_id'=>$searchModel->menu_id], ['class' => 'btn btn-primary mb-sm']) ?>
                <?= Html::a(Yii::t('app','返回列表'), Url::previous('menu'), ['class' => 'btn btn-primary mb-sm']) ?>
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
                                <?= \Yii::t('app', '搜索'); ?>:<!--<input type="search" class="" placeholder="" aria-controls="DataTables_Table_0">-->
                                <?= Html::activeTextInput($searchModel, 'url'); ?>
                            </label>
                        </div>
                        <table datatable="ng" class="row-border hover ng-isolate-scope dataTable no-footer" style="display: table;" id="DataTables_Table_0" role="grid">
                            <thead>
                                <tr role="row"><!--<th class="sorting_asc  sorting"  ...-->
                                    <th tabindex="0" rowspan="1" colspan="1" style="width: 74px;"></th>
                                    <th  tabindex="0" rowspan="1" colspan="1" style="width: 300px;"><?= \Yii::t('app', '路径URL'); ?></th>
                                    <th  tabindex="0" rowspan="1" colspan="1" style="width: 200px;"><?= \Yii::t('app', '开始时间'); ?></th>
                                    <th  tabindex="0" rowspan="1" colspan="1" style="width: 300px;"><?= \Yii::t('app', '结束时间'); ?></th>
                                    <th  tabindex="0" rowspan="1" colspan="1" style="width: 300px;"><?= \Yii::t('app', '是否为默认URL'); ?></th>
                                    <th tabindex="0" rowspan="1" colspan="1" style="width: 166px;"><?= \Yii::t('app', '操作'); ?></th>
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
                                    ],
                                    'layout' => '{items}',
                                    'showOnEmpty' => true,
                                    'viewParams' => [
                                        'platform' => $platform,
                                    ],
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
                    <h3 class="dt-loading" style="display: none;">Loading...</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->registerJs("jQuery('#DataTables_Table_0_wrapper').yiiGridView($options);"); ?>