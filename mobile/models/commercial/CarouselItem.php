<?php


namespace mobile\models\commercial;


use common\models\commercial\BaseItem;

/**
 * 轮播广告条目
 */
class CarouselItem extends BaseItem {
    //图片地址
    public $imageUrl;
    //点击跳转地址
    public $href;


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
            [['imageUrl', 'href'], 'required'],
        ];
    }

}