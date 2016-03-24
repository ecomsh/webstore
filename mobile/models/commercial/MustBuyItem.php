<?php


namespace mobile\models\commercial;


use common\models\commercial\BaseItem;

/**
 * 每日必买广告条目
 */
class MustBuyItem extends BaseItem {
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
    //原价
    public $originPrice;
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
            [['productImage', 'href', 'title', 'description', 'price', 'originPrice', 'endTime','zhijiang'], 'required'],
            [['price', 'originPrice'], 'number', 'min' => 0],
        ];
    }

}