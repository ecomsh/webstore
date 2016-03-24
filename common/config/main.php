<?php
$sn = $_SERVER['SERVER_NAME'];
$domain =  substr($sn, strpos($sn,'.'));

return [
    'language' => 'zh-CN',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
//已经放到了common config main 中
        'session' =>(YII_ENV_PROD)? [
            'class' => 'yii\redis\Session',
            'cookieParams' => ['httponly' => true,'domain'=>$domain],
        ]:[
            'class' => 'yii\web\Session',
           // 'name'=>'ptoken'
            'cookieParams' => ['httponly' => true,'domain'=>$domain],
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '192.168.225.19',
            'port' => 6379,
            'database' => 9,
        ],
//        'session' =>[
//            'class' => 'yii\web\Session',
//            'timeout' => 7*24*3600,
//        ],
       //**注意 线上环境的cms需要登陆ci环境vpn，通过192.168.225.51/webstore_0.3/backend/index.php来修改 或者本地host  cms.ftzmall.com  到192.168.255.51
        // TODO  cms  用户管理登陆
        'db' => [
              'class' => 'yii\db\Connection',
           'dsn' => YII_ENV_PROD?'mysql:host=192.168.225.51;dbname=webstore':'mysql:host=127.0.0.1;dbname=webstore',
            'username' =>YII_ENV_PROD?'passw0rd':'root',
//           'password' => YII_ENV_PROD?'password':'ecomsh',
            'password' => YII_ENV_PROD?'passw0rd':'handaocn',
            'charset' => 'utf8',
            'tablePrefix' => 'cms_',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true, //
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'suffix' => '.html',
            'rules' => [
                'p/<id:\d+>' => 'product/view',
                'pg/<id:\d+>' => 'productgai/view',
                'issue/<view:\w+>' => 'article/page',
                'issuegroup/<view:\w+>' => 'article/pagegroup',
                'sp/<view:\w+>' => 'sandbox/page',
                'act/page' => 'act/page',
                'act/<view:\w+>' => 'act/page',
                '<controller>/<action>' => '<controller>/<action>',
                'index' => 'site/index',
            //'aaa'=>'bksg/index',
// ...
            /*             * [
              'pattern' => 'site-about',
              'route' => 'site/about',
              'suffix' => '.html',
              ], */
            ],
        ],
        'user' => [
            'class' => 'common\models\UserLogin',
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'loginUrl' => ['login/index'],
            'identityCookie' => ['name' => '_u', 'httpOnly' => true],
            'authTimeout' => 86400,
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false, //这句一定有，false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.sohu.com',
                'username' => 'ftzmall@sohu.com',
                'password' => 'ftzmall123',
                'port' => '25',
                'encryption' => 'tls',
            ],
            'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => ['ftzmall@sohu.com' => 'admin']
            ],
        ],
        'assetManager' => [
            'bundles' => [
                /**
                 * 将yii默认的jquery去掉，后续请用MainAsset引入
                 */
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'js' => []
                ],
                /**
                 * 将yii默认的bootstrap去掉，后续请用MainAsset引入
                 */
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'css' => [],
                    'js' => [],
                ]
            ],
        ],
    ],

];
