<?php


namespace frontend\models\commercial;


use common\models\commercial\BaseItem;

/**
 * 全球精选广告条目
 */
class GlobalSelectionItem extends BaseItem {
    //图片地址
    public $productImage;
    //点击跳转地址
    public $href;
    //商品说明
    public $description;
    //商品价格
    public $price;
    //国内参考价
    public $listPrice;
    //原价
    public $offerPrice;
    //活动价
    public $promotionPrice;
    //新品尝鲜
    public $newPro;
    //包邮商品
    public $baoyou;
    //库存告急
    public $emergency;
    //已售空
    public $soldout;


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
            [['productImage', 'href', 'description', 'price', 'listPrice', 'offerPrice', 'promotionPrice', 'newPro', 'baoyou', 'emergency', 'soldout',], 'required'],
            [['price', 'listPrice', 'offerPrice', 'promotionPrice'], 'number', 'min' => 0],
            [['newPro', 'baoyou', 'emergency', 'soldout',], 'in', 'range' => [0, 1,]],
        ];
    }

}