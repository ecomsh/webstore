<?php

use yii\filters\AccessControl;

$current_url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

return [
	'platform' => 2, //app=>1 pc=>2 wechat=>3
    'adminEmail' => 'admin@example.com',
    'baseUrl'=>'http://m.ftzmall.com/',
    /**
     * 后续需要把各个模块的配置文件统一一下
     * sModule=>[
     *  'cart'=>['baseUrl'=>'aaa','isGetCache'=>true,'addNumberLimit'=>59]
     * ]
     */
    //接口地址配置与errorCode配置已迁移到common/config/params.php
    'pageAccess' => [
        'address' => ['class' => AccessControl::className(), 'only' => ['index', 'update'], 'rules' => [['allow' => true, 'roles' => ['@']]]],
        'cart' => ['class' => AccessControl::className(), 'rules' => [['allow' => true, 'roles' => ['@']]]],
        'user' => ['class' => AccessControl::className(), 'rules' => [['allow' => true, 'roles' => ['@']]]],
        'order' => ['class' => AccessControl::className(), 'rules' => [['allow' => true, 'roles' => ['@']]]],
        'realname' => ['class' => AccessControl::className(), 'rules' => [['allow' => true, 'roles' => ['@']]]],
        'account' => ['class' => AccessControl::className(), 'rules' => [['allow' => true, 'roles' => ['@']]]],
        'coupon' => ['class' => AccessControl::className(), 'rules' => [['allow' => true, 'roles' => ['@']]]],
        'refund' => ['class' => AccessControl::className(), 'rules' => [['allow' => true, 'roles' => ['@']]]],
    ],
    'cms_route' => ['site/index', 'article/page', 'sandbox/page', 'sandbox/Histories', 'act/page'],
    'qn' => ['baseimgUrl' => ''],
    'cart' => ['maxbuy' => 50],
    'navMenu' => [
        'items' => [
            ['label' => '首页', 'url' => ['act/page','view' => 'index']],
            // 'Products' menu item will be selected as long as the route is 'product/index'
//                    ['label' => 'About', 'url' => ['article/page'], 'items' => [
//                            ['label' => '联系我们', 'url' => ['/site/contact', 'tag' => 'new']],
//                            ['label' => '曹琦', 'url' => ['/site/caoqi', 'tag' => 'popular']],
//                        ]],
			['label' => '母婴用品', 'url' => ['act/page', 'view' => 'myyp']],
            ['label' => '护肤彩妆',  'url' => ['act/page', 'view' => 'mzgh']],
            ['label' => '食品保健',  'url' => ['act/page', 'view' => 'spbj']],
            ['label' => '家居生活',  'url' => ['act/page', 'view' => 'jjsh']],
            ['label' => '大牌轻奢', 'url' => ['act/page', 'view' => 'qssh']],
//            ['label' => '测试请进', 'url' => ['act/page', 'view' => 'fake_list_0812']],
//            ['label' => 'Buglist', 'url' => ['act/page', 'view' => 'buglist']],
//            ['label' => '迁移商品', 'url' => ['product/getall']],
            //['label' => '手表专场', 'url' => ['act/page', 'view' => 'huodongzhuanqu_239']],
        ],
        'options' => ['class' => 'nav nav-ul'],
        'itemOptions' => ['class' => 'pull-left'],
        'activeCssClass' => 'bg-color1',
    ],
    'mapMenu1' => [
        'items' => [           
            ['label' => '购物流程', 'url' => ['article/page', 'view' => 'gwlc']],
            ['label' => '发票政策', 'url' => ['article/page', 'view' => 'fpzc']],
            ['label' => '安全保证', 'url' => ['article/page', 'view' => 'aqbz']],
            ['label' => '服务保证', 'url' => ['article/page', 'view' => 'fwbz']],
            ['label' => '意见与建议', 'url' => ['article/page', 'view' => 'yjyjy']],
        ],        
    ],
    'mapMenu2' => [
        'items' => [           
            ['label' => '配送范围及运费', 'url' => ['article/page', 'view' => 'psfwjyf']],
            ['label' => '配送服务', 'url' => ['article/page', 'view' => 'psfw']],
            ['label' => '验货与签收', 'url' => ['article/page', 'view' => 'yhyqs']],
        ],        
    ],
    'mapMenu3' => [
        'items' => [           
         /*   ['label' => 'DIG卡支付', 'url' => ['article/page', 'view' => 'digkzf']],*/
            ['label' => '在线支付', 'url' => ['article/page', 'view' => 'zxzf']],
          /*  ['label' => '组合支付', 'url' => ['article/page', 'view' => 'zhzf']],*/
        ],       
    ],
    'mapMenu4' => [
        'items' => [            
            ['label' => '退换货政策', 'url' => ['article/page', 'view' => 'thhzc']],
            ['label' => '退换货流程', 'url' => ['article/page', 'view' => 'thhlc']],
            ['label' => '退款说明', 'url' => ['article/page', 'view' => 'tksm']],
            ['label' => '常见问题', 'url' => ['article/page', 'view' => 'cjwt']],
        ],       
    ],
    'mapMenu5' => [
        'items' => [           
            ['label' => '消费者告知书', 'url' => ['article/page', 'view' => 'xfzgzs']],
            ['label' => '海关通关及关税', 'url' => ['article/page', 'view' => 'hgtgjgs']],
            ['label' => '自贸区直购购物流程', 'url' => ['article/page', 'view' => 'zmqzggwlc']],
            ['label' => '自贸区直购退换货政策', 'url' => ['article/page', 'view' => 'zmqzgthhzc']],
            ['label' => '自贸区直购退换货流程', 'url' => ['article/page', 'view' => 'zmqzgthhlc']],
            ['label' => '自贸区直购退款说明', 'url' => ['article/page', 'view' => 'zmqzgtksm']],
        ],       
    ], 
    'ufavoriteMenu' => [
        'items' => [
            ['label' => '商品收藏', 'url' => ['user/favorite']],
            ['label' => '店铺收藏', 'url' => ['user/sfavorite']],
        ],
        'activeCssClass' => 'current',
    ],
    'uaskMenu' => [
        'items' => [
            ['label' => '我的评论', 'url' => ['comment/']],
            ['label' => '我的咨询', 'url' => ['user/ask']],
            ['label' => '浏览历史', 'url' => ['user/history']],
        ],
        'activeCssClass' => 'current',
    ],
    'ubuyMenu' => [
        'items' => [
            ['label' => '最近购买的商品', 'url' => ['user/buy']],
        ],
        'activeCssClass' => 'current',
    ],
    'utransactionMenu' => [
        'items' => [
            ['label' => '我的订单', 'url' => ['order/index']],
            ['label' => '我的购物车', 'url' => ['cart/index']],
            ['label' => '我的优惠券', 'url' => ['coupon/index']],
            ['label' => '我的预存款', 'url' => ['account/index']],
            //['label' => '预存款充值', 'url' => ['account/deposit']],
            ['label' => '退款退货管理', 'url' => ['aftersales/index']],
        //['label' => '邮件订阅', 'url' => ['user/emails']],
        ],
        'activeCssClass' => 'current',
    ],
    'ucenterMenu' => [
        'items' => [
            ['label' => '账户信息', 'url' => ['user/setting']],
            ['label' => '实名认证', 'url' => ['realname/index']],
           ['label' => '修改密码', 'url' => ['user/security']],
            ['label' => '收货地址', 'url' => ['address/index']],
//            ['label' => '我的积分', 'url' => ['user/point']],
        ],
        'activeCssClass' => 'current',
    ],
    'upowerMenu' => [
        'items' => [
            ['label' => '投诉管理', 'url' => ['complain/']],
            ['label' => '举报管理', 'url' => ['user/reports']],
        ],
        'activeCssClass' => 'current',
    ],
    'staticize' => [
        0 => 'activity-index',
        1 => 'activity-view',
        2 => 'product-view-211',
        3 => 'activity-view-211',
        4 => 'site',
        5 => 'user-index',
        6 => 'gallery-index',
        7 => 'user-orderdetail',
        8 => 'product-211',
    ],

    'searchmoredisplay' => '1', //search页面是否显示更多跟精选,1为显示,0位不显示
    'searchmore' => 2, //search页面从第几行开始显示更多跟精选，只有searchmoredisplay为1时有效
    'AppId' => 'Web', // 用于区分web和mobile
];
