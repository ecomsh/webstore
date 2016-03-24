<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace frontend\models;

use frontend\models\AddressApi;
use common\models\OrderBaseApi;
use yii\helpers\ArrayHelper;
use common\helpers\Tools;
use common\models\cps\BaseCps;

/**
 * 用于请求web端订单数据的类
 */
class OrderApi extends OrderBaseApi
{

    public function __construct($operatorId = '')
    {
        parent::__construct($operatorId);
    }

    public function rules()
    {
        return parent::rules();
    }

    public function orderCreate($params, $uid = '')
    {
        if (!isset($params['addressId']) || !isset($params['shipInst']) || !isset($params['cartlineId']))
        {
            return Tools::error('99002', '输入参数有误，请重新输入');
        }

        $orderData = [
            "channelId" => "ftzmall",
            "channelType" => "2",
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
            "extensionData" => [
                "shipping" => true,
                "limitAmount" => false,
                "tax" => true,
                "promotion" => true
            ],
            "carrierId" => null,
            "carrierName" => null,
            "expDeliveryDate" => null,
            "requestShippingDate" => null,
            "shipCustomField" => null,
        ];

        $tmpuid = $uid ? $uid : $this->operatorId;

        $addmodel = new AddressApi($tmpuid);
        $addinfo = $addmodel->getById($params['addressId']);
        $key = key($addinfo);
        $addinfo = isset($addinfo[$key]) ? $addinfo[$key] : [];
        if (empty($addinfo))
        {
            return Tools::error('99002', '地址获取异常，请稍后重试');
        }

        $orderData['buyerId'] = $tmpuid;

        $orderData['shipAddress'] = $addinfo['address'];
        $orderData['shipCityCode'] = $addinfo['cityCode'];
        $orderData['shipCityName'] = $addinfo['cityName'];
        $orderData['shipDistrictCode'] = $addinfo['districtCode'];
        $orderData['shipDistrictName'] = $addinfo['districtName'];
        $orderData['shipPostcode'] = $addinfo['postcode'];
        $orderData['shipReceiverMobile'] = $addinfo['receiverMobile'];
        $orderData['shipReceiverName'] = $addinfo['receiverName'];
        $orderData['shipReceiverPhone'] = $addinfo['receiverPhone'];
        $orderData['shipStateCode'] = $addinfo['stateCode'];
        $orderData['shipStateName'] = $addinfo['stateName'];
        $orderData['shipInst'] = $params['shipInst'];
        //可不填
        $orderData['invCategory'] = $params['invCategory'];
        $orderData['invName'] = $params['invName'];

        $orderData['cartlineId'] = explode(',', $params['cartlineId']);
        
        $baseCps = new BaseCps();
        $getData = $baseCps->getDataFromCookie();
        $orderData['unionData'] = json_encode($getData);
        
        if ($this->load(['OrderApi'=>$orderData]) && $this->validate())
        { 
            $validate = $this->submitValidate($orderData['cartlineId'], $params['orderAmount']);
            if($validate){
                $params = ArrayHelper::remove($params, 'orderAmount');
                $data = $this->SubmitOrder($orderData);
                return $data['order'];
            }else{
                return false;
            }
        }else{
            $this->setErrors();
            return false;
        }
    }
}
