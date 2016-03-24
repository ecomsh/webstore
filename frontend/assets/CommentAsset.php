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
class CommentAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/ftzmallold';
    public $css = [
        'css/member.css',
        'css/style.css',
//        'css/lang.css',
    ];
    public $js = [
        'js/dialog.js',
        'js/load.js',
        'js/wpage.js',
    ];
    public $depends = [
        'frontend\assets\MainAsset',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

}
