<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace mobile\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CartAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/mobile';
    public $css = [   
    ];
    public $js = [
        'js/cart.js',
    ];
    public $depends = [
        'mobile\assets\MainAsset',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}

