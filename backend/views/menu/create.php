<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Menu */

$this->title = '创建栏目';
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'menuUrl' => $menuUrl,
        'urlList' => $urlList,
    ]) ?>

</div>
