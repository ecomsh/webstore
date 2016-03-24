<?php
return (YII_ENV_ALLINONE) ?[
  
    'cashier'=>[
        //used to generate item url
        'domain'=>'http://ma.soupian.me',
        'wechatPayurl'=>'http://ma.soupian.me/pay/wx.html',
    ],
		
	'passport' => [
                        'baseUrl' => 'http://cbt.backend.internal.localdomain:8080/passport-web/rest/passport/',
	],
    'o2omemorders' => [
        'baseUrl' => 'http://192.168.225.12:8080/ecomcbt/o2o_report_search',
    ],
]:[];
