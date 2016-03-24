<?php

namespace common\models\commercial;

use common\models\commercial\BaseAdvertisement;

/**
 * 品牌团广告
 */
class BrandAdvertisement extends BaseAdvertisement {


    //**测试数据**
    protected $fakeData = [
        //公用属性
        'cache' => '3600', //单位为秒，0则视为不缓存
        'startTime' => '2015-11-11 00:00:00', //开始时间
        'endTime' => '2015-11-11 00:00:00', //结束时间
        'enable' => '1', //广告状态 1正常 0下架 -1demo

        'items' => [
        //品牌团项目
            [
                'imageUrl' => 'http://w3.soupian.me/cbtui/src/images/brandpro.png', //图片地址
                'href' => 'http://www.php.net/manual/zh/class.reflectionclass.php', //点击跳转地址
                'logoSrc' => 'http://w3.soupian.me/cbtui/src/images/brand-logo.png', //logo图片地址
                'title' => '雅漾品牌团',
                'description' => '十年敏肌 百年雅漾',       //商品价格
                'proText' => '满<span class="brand-price">199</span>减<span class="brand-price">50</span> 上不封顶',  //商品促销信息
            ],
            [
                'imageUrl' => 'http://w3.soupian.me/cbtui/src/images/brandpro.png', //图片地址
                'href' => 'http://www.php.net/manual/zh/class.reflectionclass.php', //点击跳转地址
                'logoSrc' => 'http://w3.soupian.me/cbtui/src/images/brand-logo.png', //logo图片地址
                'title' => '雅漾品牌团',
                'description' => '十年敏肌 百年雅漾',       //商品价格
                'proText' => '满<span class="brand-price">199</span>减<span class="brand-price">50</span> 上不封顶',  //商品促销信息
            ],
            [
                'imageUrl' => 'http://w3.soupian.me/cbtui/src/images/brandpro.png', //图片地址
                'href' => 'http://www.php.net/manual/zh/class.reflectionclass.php', //点击跳转地址
                'logoSrc' => 'http://w3.soupian.me/cbtui/src/images/brand-logo.png', //logo图片地址
                'title' => '雅漾品牌团',
                'description' => '十年敏肌 百年雅漾',       //商品价格
                'proText' => '满<span class="brand-price">199</span>减<span class="brand-price">50</span> 上不封顶',  //商品促销信息
            ],
        ],

        //品牌团专有属性
        
    ];
    
    /**
     * 构造函数
     * @override
     */
    public function __construct() {
        parent::__construct();
        $this->view = 'brand';
        $this->type = 'brand';
        $this->itemClass = '\common\models\commercial\BrandItem';
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
                $newItem['imageUrl'] = !empty($item->imageUrl) ? $item->imageUrl : '';
                $newItem['href'] = !empty($item->href) ? $item->href : '#';
                $newItem['logoSrc'] = !empty($item->logoSrc) ? $item->logoSrc : '';
                $newItem['title'] = !empty($item->title) ? $item->title : '';
                $newItem['description'] = !empty($item->description) ? $item->description : '';
                $newItem['proText'] = !empty($item->proText) ? $item->proText : '';

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