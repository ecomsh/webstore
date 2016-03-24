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
class UploadAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/ftzmallold';
    public $js = [
        'js/uploader/plupload.full.min.js',
        'js/uploader/qiniu.min.js'
    ];
    public $css = [
        'css/uploader/style.css'
    ];
    public $depends = [
        'frontend\assets\MainAsset',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

}
