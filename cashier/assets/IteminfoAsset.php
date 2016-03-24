<?php

namespace cashier\assets;

use yii\web\AssetBundle;

/**
 * @author
 *
 */
class IteminfoAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/iteminfo.css'
    ];
    public $js = [
         'js/jquery-1.11.3.min.js',
        'js/system.ui.iteminfo.js'
//        'js/cashier.ft.salesdata.js',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

}
