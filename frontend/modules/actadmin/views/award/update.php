<?php

use backend\assets\CmsAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Cms */

CmsAsset::register($this);
//GridViewAsset::register($this);

$this->title = 'Award Update: ' . ' ' . $model->award_id;
$this->params['breadcrumbs'][] = ['label' => 'Award', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;;
?>
<div class="cms-update">
    <section class="ng-scope">
        <div ui-view="" autoscroll="false" class="content-wrapper ng-scope ng-fadeInUp">
            <h3 class="ng-binding ng-scope"><?=\Yii::t('app','编辑奖品');?></h3>
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </section>
</div>
