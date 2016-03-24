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
 * 用于请求地址数据的基类
 */
class AddressBaseApi extends BaseApi
{

    public $userId; //": "string",
    public $addressId; //": "string",
    public $addressName; //": "string",
    public $isDefault; //": true,
    public $countryCode; //": "string",
    public $stateCode; //": "string",
    public $stateName; //": "string",
    public $cityCode; //": "string",
    public $cityName; //": "string",
    public $districtCode; //": "string",
    public $districtName; //": "string",
    public $postcode; //": "string",
    public $address; //": "string",
    public $receiverName; //": "string",
    public $receiverMobile; //": "string",
    public $receiverPhone; //": "string"
    private $_baseUri;
    public $isNewRecord;
    public $isSave;
//    private $_operatorId;

    /**
     * 验证器，验证规则
     * @return type
     */
    public function rules()
    {
        return [
            [['stateCode', 'cityCode', 'districtCode', 'receiverName', 'address', 'postcode', 'receiverMobile'], 'required', 'message' => '此项为必填', 'on' => ['index', 'create', 'update']],
            [['stateCode', 'cityCode', 'districtCode', 'receiverName', 'address', 'receiverMobile'], 'required', 'message' => '不能为空', 'on' => ['ajaxcreate']],
            [['stateCode', 'cityCode', 'districtCode'], 'required', 'message' => '不能为空', 'on' => ['ajaxwebposcreate']],
            [['address', 'receiverName'], 'string'],
            [['postcode', 'receiverMobile'], 'integer'],
            [['address'], 'string', 'min' => 10, 'max' => 200],
            [['address'], 'trim'],
            [['receiverName'], 'string', 'min' => 2, 'max' => 15],
            [['postcode'], '\frontend\validators\PostcodeValidator'],
            [['receiverMobile'], '\frontend\validators\MobileValidator'],
            [['receiverPhone'], '\frontend\validators\PhoneValidator']
                //       [['receiverMobile','mobile']]
//            [['auth_key'], 'string', 'max' => 32]
        ];
    }

    /**
     * 只有在这里的属性，才会在对应的场景中可以用
     * @return type
     */
    public function scenarios()
    {
        return [
            'index' => ['isDefault', 'stateCode', 'cityCode', 'districtCode', 'receiverName', 'address', 'postcode', 'receiverMobile', 'receiverPhone'],
            'create' => ['isDefault', 'stateCode', 'cityCode', 'districtCode', 'receiverName', 'address', 'postcode', 'receiverMobile', 'receiverPhone'],
            'update' => ['isDefault', 'stateCode', 'cityCode', 'districtCode', 'receiverName', 'address', 'postcode', 'receiverMobile', 'receiverPhone'],
            'ajaxcreate' => ['isDefault', 'stateCode', 'cityCode', 'districtCode', 'receiverName', 'address', 'receiverMobile', 'receiverPhone'],
            'ajaxwebposcreate' => ['isDefault', 'stateCode', 'cityCode', 'districtCode', 'receiverName', 'address', 'receiverMobile', 'receiverPhone'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'receiverName' => '收货人：',
            'address' => '地址：',
            'postcode' => '邮编：',
            'receiverMobile' => '手机：',
            'stateCode' => '地区：',
            'cityCode' => '城市：',
            'districtCode' => '区县：',
            'stateName' => '',
            'cityName' => '',
            'districtName' => '',
            'receiverPhone' => '座机：',
        ];
    }

    public function __construct($operatorId = '')
    {
        parent::__construct($operatorId);
        //$userId = 'e468a389-19c1-11e5-bba0-00ffaa3562cc'; //from user session  
        $this->_baseUri = Yii::$app->params['sm']['address']['baseUrl'];
    }

    public function getList($params = [], $userid = '')
    {
        $tmpuid = $userid ? $userid : $this->operatorId;
        if(!empty($tmpuid)){
            $tmp_url = $this->_baseUri . $tmpuid . '/addresses';
            return $this->get(['address' => $tmp_url], $params = []);
        }
        else{
            $msg = YII_DEBUG? '----|userid can not be empty|----' : '';
            return Tools::error('99008', $msg);
        }
    }

    public function getById($id, $params = [], $userid = '')
    {
        $tmpuid = $userid ? $userid : $this->operatorId;
        if(!empty($tmpuid)){
            $url = $this->_baseUri . $tmpuid . '/addresses/' . $id;
            return $this->get(['address' => $url], $params = []);
        }
        else{
            $msg = YII_DEBUG? '----|userid can not be empty|----' : '';
            return Tools::error('99008', $msg);
        }
    }

    public function createAddress($params = array(), $userid = '')
    {
        $tmpuid = $userid ? $userid : $this->operatorId;
        if(!empty($tmpuid)){
            $tmp_url = $this->_baseUri . $tmpuid . '/addresses';
            return $this->create(['address' => $tmp_url], $params);
        }
        else{
            $msg = YII_DEBUG? '----|userid can not be empty|----' : '';
            return Tools::error('99008', $msg);
        }
    }

    public function deleteById($id, $userid = '')
    {
        $tmpuid = $userid ? $userid : $this->operatorId;
        if(!empty($tmpuid)){
            $url = $this->_baseUri . $tmpuid . '/addresses/' . $id;
            return $this->delete($url);
        }
        else{
            $msg = YII_DEBUG? '----|userid can not be empty|----' : '';
            return Tools::error('99008', $msg);
        }
    }

    public function updateById($id, $params = [], $userid = '')
    {
        $tmpuid = $userid ? $userid : $this->operatorId;
        if(!empty($tmpuid)){
            $url = $this->_baseUri . $tmpuid . '/addresses/' . $id;
            return $this->update(['address' => $url], $params);
        }
        else{
            $msg = YII_DEBUG? '----|userid can not be empty|----' : '';
            return Tools::error('99008', $msg);
        }
    }

    public function setDefaultById($id, $params = [], $userid = '')
    {
        $tmpuid = $userid ? $userid : $this->operatorId;
        if(!empty($tmpuid)){
            $url = $this->_baseUri . $tmpuid . '/addresses/' . $id . '/_setDefault';
            return $this->create(['address' => $url], $params);
        }
        else{
            $msg = YII_DEBUG? '----|userid can not be empty|----' : '';
            return Tools::error('99008', $msg);
        }
    }

    public function getDefaultAddress($userid = '')
    {
        $tmpuid = $userid ? $userid : $this->operatorId;
        if(!empty($tmpuid)){
            $url = $this->_baseUri . $tmpuid . '/addresses/' . 'default';
            return $this->get(['address' => $url], $params = []);
        }
        else{
            $msg = YII_DEBUG? '----|userid can not be empty|----' : '';
            return Tools::error('99008', $msg);
        }
        
    }

}
