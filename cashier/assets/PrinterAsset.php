<?php

namespace cashier\assets;

use yii\web\AssetBundle;

/**
 * @author
 *
 */
class PrinterAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/reset.css',
        'css/budaxiaopiao.css',
    ];
    public $js = [
//         'js/cashier.ui.printer.js',
        'js/jquery-1.11.3.min.js',
        'js/cashier.ft.printer.js'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

}
