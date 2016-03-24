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
class WxpayAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/wxnew';
    public $css = [
           'fui/css/frozen.css',
           'css/m.wxpay.css',
    ];
    public $js = [
           'js/jquery-1.11.3.min.js',
           'js/m.ft.wxpay.js',
           'js/m.ui.message.js',
    ];
    public $depends = [
        //'mobile\assets\ftzmallmobilenew\MainnewAsset',
    ]; 
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

}
