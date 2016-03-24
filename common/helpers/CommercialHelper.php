<?php

namespace common\helpers;

use frontend\widgets\commercial\CommercialWidget;
use yii\base\InvalidParamException;

//职责
//
//1.定位到tag
//2.处理tag，截取到class, id, device
//3.将tag替换成php Widget代码
//
//tag example :  <@pc.\frontend\models\commercial\CarouselAdvertisement.12@>
//
class CommercialHelper
{

    public static $typeList = [
        'pc' => '\frontend\models\commercial\\',
        'mobile' => '\frontend\models\commercial\\',
        'common' => '\common\models\commercial\\',
        'api' => 'api\\modules\\v1\\models\\commercial\\',
    ];

    public static function parse($content)
    {
        $content = preg_replace_callback('/<@([^\.]*)\.([^\.]*)\.([^\.]*)(?:\.([^\.]*))?@>/i', function($matches)
        {
            try {
                $type = $matches[1];
                $adClass = $matches[2];
                $adId = $matches[3];
                $tpl = !empty($matches[4]) ? $matches[4] : null;
                if (!empty($adClass))
                {
                    $adClass = self::getAds($adClass, $type);
                    $seg = CommercialWidget::widget(['adClass' => $adClass, 'adId' => $adId, 'tpl' => $tpl,]);
                    return $seg;
                }
            } catch (Exception $e) {
                Yii::error($e);;  
            }
        }, $content);
        return $content;
    }

    public static function getAds($adClass, $type = 'common')
    {
        if (!in_array($type, array_keys(self::$typeList)))
        {
            $type = 'common'; //默认pc
        }

        $tmp = self::$typeList[$type] . ucwords($adClass).'Advertisement';
        if (!class_exists($tmp))
        {
            $type = 'common';
            $tmp = self::$typeList[$type]. ucwords($adClass).'Advertisement';
            if (!class_exists($tmp))
            {
                throw new InvalidParamException('can not find proper'.$tmp.' ads widgets class,please check it!');
            }
        }


        return $tmp;
    }

}
