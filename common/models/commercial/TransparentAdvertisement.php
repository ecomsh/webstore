<?php

namespace common\models\commercial;

use common\models\commercial\BaseAdvertisement;
use yii\helpers\Url;

/**
 * 最后疯抢广告
 */
class TransparentAdvertisement extends BaseAdvertisement {

    //**测试数据**
    protected $fakeData = [
        //公用属性
        'cache' => '3600', //单位为秒，0则视为不缓存
        'startTime' => '2015-11-11 00:00:00', //开始时间
        'endTime' => '2015-11-11 00:00:00', //结束时间
        'enable' => '1', //广告状态 1正常 0下架 -1demo

        'items' => [
        //最后疯抢项目
            [
                'productImage' => 'http://w3.soupian.me/cbtui/src/images/finalpro.png', //图片地址
                'href' => 'http://www.php.net/manual/zh/class.reflectionclass.php', //点击跳转地址
                'title' => 'Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色', //商品说明
                'description' => '<span class="global-highlight">6.4折/</span>美国4.8折/【满169减69】 沃思莱斯只能微震美胸仪，罩杯D密码，“挺”起来，“乳”此美丽动人！',
                'listPrice' => '400',  //国内参考价
                'offerPrice' => '300',  //原价
                'promotionPrice' => '200',  //活动价
                'price' => '200', //商品价格
                'endTime' => '2015-11-27 13:23:30',
            ],
            [
                'productImage' => 'http://w3.soupian.me/cbtui/src/images/finalpro.png', //图片地址
                'href' => 'http://www.php.net/manual/zh/class.reflectionclass.php', //点击跳转地址
                'title' => 'Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色', //商品说明
                'description' => '<span class="global-highlight">6.4折/</span>美国4.8折/【满169减69】 沃思莱斯只能微震美胸仪，罩杯D密码，“挺”起来，“乳”此美丽动人！',
                'listPrice' => '400',  //国内参考价
                'offerPrice' => '300',  //原价
                'promotionPrice' => '200',  //活动价
                'price' => '200', //商品价格
                'endTime' => '2015-11-27 13:23:30',
            ],
            [
                'productImage' => 'http://w3.soupian.me/cbtui/src/images/finalpro.png', //图片地址
                'href' => 'http://www.php.net/manual/zh/class.reflectionclass.php', //点击跳转地址
                'title' => 'Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色', //商品说明
                'description' => '<span class="global-highlight">6.4折/</span>美国4.8折/【满169减69】 沃思莱斯只能微震美胸仪，罩杯D密码，“挺”起来，“乳”此美丽动人！',
                'listPrice' => '400',  //国内参考价
                'offerPrice' => '300',  //原价
                'promotionPrice' => '200',  //活动价
                'price' => '200', //商品价格
                'endTime' => '2015-11-27 13:23:30',
            ],
            [
                'productImage' => 'http://w3.soupian.me/cbtui/src/images/finalpro.png', //图片地址
                'href' => 'http://www.php.net/manual/zh/class.reflectionclass.php', //点击跳转地址
                'title' => 'Teazen江南桑拿柠檬马黛茶可爱卡通茶包9克/蓝色', //商品说明
                'description' => '<span class="global-highlight">6.4折/</span>美国4.8折/【满169减69】 沃思莱斯只能微震美胸仪，罩杯D密码，“挺”起来，“乳”此美丽动人！',
                'listPrice' => '400',  //国内参考价
                'offerPrice' => '300',  //原价
                'promotionPrice' => '200',  //活动价
                'price' => '200', //商品价格
                'endTime' => '2015-11-27 13:23:30',
            ], 
        ],     
    ];
    
    /**
     * 构造函数
     * @override
     */
    public function __construct() {
        parent::__construct();
        $this->view = 'transparent';
        $this->type = 'transparent';
        $this->itemClass = '\common\models\commercial\TransparentItem';
    }
    protected function analyData($data){
$data['startTime'] = !empty($data['startTime']) ? $data['startTime'] : time() - 86400;
        $data['endTime'] = !empty($data['endTime']) ? $data['endTime'] : time() + 86400;
        $data['cache'] = !empty($data['cache']) ? $data['cache'] : "3600";
        $newData['items'] = $data;
        return $newData;
    }
    /**
     * 验证规则
     * 会自动和父元素的规则合并
     * @override
     */
    public function rules(){
        $rules = [
        ];
        return array_merge($rules,parent::rules());
    }
}