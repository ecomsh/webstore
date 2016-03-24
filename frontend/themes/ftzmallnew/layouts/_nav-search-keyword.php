<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
?>
<ul class="nav search-nav">
	<li class="pull-left"><a href="<?= Url::to(['search/index','search'=>"资生堂"]);?>">资生堂</a>|</li>
	<li class="pull-left"><a href="<?= Url::to(['search/index','search'=>"肌研"]);?>">肌研</a>|</li>
	<li class="pull-left"><a href="<?= Url::to(['search/index','search'=>"嘉宝"]);?>">嘉宝</a>|</li>
	<li class="pull-left"><a href="<?= Url::to(['search/index','search'=>"花王"]);?>">花王</a>|</li>
	<li class="pull-left"><a href="<?= Url::to(['search/index','search'=>"爱他美"]);?>">爱他美</a>|</li>
	<li class="pull-left"><a href="<?= Url::to(['search/index','search'=>"Swisse"]);?>">Swisse</a>|</li>
	<li class="pull-left"><a href="<?= Url::to(['search/index','search'=>"EDO"]);?>">EDO零食</a>|</li>
    <li class="pull-left"><a href="<?= Url::to(['search/index','search'=>"妙巴黎"]);?>">妙巴黎</a></li>
</ul>