<?php

use frontend\assets\ftzmallnew\MainAsset;
use frontend\assets\ftzmallnew\FindpwdAsset;
use yii\helpers\Html;
MainAsset::register($this);
FindpwdAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=1200" />
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
        <?= $this->render('_header-findpwd') ?>
        <?= $content ?>   
        <?= $this->render('_footer') ?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>