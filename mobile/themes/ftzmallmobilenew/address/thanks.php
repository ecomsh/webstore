<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '订单地址更新成功';

/**
 * 1.active form 当中的field不能自己定义id，否则会失去客户端验证效果
 * 2.必要时，可以先把enableClientValidation=false 来调节关闭客户端验证后的效果
 * 3.tools_min.js和submit有冲突，添加了额外的disable事件阻止提交
 * 
 */
?>


<div style="padding:0 15px;margin-top:40px;font-size:17px;margin-top:100px">
                <p style="text-align:center;color:#b0020b;">更新成功</p>
                
 <div><p><?php echo $updateInfo?></p> </div>
 </div>
                      
                  