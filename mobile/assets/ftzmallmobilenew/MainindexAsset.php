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
class MainindexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/wxnew';
    public $css = [
        'fui/css/frozen_index.css',
        'fui/css/font-awesome.css',  
        'css/m.index.css',
        'css/m.act.css'

    ];
    public $js = [ 
               'js/jquery-1.11.3.min.js',
        'js/jquery.cookie.js',
        'fui/lib/zepto.min.js',
        'fui/js/frozen.js',
        'js/m.ft.cartbar.js',
        'js/m.ft.index.js',
        'js/ftzmallWebView.js'
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}

