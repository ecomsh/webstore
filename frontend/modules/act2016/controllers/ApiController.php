<?php

namespace frontend\modules\act2016\controllers;

use Yii;
use yii\web\Controller;

class ApiController extends Controller
{
	private $_secret = 'aaa';
	private $_timeout = 1000;
	private $_error = array(
						'0'=>array('code'=>'0','msg'=>'接口调用失败'),
						'1'=>array('code'=>'1','msg'=>'接口调用成功'),
						'-1'=>array('code'=>'-1','msg'=>'请求参数错误'),
						'-2'=>array('code'=>'-2','msg'=>'访问超时'),
						'-3'=>array('code'=>'-3','msg'=>'签名校验错误'),
						);
	
    public function actionIndex()
    {
    	/*
    	userId:8784
    	orderId:8867995153256252300
    			2015110909261248
    			2015110300555749
    	 */
    	$params = $_REQUEST;
    	$validateResult = $this->paramsValidate($params);
    	if ( $validateResult !== true )
    	{
    		//var_dump(json_decode($validateResult,true));die;
    		return $validateResult;
    	}
    	
    	try 
    	{
	    	$data = json_decode($params['data'],true);
	    	$result = $this->_error[1];
	    	$result['data'] = $this->$params['method']($data);
    	}
    	catch (Exception $e)
    	{
    		$result['result'] = $this->_error[0];
    	}
    	//print_r($result);die;
    	return json_encode($result);
    }
    
    /**
     * 参数验证
     * @param unknown_type $params
     * @return string|boolean
     */
    private function paramsValidate($params)
    {
    	if ( !$params['sign'] || !$params['timestamp'] || !$params['method'] )
    	{
    		return json_encode($this->_error[-1]);
    	}
    	
    	if ( $this->timeoutValidate($params['timestamp']) === false )
    	{
    		return json_encode($this->_error[-2]);
    	}
    	
    	if ( $this->signValidate($params) === false )
    	{
    		//return json_encode($this->_error[-3]);
    	}
    	
    	return true;
    }
    
    /**
     * 超时验证
     * @param unknown_type $timestamp
     * @return boolean
     */
    private function timeoutValidate($timestamp)
    {
    	$currentTimestamp = date('YmdHis',time());
    	if ( $currentTimestamp - $timestamp > $this->_timeout )
    	{
    		return false;
    	}
    	return true;
    }
    
    /**
     * 签名验证
     * @param unknown_type $params
     * @return boolean
     */
    private function signValidate($params)
    {
    	$sign = $params['sign'];
    	unset($params['sign']);
    	
    	$signTmp = $this->getSignature($params);
    	if ( $sign != $signTmp )
    	{
    		return false;
    	}
    	return true;
    }
    
    /**
     * 获取签名
     * @param unknown_type $params
     * @return string
     */
    private function getSignature($params)
    {
    	$str = '';
    	ksort($params);
    	foreach ($params as $k => $v) 
    	{
    		$str .= "$k=$v";
    	}
    	
    	$str .= $this->_secret;
    	return md5($str);
    }
    
    /*------------------------------------API接口调用-------------------------------------------*/
    
    /**
     * 载入广告信息
     * @param unknown_type $data
     * @return string|\common\models\commercial\无
     */
    private function advertisement_fetch($data)
    {
    	$id = isset($data['id']) ? $data['id'] : '';
    	$useCache = isset($data['useCache']) ? $data['useCache'] : false;
    	if ( !$id ) return json_encode($this->_error[-1]);
    	
    	$advertisementApi = new \frontend\models\commercial\GlobalSelectionAdvertisement;
    	return $advertisementApi->fetch($id,$useCache);
    }
    
    /**
     * 地址获取接口
     * @param unknown_type $data
     * @return string|\common\helpers\type
     */
    private function address_getList($data)
    {
    	$params = isset($data['params']) ? $data['params'] : array();
    	$userId = isset($data['userId']) ? $data['userId'] : '';
    	if ( !$userId ) return json_encode($this->_error[-1]);
    	 
    	$addressApi = new \frontend\models\AddressApi;
    	return $addressApi->getList( $params , $userId );
    }
}
