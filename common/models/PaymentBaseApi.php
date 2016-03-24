<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace common\models;

use Yii;
use common\models\BaseApi;
use common\helpers\Tools;

/**
 * 用于请求支付数据的基类
 */
class PaymentBaseApi extends BaseApi
{
     private $_baseUri;

    public function __construct($userid = '')
    {
        parent::__construct($userid);
        $this->_baseUri = Yii::$app->params['sm']['pay']['baseUrl'];
    }

    /**
     * 支付订单
     * input params:
     * $params = [
     *  "orderId" => "xxx",
     *  "payMethod" => "xxx", //     Value can be
     *               'Account' --站内支付
     *               'TenPay' -- 财付通
     *               'AliPay' -- 支付宝
     *               'EasiPay' -- 东方支付 //一期不支持
     *               'DIG' -- DIG卡
     *              微信支付，暂时没有，需支持
     *  "subject" => "xxx",
     *  "itemSum" => "xxx", 
     * ]
     */
    public function payForOrder($params){
        
        if ($params['orderId'] && $params['payMethod'] && $params['subject'] && $params['itemSum'] && $params['return_url_pay']){
            $orderId = $params['orderId'];
            $payMethod = $params['payMethod'];
            $subject = $params['subject'];
            $itemsum = $params['itemSum'];
            $return_url_pay = $params['return_url_pay'];
            $userIP = Yii::$app->request->userIP;
            $tmp_url = $this->_baseUri . 'payurl/orderId/' . $orderId . '/paymentmethod/' . $payMethod;
            if(isset($params['mobile'])){
                $tmp_url .= "?mobile=true";
            }
            $body = [
                "extData" => [
                    "subject" => $subject,
                    "userIP" => $userIP,
                    "itemsum" => $itemsum,
                    "return_url_pay" => $return_url_pay
                ]
            ];
            return $this->create(['pay' => $tmp_url], $body);
        }
        else{
            $msg = YII_DEBUG? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'payForOrder input param error' . $msg);
        }
    }
    
    public function getPaymentDetails($orderid){
        $tmp_url = $this->_baseUri . 'paymentdetails/' . $orderid;
        return $this->get(['pay' => $tmp_url], [], 'GET');
    }

}
