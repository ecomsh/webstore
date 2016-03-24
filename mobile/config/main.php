<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/../../common/config/params-allinone.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-mobile',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'zh-CN',
    'controllerNamespace' => 'mobile\controllers',
    'defaultRoute' => 'site',
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => ['@app/views' => '@app/themes/ftzmallmobilenew'],
//                'baseUrl' => '@web/themes/ftzmallold',
            ],
        ],
        'mobileUser' => [
            'class' => 'mobile\models\MobileUserLogin',
            'identityClass' => 'mobile\models\MobileUser',
            'enableAutoLogin' => true,
            'loginUrl' => ['passport/login'],
            'identityCookie' => ['name' => '_u', 'httpOnly' => true],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                 #   'logVars' => [],
                    'levels' => YII_DEBUG ? ['error', 'warning', 'info'] : ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'modules' => [
        'act2016' => [
            'class' => 'mobile\modules\act2016\Act',
        ],
    ],
    'params' => $params,
];
