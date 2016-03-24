<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace common\models;

use Yii;
use common\models\BaseApi;

/**
 * 用于实名认证的基类
 */
class RealnameBaseApi extends BaseApi
{

    public $userId; //": "string",
    public $realName; //": "string",
    public $identityType; //": "integer",证件类型 1-身份证 ,
    public $identityNumber; //": "string",
    public $email; //": "string",
    public $mobile; //": "integer",
    public $file1URL; //": "string",
    public $file2URL; //": "string",
    public $file3URL; //": "string",
    public $file1Id; //": "string",身份证照片（正面）Id ,
    public $file2Id; //": "string",身份证照片（反面）Id ,
    public $file3Id; //": "string",签名照片Id ,
    public $status; //": "integer",
    public $type; //": "integer",认证类型 1-自贸 2-直邮 
    private $_baseUri;

    public function rules()
    {
        return [
            [['realName', 'mobile', 'email', 'identityType', 'identityNumber'], 'required', 'message' => '此项为必填'],
            [['realName'], 'string', 'min' => 1, 'max' => 20],
            [['realName', 'mobile', 'email', 'identityType', 'identityNumber'], 'trim'],
            [['mobile'], '\common\validators\MobileValidator'],
            [['email'], '\common\validators\EmailValidator'],
            [['realName'], '\common\validators\RealnameValidator'],
            [['identityNumber'], '\common\validators\IdcardValidator'],
        ];
    }

    /**
     * 只有在这里的属性，才会在对应的场景中可以用
     * @return type
     */
    public function scenarios()
    {
        return [
            'index' => ['realName', 'mobile', 'email', 'identityType', 'identityNumber'],
            'create' => ['realName', 'mobile', 'email', 'identityType', 'identityNumber'],
            'update' => ['realName', 'mobile', 'email', 'identityType', 'identityNumber'],
        	'createWEBPOS' => ['realName', 'email', 'identityType', 'identityNumber'],
        		
        ];
    }

    public function attributeLabels()
    {
        return [
            'realName' => '姓名：',
            'mobile' => '手机：',
            'email' => '邮箱：',
            'identityType' => '证件：',
            'identityType.SelectedValue' => 1,
            'identityNumber' => '证件号码：',
            'type' => '',
        ];
    }

    public function __construct($userId)
    {
        parent::__construct($userId);
        //$userId = '2888760349360512009'; //from user session  
        $this->userId = $userId;
        $this->_baseUri = Yii::$app->params['sm']['realname']['baseUrl'] . $userId . '/realNameVerification';
//        $header = ['X-dbecom-OperatorId:'.$this->userId, 'X-dbecom-AppId:Web'];
//        $this->header = array_merge($header, $this->header);
    }

    public function getById($params = array())
    {
        return $this->get(['realname' => $this->_baseUri], Null, 'GET', FALSE);
    }

    public function createRealname($params = array())
    {
        return $this->create(['realname' => $this->_baseUri], $params, 'POST');
    }

    public function deleteById()
    {
        
    }

    public function updateById()
    {
        
    }

    public function getAllById()
    {
        
    }
    
    public function isNeedRealname($CartLines){
        $isCBT = false;
        $isRealname = false;
        
        foreach ($CartLines as $key => $val) {
            if(in_array($key, Yii::$app->params['sm']['store']['isCBT'])){
                $isCBT = true;
                break;
            }
        }

        $realnameInfo = $this->getById($this->userId);

        //判断用户是否需要进行实名认证
        if($isCBT){
            if($realnameInfo['realname']['status'] == 404){
                $isRealname = true;
            }
        }
        
        return ['isCBT' => $isCBT, 'isRealname' => $isRealname];
    }
}
