<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MenuUrl */

$this->title = '编辑Url';
$this->params['breadcrumbs'][] = ['label' => 'Menu Urls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="menu-url-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'startDate' => $startDate,
        'endDate' => $endDate,
        'urlList' => $urlList,
    ]) ?>

</div>
