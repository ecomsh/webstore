<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author yyjia@cn.ibm.com
 */

namespace mobile\models;

use yii;
use common\models\DirectOrderBaseApi;
use yii\helpers\ArrayHelper;
use mobile\models\ValidateApi;
use common\helpers\Tools;
use common\models\cps\BaseCps;

/**
 * 用于请求web端直接下单的类
 */
class DirectOrderApi extends DirectOrderBaseApi
{

    public function __construct($userid = '')
    {
        parent::__construct($userid);
    }
    
    public function directOrderCreate($params, $uid = '')
    {
        if (!isset($params['addressId']) || !isset($params['shipInst']) || !isset($params['itemInfo']))
        {
            return Tools::error('99002', '输入参数有误，请重新输入');
        }
        $channelId = isset($params['channelId']) ? $params['channelId'] : 'ftzmall';
        $orderData = [
            "channelId" => $channelId,
            "channelType" => Yii::$app->params['platform'],
            "paymentType" => "1",
            "shipAddressNickName" => "",
            "shipReceiverEmail" => "",
            "shipCountryCode" => "CN",
            "shipCountryName" => "中国",
            "shipType" => "快递",
            "currency" => "CNY",
            "invType" => "普通发票",
            "invNo" => "",
            "invCode" => "",
            "invComment" => "",
            "orderComment" => "",
            "couponId" => empty($params['couponId']) ? null :$params['couponId'],
            "carrierId" => null,
            "carrierName" => null,
            "expDeliveryDate" => null,
            "requestShippingDate" => null,
            "shipCustomField" => null,
            "extensionData" => [
                "shipping" => true,
                "limitAmount" => false,
                "tax" => true,
                "promotion" => true,
            ],
        ];

        $tmpuid = $uid ? $uid : $this->operatorId;

        $orderData['buyerId'] = $tmpuid;
        $orderData['shipInst'] = $params['shipInst'];
        //可不填
        $orderData['invCategory'] = $params['invCategory'];
        $orderData['invName'] = $params['invName'];

        $directOrderMode = new DirectOrderApi($tmpuid);
        $directOrderParams = ['addid' => $params['addressId'], 'itemsInfo' => json_decode($params['itemInfo'],true)];
        $DTOInfo = $directOrderMode->DirectOrder($directOrderParams, $channelId);
        
        if(!empty($DTOInfo['error'])){
            $msg = '提交失败 ';
            $itemId = isset($DTOInfo['cartlineDTOList'][0]['itemId']) ? $DTOInfo['cartlineDTOList'][0]['itemId'] : 0;
            
            if(isset($DTOInfo['error'][0][$itemId])){
                foreach($DTOInfo['error'][0][$itemId] as $v){
                    if (is_array($v))
                    {
                        foreach ($v as $sv)
                        {
                            $msg .= '该商品'.$sv . '</br>';
                        }
                    } else {
                        $msg .= '该商品'.$v;
                    }
                }
            }
            Tools::error('99041', $msg);
            return false;
        }
        
        $validator = new ValidateApi();
        $orderinfo['ValidateApi'] = [
            'salesType' => $DTOInfo['cartlineDTOList'][0]['itemSalestype'],
            'orderAmount' => $params['orderAmount'],
            'quantity' => $DTOInfo['cartlineDTOList'][0]['cartlineQuantity'],
        ];
        $validator->scenario = 'orderamountVal';
        if($validator->load($orderinfo) && !($validator->validate())){
            $validator->setErrors('',false);
            return false;
        }else{
            ArrayHelper::remove($DTOInfo, 'error');
        }
        
        $orderData = array_merge($orderData,$DTOInfo);
        
        $baseCps = new BaseCps();
        $getData = $baseCps->getDataFromCookie();
        $orderData['unionData'] = json_encode($getData);
        
        if ($this->load(['DirectOrderApi'=>$orderData]) && $this->validate())
        {
            $data = $this->directSubmitOrder($orderData);
            return $data['order'];
        }else{
            $this->setErrors();
        }
    }

 }
