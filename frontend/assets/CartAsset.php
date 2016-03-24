<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CartAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/ftzmallold';
    public $css = [
    ];
    public $js = [
//          //'js/h.js',
//        'js/lang.js',
//        'js/moo_min.js',
        'js/lang(1).js',
        //'js/shoptools_min.js',   
    //    'js/region.js',
        'js/tools_min.js',
            //'js/cart_v1.js',   
    ];
    public $depends = [
        'frontend\assets\MainAsset',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

}
