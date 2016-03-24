<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author yyjia@cn.ibm.com
 */

namespace common\models;

use Yii;
use common\models\BaseApi;

//use common\helpers\Tools;
//use yii\helpers\ArrayHelper;

/**
 * 用于请求购物车的基类
 * #TBD yyjia, addtocart might need to modify.
 */
class ValidateBaseApi extends BaseApi {

    public $minBuyCount; //To validate quantity
    public $maxBuyCount; //To validate quantity
    public $buyable; //To validate quantity
    public $quantity; //quantity
    public $salesType; //salestype
    public $orderAmount; //订单金额
    public $itemInv = null; //商品库存

//    public $itemId; //商品id

    public function __construct($operatorId = '') {
        parent::__construct($operatorId);
    }

    public function rules() {
        return [
            [['buyable', 'quantity'], 'required', 'on' => ['itemsVal','all']], // 'itemDisplayText',先去了测试
            [['salesType', 'orderAmount'], 'required', 'on' => ['orderamountVal','all']],
            [['quantity', 'itemInv'], 'integer'],
            [['quantity'], 'validateQuantity'],
            [['buyable'], 'validateBuyable'],
            [['orderAmount'], 'validateAmount'],
            [['itemInv'], 'validateInventory'],
        ];
    }

    public function scenarios() {
        return [
            'itemsVal' => ['minBuyCount', 'maxBuyCount', 'buyable', 'quantity', 'itemInv'],
            'orderamountVal' => ['salesType', 'orderAmount', 'quantity'],
            'all' => ['minBuyCount', 'maxBuyCount', 'buyable', 'quantity','salesType', 'itemInv', 'orderAmount'],
        ];
    }

    public function validateQuantity($attribute) {
        $quantity = $this->quantity;
        $min = $this->minBuyCount;
        $max = $this->maxBuyCount;
        if (isset($min)) {
            if ($quantity < $min) {
                $msg = '起购' . $min . '件'; //这个信息web pos direct order和cart都可以用，pc的direct order需要加上‘该商品’
                $this->addError($attribute, $msg);
            }
        }
        if (isset($max)) {
            if ($quantity > $max) {  //这个信息web pos direct order和cart都可以用，pc的direct order需要加上‘该商品’
                $msg = '限购' . $max . '件';
                $this->addError($attribute, $msg);
            }
        }
    }

    public function validateBuyable($attribute) {
        $buyable = $this->buyable;
        if (!$buyable) {
            $msg = '该商品已下架';
            $this->addError($attribute, $msg);
        }
    }

        public function validateAmount($attribute) {
        $orderAmount = $this->orderAmount;
        $salesType = $this->salesType;
        $quantity = $this->quantity;
        $types = Yii::$app->params['sm']['store']['isCBT'];
        if (in_array($salesType, $types)) {
            if (($orderAmount > Yii::$app->params['sm']['store']['maxAmount']) && ($quantity >1)){ //是CBT的salestype时，订单价格不得超过1000
                $msg = '该订单超出'.Yii::$app->params['sm']['store']['maxAmount'].'元'; //TBD, confirm with Cheng Jun
                $this->addError($attribute, $msg);
            }
        }
    }
    
        public function validateInventory($attribute) {
        $quantity = $this->quantity;
        $itemInv = $this->itemInv;
        if (isset($itemInv) && ($quantity > $itemInv)) {
            $msg = '库存剩余' . $itemInv . '件';
            $this->addError($attribute, $msg);
        }
    }
    
}
