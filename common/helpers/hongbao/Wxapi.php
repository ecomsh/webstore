<?php

namespace common\helpers\hongbao;

use Yii;
use common\helpers\hongbao\WxHongBaoHelper;

class Wxapi {
    private $app_id;
    private $app_secret;
    private $app_mchid;
    function __construct(){
    	$this->app_id = Yii::$app->params['pay']['wx']['APPID'];
    	$this->app_secret = Yii::$app->params['pay']['wx']['APPSECRET'];
    	$this->app_mchid = Yii::$app->params['pay']['wx']['MCHID'];
    	define('PARTNERKEY',Yii::$app->params['pay']['wx']['KEY']);
    }
    /**
     * 微信支付
     * 
     * @param string $openid 用户openid
     */
    public function pay($re_openid,$money,$db=null)
    {
        $commonUtil = new CommonUtil();
        $wxHongBaoHelper = new WxHongBaoHelper();
		
        $wxHongBaoHelper->setParameter("nonce_str", $this->great_rand());//随机字符串，丌长于 32 位
        $wxHongBaoHelper->setParameter("mch_billno", $this->app_mchid.date('YmdHis').rand(1000, 9999));//订单号
        $wxHongBaoHelper->setParameter("mch_id", $this->app_mchid);//商户号
        $wxHongBaoHelper->setParameter("wxappid", $this->app_id);
        $wxHongBaoHelper->setParameter("nick_name", 'FTZMALL');//提供方名称
        $wxHongBaoHelper->setParameter("send_name", 'FTZMALL');//红包发送者名称
        $wxHongBaoHelper->setParameter("re_openid", $re_openid);//相对于医脉互通的openid
        $wxHongBaoHelper->setParameter("total_amount", $money);//付款金额，单位分
        $wxHongBaoHelper->setParameter("min_value", 100);//最小红包金额，单位分
        $wxHongBaoHelper->setParameter("max_value", 500);//最大红包金额，单位分
        $wxHongBaoHelper->setParameter("total_num", 1);//红包収放总人数
        $wxHongBaoHelper->setParameter("wishing", '恭喜中奖，邀请好友注册一起拿大奖！');//红包祝福诧
        $wxHongBaoHelper->setParameter("client_ip", '127.0.0.1');//调用接口的机器 Ip 地址
        $wxHongBaoHelper->setParameter("act_name", '微信摇红包大奖');//活动名称
        $wxHongBaoHelper->setParameter("remark", '邀请3个好友注册赢摇奖机会');//备注信息
        $postXml = $wxHongBaoHelper->create_hongbao_xml();
        $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';
        
        $responseXml = $wxHongBaoHelper->curl_post_ssl($url, $postXml);
		$responseObj = simplexml_load_string($responseXml, 'SimpleXMLElement', LIBXML_NOCDATA);
		return $responseObj;//->return_code;

		return;
    }
    /**
     * 获取微信授权链接
     * 
     * @param string $redirect_uri 跳转地址
     * @param mixed $state 参数
     */
    public function get_authorize_url($redirect_uri = '', $state = '')
    {
        $redirect_uri = urlencode($redirect_uri);
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->app_id}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_userinfo&state={$state}#wechat_redirect";  
        echo "<script language='javascript' type='text/javascript'>";  
        echo "window.location.href='$url'";  
        echo "</script>";       
    }       
    
    /**
     * 获取授权token
     * 
     * @param string $code 通过get_authorize_url获取到的code
     */
    public function get_access_token($code = '')
    {
        $token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->app_id}&secret={$this->app_secret}&code={$code}&grant_type=authorization_code";
        $token_data = $this->http($token_url);
        if(!empty($token_data[0]))
        {
            return json_decode($token_data[0], TRUE);
        }
        
        return FALSE;
    }   

    /**
     * 获取授权后的微信用户信息
     * 
     * @param string $access_token
     * @param string $open_id
     */
    public function get_user_info($access_token = '', $open_id = '')
    {
        if($access_token && $open_id)
        {
			$access_url = "https://api.weixin.qq.com/sns/auth?access_token={$access_token}&openid={$open_id}";
			$access_data = $this->http($access_url);
			$access_info = json_decode($access_data[0], TRUE);
			if($access_info['errmsg']!='ok'){
				exit('页面过期');
			}
            $info_url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$open_id}&lang=zh_CN";
            $info_data = $this->http($info_url);  		
            if(!empty($info_data[0]))
            {
                return json_decode($info_data[0], TRUE);
            }
        }
        
        return FALSE;
    }   	
    /**
     * Http方法
     * 
     */ 
    public function http($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $output = curl_exec($ch);//输出内容
        curl_close($ch);
        return array($output);
    }   

    /**
     * 生成随机数
     * 
     */     
    public function great_rand(){
    	$t1 = null;
        $str = '1234567890abcdefghijklmnopqrstuvwxyz';
        for($i=0;$i<30;$i++){
            $j=rand(0,35);
            $t1 .= $str[$j];
        }
        return $t1;    
    }
}