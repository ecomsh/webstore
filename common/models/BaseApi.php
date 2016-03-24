<?php

/**
 * 用curl方式获取数据 以及支持原始的 socket
 * 在get数据的时候，可以考虑使用multiFetch的方式
 * 而post的时候可以考虑使用curl
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace common\models;

use Yii;
use yii\base\Model;
use common\models\Curl;
use yii\web\BadRequestHttpException;
use yii\helpers\Url;
use common\helpers\Tools;

//use yxdj\network\Api;

/**
 * 用于请求其他数据的基类
 */
class BaseApi extends Model
{

    public $url;
    public $returnRaw = false;
    public $debug = YII_DEBUG;
    public $language;
    public $format;
    public $operatorId;
    private $_curl;
    public $header = [];

    public function __construct($operatorId = '')
    {
        parent::__construct();
        $this->language = \Yii::$app->language;
        $this->_curl = Curl::getInstance();
        $this->format = Yii::$app->response->format;
        $this->operatorId = $operatorId;
        $this->header = $this->setApiHeader();
    }

    public function setApiHeader()
    {
        $traceId = Yii::$app->security->generateRandomString();
        $currentPage = YII_ENV_TEST ? 'test' : Url::current();
        $appId = Yii::$app->params['AppId'] . '-' . $currentPage;
        $header = ['Content-Type:application/json', 'X-dbecom-TraceId:' . $traceId, 'X-dbecom-OperatorId:' . $this->operatorId, 'X-dbecom-AppId:' . $appId];
        return $header;
    }

    public function create($url, $params)
    {
        $this->_curl->header = $this->header;
        $rs = $this->_curl->fetch($url, $params, 'POST');

        return $this->_r($rs);
    }

    public function delete($url)
    {
        $this->_curl->header = $this->header;
        $rs = $this->_curl->fetch($url, $params = null, 'DELETE');
        return $this->_r($rs);
    }

    public function update($url, $params)
    {
        $this->_curl->header = $this->header;
        $rs = $this->_curl->fetch($url, $params, 'PUT');
        return $this->_r($rs);
    }

    private function _generateCacheKey($url = '', $params = null)
    {
        $isMultiFetch = is_array($url) && count($url) > 1;
        if ($isMultiFetch)
        {
            $i = 0;
            $key = '';
            foreach ($url as $k => $v)
            {
                $key = $key . $v;
                if (isset($params[$i]))
                {
                    $key = $key . implode($params[$i], '-');
                }
                $i++;
            }
        } else
        {
            $key = is_array($url) ? $url[key($url)] : $url;
            if (isset($params))
            {
                $key = $key . implode($params, '-');
            }
        }
        return $key;
    }

    /**
     * 该方法是调用API的入口方法，自动判断是否调用并发，（并发只支持GET方法），默认对结果缓存
     * $url 可以是单独的一个URL，返回结果以该URL做key
     *      也可以是数组，指定[key=>URL],返回结果以指定的key做key
     *      [url1,url2,...]，此时会调用并发的curl，结果以分别url做key
     *      ['a'=>url1,'b'=>url2,...]，此时会调用并发的curl，结果以分别指定的key做key
     * params 可以为空， 若不空以数组形式传递['s'=>1,'h'=>2]
     *        并发调用时，样例：[['s'=>1],['h'=>2]]
     * @param string/array 
     * @param type $params
     * @param type $method
     * @param type $cache
     * @return type
     */
    public function get($url = '', $params = null, $method = 'GET', $cache = false, $refresh = false)
    {
        $this->_curl->header = $this->header;
        $url = $url ? $url : $this->url;
        if (!$url)
        {
            return $this->callErrorProcess(99004);
        }
        $isMultiFetch = is_array($url) && count($url) > 1;
        if ($cache)
        {
            $cache = Yii::$app->cache;
            $key = $this->_generateCacheKey($url, $params);
        }
        if ($cache && !$refresh)
        {
            $data = $cache->get($key);
        }

        if (isset($data) && $data !== false && !$refresh)
        {
            return $data;
        }
        if ($isMultiFetch)
        { //传入的是数组，且不止一个元素
            $rs = $this->_curl->multiFetch($url, $params);
        } else
        {
            $rs = $this->_curl->fetch($url, $params, $method);
        }
        $result = $this->_r($rs);
        if ($cache || $refresh)
        {
            $cache->set($key, $result, 600);
        }
        return $result;
    }

    /**
     * 统一处理结构，判断结果是否正确返回，且被解析。
     * 
     * 注意，如果是暴露给用户的error，一要在config文件夹下的params.php配置异常信息code对应关系
     * 
     * todo hezll
     */
    public function callErrorProcess($errorCode = '99001', $errorMsg = '', $errorAll = '')
    {

        $errorAll = YII_DEBUG ? '|--debug header:--|' . json_encode($this->header) . '|--error msg:--|' . $errorAll : $errorAll;
        return Tools::error($errorCode, $errorMsg, $this->format, 'BaseApi', $errorAll);
    }

    /**
     * 处理结果，同时判断是否异常
     */
    private function _r($d)
    {
        $f = '_';
        if ($this->returnRaw)
        {
            return [$d];
        }

        if (!$d | !is_array($d))
        {
            $errorCode = '99002';
            $errorMsgAll = YII_DEBUG ? $errorMsg . json_encode($d) : '';
            return $this->callErrorProcess($errorCode, '', $f . $errorMsgAll);
        }
        $data = [];
        foreach ($d as $k => $v)
        {
            if (!isset($v['response']))
            {
                $errorCode = '99005';
                $errorMsgAll = YII_DEBUG ? $errorMsg . json_encode($v) : '';
                return $this->callErrorProcess($errorCode, '', $f . $errorMsgAll);
            }

            //$v['results'] = '{"status":false,"errCode":"01500""errMessage":"内部服务异常111。"}';
            $rs = json_decode($v['response'], true, 512, JSON_BIGINT_AS_STRING);

            //$v['http_code']=400;
            if ($v['http_code'] == 200)
            {

                if ($rs !== false || $rs !== null)
                {
                    $data[$k] = $rs;
                } else if ($rs === null)
                {
                    $errorMsg = YII_DEBUG ? json_encode($rs) : '';
                    return $this->callErrorProcess('99003', $errorMsg);
                }
            } else
            {

                $errorCode = isset($rs['errCode']) ? $rs['errCode'] : $v['http_code'];
                $errorMsg = isset($rs['errMessage']) ? $rs['errMessage'] : NULL;



                if (!$errorMsg && isset($rs['errors'][0]['ErrorDescription']))
                {
                    $errorMsg = $rs['errors'][0]['ErrorDescription'];
                }

                if ($rs)
                {
                    $errorMsgAll = YII_DEBUG ? $errorMsg . json_encode($v) : '';
                    return $this->callErrorProcess($errorCode, $errorMsg, $f . $errorMsgAll);
                } else
                {
                    $errorMsgAll = YII_DEBUG ? $errorMsg . json_encode($v) : '';
                    return $this->callErrorProcess($v['http_code'], '系统无响应:' . $errorMsgAll);
                }
            }
        }
        // $this->loadMultiple($this,$data);
        return $data;
    }

    public function setErrors($format = "", $isShowKey = true)
    {
        $format = $format ? $format : Yii::$app->response->format;
        $e = $this->getErrors();
        $msg = '';
        if ($e & is_array($e))
        {
            foreach ($e as $k => $v)
            {
                if (is_array($v))
                {
                    foreach ($v as $sv)
                    {
                        //有时会出现 “手机：手机：必须是整数” 这种提示，所以先判断一下，message是不是以attributeLabel开头的
                        if (strpos($sv, $this->getAttributeLabel($k)) === 0)
                        {
                            $msg .= $sv . '</br>';
                        } else
                        {
                            if($isShowKey){
                                $msg .= $this->getAttributeLabel($k) . "" . $sv . '</br>';
                            }else{
                                $msg .= $sv . '</br>';
                            }
                        }
                    }
                } else
                {
                    if($isShowKey){
                        $msg .= $this->getAttributeLabel($k) . "" . $v . '</br>';
                    }else{
                        $msg .= $v . '</br>';
                    }
                }
            }
            $d = Tools::error('99041', $msg, $format);
            return $d;
        }
    }

}
