<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace mobile\modules\act2016\assets;

use yii\web\AssetBundle;

/**
 * 这是模块对应的样式，请自觉修改到对应目录
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ActAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/wxnew/act2016';
    public $css = [
//        'css/amazeui.min.css',
//        'css/mobile.css',         
        'css/m.user.css',
    ];
    public $js = [
        'js/m.ui.user.js',
//        'js/amazeui.min.js',      
//        'js/main.js',       
    ];
    public $depends = [
        'mobile\assets\ftzmallmobilenew\MainnewAsset',
    ];

}
