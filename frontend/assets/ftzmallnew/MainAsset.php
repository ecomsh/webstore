<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2008 Ftzmall&IBM Software LLC
 * @license http://www.ftzmall.com/license/
 */

namespace frontend\assets\ftzmallnew;

use yii\web\AssetBundle;

/**
 * @author Zonglin He <hezonglin@cn.ibm.com>
 * @since 0.3
 */
class MainAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/ftzmallnew';
    public $css = [
        'http://www.ftzmall.com/themes/ftzmallnew/src/bp/css/bootstrap.css',
        'http://www.ftzmall.com/themes/ftzmallnew/src/css/common.css',
        'http://www.ftzmall.com/themes/ftzmallnew/src/css/layout.css',
        'http://static.tbh.dev/ftzmall/frontend/css/search.css',
//        'src/bp/css/bootstrap.css',
//        'src/css/common.css',
//        'src/css/layout.css',
    ];
    public $js = [  
        'src/js/jquery-1.11.3.min.js',
        'src/js/jquery.cookie.js',
        'src/bp/js/bootstrap.js',
        'src/js/search.js',

    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];

}
