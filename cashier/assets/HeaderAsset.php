<?php

namespace cashier\assets;

use yii\web\AssetBundle;

/**
 * @author
 *
 */
class HeaderAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/reset.css',
        'css/shouyin.css',
    ];
    public $js = [
        'js/jquery-1.11.3.min.js',
         'js/login-info.js'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

}
