<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MenuUrl */

$this->title = '创建URL';
$this->params['breadcrumbs'][] = ['label' => 'Menu Urls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-url-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'startDate' => $startDate,
        'endDate' => $endDate,
        'urlList' => $urlList,
    ]) ?>

</div>
