<?php
use frontend\assets\ftzmallnew\IndexAsset;
use yii\helpers\Html;
IndexAsset::register($this);
$this->title = $title;
$this->registerMetaTag(['name'=>'keywords', 'content' => $keywords],'keywords');
$this->registerMetaTag(['name'=>'description', 'content' => $description],'description');
?>
<?=$content;?>