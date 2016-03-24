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
use yii\helpers\ArrayHelper;


/**
 * 用于请求地址数据的基类
 */
class PromotionBaseApi extends BaseApi {

    private $_baseCouponUri;
    private $_basepsdlUrl;
    private $_baseruleUrl;
    private $_basememberUrl;

    public function __construct($userId) {
        parent::__construct($userId);
        $this->_baseCouponUri = Yii::$app->params['sm']['promotion']['baseCouponUrl'];
        $this->_basepsdlUrl = Yii::$app->params['sm']['promotion']['basepsdlUrl'];
        $this->_baseruleUrl = Yii::$app->params['sm']['promotion']['baseruleUrl'];
        $this->_basememberUrl = Yii::$app->params['sm']['promotion']['basememberUrl'];
    }

    /*
     * 检查某个coupon code在不在某个用户名下。
     * 若在用户名下，返回couponcode对应的所有信息，若入参onlyids为true，则只返回对应的couponid。
     * 若不在用户名下，返回空（解除php封装后）。
     * @input
     * $couponcode //required，优惠码
     * $params => [ //optional
     *    "onlyids" => true or false, true--返回结果只有对应的couponid，false--返回结果为相应的coupon信息(默认返回)。
     *    "page" => xxx, 第几页
     *    "per_page" => xxx,  每页几条信息
     * ]  
     * $memberid //optional, 用户id   
     */

    public function checkCouponcode($couponcode, $params = [], $memberid = '') {
        $input = array();
        $input['memberid'] = $memberid ? $memberid : $this->operatorId;
        $input['couponcode'] = $couponcode;
        $tmp_url = $this->_baseCouponUri . '?onlyids=';

        if (!empty($params)) {
            if (isset($params['onlyids'])) {
                $str = $params['onlyids'] ? 'true' : 'false';
                $tmp_url = $tmp_url . $str;
                $params = ArrayHelper::remove($params, 'onlyids');
            } else {
                $tmp_url = $tmp_url . 'false';
            }
            $appendurl = http_build_query($params);
            $tmp_url = $tmp_url . '&' . $appendurl;
        } else {
            $tmp_url = $tmp_url . 'false';
        }
        return $this->create(['promotion' => $tmp_url], $input);
    }

    /*
     * 获取某个用户名下的active优惠券信息。
     * 默认返回couponcode对应的所有信息，若入参onlyids为true，则只返回对应的couponid。
     * @input
     * $params => [ //optional
     *    "onlyids" => true or false, true--返回结果只有对应的couponid，false--返回结果为相应的coupon信息(默认返回)。
     *    "page" => xxx, 第几页
     *    "per_page" => xxx,  每页几条信息
     * ]    
     * $memberid //optional, 用户id 
     */

    public function getActiveCoupon($params = [], $memberid = '') {
        $input = array();
        $input['memberid'] = $memberid ? $memberid : $this->operatorId;
        $input['status'] = 'ACTIVE';
        $tmp_url = $this->_baseCouponUri . '?onlyids=';

        if (!empty($params)) {
            if (isset($params['onlyids'])) {
                $str = $params['onlyids'] ? 'true' : 'false';
                $tmp_url = $tmp_url . $str;
                $params = ArrayHelper::remove($params, 'onlyids');
            } else {
                $tmp_url = $tmp_url . 'false';
            }
            $appendurl = http_build_query($params);
            $tmp_url = $tmp_url . '&' . $appendurl;
        } else {
            $tmp_url = $tmp_url . 'false';
        }
        return $this->create(['promotion' => $tmp_url], $input);
    }

    /*
     * 向某个用户绑定优惠码。
     * @input
     * $couponcode //required，优惠码  
     * $memberid //optional, 用户id 
     * @Return:
     * 成功绑定 -- 返回绑定的couponid
     * 绑定失败--返回空
     */

    public function bindCouponCode($couponcode, $memberid = '') {
        $input = array();
        $input['memberid'] = $memberid ? $memberid : $this->operatorId;
        $input['code'] = $couponcode;

        $tmp_url = $this->_baseCouponUri . '_fetchOneByCode?';
        $appendurl = http_build_query($input);
        $tmp_url = $tmp_url . $appendurl;
        return $this->get(['promotion' => $tmp_url], [], 'GET');
    }

    /*
     * 根据attrname查找促销规则。
     * @input
     * $attrname //required，属性名  
     * $value //required, 属性值
     * @Return:
     * 查到结果 -- 返回结果list
     * 未查到结果--返回空
     */

    public function findRuleByAttr($attrname, $value) {

        $tmp_url = $this->_basepsdlUrl . 'rules/_findBy' . $attrname . '.json?value=' . $value;
        return $this->get(['promotion' => $tmp_url], [], 'GET');
    }

    /*
     * 通过item id查询对应商品的促销tag
     * @input: 
     * $itemids =>[      //需要查询的itemids，单个itemid也需要为array形式。
     *     itemid1,
     *     itemid2,
     *     itemid3,
     *      xxx
     * ]
     *  @Return:
      [
        {
            "itemid": itemid1,
            "tags": [ "xxx"],
            "ruleids": [ ]
        },
        {
            "itemid": itemid2,
            "tags": ["xxx" ],
            "ruleids": [ ]
        },
        {
            "itemid": itemid3,
            "tags": [ ],
            "ruleids": [ ]
        }
      ]
     *      
     */

    public function findtagsByItemid($itemids) {

        if (is_array($itemids)) {
            $tmp_url = $this->_baseruleUrl . '_itemtags';
            return $this->create(['promotion' => $tmp_url], $itemids);
        } else {
            $msg = YII_DEBUG ? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'findtagsByItemid input param should be an array' . $msg);
        }
    }

    
    
    /*
     * 用户领取某促销规则对应的优惠券,并绑定在自己名下
     * @input:
     * $rulename --required,促销规则，比如：满xx减xx，满xx包邮
     * $memberid -- optional,用户id  
     * return:
     * {"promotion":{"result":true,"detail":{"couponid":xx}}} 
     */

        public function getCouponbyRule($rulename, $memberid = '') {
        $input = array();
        $input['memberid'] = $memberid ? $memberid : $this->operatorId;
        $input['rulename'] = $rulename;
        $tmp_url = $this->_baseCouponUri . '_fetchOneByRuleName?';
        $appendurl = http_build_query($input);
        $tmp_url = $tmp_url . $appendurl;
        return $this->get(['promotion' => $tmp_url], [], 'GET');
    }
    
    /*
     * 查询某用户名下的符合某种规则的优惠券数量
     * @input:
     * $rulename --required,促销规则，比如：满xx减xx，满xx包邮
     * $memberid -- optional,用户id  
     * return:
     * {"promotion": couponNo} //couponNo为对应的优惠券个数
     */

        public function getCouponNumberbyRule($rulename, $memberid = '') {
        $input = array();
        $input['memberid'] = $memberid ? $memberid : $this->operatorId;
        $input['rulename'] = $rulename;

        $tmp_url = $this->_baseCouponUri . '_countMember?';
        $appendurl = http_build_query($input);
        $tmp_url = $tmp_url . $appendurl;
        return $this->get(['promotion' => $tmp_url], [], 'GET');
    }
    
    //list 用户名下针对该订单能用的优惠券
        public function listValidCoupons($postData, $cartModel,$dtoModel, $userId = ''){
            $userId = $userId ? $userId : $this->operatorId;               
            //获取个人名下所有的active优惠券   
            $couponInfos = $this->getValidCoupons()['coupon'];
            $coupons = array();
            if(is_array($couponInfos)){
                $validCouponIds = ArrayHelper::getColumn($couponInfos, 'couponid');
                if(empty($validCouponIds)){
                    return ['success' => 'c200','coupons'=>[]];
                }
            //验证有效的优惠券对于当前订单的有效性
                $canUseCouponIds = $cartModel->checkCoupons($postData, $dtoModel, $validCouponIds);
                $couponInfos = ArrayHelper::index($couponInfos, 'couponid');
                foreach ($canUseCouponIds as $key => $value) {
                    $coupons[$value] = $couponInfos[$value];
                }   
                return ['success' => 'c200','coupons'=>$coupons];
            }else{
                return ['errorCode'=>'c500','errorMsg'=>'获取优惠券出错'];
            }
        }
        
         public function activeCoupons($postData, $cartModel,$dtoModel, $userId = ''){
            $userId = $userId ? $userId : $this->operatorId;       
            $couponCode = $postData['couponCode'];    
            $couponInfo = $this->getCouponId($couponCode);   
            // 获取到couponId
            if(isset($couponInfo['couponId'])){
                $couponId = $couponInfo['couponId'];
                $couponIds[] = $couponId;
                //检查该优惠码是否可用
                $couponStatus = $cartModel->checkCoupons($postData,$dtoModel, $couponIds,true);
                if(isset($couponStatus['status']) && $couponStatus['status'] === 'p200'){
                    $couponStatus['ruleName'] = $couponInfo['ruleName'];
                    $couponStatus['desc'] = $couponInfo['desc'];
                }
                return $couponStatus;
            }else{
                return $couponInfo;
            }
        }
        
        //根据couponId判断该优惠券是否有效 一次只能判断一个
    public function validateByCouponId($couponId) {
        
        $tmp_url = $this->_baseCouponUri . '_validateByCouponId' . '?value=' . $couponId;
        return $this->get(['promotion' => $tmp_url], [], 'GET');
    }
    //批量判断优惠券的有效性
    public function validateByCouponIds($couponIds) {

        $result = array();
        foreach ($couponIds as $key => $value) {
            $valid = $this->validateByCouponId($value);
            if($valid['promotion'] === true){
                $result[] = $value;
            }
        }
        return $result;
    }
    
    public function getCouponId($couponCode){
        //Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $couponId = null;
//        $coupon = $this->checkCouponcode($couponCode);
//        //可能用户之前已经绑定过优惠券
//        if(isset($coupon['promotion']) && !empty($coupon['promotion'])){
//            foreach ($coupon['promotion'] as $key => $value) {
//                if($value['status'] === 'ACTIVE'){
//                    $valid = $this->validateByCouponId($value['couponid']);
//                    if($valid['promotion'] === true){
//                        return ['couponId'=>$value['couponid']];
//                    }
//                }
//            }
//        }
        //如果该用户没绑定过这个code
        try{
            $coupon = $this->bindCouponCode($couponCode);
        } catch (\Exception $ex) { 
            return ['errorCode'=>'p500','errorMsg'=>'优惠码激活失败'];
        }

        if(isset($coupon['promotion']['result']) && $coupon['promotion']['result'] == true ){
            $couponId = $coupon['promotion']['detail']['coupon']['couponid'];
            $ruleName = $coupon['promotion']['detail']['coupon']['rulename'];
            $desc = $coupon['promotion']['detail']['coupon']['desc'];
        }else{
            $failReason = Yii::$app->params['sm']['promotion']['activateFail'];
            if(isset($coupon['promotion']['detail']['errcode']) && $coupon['promotion']['detail']['errcode']
                   && array_key_exists($coupon['promotion']['detail']['errcode'], $failReason))
                {
                    $errmsg = $failReason[$coupon['promotion']['detail']['errcode']];
                    return ['errorCode'=>'p500','errorMsg' => $errmsg];
            }
            return ['errorCode'=>'p500','errorMsg'=>'优惠码激活失败'];
        }
       
        return ['couponId'=>$couponId,'ruleName' =>$ruleName,'desc' => $desc];
    }
    
    /*
     * 查询某用户名下可用优惠券列表
     * @input:
     * $memberid -- optional,用户id  
     * return:
     * [
    {
        "_id": {}, 
        "couponcode": "test4cart", 
        "couponid": 1, 
        "coupontype": "PUBLIC", 
        "deliveredTime": "2015-12-03T07:44:16.947+00:00", 
        "desc": "订单满100-10，优惠券限制", 
        "etime": "9999-12-11T00:00:00.000+00:00", 
        "lazycoupon_id": {
            "$oid": "565ff29e68504b8da8000001"
        }, 
        "memberid": "xxx", 
        "orderid": "", 
        "ruleid": "1", 
        "rulename": "订单满减100-10", 
        "status": "ACTIVE", 
        "stime": "2013-12-01T00:00:00.000+00:00", 
        "usedTime": null, 
        "validperiod": 30, 
        "validperiodunit": "Day"
    }, 
    {
        "_id": {
            "$oid": "565ff4ca68504b1dfd000005"
        }, 
        "couponcode": "test4cart", 
        "couponid": 4, 
        "coupontype": "PUBLIC", 
        "deliveredTime": "2015-12-03T07:52:42.067+00:00", 
        "desc": "订单满100-10，优惠券限制", 
        "etime": "9999-12-11T00:00:00.000+00:00", 
        "lazycoupon_id": {
            "$oid": "565ff29e68504b8da8000001"
        }, 
        "memberid": "xxx", 
        "orderid": "", 
        "ruleid": "1", 
        "rulename": "订单满减100-10", 
        "status": "ACTIVE", 
        "stime": "2013-12-01T00:00:00.000+00:00", 
        "usedTime": null, 
        "validperiod": 30, 
        "validperiodunit": "Day"
    }
    ]
     */

        public function getValidCoupons($memberid = '') {
        $tmp_uid = $memberid ? $memberid : $this->operatorId;
        $tmp_url = $this->_basememberUrl . '_validcoupons?memberid=' . $tmp_uid;
        return $this->get(['coupon' => $tmp_url], [], 'GET');
    }
    /*
     * 查询某用户名下已用优惠券列表
     * @input:
     * $memberid -- optional,用户id  
     * return: 同getValidCoupons
     * 
     */
        public function getUsedCoupons($memberid = '') {
        $tmp_uid = $memberid ? $memberid : $this->operatorId;
        $tmp_url = $this->_basememberUrl . '_usedcoupons?memberid=' . $tmp_uid;
        return $this->get(['coupon' => $tmp_url], [], 'GET');
    }
    
    /*
     * 查询某用户名下已过期优惠券列表
     * @input:
     * $memberid -- optional,用户id  
     * return: 同getValidCoupons
     * 
     */
        public function getInvalidCoupons($memberid = '') {
        $tmp_uid = $memberid ? $memberid : $this->operatorId;
        $tmp_url = $this->_basememberUrl . '_invalidcoupons?memberid=' . $tmp_uid;
        return $this->get(['coupon' => $tmp_url], [], 'GET');
    }

    
    /*
     * 查询N元的metadata信息
     * @input:
     * $memberid -- optional,用户id  
     * return: 
     * 
     */
    public function getMetaDataInfo($params = [], $memberid = '') {
        
        $tmp_url = $this->_baseruleUrl . '_tags4MetaData';        
        return $this->create(['promotion' => $tmp_url], $params);
    }
        
    public function getNSelectMetaDataInfo($params = []) {
        if(empty($params)){
            return null;
        }
        $result = $this->getMetaDataInfo($params);
        $nSelectMetaData = array();
        if(isset($result['promotion'])){
            $mda = $result['promotion'];
            
            foreach ($mda as $key => $md) {
                $temp = array();
                foreach ($md['metadata'] as $k => $mdd) {
                    if(isset($mdd['typecode']) && (substr($mdd['typecode'], 2, 3) === '600' || substr($mdd['typecode'], 2, 3)=== '700')){
                        
                        $temp['fixedPrice'] = $mdd['fixedPrice'];
                        $temp['numOfGoods'] = $mdd['numOfGoods'];
                        if(isset($mdd['landingpage'])){
                            $temp['landingpage'] = $mdd['landingpage'];
                        }
                        if(isset($mdd['mlandingpage'])){
                            $temp['mlandingpage'] = $mdd['mlandingpage'];
                        }
                        $temp['tagType'] = $mdd['tagType'];
                        $temp['typecode'] = $mdd['typecode'];
                        break;
                    }
                    
                }
                $nSelectMetaData[$md['tag']] = $temp;
            }
            return $nSelectMetaData;
        }else{
            return null;
        }
        
    }
}
