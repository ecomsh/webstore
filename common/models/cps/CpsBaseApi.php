<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author yyjia@cn.ibm.com
 */

namespace common\models\cps;

use Yii;
use common\models\BaseApi;
use common\helpers\Tools;
use yii\helpers\ArrayHelper;

/**
 * 用于请求地址数据的基类
 */
class CpsBaseApi extends BaseApi {

    private $_baseUrl;

    public function __construct($userId = '') {
        parent::__construct($userId);
        $this->_baseUrl = Yii::$app->params['sm']['cps']['baseUrl']; 
    }

    /*
     * 获取某段时间内多麦的订单列表
     * @input:
     * $params = [
     * 'startTime' => 'yyyy-MM-dd HH:mm:ss' //起始时间，格式必须一致
     * 'endTime' => 'yyyy-MM-dd HH:mm:ss'//截止时间，格式必须一致。
     * ]
     * @return:
     * {"cps":[
      "success": 1,
      "errors": "",
      "orders":[
      {"test": 1, "euid": "10030_633_0_dGVzdA==_0", "mid": "10030", "order_sn": "2015072412130998",…},
      {"test": 1, "euid": "10029_633_0_dGVzdA==_0", "mid": "10029", "order_sn": "2015072523574113",…},
      {"test": 1, "euid": "10028_633_0_dGVzdA==_0", "mid": "10028", "order_sn": "2015081320777636",…},
      {"test": 1, "euid": "10027_633_0_dGVzdA==_0", "mid": "10027", "order_sn": "2015081512177454",…},
      {"test": 1, "euid": "10026_633_0_dGVzdA==_0", "mid": "10026", "order_sn": "2015081915742624",…},
      {"test": 1, "euid": "10030_633_0_dGVzdA==_0", "mid": "10030", "order_sn": "2015082711518062",…},
      {"test": 1, "euid": "10030_633_0_dGVzdA==_0", "mid": "10030", "order_sn": "2015082718729095",…}
      ]
     * ]
      }
     *  
     */

    public function getDMOrdersByTime($params) {
        if ($params['startTime'] && $params['endTime']) {
            $tmp_url = $this->_baseUrl . 'duomai/orders/byCreatedTime?';
            $appendUrl = http_build_query($params);
            $tmp_url = $tmp_url . $appendUrl;
            return $this->get(['cps' => $tmp_url], [], 'GET');
        } else {
            $msg = YII_DEBUG ? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'getDMOrderlistByTime input param error' . $msg);
        }
    }

    /*
     * 获取多麦中某个order id相关的订单详情。
     * @input
     * $orderId -- 订单id
     * @return:
     * {cps:[
      "success": 1,
      "errors": "",
      "orders": [
      {
      "test": 1,
      "euid": "10026_633_0_dGVzdA==_0",
      "mid": "10026",
      "order_sn": "2015081915742624",
      "order_time": "2015-08-19 15:09:08",
      "click_time": "2015-08-19 14:09:08",
      "orders_price": 1313.1,
      "discount_amount": 0,
      "is_new_custom": 0,
      "order_channel": 2,
      "referer": "http://c.duomai.com/track.php?sid=10010&aid=123&euid=&t=http://www.ftzmall.com/",
      "currency": "CNY",
      "timezone": "UTC+8",
      "details": [
      {
      "goods_id": "2290",
      "goods_ta": 1,
      "goods_price": 1999,
      "goods_name": "Chanel 香奈儿 女士墨镜 OCH5171",
      "goods_cate": "1008",
      "goods_cate_name": "女士配件",
      "rate": 0.07,
      "totalPrice": 1313.1
      }]}]]}
     */

    public function getOrderbyId($orderId) {
        $tmp_url = $this->_baseUrl . 'duomai/orders/' . $orderId;
        return $this->get(['cps' => $tmp_url], [], 'GET');
    }

    /*
     * 更新union的access log。
     * @input
     * $params = [
     * 'unionId' => "duomai"; //联盟id，比如duomai
     * 'refererUrl' => 'xxx',
     * 'hostUrl' => 'xxx',
     * "clientIp" => 'x.x.x.x'
     * ]
     * @Return:
     * {"cps":[
      "unionConfig": {
      "unionId": "duomai",
      "unionName": null,
      "unionIssuedIdentity": null,
      "signatureKey": null,
      "createTimestamp": null,
      "updateTimestamp": null,
      "creatorId": null,
      "updaterId": null,
      "markForDelete": 0,
      "unionKey": null
      },
      "refererUrl": 'xxx',
      "hostUrl": 'xxx',
      "clientIp": 'x.x.x.x',
      "createTimestamp": 1449054896041,
      "updateTimestamp": 1449054896041,
      "creatorId": null,
      "updaterId": null,
      "markForDelete": 0,
      "accessLogKey": 8
      ]
      }

     */

    public function updateUnionAccessLog($params) {
        if ($params['unionId'] && isset($params['refererUrl']) && isset($params['hostUrl']) && isset($params['clientIp'])) {
            $tmp_url = $this->_baseUrl . $params['unionId'] . '/accesslog';
            $unionId = ArrayHelper::remove($params, 'unionId');
            return $this->create(['cps' => $tmp_url], $params);
        } else {
            $msg = YII_DEBUG ? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'updateUnionAccessLog input param error' . $msg);
        }
    }
     /*
     * 获取某段时间内成果网的订单列表
     * @input:
     * $params = [
     * 'startTime' => 'yyyy-MM-dd HH:mm:ss' // required, 起始时间，格式必须一致
     * 'endTime' => 'yyyy-MM-dd HH:mm:ss'//required, 截止时间，格式必须一致。
      * 'page'=> '1' //optional, 页码，必须从1开始，如果查询页码书超出总页数，结果中的result为空数组。
     * ]
     * @return:
     *{
        "cps": {
            "total_page": 1, 
            "current_page": 0, 
            "results": [
            {
                "order_time": "2015-08-27 11:00:25", 
                "order_id": "12015082711518062", 
                "union_id": "10030_633_0_dGVzdA==_0", 
                "status": "0", 
                "payment": "5", 
                "paid": "0", 
                "total_price": "52.00", 
                "shipping": "0.00", 
                "coupon": "50.00", 
                "items": [
                    {
                        "item_id": "2007", 
                        "item_name": "【测试订单】中国台湾 自然素材无籽原味葡萄干 320g", 
                        "category": "system_normal", 
                        "price": "36.00", 
                        "amount": 1
                    }, 
                    {
                        "item_id": "683", 
                        "item_name": "【测试订单】苏格兰 殿斯圆形核桃黄油饼干 160g", 
                        "category": "system_special", 
                        "price": "32.00", 
                        "amount": 1
                    }, 
                    {
                        "item_id": "1188", 
                        "item_name": "【测试订单】韩国 EDO一口酥（蜜糖味）80g", 
                        "category": "system_normal", 
                        "price": "17.00", 
                        "amount": 1
                    }, 
                    {
                        "item_id": "1213", 
                        "item_name": "【测试订单】中国台湾 EDO凤梨酥 154g", 
                        "category": "system_normal", 
                        "price": "17.00", 
                        "amount": 1
                    }
                ]}
        ]
    }
}
      */
    public function getChanetOrders($params){
        if ($params['startTime'] && $params['endTime']) {
            $tmp_url = $this->_baseUrl . 'chanet/orders/byCreatedTimeAndPage?';
            $appendUrl = http_build_query($params);
            $tmp_url = $tmp_url . $appendUrl;
            return $this->get(['cps' => $tmp_url], [], 'GET');
        } else {
            $msg = YII_DEBUG ? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'getChanetOrders input param error' . $msg);
        }
    }

}
