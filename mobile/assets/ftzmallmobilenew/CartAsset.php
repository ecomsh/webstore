<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2008 Ftzmall&IBM Software LLC
 * @license http://www.ftzmall.com/license/
 */

namespace mobile\assets\ftzmallmobilenew;

use yii\web\AssetBundle;

/**
 * @author Zonglin He <hezonglin@cn.ibm.com>
 * @since 0.3
 */
class CartAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/wxnew';
    public $css = [
           'css/m.cart.css',
    ];
    public $js = [  
           'js/m.ui.message.js',
           'js/m.ui.cart.js',
           'js/m.ft.cart.js',
    ];
    public $depends = [
        'mobile\assets\ftzmallmobilenew\MainnewAsset',
    ]; 
    public $jsOptions = ['position' => \yii\web\View::POS_END];

}
