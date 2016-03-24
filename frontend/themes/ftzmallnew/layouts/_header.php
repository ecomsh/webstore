<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
?>
<div class="header">
	<div class="container clearfix">	
		<div class="pull-left logo">
			<a href="<?=Url::to(['act/page','view'=>'index'])?>"><img src="<?=Url::to('@web/themes/ftzmallnew/src/images/logo.png', true)?>"></a>
		</div>
		<?= $this->render('_search') ?>
	</div>
</div>