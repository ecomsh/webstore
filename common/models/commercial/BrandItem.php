<?php

namespace common\models\commercial;

use common\models\commercial\BaseItem;

/**
 * 品牌团广告条目
 */
class BrandItem extends BaseItem {
    //图片地址
    public $imageUrl;
    //点击跳转地址
    public $href;
    //logo图片地址
    public $logoSrc;
    //品牌名称
    public $title;
    //品牌说明
    public $description;
    //促销相关信息
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
            [['imageUrl', 'href', 'logoSrc', 'title', 'description', 'proText',], 'required'],
        ];
    }

}