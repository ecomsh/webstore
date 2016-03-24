<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace frontend\models;

use Yii;
use common\models\BaseApi;
use common\helpers\Tools;

/**
 * 用于请求其他数据的基类
 */
class PassportApi extends BaseApi
{
     private $_operatorId;
     private $_baseUri;

    public function __construct($userid = '')
    {
        parent::__construct($userid);
        $this->_baseUri = Yii::$app->params['sm']['passport']['appBaseUrl'];
        $this->_operatorId = $userid? $userid: 'anonymousUser';
//        $header = ['X-dbecom-OperatorId:'.$this->_operatorId, 'X-dbecom-AppId:Mobile'];
//        $this->header = array_merge($header, $this->header);
    }

    
    /**
     * {passport:
     * {"userId":127,"username":"xxxx","password":null,"email":null,
     * "mobile":"xxxx138","mobileVerified":false,"emailVerifiend":false,
     * "orgId":"member","orgType":"member","roles":[],"status":"normal"}
     * }
     * 
     * @param unknown $userId
     * @return \common\models\type|\common\helpers\type
     */
    public function getPassportByUserId($userId){
    
    	if ($userId){
    		$tmp_url = $this->_baseUri . $userId;
    		return $this->get(['passport' => $tmp_url], [], 'GET');
    	}
    	else{
    		$msg = YII_DEBUG? '----|input param is' . json_encode($userId) . '|----' : '';
    		return Tools::error('99008', 'checkIdentity input param error' . $msg);
    	}
    }
   
    
}
