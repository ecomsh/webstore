<?php

namespace mobile\models\commercial;

use common\models\commercial\BaseAdvertisement;

/**
 * 轮播广告
 */
class CarouselAdvertisement extends BaseAdvertisement {
    //图片轮播时间间隔
    public $duration;
    //轮播区域的高度
    public $height;

    //**测试数据**
    protected $fakeData = [
        //公用属性
        'cache' => '3600', //单位为秒，0则视为不缓存
        'startTime' => '2015-11-11 00:00:00', //开始时间
        'endTime' => '2015-11-11 00:00:00', //结束时间
        'enable' => '1', //广告状态 1正常 0下架 -1demo

        'items' => [
        //轮播页项目
            [
                'imageUrl' => 'http://w3.soupian.me/cbtui/src/images/banner.png', //图片地址
                'href' => 'http://www.php.net/manual/zh/class.reflectionclass.php', //点击跳转地址
            ],
            [
                'imageUrl' => 'http://w3.soupian.me/cbtui/src/images/banner1.jpg', //图片地址
                'href' => 'http://www.php.net/manual/zh/class.reflectionclass.php', //点击跳转地址
            ],
            [
                'imageUrl' => 'http://w3.soupian.me/cbtui/src/images/banner2.jpg', //图片地址
                'href' => 'http://www.php.net/manual/zh/class.reflectionclass.php', //点击跳转地址
            ],
        ],

        //轮播广告专有属性
        'height' => 500, //高度
        'duration' => 1000 //轮播间隔
        
    ];
    
    /**
     * 构造函数
     * @override
     */
    public function __construct() {
        parent::__construct();
        $this->view = 'carousel';
        $this->type = 'carousel';
        $this->itemClass = '\mobile\models\commercial\CarouselItem';
    }


    /**
     * 解析获取到的数据
     * @param $data 原始数据 
     * @return object 转换后的结果
     * @override
     */
    protected function analyData($data){
        $newData = parent::analyData($data);

        $newData['height'] = 500;
        $newData['duration'] = 1000;

        //解析子项
        if(!empty($data['items'])){
            $items = json_decode($data['items']);
            foreach($items as $item){
                $newItem = array();
                $newItem['imageUrl'] = !empty($item->imageUrl) ? $item->imageUrl : "";
                $newItem['href'] = !empty($item->href) ? $item->href : "";

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
            [['duration', 'height'], 'required'],
            [['duration', 'height'], 'number', 'min' => 0],
        ];
        return array_merge($rules,parent::rules());
    }
}