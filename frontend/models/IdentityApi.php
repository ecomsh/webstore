<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace frontend\models;

use common\models\IdentityBaseApi;

/**
 * 用于请求其他数据的基类
 */
class IdentityApi extends IdentityBaseApi
{
	
// 	private $_baseUri;
	
    public function __construct($userid = '')
    {
        parent::__construct($userid);
        
    }
    

    public function registerUser($params)
    {
    	if ($params['mobile'] && $params['password'] && $params['smsCode'] && $params['smsCodeStub']){
    		//这里需要调用passport 的API
    		//原因输出结果和默认的registerUser 多出了firstlogincode
//     		var_dump();
    		$tmp_url = $this->_baseUri . 'register/logon';
    
    		return $this->create(['identity' => $tmp_url], $params);
    	}
    	else{
    		$msg = YII_DEBUG? '----|input param is' . json_encode($params) . '|----' : '';
    		return Tools::error('99008', 'registerUser input param error' . $msg);
    	}
    }
    
    
}
