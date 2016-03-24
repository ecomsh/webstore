<?php

namespace mobile\models\commercial;

use common\models\commercial\BaseAdvertisement;
use Yii;
use yii\helpers\Url;

/**
 * 每日必买广告
 */
class MustBuyAdvertisement extends BaseAdvertisement {

    //**测试数据**
    protected $fakeData = [
        //公用属性
        'cache' => '3600', //单位为秒，0则视为不缓存
        'startTime' => '2015-11-11 00:00:00', //开始时间
        'endTime' => '2015-11-11 00:00:00', //结束时间
        'enable' => '1', //广告状态 1正常 0下架 -1demo

        'items' => [
        //每日必买项目
            [
                'productImage' => 'http://w3.soupian.me/themes/ftzmallnew/src/images/buyproduct.png', //图片地址
                'href' => 'http://www.php.net/manual/zh/class.reflectionclass.php', //点击跳转地址
                'title' => '韩国It \'s skin晶钻蜗牛乳液1号清爽型乳液140ml', //商品名称
                'description' => '提取蜗牛原液，给你护肤界的软黄金————Its skin晶钻蜗牛乳液1号（清爽型）！爽哭的修复能力，敏感肌、痘痘肌、脱皮肌任性用！一瓶能满足你对乳液的要求，清爽保湿美美哒！', //商品说明
                'price' => '119', //商品价格
                'originPrice' => '279', //原价
                'endTime' => '2015-12-1 10:00:00',
            ],
            [
                'productImage' => 'http://w3.soupian.me/themes/ftzmallnew/src/images/buyproduct.png', //图片地址
                'href' => 'http://www.php.net/manual/zh/class.reflectionclass.php', //点击跳转地址
                'title' => '韩国It \'s skin晶钻蜗牛乳液1号清爽型乳液140ml', //商品名称
                'description' => '提取蜗牛原液，给你护肤界的软黄金————Its skin晶钻蜗牛乳液1号（清爽型）！爽哭的修复能力，敏感肌、痘痘肌、脱皮肌任性用！一瓶能满足你对乳液的要求，清爽保湿美美哒！', //商品说明
                'price' => '119', //商品价格
                'originPrice' => '279', //原价
                'endTime' => '2015-12-2 10:00:00',
            ],   
        ],

        //每日必买专有属性
        
    ];
    
    /**
     * 构造函数
     * @override
     */
    public function __construct() {
        parent::__construct();
        $this->view = 'mustBuy';
        $this->type = 'mustBuy';
        $this->itemClass = '\mobile\models\commercial\MustBuyItem';
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
                $newItem['title'] = !empty($item->title) ? $item->title : "";
                if(empty($item->description)){
                    $newItem['description'] = !empty($item->description2) ? $item->description2 : '该产品没有表述';
                }else{
                   $newItem['description'] =  $item->description; 
                }
                $newItem['price'] = !empty($item->price) ? $item->price : 0;
                $newItem['originPrice'] = !empty($item->originPrice) ? $item->originPrice : 0;
                $newItem['endTime'] = !empty($item->endTime) ? $item->endTime : date("Y-m-d H:i:s", time()+86400);
                if(!empty($item->offerPrice) && !empty($item->promotionPrice)){
                    $newItem['zhijiang'] = $item->offerPrice - $item->promotionPrice;
                }else{
                    $newItem['zhijiang'] = 0;
                }
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