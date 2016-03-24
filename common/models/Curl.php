<?php

/**
 * This is the base curl class
 */

namespace common\models;

use Yii;
use yii\web\BadRequestHttpException;

/**
 * Curl Class for curl rest apis
 * Normally you should new a Curl entity and call function
 * exapmle:
 *        $this->_curl = Curl::getInstance();
 *        $data = $this->get();
 * 
 * 
 * 
 * @author Henry <hezonglin@cn.ibm.com>
 * @copyright (c) 2015, IBM CDL Commerce
 * 
 * 
 */
class Curl
{

    /**
     * put method
     */
    const METHOD_PUT = 'PUT';

    /**
     * delete method
     */
    const METHOD_DELETE = 'DELETE';

    /**
     * post method
     */
    const METHOD_POST = 'POST';

    /**
     * get method
     */
    const METHOD_GET = 'GET';

    /**
     * set the header text
     * @var string
     */
    public $header = [];

    /**
     * set to debug model
     * @var boolen
     */
    public $debug = YII_DEBUG;
    public $debugInfo;

    /**
     * set the longest waiting time of curl
     * @var int
     */
    public $timeout = 15;

    /**
     * set the waiting time before connect to the server
     * @var int
     */
    public $connectTimeout = 15;

    /**
     * set the default language
     * @var string
     */
    public $lan;
    public $gzip = true;
    private static $_instance;

    public function __construct()
    {
        
    }

    //创建__clone方法防止对象被复制克隆
    public function __clone()
    {
        trigger_error('Clone is not allow!', E_USER_ERROR);
    }

    public static function getInstance()
    {
        if (self::$_instance === null)
        {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * 
     * @param array $urls [key1=>url1,key2=>url2,key3=>url3]
     * @param array $params [$params1,$params2,$params3]   
     * @param type $method  get only
     * @return array
     */
    public function multiFetch($urls = array(), $params = [[]], $method = self::METHOD_GET)
    {


        $json = json_encode(['header' => $this->header, 'url' => $urls, 'params' => $params, 'method' => $method]);
        Yii::beginProfile('multi fetch profile:' . $json);



        $queue = curl_multi_init();
        $map = array();
        $this->method = $method;
        $i = 0;
        foreach ($urls as $key => $url)
        {
            $this->method = strtoupper($method);
            if (isset($params[$i]))
            {
                $url = $this->_setParams($url, $params[$i], $method);
            }
            $this->pathKey = is_string($key) ? $key : $url;
            $ch = curl_init($url);
            $options = $this->_setOptions();
            curl_setopt_array($ch, $options);
            curl_multi_add_handle($queue, $ch);
            $map[(string) $ch] = $this->pathKey;
            $i++;
        }
        $rs = array();
        $active = null;
        do
        {
            while (($code = curl_multi_exec($queue, $active)) == CURLM_CALL_MULTI_PERFORM);
            // a request was just completed -- find out which one
            while ($code == CURLM_OK && $done = curl_multi_info_read($queue))
            {
                // get the info and content returned on the request
                $info = curl_getinfo($done['handle']);
                $error = curl_error($done['handle']);
                $response = curl_multi_getcontent($done['handle']);
                $rs[$map[(string) $done['handle']]] = compact('error', 'response');
                $rs[$map[(string) $done['handle']]]['http_code'] = $info['http_code'];
                if ($this->debug)
                {
                    $rs[$map[(string) $done['handle']]]['info'] = $info;
                    $rs[$map[(string) $done['handle']]]['curl_info'] = $error;
                    //unset($rs[$map[(string) $done['handle']]]['error']);
                } else
                {
                    $this->debugInfo = $rs;
                }
                // remove the curl handle that just completed
                curl_multi_remove_handle($queue, $done['handle']);
                curl_close($done['handle']);
            }

            // Block for data in / output; error handling is done by curl_multi_exec
            if ($active > 0)
            {
                curl_multi_select($queue, $this->connectTimeout);
            }
        } while ($active);
        curl_multi_close($queue);


        Yii::endProfile('multi fetch profile:' . $json);

        return $rs;
    }

    public function fetch($url, $params = [], $method = self::METHOD_GET)
    {
        
        $json = json_encode(['header' => $this->header, 'url' => $url, 'time' => microtime(),'params' => $params, 'method' => $method]);
//        if (YII_DEBUG)
//        {
//            Yii::info('curl header is' . $json);
//        }
        
            
        Yii::beginProfile('single fetch profile:' . $json);
        $starttime = explode(' ',microtime()); 
        if (is_array($url))
        {
            $key = key($url);
            $this->pathKey = is_string($key) ? $key : $url[$key];
            $url = $url[$key];
        } else
        {
            $this->pathKey = $url ? $url : '';
        }
        $this->method = strtoupper($method);
        if (isset($params))
        {
            $url = $this->_setParams($url, $params, $method);
        }
        $this->_dataString = $params ? json_encode($params) : '';
        $options = $this->_setOptions();
        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        $error = curl_error($ch);
        $info = curl_getinfo($ch);

        $rs = array();

        $rs[$this->pathKey] = compact('error', 'response');
        $rs[$this->pathKey]['http_code'] = $info['http_code'];

        if ($this->debug)
        {
            $rs[$this->pathKey]['info'] = $info;
            $rs[$this->pathKey]['curl_error'] = $error;
        }
        curl_close($ch);
//        if (YII_DEBUG)
//        {
//            Yii::info($rs, 'Curl');
//        }
        $endtime = explode(' ',microtime());
        $thistime = round($endtime[0]+$endtime[1]-($starttime[0]+$starttime[1]),6);
       
        Yii::info('cost_time:    '.$thistime);
        
        //$json = json_encode(['header' => $this->header, 'url' => $url, 'cost_time' => $thistime,'params' => $params, 'method' => $method]);
        
        
        Yii::endProfile('single fetch profile:' . $json);
       
        return $rs;
    }

    private function _setParams($url, $params, $method)
    {
        $query = $this->_buildQuery($params);
        if ($method === self::METHOD_GET && $query)
        {
            $url .= preg_match('/\?/i', $url) ? '&' . $query : '?' . $query;
        }
        return $url;
    }

    private function _setOptions()
    {
        $options = [
            CURLOPT_HTTP_VERSION => 'CURL_HTTP_VERSION_1_1',
            CURLOPT_HTTPHEADER => $this->header,
            CURLOPT_CONNECTTIMEOUT => $this->connectTimeout,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_CUSTOMREQUEST => $this->method,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
                // CURLOPT_USERAGENT => "",
        ];
        if ($this->method == self::METHOD_POST || $this->method == self::METHOD_PUT)
        {
            $options[CURLOPT_POSTFIELDS] = $this->_dataString;
            $options[CURLOPT_HTTPHEADER] = array_merge($this->header, ['Content-Type: application/json',
                'Content-Length: ' . strlen($this->_dataString)]);
        }
        if ($this->gzip)
        {
            $options[CURLOPT_ENCODING] = 'gzip';
        }
        return $options;
    }

    /**
     * 把数组生成http请求需要的参数。
     * @param array $params
     * @return string
     */
    private function _buildQuery($params)
    {
        $args = http_build_query($params);
        // remove the php special encoding of parameters
        // see http://www.php.net/manual/en/function.http-build-query.php#78603
        //return preg_replace('/%5B(?:[0-9]|[1-9][0-9]+)%5D=/', '=', $args);
        return $args;
    }

}
