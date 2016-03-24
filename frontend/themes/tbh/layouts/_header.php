<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
?>

<div class="header">
	<div class="container">	
		
            <a href="<?=Url::to(['act/page','view'=>'index'])?>"><img class="logo" src="<?= Yii::$app->params['staticUrl'] ?>images/logo.jpg"></a>
		
            <?= $this->render('_search') ?>
            
	</div>
</div>