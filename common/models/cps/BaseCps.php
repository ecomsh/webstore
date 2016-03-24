<?php

namespace common\models\cps;

use Yii;
use yii\base\Model;
use common\helpers\Tools;

/**
 * 广告联盟基类
 */ 
class BaseCps extends Model {
    //CPS广告联盟标识
    public $unionId;
    //联盟成员(也称作网站主)标识
    public $unionPublisherId;
    //活动标识
    public $unionCampaignId;
    //广告入口流量来源URL
    public $unionReferer;
    //用户点击进入CPS广告入口的时间
    public $unionClickTimestamp;

    //cookies名字
    private static $cookiesName = 'cps';
    //cookies超时时间
    protected $expire = 432000;

    //类型映射
    private $cpsMap = [
        'frontend' => [
            'duomai' => '',
        ],
        'mobile' => [
        ],
    ];

    //"unionId": "duomai",
    //"unionPublisherId": "10026_633_0_dGVzdA==_0",
    //"unionCampaignId": "10026",
    //"unionReferer": "http://c.duomai.com/track.php?sid=10010&aid=123&euid=&t=http://www.ftzmall.com/",
    //"uni0nClickTimestamp": "2015-08-19 14:09:08"

    /**
     * 构造函数
     * @override
     */
    public function __construct() {

    }


    /**
     * 验证规则
     * @override
     */
    public function rules() {
        return [
            [['unionId', 'unionPublisherId', 'unionClickTimestamp'], 'required'],
            [['unionReferer', 'unionCampaignId'], 'safe']
        ];
    }


    /**
     * 记录广告联盟信息到cookies
     * 将从url、header里解析所需内容
     * @param 无
     * @return 无
     */
    public function setDataToCookie(){
        $data = [
            "unionId" => $this->unionId,
            "unionPublisherId" => $this->unionPublisherId,
            "unionCampaignId" => $this->unionCampaignId,
            "unionReferer" => $this->unionReferer,
            "unionClickTimestamp" => $this->unionClickTimestamp,
        ];

        $cookies = Yii::$app->response->cookies;
        $cookies->add(new \yii\web\Cookie([
            'name' => BaseCps::$cookiesName,
            'value' => base64_encode(json_encode($data)),
            'expire' => time() + Yii::$app->params['cps'][$this->unionId]['expire'],
            'domain' => Yii::$app->params['cps']['domain'],
        ]));
    }


    /**
     * 从cookies获取广告联盟信息
     * @param 无
     * @return array 信息
     */
    public function getDataFromCookie(){
        $cookies = Yii::$app->request->cookies;
        if (($cookie = $cookies->get(BaseCps::$cookiesName)) !== null) {
            $data = json_decode(base64_decode($cookie->value));
        }else{
            $data = null;
        }

        return $data;
    }


    /**
     * 获取电脑版cpsMap
     * @param 无
     * @return array
     */
    public static function getFrontMap(){
        return $this->cpsMap['frontend'];
    }
}