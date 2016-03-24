<?php


namespace mobile\models\commercial;


use common\models\commercial\BaseItem;

/**
 * 专场广告条目
 */
class HalfBannerItem extends BaseItem {
    //图片地址
    public $imageUrl;
    //点击跳转地址
    public $href;
    //广告标题
    public $title;
    //广告内容
    public $description;
    //折扣
    public $proText;

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
            [['imageUrl', 'href', 'title', 'description', 'proText'], 'required'],
        ];
    }

}