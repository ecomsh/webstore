<?php

use yii\helpers\Html;
use yii\helpers\Url;

$posts = [
    Html::a('找回密码', ['findpwd/index']),
    Html::a('验证手机，本nav最后上线的时候请删除，谢谢志军', ['findpwd/checkidentity']),
    Html::a('验证邮箱', ['findpwd/checkemail']),
    Html::a('设置密码', ['findpwd/resetpwd']),
    Html::a('设置完成', ['findpwd/complete']),
];
$options['encode'] = false;
?>
<?= Html::ul($posts, $options) ?>


