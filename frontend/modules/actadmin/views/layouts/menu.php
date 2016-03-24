<?php

use yii\helpers\Html;
use yii\helpers\Url;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?= Html::a(Yii::t('app','摇一摇奖品管理'), ['award/index'], ['data-pjax' => 0]); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?= Html::a(Yii::t('app','摇一摇数据统计'), ['award/report'], ['data-pjax' => 0]); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?= Html::a(Yii::t('app','限购商品管理'), ['buylimits/index'], ['data-pjax' => 0]); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
