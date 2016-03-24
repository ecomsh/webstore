<?php

use yii\filters\AccessControl;

$current_url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

return [
    'platform' => 3, //app1 pc 2 wechat 3
    'pageAccess' => [
        'realname' => ['class' => AccessControl::className(), 'user' => 'mobileUser', 
        		'rules' => [['actions' => ['certify'],'allow' => true,'roles' => ['?']],['allow' => true, 'roles' => ['@']]]],
    	'address' => ['class' => AccessControl::className(), 'user' => 'mobileUser', 
    			'rules' => [ ['actions' => ['completeaddress'], 'allow' => true, 'roles' => ['?']], ['allow' => true, 'roles' => ['@']]]],
        'cart' => ['class' => AccessControl::className(), 'user' => 'mobileUser', 'rules' => [['allow' => true, 'roles' => ['@']]]],
        'user' => ['class' => AccessControl::className(), 'user' => 'mobileUser', 'rules' => [['allow' => true, 'roles' => ['@']]]],
        'order' => ['class' => AccessControl::className(), 'user' => 'mobileUser', 'rules' => [['allow' => true, 'roles' => ['@']]]],
        'coupon' => ['class' => AccessControl::className(), 'user' => 'mobileUser', 'rules' => [['allow' => true, 'roles' => ['@']]]],
        'account' => ['class' => AccessControl::className(), 'user' => 'mobileUser', 'rules' => [['allow' => true, 'roles' => ['@']]]],
        'refund' => ['class' => AccessControl::className(), 'user' => 'mobileUser', 'rules' => [['allow' => true, 'roles' => ['@']]]],
        'pay' => ['class' => AccessControl::className(), 'user' => 'mobileUser', 'rules' => [['allow' => true, 'roles' => ['?', '@']]]],
    ],
    'idendityType' => [
        'mobile' => 'mobile',
        'wx' => 'wx001',
        'username' => 'username'
    ],
    'cms_route' => ['site/index', 'article/page', 'sandbox/page', 'sandbox/Histories', 'act/page'],
    'qn' => ['baseimgUrl' => ''],
    'cart' => ['maxbuy' => 50],
    'userMenu' => [
        'items' => [
            ['label' => '我的订单', 'url' => ['order/index']],
            ['label' => '我的余额', 'url' => ['cart/checkout']],
            ['label' => '我的积分', 'url' => ['user/index']],
            ['label' => '优惠劵', 'url' => ['cart/cartempty']],
//            ['label' => '扫一扫', 'url' => ['user/index']],
            ['label' => '扫一扫', 'url' => 'javascript:void(0);', 'class' => 'scanQRCode0'],
            ['label' => '地址管理', 'url' => ['address/index']],
            ['label' => '实名认证', 'url' => ['realname/index']],
            ['label' => '致电客服', 'url' => 'javascript:void(0);', 'class' => 'js_tel'],
        ],
        'options' => ['class' => 'member-list'],
        'activeCssClass' => 'current',
        'lastItemCssClass' => 'js_tel',
    ],
    'navMenu' => [
        'items' => [
             ['label' => '首页', 'url' => ['act/page','view' => 'demo']],
            // 'Products' menu item will be selected as long as the route is 'product/index'
//                    ['label' => 'About', 'url' => ['article/page'], 'items' => [
//                            ['label' => '联系我们', 'url' => ['/site/contact', 'tag' => 'new']],
//                            ['label' => '曹琦', 'url' => ['/site/caoqi', 'tag' => 'popular']],
//                        ]],
//            ['label' => '爆款闪购', 'url' => ['bksg/']],
//            ['label' => '海外直邮', 'url' => ['hwzg/']],
			['label' => '母婴用品', 'url' => ['act/page','view' => 'baby']],
            ['label' => '护肤彩妆', 'url' => ['act/page','view' => 'beauty']],
            ['label' => '食品保健', 'url' => ['act/page','view' => 'food']],
            ['label' => '家居生活',  'url' => ['act/page', 'view' => 'living']],
            ['label' => '大牌轻奢', 'url' => ['act/page','view' => 'luxury']],
            //['label' => '特卖专区', 'url' => ['site/temai']],
        ],
        'options' => ['class' => 'ui-tab-nav ui-border-b fontclass-tab','style'=>'width:100%'],
        'itemOptions' => [],
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
    'AppId' => 'Mobile', // 用于区分web和mobile
    'o2ostore' =>[   		//TBD, If the backend system admin is ready, no need to mantain this param, call API instead
	'zunyi'	=>  '遵义店',
	'weiniuhui' => '鲔牛汇店',
	'senlan' =>  '森兰店',
	'lingang' => '临港店',
	'shantou' => '汕头店',
	'wuninglu' => '武宁路',
	'xuhui' =>  '徐汇店',
    ],

];
