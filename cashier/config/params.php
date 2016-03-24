<?php
return [
    'adminEmail' => 'admin@example.com',
    'qrcode' => ['baseUrl'=>'http://m.ftzmall.com/index.php?'],
    'accounts' =>[   		
		'zunyi'	=> ['channelType'=>'4',      'channelId' => 'zunyi', 'storeName' => '遵义店'],
		'weiniuhui' => ['channelType'=>	'4', 'channelId' => 'weiniuhui', 'storeName' => '鲔牛汇店'],
		'senlan' => ['channelType'=>	'4',    'channelId' => 'senlan', 'storeName' => '森兰店'],
		'lingang' 	=> ['channelType'=>	'4',   'channelId' => 'lingang', 'storeName' => '临港店'],
		'shantou' 	=> ['channelType'=>	'4',   'channelId' => 'shantou', 'storeName' => '汕头店'],
		'wuninglu' 	=> ['channelType'=>	'4',   'channelId' => 'wuninglu', 'storeName' => '武宁路'],
		'xuhui' 	=> ['channelType'=>	'4',   'channelId' => 'xuhui', 'storeName' => '徐汇店'],
    ],
    'tokens' => [
        'zunyi' => 'f76b441f1b053c1c885467b39109cc3e',
        'weiniuhui' => '7c582995b69745696804671637e20287',
        'senlan' => 'ee561228b7e06d65fffb4fa6c3856c2a',
        'lingang' => '37db770660bf3281bcad519f9d200220',
        'shantou' => 'c0767d584286cdcd7d212d699cb40888',
        'wuninglu' => '9d202bb135423839d1184c78c2861e50',
        'xuhui' => 'd05f12104adf019a1b8e5e181679bfc5',
        'ftzmall' => 'd9c94b40706139f769ee180813b3ffd2',
            
        ],
    'system_navmenu' => [
        'items' => [
            ['label' => '店铺信息', 'url' => ['system/index']],
            ['label' => '营业数据', 'url' => ['system/salesdata']],
            ['label' => '注册用户', 'url' => ['system/registeruser']],
            ['label' => '会员销售', 'url' => ['system/memorders']],
            ['label' => '商品查询', 'url' => ['system/iteminfo']],
        ],
        'activeCssClass' => 'current',
        'options'=>[
            'class'=>'inleft',
            ],
    ],
    'cashier'=>[
        //used to generate item url
        'domain'=>'http://m.ftzmall.com',
        'wechatPayurl'=>'http://m.ftzmall.com/pay/wx.html',
    ],
    'payMethod' => [
        'wechat' => '微信',
        'alipay' => '支付宝',
    ],
    'o2omemorders' => [
        'baseUrl' => 'http://192.168.225.12:8080/ecomcbt/o2o_report_search',
	],
		
	'passport' => [
			'baseUrl' => 'http://cbt.backend.internal.localdomain:8080/passport-web/rest/passport/',
	],
    'AppId' => 'Cashier', // 用于区分web和mobile
    'platform' => 4,

];
