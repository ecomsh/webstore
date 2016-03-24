<?php

use yii\helpers\Html;

$this->title = "管理后台";
$orderStatus = Yii::$app->request->get('orderStatus');
$order_time = Yii::$app->request->get('order_time');
$startDate = Yii::$app->request->get('startDate');
$endDate = Yii::$app->request->get('endDate');

 if ((!isset($order_time) && !isset($startDate) && !isset($endDate)) || (isset($order_time) && ($order_time == '1th')))
{
    $displayClass = 'current';
} else
{
    $displayClass = '';
}

if((isset($orderStatus) && $orderStatus == 1)|| !isset($orderStatus)){
    $orderStatusCss = 'current';
}
else{
    $orderStatusCss = '';
}

?>
<style type="text/css">
.container-fluid{height: 100%;}
.main{margin-left: -15px;height: 100%;}

</style>

<div class="main">
    <?= $this->render('../layouts/system_nav_left') ?>
    <div class="system-right">
        <h3><span></span> 会员销售(数据仅供参考，准确数据请以ERP报表为准)</h3><br>
        <?= Html::beginForm(['system/memorders'], 'get', ['enctype' => 'multipart/form-data' , 'id' => 'frm', 'onsubmit' => 'checkInput(this)']) ?>
        <label for="shijian">时间：</label>
        <input id="startdate" type="date" name="startDate" value="<?= isset($startDate)? $startDate: ''?>"/> - 
        <input  id="enddate" type="date" name="endDate" value="<?= isset($endDate)? $endDate:'' ?>"/>　
        <input type="hidden" id="orderstatus" name="orderStatus" value="<?= isset($orderStatus) ? $orderStatus : '1' ?>">
        <input type="hidden" id="ordertime" name="order_time" value="<?= isset($order_time) ? $order_time : '1th' ?>">
        <button type="submit">查询</button>
        <a href="javascript:void(0);" ordertime="today" onclick="tosearch(this, 'ordertime')"
         <?php if (isset($order_time) && $order_time == 'today'){ echo'class = "current"';} else{echo'';}?>>　今天</a>
        <span>　｜　最近</span>
        <a href="javascript:void(0);" ordertime="1th" onclick="tosearch(this, 'ordertime')"class="<?= $displayClass ?>">　1个月</a>
        <a href="javascript:void(0);" ordertime="3th" onclick="tosearch(this, 'ordertime')"          
            <?php
            if (isset($order_time) && $order_time == '3th')
            {
                echo'class = "current"';
            } else{echo'';}?>>　3个月</a>
        <a href="javascript:void(0);" ordertime="1yearAgo" onclick="tosearch(this, 'ordertime')"             
            <?php
            if (isset($order_time) && $order_time == '1yearAgo')
            {
                echo'class = "current"';
            } else{echo'';}?>>　1年</a><br><br>
        <label>订单查询条件：</label>
        <a href="javascript:void(0);" orderstatus="1" onclick="tosearch(this, 'orderstatus')"  class = "<?= $orderStatusCss?>">　全部订单</a>
        <a href="javascript:void(0);" orderstatus="2" onclick="tosearch(this, 'orderstatus')"  <?= isset($orderStatus) && $orderStatus == 2 ? 'class = "current"' : '' ?>>　已支付订单</a>
        <?= Html::endForm() ?>
        <div class="inright">
            <span class="emptyinfo">未查到符合条件的订单数据，请更改查询条件</span>
         </div>  
    </div>
</div>
<script>
    function tosearch(a, name) {
        var form = $('#frm');
        var args = $(a).attr(name);
        var domId = '#' + name;
        $(domId).val(args);
        if(name == 'ordertime'){
            $('#startdate').val('');
            $('#enddate').val('');
        }
        form.submit();
    }
    function checkInput(){
        var startdate = $('#startdate').val();
        var enddate = $('#enddate').val();
        if(startdate || enddate){
            $('#ordertime').val('');
        }
//        return true;
    }
</script>