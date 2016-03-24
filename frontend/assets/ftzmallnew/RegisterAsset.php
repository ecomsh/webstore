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
class RegisterAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/ftzmallnew';
    public $css = [
        'src/css/login.css',
    ];
    public $js =[
    	'src/js/cbt.ui.register.js',
        'src/js/jquery.placeholder.min.js',
        'src/js/cbt.ft.register.update0106.js',
    	'src/js/jquery.md5.js',
    ];
    public $depends = [
        'frontend\assets\ftzmallnew\MainAsset',
    ]; 
    public $jsOptions = ['position' => \yii\web\View::POS_END];

}
