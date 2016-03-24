<?php


namespace common\models\commercial;

use Yii;
use yii\base\Model;

use ReflectionClass;

//代表广告位上的一个区域
abstract class BaseItem extends Model{











    //may be enabled in version 2.0
    public function propToConfig()
    {
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
        return $config;
    }






    //may be enabled in version 2.0
    public function getConfig(){

        $config = $this->propToConfig();
        return $config;

    }

    //
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

}