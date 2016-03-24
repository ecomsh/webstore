<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Liang Jingxi <jingxil@cn.ibm.com>
 * @since 2.0
 */
class RefundAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/ftzmallold';
    public $css = [
        'css/refund.css'
    ];
    public $depends = [
        'frontend\assets\MainAsset',
    ];
    public $cssOptions = ['position' => \yii\web\View::POS_HEAD];

}
