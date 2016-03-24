<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace frontend\models;

use common\models\BaseApi;
use yii\captcha\Captcha;
/**
 * 用于实名认证的基类
 */
class LogintestApi extends BaseApi
{
    /**
     * 只有在这里的属性，才会在对应的场景中可以用
     * @return type
     */
    
    public $mobile_id;
    public $smscode;
    public $password;
    public $confirmPassword;
    public $sex;
    public $verifycode;
    public $auto_login;
   
    public function rules() 
    {         
        return 
        [
            ['verifycode', 'captcha']                        
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'mobile_id' => '',
            'smscode' => '',
            'password' => '',
            'confirmPassword' => '',            
            'sex' => '',
            'verifycode' => '',
            'auto_login' => '',
        ];
    }   
  
}
