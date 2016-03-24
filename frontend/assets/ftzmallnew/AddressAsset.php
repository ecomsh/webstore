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
class AddressAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/ftzmallnew';
    public $css = [
            // 'src/css/member.css',
    ];
    public $js = [
        'src/js/cbt.ft.usercenter.address.js',
        'src/js/cbt.ft.selectcity.js',
    ];
    public $depends = [
        'frontend\assets\ftzmallnew\MainAsset',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];

}
