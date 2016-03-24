<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace mobile\assets\ftzmallmobilenew;

use yii\web\AssetBundle;

/**
 * @author He Zonglin <Hezonglin@cn.ibm.com>
 * @since 2.0
 */
class PassportAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/wxnew';
    public $css = [
        'css/m.login.css',
    ];
    public $js = [
        'js/m.ft.passport.update0107.js',
        'js/jquery.md5.js',
    ];
    public $depends = [
        'mobile\assets\ftzmallmobilenew\MainnewAsset',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];

}
