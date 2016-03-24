<?php

namespace common\pay\wxpay\lib;

use Yii;
use yii\helpers\Url;
use common\helpers\Tools;
use yii\base\InvalidConfigException;



/**
 * 
 * 接口调用结果类
 * @author widyhu
 *
 */
class WxPayResults extends WxPayDataBase
{
    public function __construct($salesType)
    {
        parent::__construct($salesType);
    }
    /**
     * 
     * 检测签名
     */
    public function CheckSign()
    {
        //fix异常
        if (!$this->IsSignSet())
        {
            throw new InvalidConfigException("签名错误！");
        }

        $sign = $this->MakeSign();
        if ($this->GetSign() == $sign)
        {
            return true;
        }
        throw new InvalidConfigException("签名错误！");
    }

    /**
     * 
     * 使用数组初始化
     * @param array $array
     */
    public function FromArray($array)
    {
        $this->values = $array;
    }

    /**
     * 
     * 使用数组初始化对象
     * @param array $array
     * @param 是否检测签名 $noCheckSign
     */
    public static function InitFromArray($array, $noCheckSign = false)
    {
        $obj = new self();
        $obj->FromArray($array);
        if ($noCheckSign == false)
        {
            $obj->CheckSign();
        }
        return $obj;
    }

    /**
     * 
     * 设置参数
     * @param string $key
     * @param string $value
     */
    public function SetData($key, $value)
    {
        $this->values[$key] = $value;
    }

    /**
     * 将xml转为array
     * @param string $xml
     * @throws InvalidConfigException
     */
    public  function Init($xml)
    {
        $obj = new self($this->_salesType);
        $obj->FromXml($xml);
        //fix bug 2015-06-29
        if ($obj->values['return_code'] != 'SUCCESS')
        {
            return $obj->GetValues();
        }
        $obj->CheckSign();
        return $obj->GetValues();
    }

}
