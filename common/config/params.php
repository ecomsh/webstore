<?php

return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'CAS' => [
        'domain' => 'pa.soupian.me',
        'port' => 443,
        'path' => '/passport-cas',
        'cas_path' => '/usr/share/pear/CAS.php',
        'cacert' => 'path to cert',
        'regUrl' => 'https://pa.soupian.me/passport-reg/?service=http://www.ftzmall.com/login.html',
        //PC 端注册成功后需要调用该变量loginUrl，重定向到登陆页加上参数实现注册后自动登陆功能。
        'loginUrl' => 'https://pa.soupian.me/passport-cas/login?service=http://www.ftzmall.com/login.html',
    ],
    /*     * notice: 以下配置在www.shotki.com的线上环境时使用。若自己在本地调试前端，
     *      
     * 本地请启用params-loacl中的配置
     */
    'cps' => [
        'domain' => '.ftzmall.com',
        'duomai' => ['expire' => 60 * 60 * 24 * 5, 'hash' => 'b1a8a0bf7cd3ec4b56a312cb6ea6cec4'],
        'chanet' => ['expire' => 60 * 60 * 24 * 5, 'key' => 'YR3tt3KG4wpuPkIA'],
        'xxx' => [],
        'ooo' => [],
    ],
    /**/
    'sm' => [
        'store' => [
            'maxAmount' => 800,
            'key' => [
                'ybmyDig' => 1,
                'ybmyGyx' => 2,
                'hw' => 3,
                'kjbhZy' => 4,
                'kjbhFx' => 5
            ],
            'display' => ['1' => '一般贸易-DIG发货订单',
                '2' => '一般贸易-供应商直送',
                '3' => '海外直邮',
                '4' => '跨境备货-自营订单',
                '5' => '跨境备货-分销订单',
            ],
            'isCBT' => [3, 4, 5],
            'needmfName' => [2, 3],
            'showButton' => [
                'payment' => ['CREATED', 'CREATING'],
                'confirmreceived' => ['INCLUDED_IN_SHIPPMENT'],
                'cancelorder' => ['CREATED', 'CREATING', 'SCHEDULED'],
                'aftersales' => ['INCLUDED_IN_SHIPPMENT', 'SHIPPED', 'RETURN_CREATED', 'RETURN_RECEIVED', 'REFUND_CREATED', 'REFUNDED', 'RETURN_CANCELED'],
            ],
            'detailShowButton' => [
                'payment' => ['CREATED', 'CREATING'],
                'shippment' => ['PAID', 'SCHEDULED', 'RELEASED'],
                'confirmreceived' => ['INCLUDED_IN_SHIPPMENT'],
            ],
            'payType' => [
                'AliPay' => '支付宝',
                'TenPay' => '财付通',
                'DIG' => 'DIG',
                'Wechat' => '微信',
                'Account' => '账户余额',
                'Easipay' => '东方支付',
                '99bill' => '快钱',
                'WechatSelfRun' => '微信',
                'AliPayQr' => '支付宝',
            ],
            'domain' => 'http://www.ftzmall.com', //给web pos用的前端域名，真正上线之后需要调整。
        ],
        'cart' => [
            'baseUrl' => 'http://api.soupian.me:8080/trade-web/rest/v1/cart/',
            'isGetCache' => true,
            'addNumberLimit' => 59,
            'store' => ['1_' => 'FTZMALL国内仓直发',
                '2' => '一般贸易-供应商直送',
                '3' => '海外直邮',
                '4_' => '跨境备货-自营订单',
                '5_' => '海关保税仓直发',
            ],
            'isRealname' => [3, 4, 5],
        ],
        'price' => [
            'baseUrl' => 'http://api.soupian.me:8080/calculation-web/rest/v1/price/',
        ],
        'order' => [
            'baseUrl' => 'http://api.soupian.me:8080/trade-web/rest/v1/order/',
            'status' => [
                "CREATED" => "待付款（已创建）",
                'CREATING' => '待付款（创建中）',
                "PAID" => "待发货（已支付）",
                "SCHEDULED" => "待发货（处理中）",
                "RELEASED" => "待发货（准备出库）",
                "INCLUDED_IN_SHIPPMENT" => "待确认（等待收货）",
                "SHIPPED" => "已完成（交易成功）",
                "CLOSED" => "已关闭（交易关闭）",
                "CANCELED" => "已关闭（取消交易）",
                "RETURN_CREATED" => "已申请退货退款",
                "RETURN_RECEIVED" => "退货中",
                "REFUND_CREATED" => "退款中",
                "REFUNDED" => "退款完成",
                "RETURN_CANCELED" => "退货拒绝",
            ],
            'subStatus' => [
                '1' => '卖家取消',
                '2' => '买家取消',
                '3' => '缺货取消',
                '4' => '库存锁定失败',
            ],
            'isShowButton' => true, //是否显示取消订单按钮
        ],
        'pay' => [
            'baseUrl' => 'http://api.soupian.me:8080/trade-web/rest/v1/payment/',
            'type' => [
                '1' => ['AliPay' => 'alipay1', 'TenPay' => 'alipay2'],
                '2' => ['AliPay' => 'alipay1', 'TenPay' => 'alipay2'],
                '3' => ['AliPay' => 'alipay1', 'TenPay' => 'alipay2'],
                '4' => ['AliPaySelfRun' => 'alipay1', 'TenPay' => 'alipay2'],
                '5' => ['AliPay' => 'alipay1', 'TenPay' => 'alipay2']
            ]
        ],
        'product' => [
            'baseUrl' => 'http://api.soupian.me:8080/search-web/rest/v1/search/',
            'getAllUrl' => 'http://api.soupian.me:8080/search-web/rest/v1/search/item/_byTypes?types=Item'
        ],
        'coupon' => [
            'baseUrl' => 'http://api.soupian.me:8080/couponservice/v1/',
        ],
        'inventory' => [
            'baseUrl' => 'http://api.soupian.me:8080/trade-web/rest/v1/inventory/',
        ],
        'address' => [
            'baseUrl' => 'http://api.soupian.me:8080/member-web/rest/member/users/', //the same with user baseurl, should we keep it?
        ],
        'widget' => [
            'baseUrl' => 'http://localhost:8888/',
        ],
        'comment' => [
            'baseUrl' => 'http://api.soupian.me:8080/review-web/reviewservice/vi/reviews/',
        ],
        'realname' => [
            'baseUrl' => 'http://api.soupian.me:8080/member-web/rest/member/users/', //the same with user baseurl, shoule we keep it?
            'appkey' => 'xjrwd84hys',
        ],
        'user' => [
            'baseUrl' => 'http://api.soupian.me:8080/member-web/rest/member/users/',
        ],
        'passport' => [
            'baseUrl' => 'http://api.soupian.me:8080/passport-reg/rest/v1/passport/',
            'appBaseUrl' => 'http://api.soupian.me:8080/passport-web/rest/passport/',
        ],
        'refund' => [
            'baseUrl' => 'http://oms.cbt.localdomain:9080/smcfs/restapi/',
            'authorization' => "Authorization:Basic YXBpOkFwaTEyM18=",
            'typeMap' => [
                'NO_CHARGE' => '七天无理由退货',
                'ITEM_BROKEN' => '收到商品破损',
                'ITEM_INCORRECT' => '商品错发',
                'ITEM_MISMATCH' => '收到商品不符',
                'QUALITY_ISSUE' => '商品质量问题',
                'ACCEPT_REJECT' => '物流拒收',
                'OTHERS' => '其他'
            ],
            'statusMap' => [
                'Created' => '已创建',
                'Partially Created' => '已创建',
                'Authorized' => '审批已通过',
                'Partially Authorized' => '审批已通过',
                'Realsed' => '等待仓库收货',
                'Partially Realsed' => '等待仓库收货',
                'Included In Shipment' => '等待仓库收货',
                'Partially Included In Shipment' => '等待仓库收货',
                'Shipped' => '退单已完成',
                'Partially Shipped' => '退单已完成',
                'Cancelled' => '退单已取消',
                'Partially Cancelled' => '退单已取消',
                'Released' =>"已下达",
                'Partially Released' =>"已下达",
            ]
        ],
        'identity' => [
            'baseUrl' => 'http://api.soupian.me:8080/passport-web/rest/mobile/',
        ],
        'promotion' => [
            'baseCouponUrl' => 'http://api.soupian.me:8080/couponservice/v1/coupons/',
            'basepsdlUrl' => 'http://api.soupian.me:8080/pdslengine/v1/',
            'baseruleUrl' => 'http://api.soupian.me:8080/ruleengine/v1/rules/',
            'basememberUrl' => 'http://api.soupian.me:8080/couponservice/v1/member/',
            'activateFail' =>[
                '2004' => '亲，优惠码无效哦',
                '2001' => '亲，优惠码过期喽，下次早点激活哦',
                '2011' => '亲，优惠码格式不正确，请重新输入哦',
                '2008' => '亲，领过了哦',
                '2002' => '亲, 您来晚了, 优惠券已发完, 下次早点哦',
                '2007' => '亲，优惠码已被别人激活，下次妥善保管哦',
            ],
        ],
        'qiniu' => [
            'baseUrl' => 'http://7xl90w.com2.z0.glb.qiniucdn.com/',
            'domain' => '7xl90w.com2.z0.glb.qiniucdn.com',
            'accessKey' => 'RceSnszL1jQyOLEXNe15YziDF07UGOZBEJI-TNmA',
            'secretKey' => 'b96GhGoZy56rwbYPbs5gwZK114LUEIHE9lNN3ArN',
            'bucket' => 'testspace',
        ],
        'cps' => [
            'baseUrl' => 'http://api.soupian.me:8080/union-web/rest/union/',
        ],
        'xxx' => [],
    ],
    /**/
//     本地调试若想接入最新环境，请使用以下配置(api.soupian.me
//     已经放入local 中，大家如果在本地将local中的注释打开
    /**/


    /**/
    'errorCode_zh-CN' => [
        '99001' => '系统相关错误信息以01开头',
        '99002' => '请求数据返回异常，请稍后重试',
        '99003' => '请求数据无法解析，请稍后重试',
        '99004' => '解析地址url不能为空',
        '99005' => '返回中的response异常',
        '99006' => '请不要频繁提交',
        '99007' => '系统异常，请稍后重试',
        '99008' => '输入参数错误，请检查',
        '99011' => '用户权限信息以01开头',
        '99031' => '其他模块以03开头',
        '99032' => '您好，加入购物车前请登录，谢谢',
        '99041' => '地址模块占位',
    ],
    'errorCode_en-US' => [
        '99001' => 'system intern error',
        '99002' => 'call exception, please try it later',
        '99011' => 'auth error',
        '99031' => 'other module error',
    ],
    'sdk' => ['jswx' => []],
    'pay' => [
        'wx' => [
            'baseUrl' => 'http://api.soupian.me:8080/trade-web/rest/v1/payment/',
            'notifyUrl' => 'http://pay.ftzmall.com/trade-web/rest/v1/payment/',
            //=======【基本信息设置】=====================================
//  wxpay
            /**
             * TODO: 修改这里配置为您自己申请的商户信息
             * 微信公众号信息配置
             * 
             * APPID：绑定支付的APPID（必须配置，开户邮件中可查看）
             * 
             * MCHID：商户号（必须配置，开户邮件中可查看）
             * 
             * KEY：商户支付密钥，参考开户邮件设置（必须配置，登录商户平台自行设置）
             * 设置地址：https://pay.weixin.qq.com/index.php/account/api_cert
             * 
             * APPSECRET：公众帐号secert（仅JSAPI支付的时候需要配置， 登录公众平台，进入开发者中心可设置），
             * 获取地址：https://mp.weixin.qq.com/advanced/advanced?action=dev&t=advanced/dev&token=2005451881&lang=zh_CN
             * @var string
             */
            'APPID' => 'wx77be89a71184009b',
            'MCHID' => '1264207701',
            'KEY' => 'KfpGtHLjrPuXWwMmcKOC1XsLocLiwpob',
            'APPSECRET' => '12cf3d2cbd1ba9696bde81a724c95376',
            //    'NOTIFY_URL' =>  'http://wechatpay.api.soupian.me/trade-web/rest/v1/payment/paycallback/orderId/{ecOrderId}/paymentmethod/Wechatpay/actionName/deposit/storeId/ftzmall ',
            'NOTIFY_URL' => 'http://m.ftzmall.me/pay/notify.html',
//=======【证书路径设置】=====================================
            /**
             * TODO：设置商户证书路径
             * 证书路径,注意应该填写绝对路径（仅退款、撤销订单时需要，可登录商户平台下载，
             * API证书下载地址：https://pay.weixin.qq.com/index.php/account/api_cert，下载之前需要安装商户操作证书）
             * @var path
             */
            'SSLCERT_PATH' => '../cert/apiclient_cert.pem',
            'SSLKEY_PATH' => '../cert/apiclient_key.pem',
            //=======【curl代理设置】===================================
            /**
             * TODO：这里设置代理机器，只有需要代理的时候才设置，不需要代理，请设置为0.0.0.0和0
             * 本例程通过curl使用HTTP POST方法，此处可修改代理服务器，
             * 默认CURL_PROXY_HOST=0.0.0.0和CURL_PROXY_PORT=0，此时不开启代理（如有需要才设置）
             * @var unknown_type
             */
            'CURL_PROXY_HOST' => "0.0.0.0", //"10.152.18.220";
            'CURL_PROXY_PORT' => 0, //8080;
//=======【上报信息配置】===================================
            /**
             * TODO：接口调用上报等级，默认紧错误上报（注意：上报超时间为【1s】，上报无论成败【永不抛出异常】，
             * 不会影响接口调用流程），开启上报之后，方便微信监控请求调用的质量，建议至少
             * 开启错误上报。
             * 上报等级，0.关闭上报; 1.仅错误出错上报; 2.全量上报
             * @var int
             */
            'REPORT_LEVENL' => 1,
        ],
    ],
    'advertisement' => [
        'baseUrl' => 'http://api.soupian.me:8080/espot-web/rest/v1/emspot'
    ],
    'staticUrl' => 'http://static.ftzshop.com.cn/yingyuan/static/',
];
