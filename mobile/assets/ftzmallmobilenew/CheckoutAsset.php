<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace mobile\assets\ftzmallmobilenew;

use yii\web\AssetBundle;

/**
 * @author He zonglin <hezonglin@cn.ibm.com>
 * @since 2.0
 */
class CheckoutAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/wxnew';
    public $css = [      
        'css/m.checkout.css', 
    ];
     public $js = [
        'js/m.ui.message.js',
        'js/m.ui.checkout.js',
        'js/m.ft.checkout.js',
    ];
    public $depends = [
        'mobile\assets\ftzmallmobilenew\MainnewAsset',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];
}

