<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2008 Ftzmall&IBM Software LLC
 * @license http://www.ftzmall.com/license/
 */

namespace frontend\assets\ftzmallnew;

//use yii\web\AssetManager;
use yii\web\AssetBundle;

/**
 * @author Zonglin He <hezonglin@cn.ibm.com>
 * @since 0.3
 */
class ProductAssetgai extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/ftzmallnew';
    //public $cssOptions = ['rel' => 'stylesheet/less'];
    public $css = [      
        'src/css/cloud-zoom.css', //放大镜的css
        'src/css/productgai.less',
    ];

    public $js = [      
     //   'src/less/dist/less.js',  //调用less.js
		'src/js/cloud-zoom.1.0.2.js', //放大镜的js
        'src/js/jquery.lazyload.min.js', //lazyload的js         
        'src/js/cbt.ft.selectcity.js', //下拉框的js
        'src/js/jquery.fly.min.js',
        'src/js/cbt.ui.message.js', 
		'src/js/cbt.ft.productgai.js',   
        'src/js/cbt.ui.product.js', 
    ];
	public $depends = [
        'frontend\assets\ftzmallnew\MainAsset',
    ]; 

    public $jsOptions = ['position' => \yii\web\View::POS_END];
}
