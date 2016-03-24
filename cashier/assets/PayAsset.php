<?php

namespace cashier\assets;

use yii\web\AssetBundle;

/**
 * @author
 *
 */
class PayAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/web-pos.css',
        'css/cashier.css',
    ];
    public $js = [
        'js/jquery-1.11.3.min.js',
        'js/bootstrap.min.js',
        'js/jquery.cookie.js',
        'js/pay.ft.printer.js',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

/*    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];*/
}
