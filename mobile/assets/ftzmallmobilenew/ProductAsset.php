<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace mobile\assets\ftzmallmobilenew;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ProductAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/wxnew';
    public $css = [
        'fui/css/frozen.css',
        'fui/css/font-awesome.css',  
        'css/m.product.css',
    ];
    public $js = [ 
        //'js/jquery-1.11.3.min.js',        
        'fui/lib/zepto.min.js', 
        'fui/js/frozen.js',     
        'js/lazyload.js',
        'js/cbt.ft.selectcity2.js',   //由于jquery冲突，zepto不支持selected选择器，部分jquery代码改写成js
        'js/m.ui.message.js',
        'js/iscroll.js',   
        'js/m.ft.product.js',
        'js/m.ui.product.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];
}

