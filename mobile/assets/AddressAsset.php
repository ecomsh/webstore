<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace mobile\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AddressAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/mobile';
    public $css = [
//        'css/amazeui.css',
//        'css/mobile.css',          
//        'css/styles.css', 
    ];
     public $js = [
//        'js/jquery.min.js',
//        'js/amazeui.js',
//        'js/jquery.noconflict.js',
     	'js/m.ft.address.js',
        'js/three_level_min.js',
    ];
    public $depends = [
        'mobile\assets\ftzmallmobilenew\MainAsset',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}

