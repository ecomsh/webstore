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
class RealnameAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/wxnew';
    public $css = [
        'css/m.realname.css',
    ];    
    public $depends = [
        'mobile\assets\ftzmallmobilenew\MainnewAsset',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];

}
