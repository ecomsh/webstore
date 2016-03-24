

<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use frontend\widgets\LinkPager;

$this->title = "管理后台";
$startDate = Yii::$app->request->get('startDate');
$endDate = Yii::$app->request->get('endDate');
$defStartDate = date('Y-m-d', strtotime("-1 month"));
$defEndDate = date('Y-m-d');
?>
<style type="text/css">
.container-fluid{height: 100%;}
.main{margin-left: -15px;height: 100%;}

</style>
<div class="main">
    <?= $this->render('../layouts/system_nav_left') ?>
    <div class="system-right">
        <h3><span></span> 注册用户</h3><br>
        <?= Html::beginForm(['system/registeruser'], 'get', ['enctype' => 'multipart/form-data' , 'id' => 'frm']) ?>
        <label for="shijian">时间：</label>
        <input id="startdate" type="date" name="startDate" value="<?= isset($startDate)? $startDate: $defStartDate?>"/> - 
        <input  id="enddate" type="date" name="endDate" value="<?= isset($endDate)? $endDate: $defEndDate ?>"/>　
        <button type="submit">查询</button>
        <?= Html::endForm() ?>
        <div class="inright">
            <span class="total-info">符合筛选条件的注册用户总数：<?= $dataProvider->getTotalCount(); ?>个</span>
            <table border="1" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>用户编号</th>
                        <th>手机号</th>
                        <th>实名认证状态</th>
                        <th>实名姓名</th>
                        <th>注册时间</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                echo ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_usersItem', //子视图
                    'layout' => '{items}',
                ]);
                ?>
            </tbody>
            </table>
        </div>   
        <nav class="clearfix">
            <span class="current-info">本页注册用户数：<?= $dataProvider->getCount(); ?>个</span>
        <?=
        LinkPager::widget([
            'pagination' => $dataProvider->getPagination(),
            'options' => ['class' => 'pagination pagination-sm'],
            'activePageCssClass' => 'active',
            'internalPageCssClass' => '',
            'prevPageCssClass' => 'prevPage',
            'nextPageCssClass' => 'nextPage',
            'disabledPageCssClass' => '',
            'nextPageLabel' => '下一页',
            'prevPageLabel' => '上一页',
        ]);
        ?>
        </nav>
    </div>
</div>