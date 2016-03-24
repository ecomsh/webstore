<?php

namespace mobile\controllers;

use Yii;
use yii\web\Controller;
use common\helpers\Wechatjssdk;

class WechatmenuController extends Controller
{

    public function actionIndex()
    {
        $appid = Yii::$app->params['pay']['wx']['APPID'];
        $appsecret = Yii::$app->params['pay']['wx']['APPSECRET'];
        $wechatsdk = new Wechatjssdk($appid, $appsecret);
        $access_token = $wechatsdk->getAccessToken();

        $jsonmenu = '{
              "button":[
              {
                   "name":"活动",
                   "sub_button":[
                    {
                        "type":"view",
                        "name":"支付",
                        "url":"http://m.ftzmall.com/pay/wx.html"
                    },
                    {
                        "type":"view",
                        "name":"DIG WIFI",
                        "url":"http://m.ftzmall.com"
                    },
                    {
                       "type":"click",
                       "name":"测试",
                       "key":"天气广州"
                    }]
               },
               {
                    "name": "特卖闪购", 
                    "sub_button": [
                        {
                        "type":"view",
                        "name":"本周上新",
                        "url":"http://m.ftzmall.com"
                        },
                        {
                        "type":"view",
                        "name":"每日秒杀",
                        "url":"http://m.ftzmall.com"
                        },
                        {
                            "type": "scancode_push", 
                            "name": "扫一扫", 
                            "key": "rselfmenu_0_1", 
                            "sub_button": [ ]
                        }, 
                        {
                        "type":"view",
                        "name":"注册",
                        "url":"http://m.ftzmall.com/register/index.html"
                        }
                    ]
                }, 
                {
                   "name":"会员中心",
                   "sub_button":[
                    {
                        "type":"view",
                        "name":"我是会员",
                        "url":"http://m.ftzmall.com/user/index.html"
                    },
                    {
                        "type":"view",
                        "name":"实名认证",
                        "url":"http://m.ftzmall.com/passport/realname.html"
                    },
                    {
                        "type":"view",
                        "name":"我的地址",
                        "url":"http://m.ftzmall.com/address/index.html"
                    },
                    {
                        "type":"view",
                        "name":"订单管理",
                        "url":"http://m.ftzmall.com/order/orders.html"
                    }]
                }]
         }';


        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . $access_token;
        $result = $this->https_request($url, $jsonmenu);
        var_dump($result);
    }

    private function https_request($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data))
        {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

}
?>





