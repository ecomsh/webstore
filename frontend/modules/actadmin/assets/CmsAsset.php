<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\modules\actadmin\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CmsAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/bootstrap.css',
        'css/app.css',
        'css/font-awesome.min.css',
        'css/simple-line-icons.css',
        'css/toaster.css',
        'css/whirl.css',
        'css/jquery.dataTables.css',
            //'css/bootstrap-rtl.css',
            //'css/app-rtl.css',
    ];
    public $js = [
        'js/jquery.js',
        'js/fastclick.js',
        'js/modernizr.js',
        'js/skycons.js',
        'js/screenfull.js',
        'js/animo.js',
        'js/jquery.slimscroll.min.js',
        'js/jquery.classyloader.min.js',
        'js/jquery.dataTables.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

}
