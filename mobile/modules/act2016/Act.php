<?php

namespace mobile\modules\act2016;

class Act extends \yii\base\Module
{
    public $controllerNamespace = 'mobile\modules\act2016\controllers';

    public function init()
    {
        parent::init();

        // 从config.php加载配置来初始化模块
        \Yii::configure($this, require(__DIR__ . '/config/config.php'));
        \Yii::configure($this, require(__DIR__ . '/config/config-local.php'));
        \Yii::configure($this, require(__DIR__ . '/config/config-allinone.php'));
    }
}
