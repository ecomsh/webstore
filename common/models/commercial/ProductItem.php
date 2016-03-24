<?php


namespace common\models\commercial;


use common\models\commercial\BaseItem;

/**
 * 最后疯抢广告条目
 */
class ProductItem extends BaseItem {
    //图片地址
    public $productImage;
    //点击跳转地址
    public $href;
    //商品名称
    public $title;
    //商品说明
    public $description;
    //商品价格
    public $price;
    //国内参考价
    public $listPrice;
     //商品属性
    public $product;
  
    //原价
    public $offerPrice;
    //活动价
    public $promotionPrice;
    //下架时间
    public $endTime;
    //直降价格
    public $zhijiang;

    /**
     * 构造函数
     * @override
     */
    public function __construct() {
        parent::__construct();
    }


    /**
     * 验证规则
     * @override
     */
    public function rules() {
        return [
            [['product'], 'safe'],
            [['productImage', 'href', 'title', 'description', 'price', 'listPrice', 'offerPrice', 'promotionPrice', 'endTime', 'zhijiang'], 'required'],
            [['price', 'listPrice', 'offerPrice', 'promotionPrice',], 'number', 'min' => 0],
        ];
    }

}