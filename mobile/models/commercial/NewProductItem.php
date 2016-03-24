<?php


namespace mobile\models\commercial;


use common\models\commercial\BaseItem;

/**
 * 新品推荐广告条目
 */
class NewProductItem extends BaseItem {
    //图片地址
    public $productImage;
    //点击跳转地址
    public $href;
    //商品名称
    public $title;
    //商品价格
    public $price;
    //原价
    public $originPrice;

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
            [['productImage', 'href', 'title', 'price', 'originPrice'], 'required'],
            [['price', 'originPrice'], 'number', 'min' => 0],
        ];
    }

}