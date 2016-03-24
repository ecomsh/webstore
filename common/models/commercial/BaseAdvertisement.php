<?php

namespace common\models\commercial;

use Yii;
use yii\base\Model;
use common\models\BaseApi;
use yii\web\HttpException;
use common\helpers\Tools;

/**
 * 广告位数据基类型
 */
class BaseAdvertisement extends Model
{

    //curl操作类
    private $_curd;
    //视图名
    protected $view;
    //模版名
    protected $tpl;
    //广告类型
    public $type;
    //item的类型
    public $itemClass;
    //广告开始时间
    public $startTime;
    //广告结束时间
    public $endTime;
    //缓存时间，0为取消
    public $cache;
    //缓存开始时间
    public $cacheTime;
    //项目
    protected $items;

    /**
     * 构造函数
     * @override
     */
    public function __construct()
    {
        $this->_curd = new BaseApi;
    }

    /**
     * 验证规则
     * @override
     */
    public function rules()
    {
        return [
            [['cache', 'startTime', 'endTime',], 'required'],
            ['cache', 'number', 'min' => 0],
                //[['startTime', 'endTime'], 'date', 'format' => 'Y-m-d H:i:s'],
        ];
    }

    /**
     * 载入广告信息
     * 优先使用缓存
     * @param $id 广告id
     * @return 无
     */
    public function fetch($id, $useCache = true)
    {
        $cacheKey = $this->generateCacheKey($id);

        //获取额外请求信息
        $request = Yii::$app->request;
        $adId = $request->get('adId');
        $contentId = $request->get('contentId');
        $previewToken = $request->get('previewToken');

        $usedCache = false;
        $cache = Yii::$app->cache;
        $data = [];

        if($request->get('cache', 1) == 0){
          $cache->delete($cacheKey);
        }else{
          //尝试从缓存读取数据         
          $cacheData = $cache->get($cacheKey);
          
          if ($adId != $id  
            && $this->load($cacheData) 
            && $this->validate())
          {
              Yii::info($id.'缓存命中！');
              Yii::info($cacheData);
              $data = $cacheData;
              $usedCache = true;
          }
        }
        //如果缓存失效，则从后端读取数据
        if (!$useCache || !$usedCache )
        {
            Yii::info($id.'缓存失效！');
            $url = Yii::$app->params['advertisement']['baseUrl'] . '/' . $id . '/_currentContentPrice';

            //传送额外信息
            if ($adId == $id)
            {
                $url = $url . '?contentId=' . $contentId . '&previewToken=' . $previewToken;
            }
            try
            {
                $data = $this->_curd->get($url);
                Yii::info($id);
                Yii::info($data);

                $data = $data[key($data)];
                
                $data = $this->analyData($data);
                

            } catch (\yii\base\Exception $e)
            {
                Yii::error($e);
                $data = [];
            }
            

            //使用假数据
            //$data = $this->fakeData;
            if (
                    $this->load($data) &&
                    $this->validate()
            ){
                if ($data['cache'] > 0 && $request->get('cache', 1) != 0)
                {
                    //存入缓存
                    $cache->set($cacheKey, $data, $data['cache']);
                }
            } else
            {
                Yii::error($this->getView() . "\n" . $id . "\n" . var_export($this->getErrors(), true));
                //throw new HttpException(500,var_export($this->getErrors(),true));
                //信息无效 错误处理…
            }
        }

        return $data;
    }

    /**
     * 解析获取到的数据
     * @param $data 原始数据 
     * @return object 转换后的结果
     */
    protected function analyData($data)
    {
        $newData = array();

        $newData['startTime'] = !empty($data['startTime']) ? $data['startTime'] : time() - 86400;
        $newData['endTime'] = !empty($data['endTime']) ? $data['endTime'] : time() + 86400;
        $newData['cache'] = !empty($data['cache']) ? $data['cache'] : "3600";
        $newData['items'] = array();
        return $newData;
    }

    /**
     * 根据id生成缓存key
     * @param $id 广告id
     * @return string 缓存key
     */
    private function generateCacheKey($id)
    {
        return static::className() . '_advertisement_' . $id;
    }

    /**
     * 获取视图名
     * @return string 视图名
     */
    public function getView()
    {

        if (!empty($this->tpl))
        {
            $viewName = $this->view . '-' . $this->tpl;
        } else
        {
            $viewName = $this->view;
        }
        return $viewName;
    }

    /**
     * 数据验证
     * @return boolean 视图名
     * @override
     */
    public function validate($attributeNames = null, $clearErrors = true)
    {
        $result = parent::validate($attributeNames, $clearErrors);

        //验证$items的子项
        if ($result)
        {
            foreach ($this->items as $item)
            {
                $result = $item->validate();
                if (!$result)
                {
                    $this->addErrors($item->getErrors());
                    break;
                }
            }
        }

        return $result;
    }

    /**
     * 获取items列表
     * @return array items列表
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * 载入数据
     * @override
     */
    public function load($data, $formName = '')
    {
        if (isset($data['items']))
        {
            $items = $data['items'];
            $this->items = array();
            foreach ($items as $item)
            {
                $instance = new $this->itemClass;
                $instance->load($item, '');
                $this->items[] = $instance;
            }
            unset($data['items']);
        }

        return parent::load($data, $formName);
    }

    public function setTpl($tpl)
    {
        $this->tpl = $tpl;
    }

    /*
      //version 2
      //*需要子类实现
      //
      //返回 属性定义数组
      //  {
      //   "type":
      //          {
      //          "prop":"type",
      //          "propName":"类型",
      //          "value":"",
      //          "":"",
      //          },
      //   "title":
      //          {
      //          "prop":"title",
      //          "proName":"广告位标题",
      //          "type":"text",
      //          "value":"",
      //          "required":true,
      //          "default":"",
      //          },
      //   "tag":{
      //          "prop":"tag",
      //          "proName":"标签",
      //          "type":"selector",
      //          "value":"",
      //          "options":{"国庆大促":"guoqingdacu",
      //                     "最后7天":"zuohou7tian",
      //                      }
      //          }
      //  }

      //abstract public function propTags();


      //version 2
      //*需要子类实现
      //
      //返回 展示商品定义数组
      //  [
      //   "common\models\commerical\ItemA",
      //   "common\models\commerical\ItemB",
      //  ]
      //abstract public function itemsClasses();




      //may be enabled in version 2.0
      //获取配置信息
      public function getConfig(){

      //检查静态类是否存在
      $this->checkIntegrity();
      $config = $this->propToConfig();

      return $config;

      }


      public function checkIntegrity(){
      $class = new ReflectionClass($this);
      $names=[];
      foreach ($class->getProperties(\ReflectionProperty::IS_STATIC) as $property) {
      if ($property->isPrivate()) {
      $names[] = $property->getName();
      }
      }

      if(!in_array('type',$names)){
      throw new Exception('Child Class should provide private static string type variable');
      }

      if(!in_array('view',$names)){
      throw new Exception('Child Class should provide private static string view variable');
      }

      }


      //may be enabled in version 2.0
      public function propToConfig() {
      $class = new ReflectionClass($this);

      $config = [];
      $propTags = $this->propTags();

      foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
      if (!$property->isStatic()) {
      $name = $property->getName();
      if(isset($propTags[$name])){
      $config[] = $propTags[$name];
      }else{
      $default = [];
      $default['prop'] = $name;
      $default['propName'] = $name;
      $default['type'] = 'text';
      $default['required'] = false;
      $default['value'] = '';
      $config[] = $default;
      }

      }
      }

      $config['items']=[];

      foreach($this->itemsClasses() as $class){
      $instance = new $class;
      $config['items'][] = $instance->getConfig();
      }

      return $config;
      }
     */
}
