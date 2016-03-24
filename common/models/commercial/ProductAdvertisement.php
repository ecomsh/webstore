<?php

namespace common\models\commercial;

use common\models\commercial\BaseAdvertisement;
use yii\helpers\Url;

/**
 * 最后疯抢广告
 */
class ProductAdvertisement extends BaseAdvertisement {

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
        $this->view = 'product';
        $this->type = 'product';
        $this->itemClass = '\common\models\commercial\ProductItem';
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

                if(empty($item->productId)){
                    continue;
                }

                if(empty($item->productImage)){
                    $newItem['productImage'] = !empty($item->productImage2) ? $item->productImage2 : Url::base().'/themes/ftzmallnew/src/images/baoshui.png';
                }else{
                   $newItem['productImage'] =  $item->productImage; 
                }
                $newItem['href'] = !empty($item->productId) ? Url::to(['/product/view','id'=>$item->productId],true) : '#';
                $newItem['title'] = !empty($item->title) ? $item->title : '';

                if(!empty($item->proText)){
                    $newItem['description'] =  $item->proText; 
                }else if(!empty($item->description)){
                    $newItem['description'] =  $item->description; 
                }else{
                    $newItem['description'] = !empty($item->description2) ? $item->description2 : '该产品没有表述';
                }
    
                $newItem['price'] = !empty($item->price) ? $item->price : 0;
                $newItem['listPrice'] = !empty($item->originPrice) ? $item->originPrice : 0; //国内参考价list price
                $newItem['offerPrice'] = !empty($item->offerPrice) ? $item->offerPrice : 0; //原价
                $newItem['promotionPrice'] = !empty($item->promotionPrice) ? $item->promotionPrice : 0; //活动价 
                
                $newItem['endTime'] = !empty($item->endTime) ? $item->endTime : date("Y-m-d H:i:s", time()+86400);
                if(!empty($item->offerPrice) && !empty($item->promotionPrice)){
                    $newItem['zhijiang'] = $item->offerPrice - $item->promotionPrice;
                }else{
                    $newItem['zhijiang'] = 0;
                }
                
                $newItem['product'] = !empty($item->product) ? $item->product : 0; //商品属性 

                if (strtotime($newItem['endTime']) < time()){
                    continue;
                }
                $newData['items'][] = $newItem;
            }
        }

      
        //$newData = $this->fakeData;
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