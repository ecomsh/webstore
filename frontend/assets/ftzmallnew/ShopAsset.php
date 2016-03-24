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
class ShopAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/ftzmallnew';
    public $css = [
        'http://static.tbh.dev/ftzmall/frontend/css/search.css',
    ];   
    public $js = [
        'src/js/cbt.ui.search.js',
        'src/js/cbt.ft.search.js',
    ];  
    public $depends = [
        'frontend\assets\ftzmallnew\MainAsset',
    ]; 
    public $jsOptions = ['position' => \yii\web\View::POS_END];
}
