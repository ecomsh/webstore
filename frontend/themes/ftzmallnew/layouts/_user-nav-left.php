<?php

use yii\helpers\Url;
use yii\widgets\Menu;

?>
<div class="member-left">
    <h4 class="member-title">会员中心</h4>
    <ul class="member-ul">
        <span>交易管理</span>
        <?php
        echo Menu::widget(Yii::$app->params['utransactionMenu'],['activeCssClass'=>'current']);
        ?>   
    </ul>
    <ul class="member-ul">
        <span>账户中心</span>
        <?php
        echo Menu::widget(Yii::$app->params['ucenterMenu'],['activeCssClass'=>'current']);
        ?>  
    </ul>
</div>
