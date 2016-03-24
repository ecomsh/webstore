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
class ProductAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/ftzmallold';
    public $css = [
        'css/product.css',
        'css/product(1).css',
        'css/jiathis_counter.css',
        'css/jiathis_share.css',
        'css/lang.css',
        'css/widgets.css',	
    ];
    public $js = [
        'js/lang.js',
        'js/moo_min.js',
        'js/tools_min.js',
        'js/ui_min.js',
        'js/jquery.js',
        'js/jquery.noconflict.js',
        'js/three_level_min.js',
        'js/jquery.cookie.js',
        'js/jquery.fly.min.js',
    ];

   /* public $depends = [
        'frontend\assets\MainAsset',
    ]; */ //todo by caoqi,这个页面单独拉样式,有jquery.fly什么的，需要重新排下js,不然报错，其次是需要mend.css覆盖部分样式
    
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

}
