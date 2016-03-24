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
class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/ftzmallold';
    public $css = [
         'css/shopping_cart.css',
        'css/b2c.css',
        'css/framework.css',
        'css/basic.css',
        'css/css.css',
        'css/default.css',    
        'css/lang.css',         
        'css/addpassport.css', 
        'css/mend.css',
        'css/mend_15_4_15.css',
    ];
    public $js = [
        //'js/h.js',
     //   'js/jquery.min.js',    
        'js/lang.js',
        'js/moo_min.js',
      //  'js/tools_min.js',   //hezll submit conflict 
        
        'js/ui_min.js',        
        'js/jquery.js',
        'js/jquery.noconflict.js',
        'js/jquery.cookie.js',
        'js/three_level_min.js'
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}

