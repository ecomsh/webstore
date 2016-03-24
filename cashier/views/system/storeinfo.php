

<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use cashier\assets\SystemAsset;
//SystemAsset::register($this);

$this->title = "管理后台";
?>
<style type="text/css">
.container-fluid{height: 100%;}
.main{margin-left: -15px;height: 100%;}
</style>
<div class="main">
    <?= $this->render('../layouts/system_nav_left') ?>
    <div class="system-right">
        <table border="1" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th>店铺名称</th>
                    <th></th>
                    <th><?= $storeName?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>			
                    <td>店铺地址</td>
                    <td></td>
                    <td></td>
<!--                    <td>贵州省 遵义市 **区 **路</td>-->
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>