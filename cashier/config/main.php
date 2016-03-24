<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), 
        require(__DIR__ . '/../../common/config/params-local.php'), 
        require(__DIR__ . '/../../common/config/params-allinone.php'), 
        require(__DIR__ . '/params.php'), 
        require(__DIR__ . '/params-local.php'), 
        require(__DIR__ . '/params-allinone.php')
);

return [
    'id' => 'app-cashier',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'cashier\controllers',
    'components' => [
        /*        'user' => [
          'identityClass' => 'common\models\User',
          'enableAutoLogin' => true,
          ], */
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'cashier/error',
        ],
        'webPOSUser' => [
            'class' => 'cashier\models\WebPOSUserLogin',
            'identityClass' => 'cashier\models\WebPOSUser',
            'enableAutoLogin' => true,
            'loginUrl' => ['login/index'],
            'identityCookie' => ['name' => '_u', 'httpOnly' => true],
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
        ],
    ],
    'defaultRoute' => 'cashier/index',
    'params' => $params,
];
