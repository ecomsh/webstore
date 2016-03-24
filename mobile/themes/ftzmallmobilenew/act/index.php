<?php
$this->title = $title;
$this->registerMetaTag(['name'=>'keywords', 'content' => $keywords],'keywords');
$this->registerMetaTag(['name'=>'description', 'content' => $description],'description');
?>
<?=$content;?>