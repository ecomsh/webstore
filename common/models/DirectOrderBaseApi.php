<?php

/**
 * @link 
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace common\models;

use Yii;
use common\models\OrderBaseApi;
use common\models\ProductBaseApi;
use common\models\AddressBaseApi;
use common\helpers\Tools;
use common\models\ValidateBaseApi;

/**
 * 用于请求其他数据的基类
 */
class DirectOrderBaseApi extends OrderBaseApi {

    public function __construct($operatorId = '') {
        parent::__construct($operatorId);
    }

    public function rules() {
        return parent::rules();
    }

    /**
     * 通过itemids, qualities, addressid等直接下单
     * @input:
     * $params = [
     *     'addid'  => 'xxx', //客户选择的配送地址id
     *     'itemsInfo' => [
     *        'itemid1' => 'itemqty1',
     *        'itemid2' => 'itemqty2',
     *        'itemid3' => 'itemqty3',
     *        'itemidxxx' => 'itemqtyxxx',
     *     ]
     * ]
     * $uid //optional, userid means buyerid
     */
    public function DirectOrder($params, $channelId = '', $uid = "") {
        if (isset($params['addid']) && $params['addid'] && isset($params['itemsInfo']) && $params['itemsInfo']) {
            $addid = $params['addid'];
            $tmpuid = $uid ? $uid : $this->operatorId;

            $addmodel = new AddressBaseApi($tmpuid);
            $addinfo = $addmodel->getById($addid);
            $key = key($addinfo);
            $addinfo = isset($addinfo[$key]) ? $addinfo[$key] : [];
            if (empty($addinfo)) {
                return Tools::error('99002', '地址获取异常，请稍后重试');
            }

            $orderData = array();
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

            $data = $this->getDTOInfo($params['itemsInfo'], $channelId, $uid);
            $orderData['cartlineDTOList'] = $data['DTOinfo'];
            $orderData['error'] = $data['error'];
            return $orderData;
        } else {
            $msg = YII_DEBUG ? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'DirectOrder input param error' . $msg);
        }
    }

    /*
      @input param:
     *  $itemsInfo => [
     *        'itemid1' => 'itemqty1',
     *        'itemid2' => 'itemqty2',
     *        'itemid3' => 'itemqty3',
     *        'itemidxxx' => 'itemqtyxxx',
     *     ]
     * $channelId = 'xxx',  //For web pos to diff different offline stores
     *  $uid => xxx //user id
     */

    public function getDTOInfo($itemsInfo, $channelId = '', $uid = '') {
        if (!is_array($itemsInfo)) {
            $itemsInfo = json_decode($itemsInfo, true);
        }
        $itemids = array_keys($itemsInfo);
        $itemqty = array_values($itemsInfo); //TODO itemqty这个数组只有下面的这个判断会用到，是不是可以考虑去掉，以其他的形式判断
        if (is_array($itemids) && is_array($itemqty)) {
            if (count($itemids) != count($itemqty)) {
                return Tools::error('99008', '立即购买商品种类和数量不一致');
            }
        }
        $tmpuid = $uid ? $uid : $this->operatorId;

        $productmodel = new ProductBaseApi($tmpuid);

        $productinfo = $productmodel->getProductByIds($itemids);
        $key = key($productinfo);
        $productinfo = isset($productinfo[$key]) ? $productinfo[$key] : [];
        if (empty($productinfo)) {
            return Tools::error('99002', '商品信息获取异常，请稍后重试');
        }

        $channel = empty($channelId)? 'ftzmall':$channelId;
        $returnInfo = Array();
        $returnInfo['DTOinfo'] = Array();
        $returnInfo['error'] = Array();
        foreach ($productinfo as $val) {
            $DTOinfo = array();
            $errorinfo = array();
            //hard code, may be modified
            $DTOinfo['cartlineType'] = '1'; //买家类型，游客0，登录用户1
            $DTOinfo['cartlineComment'] = '';
            $DTOinfo['isGift'] = '0';
            $DTOinfo['shopDisplayText'] = "自贸区直购专场"; //购物车项商品所属店铺显示的文本,自营情况下可以为空，或者默认
            $DTOinfo['shopContactId'] = ''; //店小二id
            $DTOinfo['shopLink'] = 'http://www.ftzmall.com';
            $DTOinfo['channelId'] = $channel; //Id就是渠道下具体的流量来源，比如具体的微信号，什么值得买网站，原生流量
            $DTOinfo['shopId'] = 'ftzmall'; //jingxi的对。            
            $DTOinfo['itemType'] = $val['type'];

            $DTOinfo['itemPriceListId'] = $val['offerPriceInfo'][0]['priceListId'];
            $DTOinfo['itemDisplayText'] = $val['desc']['name'];
            $DTOinfo['userId'] = $tmpuid;
            $DTOinfo['itemOwnerId'] = $val['memberId'];  //jing xi的对，产品所属组织代码
            //http://wa.soupian.me/p/9170923253546667528.html QA说直接下单报错，错误显示下面的值没有获取到。
            $DTOinfo['itemListPrice'] = isset($val['listPriceInfo'][0]['price']) ? $val['listPriceInfo'][0]['price'] : 0; 
            $DTOinfo['channelType'] = Yii::$app->params['platform']; //type一般是大的渠道区分，比如app,pc,H5,微 信,O2O,电话销售等
            $DTOinfo['itemId'] = $val['id'];
            //照顾web pos不能使用相对路径，所以从配置中读取域名。如果前端域名改动，需要修改对应的配置
            $DTOinfo['itemLink'] = Yii::$app->params['sm']['store']['domain'] . '/p/' . $val['id'] . '.html';
            $DTOinfo['itemImageLink'] = $val['desc']['fullImage']; //与cheng jun和jipeng沟通过，不采用json，直接给link
            $DTOinfo['itemSalestype'] = $val['salesType'];
            $DTOinfo['itemMfname'] = $val['manufactureName'];

            //copy from jingxi: TBD
            $itemWeight = 0;
            $itemVolumn = 0;
            $itemWeightUOM = '克';
            if (empty($val['descriptiveAttributes']) === FALSE) {
                foreach ($val['descriptiveAttributes'] as $attr) {

                    if ($attr['id'] == 'Sales-Weight') {
                        $itemWeight = $attr['value'];
                    }

                    if ($attr['id'] == 'Sales-WeightUOM') {
                        $itemWeightUOM = $attr['value'];
                    }

                    if ($attr['id'] == 'Sales-Volumn') {
                        $itemVolumn = $attr['value'];
                    }

                    if ($attr['id'] == 'Sales-VolumnUOM') {
                        $DTOinfo['itemVolumnUOM'] = $attr['value'];
                    }

                    $DTOinfo['itemVolumn'] = $itemVolumn;
                    $DTOinfo['itemWeight'] = $itemWeight;
                    $DTOinfo['itemWeightUOM'] = $itemWeightUOM;
                }
            }

            $DTOinfo['cartlineQuantity'] = $itemsInfo[$val['id']];
            $DTOinfo['itemPartNumber'] = $val['partNumber'];
            $DTOinfo['itemOfferPrice'] = $val['offerPriceInfo'][0]['price'];
            $DTOinfo['tariffno'] = isset($val['tax']['taxSerialNumber']) ? $val['tax']['taxSerialNumber'] : null;

            array_push($returnInfo['DTOinfo'], $DTOinfo);

            //validate order info begin
            $validator = new ValidateBaseApi();
            $orderinfo['ValidateBaseApi'] = [
                'minBuyCount' => $val['minBuyCount'],
                'maxBuyCount' => $val['maxBuyCount'],
                'buyable' => $val['buyable'],
                'quantity' => $itemsInfo[$val['id']]
            ];
            $validator->scenario = 'itemsVal';
            if ($validator->load($orderinfo) && (!$validator->validate())) {
                $errors = $validator->getErrors();
                $errorinfo[$val['id']] = $errors;
            }
            if(!empty($errorinfo)){
                array_push($returnInfo['error'],$errorinfo);
            }
            //validate order info end
        }
        return $returnInfo;
    }

}
