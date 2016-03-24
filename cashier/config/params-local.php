<?php

return (YII_ENV_DEV || YII_ENV_TEST) ? [
    'cashier' => [
        //used to generate item url
        'domain' => 'http://m3.soupian.me',
        'wechatPayurl' => 'http://m3.soupian.me/pay/wx.html',
    ],
    'passport' => [
        'baseUrl' => 'http://api.ftzshop.com.cn:8080/passport-web/rest/passport/',
    ],
    
    'o2omemorders' => [
        'baseUrl' => 'http://192.168.225.12:8080/ecomcbt/o2o_report_search',
    ],
        ] : [];
