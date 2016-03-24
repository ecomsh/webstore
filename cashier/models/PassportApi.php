<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace cashier\models;

use Yii;
use common\models\BaseApi;
use common\helpers\Tools;
use cashier\models\UserAPIDataProvider;

/**
 * 用于请求其他数据的基类
 */
class PassportApi extends BaseApi
{
    private $_baseUri;
    
    public function __construct($userid = '')
    {
    	parent::__construct($userid);
    	$this->_baseUri = Yii::$app->params['passport']['baseUrl'];
    }
    
    public function logon($params) {
    	if ($params['username'] && $params['password'])
    	{//&& $params['verifyCode'] && $params['verifyCodeStub'] 这俩参数可选
    	$tmp_url = $this->_baseUri . 'logon';
    	return $this->create(['identity' => $tmp_url], $params);
    	} else
    	{
    		$msg = YII_DEBUG ? '----|input param is' . json_encode($params) . '|----' : '';
    		return Tools::error('99008', 'logon input param error' . $msg);
    	}
    }
    
        public function getUsersbyRegChannel($channelId, $params, $pagesize = 20){
        $tmp_url = $this->_baseUri . 'users';
        $provider = new UserAPIDataProvider([
            'url' => $tmp_url,
            'key' => 'userId',
            'pageKey' => 'pageInfo',
            'header' => $this->header, 
            'dataKey' => 'result',
            'pagination' => [
                'pageSize' => $pagesize,
            ],
            'params' => $params,
        ]);
        return $provider;
    }
    
}
