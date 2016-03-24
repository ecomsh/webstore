<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Cms */

$this->title = 'Award Create';
$this->params['breadcrumbs'][] = ['label' => 'Award', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-create">
    <section class="ng-scope">
        <div ui-view="" autoscroll="false" class="content-wrapper ng-scope ng-fadeInUp">
            <h3 class="ng-binding ng-scope"><?=\Yii::t('app','添加奖品');?></h3>
			<?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </section>
</div>
