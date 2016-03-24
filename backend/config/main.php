<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
if(YII_ENV_ALLINONE){
    $frontendUrl = 'http://wa.soupian.me';
    $mobileUrl = 'http://ma.soupian.me';
}elseif (YII_ENV_PROD){
    $frontendUrl = 'http://www.ftzmall.com';
    $mobileUrl = 'http://m.ftzmall.com';
}else{
    $frontendUrl = 'http://w3.soupian.me';
    $mobileUrl = 'http://m3.soupian.me';
}

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'on beforeRequest' => function ($event) {
        $localeSaved = null;
        if (true){
            # use cookie to store language
            $localeSaved = Yii::$app->request->cookies->get('locale');
        }else{
            # use session to store language
            $localeSaved = Yii::$app->session['locale'];
        }
        $l = ($localeSaved)?$localeSaved:'zh-CN';

      //  Yii::$app->sourceLanguage = 'en';
        Yii::$app->language = $l;
        return; 
    },    
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning','info'],
                ],
            ],
        ],
        'i18n' => [
        'translations' => [
        'yii' => [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'zh-CN',
            'basePath' => '@app/messages'
        ],
    ],
],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
          'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'TkRNUbrCOG0EpdGS_iN3N1Zw6i_lwjk0',
        ],
                ],
    'params' => $params,
    'defaultRoute' => 'cms',
    'aliases' => [
        '@frontendUrl' => $frontendUrl,
        '@mobileUrl' => $mobileUrl,
    ],
];
