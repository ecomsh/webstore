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
class AddressAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/wxnew';
    public $css = [
        // 'css/amazeui.css',
        // 'css/mobile.css',          
        'css/m.add-address.css', 
    ];
    
    public $js = [
		'js/cbt.ft.usercenter.address.js',
		'js/cbt.ft.selectcity.js',
    ];
    public $depends = [
        'mobile\assets\ftzmallmobilenew\MainnewAsset',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];
}

