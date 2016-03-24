

<?php

use yii\helpers\Html;


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
            <span class="emptyinfo">未查到符合条件的用户数据，请更改查询条件</span>
        </div>   
    </div>
</div>