<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
//Todo hezll

namespace common\helpers;

use Yii;
use yii\web\Response;
use yii\web\BadRequestHttpException;
use yii\web\HttpException;
use yii\helpers\ArrayHelper;

/**
 * Url provides a set of static methods for managing URLs.
 *
 * @author Alexander Makarov <sam@rmcreative.ru>
 * @since 2.0
 */
class Tools
{
    public static function getNavMenu($platform){
        $returnArray = Array();
        $menuObj = new \backend\models\Menu();
        $menuUrlObj = new \backend\models\MenuUrl();
        $list = $menuUrlObj->getMenuUrlList();
        $menu = $menuObj->getMenuList($platform);
        
        $cmsViewList = ArrayHelper::map($list, 'menu_id', 'cms_view', 'is_default');
        $urlList = ArrayHelper::map($list, 'menu_id', 'url', 'is_default');
        foreach($menu as $obj){
            if(isset($cmsViewList[2][$obj->id])){
                if(empty($cmsViewList[2][$obj->id])){
                    $returnArray['items'][] = ['label'=> $obj->name, 'url' => $urlList[2][$obj->id]];
                }else{
                    $returnArray['items'][] = ['label'=> $obj->name, 'url' => ['act/page','view' => $cmsViewList[2][$obj->id]]];
                }
            }else{
                if(empty($cmsViewList[1][$obj->id])){
                    $returnArray['items'][] = ['label'=> $obj->name, 'url' => $urlList[1][$obj->id]];
                }else{
                    $returnArray['items'][] = ['label'=> $obj->name, 'url' => ['act/page','view' => $cmsViewList[1][$obj->id]]];
                }
            }
        }
        
        if($platform == 1){
            $returnArray['options'] = ['class' => 'nav nav-ul'];
            $returnArray['itemOptions'] = ['class' => 'pull-left'];
            $returnArray['activeCssClass'] = 'bg-color1';
        }else{
            $returnArray['options'] = ['class' => 'ui-tab-nav ui-border-b fontclass-tab','style'=>'width:100%'];
            $returnArray['itemOptions'] = [];
            $returnArray['activeCssClass'] = 'current';
        }
        return $returnArray;
    }


    public static function showDate($rules, $time)
    {
        $count = strlen($time);
        $time = substr($time, 0, ($count - 3));
        return date($rules, $time);
    }

    /**
     * 
     * 统一处理错误异常码
     * 
     * @param type $errorCode
     * @param type $errorMsg   支持string 和  array  数组当format 为 raw的时候可以较好的返回
     * @param type $format   支持html(抛异常)  raw（存flash session并 直接返回）  json    xml    or  ['12031'=>'json','11001'=>'raw','12303'=>'xml']
     * @param type $errorType
     * @param type $errorAll
     * @param type $language
     * @return type
     * @throws BadRequestHttpException
     */
    public static function error($errorCode, $errorMsg = '', $format = '', $errorType = 'Tools', $errorAll = '', $language = 'zh-CN')
    {
        //如果不加这句，那传format就没有意义，因为报错还会按YII的format执行
        if (!is_array($format) && $format)
            Yii::$app->response->format = $format;
        if (!$errorMsg)
        {
            $errorMsg = isset(Yii::$app->params['errorCode_' . $language][$errorCode]) ? Yii::$app->params['errorCode_' . $language][$errorCode] : Yii::$app->params['errorCode_' . $language]['99001'];
        }
        return self::handleException($errorCode, $errorMsg, $format, $errorAll, $errorType);
    }

    private static function handleException($errorCode, $errorMsg, $format, $errorAll, $errorType)
    {
        if (is_array($format) && ArrayHelper::keyExists($errorCode, $format, false))
        {
            $format = $format[$errorCode];
            Yii::$app->response->format = $format;
        } else
        {
            $format = !is_array($format) && $format ? $format : Yii::$app->response->format;
            Yii::$app->response->format = $format;
        }
        $errorInfo = YII_DEBUG ? $format . '|---|' . $errorCode . '|---|' . $errorMsg . '|---|' . $errorAll : $errorCode . '|---|' . $errorMsg;
       // Yii::error($errorInfo, $errorType);
        $errorMsg = $errorAll&&YII_DEBUG?$errorAll.$errorMsg:$errorMsg;
        if ($format == Response::FORMAT_RAW)
        {
            return ['errorCode' => $errorCode, 'errorMsg' => $errorMsg];
        } else if ($format == Response::FORMAT_JSON)
        {
            throw new HttpException(200, $errorMsg, $errorCode);
        } else
            throw new BadRequestHttpException($errorMsg, $errorCode);
    }

    public static function checkRepeatSubmit($allowRepeat = false)
    {
        $method = Yii::$app->getRequest()->getMethod();
        $route = Yii::$app->controller->getRoute();
        $format = Yii::$app->response->format;
        if ($method == 'POST' && $allowRepeat === FALSE)
        {
            $session = Yii::$app->session;
            $session->open();
            $token = Yii::$app->request->post('_csrf');
            if ($session['code'] == $token)
            {
                self::error('99006', '', $format);
            } else
            {
                $session['code'] = $token;
            }

            return true;
        } else if ($method == 'POST' && $allowRepeat)
        {
            $session = Yii::$app->session;
            $session->open();
            $time = microtime(true);
            if (isset($session[$route]) === TRUE)
            {
                $subtraction = $time - $session[$route];
                if ($subtraction * 1000 >= 500)
                {
                    unset($session[$route]);
                    return true;
                } else
                {
                    self::error('99006', '', $format);
                }
            } else
            {
                $session[$route] = $time;
            }

            return true;
        } else
        {
            return true;
        }
    }

    public static function getColumn($array)
    {
        $mergeArray = Array();
        foreach ($array as $key => $val)
        {
            $mergeArray = array_merge($mergeArray, $val);
        }
        return $mergeArray;
    }

    public static function qnImg($name = 'gogopher.jpg', $width = 200, $height = 200)
    {
        return Yii::$app->params['qn']['baseimgUrl'] . "$name?imageView2/1/w/$width/h/$height";
    }

    public static function substr_mb($str, $maxLength = 30)
    {
        $encoding = Yii::$app->charset;
        $length = mb_strlen($str, $encoding);
        if ($length > $maxLength)
        {
            return mb_substr($str, 0, $maxLength, $encoding) . '...';
        } else
        {
            return $str;
        }
    }
    public static function getSalesType($str)
    {
        if($str)
        {
            return substr($str, 0, 1);
        }
        else {
            return null;
        }
    }

}
