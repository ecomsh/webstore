<?php

namespace mobile\models\commercial;

use common\models\commercial\BaseAdvertisement;
use Yii;
use yii\helpers\Url;

/**
 * 全球精选广告
 */
class GlobalProductAdvertisement extends BaseAdvertisement {


    //**测试数据**
    protected $fakeData = [
        //公用属性
        'cache' => '3600', //单位为秒，0则视为不缓存
        'startTime' => '2015-11-11 00:00:00', //开始时间
        'endTime' => '2015-11-11 00:00:00', //结束时间
        'enable' => '1', //广告状态 1正常 0下架 -1demo

        'items' => [
        //全球精选项目
            [
                'productImage' => 'http://w3.soupian.me/themes/ftzmallnew/src/images/global.png', //图片地址
                'href' => 'http://www.php.net/manual/zh/class.reflectionclass.php', //点击跳转地址
                //proId
                'description' => '<span class="global-highlight">6.4折/</span>美国4.8折/【满169减69】 沃思莱斯只能微震美胸仪，罩杯D密码，“挺”起来，“乳”此美丽动人！',
                'price' => '119',       //商品价格
                'originPrice' => '480',  //原价
                'newPro' => 1,             //新品尝鲜，1显示/0关闭
                'baoyou' => 1,          //包邮商品，1显示/0关闭
                'emergency' => 0,       //库存告急，1显示/0关闭
                'soldout' => 0,         //已售空，1显示/0关闭
            ],
            [
                'productImage' => 'http://w3.soupian.me/themes/ftzmallnew/src/images/global.png', //图片地址
                'href' => 'http://www.php.net/manual/zh/class.reflectionclass.php', //点击跳转地址
                'description' => '<span class="global-highlight">6.4折/</span>美国4.8折/【满169减69】 沃思莱斯只能微震美胸仪，罩杯D密码，“挺”起来，“乳”此美丽动人！',
                'price' => '119',       //商品价格
                'originPrice' => '480',  //原价
                'newPro' => 0,             //新品尝鲜，1显示/0关闭
                'baoyou' => 0,          //包邮商品，1显示/0关闭
                'emergency' => 1,       //库存告急，1显示/0关闭
                'soldout' => 1,         //已售空，1显示/0关闭
            ],   
            [
                'productImage' => 'http://w3.soupian.me/themes/ftzmallnew/src/images/global.png', //图片地址
                'href' => 'http://www.php.net/manual/zh/class.reflectionclass.php', //点击跳转地址
                'description' => '<span class="global-highlight">6.4折/</span>美国4.8折/【满169减69】 沃思莱斯只能微震美胸仪，罩杯D密码，“挺”起来，“乳”此美丽动人！',
                'price' => '119',       //商品价格
                'originPrice' => '480',  //原价
                'newPro' => 0,             //新品尝鲜，1显示/0关闭
                'baoyou' => 0,          //包邮商品，1显示/0关闭
                'emergency' => 1,       //库存告急，1显示/0关闭
                'soldout' => 1,         //已售空，1显示/0关闭
            ], 
        ],

        //全球精选专有属性
        
    ];
    
    /**
     * 构造函数
     * @override
     */
    public function __construct() {
        parent::__construct();
        $this->view = 'globalProduct';
        $this->type = 'globalProduct';
        $this->itemClass = '\mobile\models\commercial\GlobalProductItem';
    }


        /**
     * 解析获取到的数据
     * @param $data 原始数据 
     * @return object 转换后的结果
     * @override
     */
    protected function analyData($data){
        $newData = parent::analyData($data);

        //解析子项
        if(!empty($data['items'])){
            $items = json_decode($data['items']);
            foreach($items as $item){
                $newItem = array();
                if(empty($item->productImage)){
                    $newItem['productImage'] = !empty($item->productImage2) ? $item->productImage2 : '';
                }else{
                   $newItem['productImage'] =  $item->productImage; 
                }
                $newItem['href'] = !empty($item->productId) ? Url::to(['product/view','id'=>$item->productId],true) : '#';
                if(empty($item->description)){
                    $newItem['description'] = !empty($item->description2) ? $item->description2 : '该产品没有表述';
                }else{
                   $newItem['description'] =  $item->description; 
                }
                $newItem['price'] = !empty($item->price) ? $item->price : 0;
                $newItem['originPrice'] = !empty($item->originPrice) ? $item->originPrice : 0;
                $newItem['endTime'] = !empty($item->endTime) ? $item->endTime : date("Y-m-d H:i:s", time()+86400);

                //后台未提供此类信息
                $newItem['newPro'] = 1;
                $newItem['baoyou'] = 1;
                $newItem['emergency'] = 1;
                $newItem['soldout'] = 1;

                $newData['items'][] = $newItem;
            }
        }

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