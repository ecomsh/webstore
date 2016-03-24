<?php

namespace mobile\models\commercial;

use common\models\commercial\BaseAdvertisement;
use Yii;
use yii\helpers\Url;
/**
 * 新品推荐广告
 */
class NewProductAdvertisement extends BaseAdvertisement {

    //**测试数据**
    protected $fakeData = [
        //公用属性
        'cache' => '3600', //单位为秒，0则视为不缓存
        'startTime' => '2015-11-11 00:00:00', //开始时间
        'endTime' => '2015-11-11 00:00:00', //结束时间
        'enable' => '1', //广告状态 1正常 0下架 -1demo

        'items' => [
        //新品推荐项目
            [
                'productImage' => 'http://w3.soupian.me/cbtui/src/images/newproduct1.png', //图片地址
                'href' => '202', //产品id
                'title' => 'Teazen江南桑拿 9克/蓝色', //商品名称
                'price' => '101', //商品价格
                'originPrice' => '201', //原价
            ],
            [
                'productImage' => 'http://w3.soupian.me/cbtui/src/images/newproduct1.png', //图片地址
                'href' => '202', //产品id
                'title' => '商品2', //商品名称
                'price' => '102', //商品价格
                'originPrice' => '202', //原价
            ],
            [
                'productImage' => 'http://w3.soupian.me/cbtui/src/images/newproduct1.png', //图片地址
                'href' => '202', //产品id
                'title' => 'Teazen江南桑拿 9克/蓝色', //商品名称
                'price' => '100', //商品价格
                'originPrice' => '200', //原价
            ],
            [
                'productImage' => 'http://w3.soupian.me/cbtui/src/images/newproduct1.png', //图片地址
                'href' => '202', //产品id
                'title' => '商品4', //商品名称
                'price' => '100', //商品价格
                'originPrice' => '200', //原价
            ],
            [
                'productImage' => 'http://w3.soupian.me/cbtui/src/images/newproduct1.png', //图片地址
                'href' => '202', //产品id
                'title' => '商品5', //商品名称
                'price' => '100', //商品价格
                'originPrice' => '200', //原价
            ],

        ],

        //新品推荐专有属性
        
    ];
    
    
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
                $newItem['title'] = !empty($item->price) ? $item->title : '';
                $newItem['price'] = !empty($item->price) ? $item->price : 0;
                $newItem['originPrice'] = !empty($item->originPrice) ? $item->originPrice : 0;

                $newData['items'][] = $newItem;
            }
        }

        return $newData;
    }


    /**
     * 构造函数
     * @override
     */
    public function __construct() {
        parent::__construct();
        $this->view = 'newProduct';
        $this->type = 'newProduct';
        $this->itemClass = '\mobile\models\commercial\NewProductItem';
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