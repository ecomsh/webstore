<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace common\models;

use Yii;
use common\models\BaseApi;
use common\helpers\Tools;

/**
 * 用于请求用户信息的基类
 */
class IdentityBaseApi extends BaseApi
{

    protected  $_baseUri;

    public function __construct($userid = '')
    {
        parent::__construct($userid);
        $this->_baseUri = Yii::$app->params['sm']['identity']['baseUrl'];
    }

    /**
     * 查询用户是否存在，并返回userid
     * @input params:
     * $params = [
     *  "type" => "xxx",//Identity type, Value can be
     *             'mobile',
     *             'email', 
     *             'username',
     *             'wx001', //wechat openid?
     *  "identity" => "xxx",  //Identity value
     * ]
     * 
     * @return:
     * {
     * 'identity':
     * {
      result:true|false,		//identity 是否被注册过
      userId:"用户唯一标示",
      identities:
      [
      {
      type: "mobile",
      identity: ""
      },
      {
      type: "wx001",
      identity: "openid"
      },
      ]
      }
     * }
     */
    public function checkIdentity($params)
    {

        if ($params['type'] && $params['identity'])
        {
            $tmp_url = $this->_baseUri . 'checkidentity';
            return $this->create(['identity' => $tmp_url], $params);
        } else
        {
            $msg = YII_DEBUG ? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'checkIdentity input param error' . $msg);
        }
    }

    /*
     * 获取短信验证码
     * @input param:
     * $mobilenumber -- 手机号
     * @ return:
     * {
     *   'identity':
     * 	 {
      'mobile'："xxxx",
      'validationStub': "uuid"
      }
     * }
     */

    public function getSMSCode($mobilenumber, $type = '')
    {
        $tmp_url = $this->_baseUri . 'smscode';
        $param = [
            'mobile' => $mobilenumber,
            'type' => $type,
            //该code代码值必须和后端JAVA API 保持一致,这是访问后端API 的令牌
            'code' => '#PHPTOKEN!%^&EDrFTGHYUJ'
        ];
        return $this->create(['identity' => $tmp_url], $param);
    }

    /*
     * 验证短信验证码
     * @input param:
     * $params = [
     *  "mobile" => "xxx" //mobile phone
     *  "code" => "xxx",  //SMS code
     * "validationStub" => "xxx" //uuid
     * ]
     * @ return:
     * TODO, I don't know //jiayy
     */

    public function validateSMSCode($params)
    {
        if ($params['mobile'] && $params['code'] && $params['validationStub'])
        {
            $tmp_url = $this->_baseUri . 'smsval';
            return $this->create(['identity' => $tmp_url], $params);
        } else
        {
            $msg = YII_DEBUG ? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'validateSMSCode input param error' . $msg);
        }
    }

    /*
     * 绑定或注册用户
     * @input param:
     * $params = [
     *  'identityType'=> "",			//wx001 一期只支持openid和手机号的绑定
      'identityCode'=> "",			//openid
      'sourceType'=> "",			//wx001
      'sourceCode'=> "",			//商店编号
      'mobile'=> "",				//手机号码
      'mobileExist'=> true|false,		//手机是否被注册过
      'verifyBySMS'=>true|false,		//是否通过手机短信方式验证
      'password'=> "",			//如果不是手机短信方式验证，需要用户输入用户密码
      'smsCode'=> "",				//如果是通过短信方式验证，输入短信验证码
      'smsStub'=>""				//生成短信码时 对应的 uuid
     * ]
     * @ return:
     * {
     * 'identity':
     * {
      resultCode:"注册结果代码",
      resultDescription:"注册结果描述",
      userId: "用户唯一标示"
      identities:
      [
      {
      type: "mobile",
      identity: ""
      },
      {
      type: "wx001",
      identity: "openid"
      },
      {
      type: "email",
      identity: "openid"
      },
      {
      type: "email",
      identity: "openid"
      },
      ]
      }
     * }
     */

    public function bindUser($params)
    {

        if (isset($params['identityType']) && isset($params['identityCode']) && isset($params['userId']))
        {
            $tmp_url = $this->_baseUri . 'bind';
            return $this->create(['identity' => $tmp_url], $params);
        } else
        {
            $msg = YII_DEBUG ? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'bindUser input param error' . $msg);
        }
    }

    /**
     * 获取验证码
     * @input param:
     * $stub -- 
     * @return 
     * {
     *  'identity':
     *  {
     *      'code': 'xxx'
     *   }
     *  }
     */
    public function getVerifycode($stub)
    {
        $tmp_url = $this->_baseUri . 'verifycode';
        $param = [
            'stub' => $stub
        ];
        return $this->create(['identity' => $tmp_url], $param);
    }

     /**
     * 获取验证码
     * @input param:
     * $stub -- 
     * @return 
     * {
     *  'identity':
     *  {
     *      'code': 'xxx'
     *   }
     *  }
     */
    public function getVcode($stub)
    {
        $tmp_url = $this->_baseUri . 'verifycode/' . $stub;
        return $this->get($tmp_url);
    }
    /**
     * 验证验证码
     * @input param:
     * $params = [
     *  'code' => 'xxx',
     *  'stub' => 'xxx'
     * ]
     * @return 
     * {
     *      'identity':
     *      {
     *          "result": true/false
     *      }
     * }
     * true/false
     */
    public function verifyCodeVal($params)
    {
        if ($params['code'] && $params['stub'])
        {
            $tmp_url = $this->_baseUri . 'verifycodeval';
            return $this->create(['identity' => $tmp_url], $params);
        } else
        {
            $msg = YII_DEBUG ? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'registerUser input param error' . $msg);
        }
    }

    /**
     * 注册用户
     * @input param:
     * $params = [
     *  'mobile' => 'xxx',
     *  'password' => 'xxx',
     *  'smsCode' => 'xxx',
     *  'smsCodeStub' => 'xxx'
     * ]
     * @return 
     * 注册成功：
     * {
     *      'identity':
     *      {
     *          {
      "resultCode": "00",
      "resultDescription": null,
      "userId": 7133727038931809260,
      "identities":[
      {
      "type": "mobile",
      "identity": "xxxx"
      },
      {
      "type": "username",
      "identity": "xxxx"
      }
      ]
      }
     *       }
     * }
     */
    public function registerUser($params)
    {
        if ($params['mobile'] && $params['password'] && $params['smsCode'] && $params['smsCodeStub'])
        {
            $tmp_url = $this->_baseUri . 'register';

            return $this->create(['identity' => $tmp_url], $params);
        } else
        {
            $msg = YII_DEBUG ? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'registerUser input param error' . $msg);
        }
    }

    /**
     * 登录
     * @input param:
     * $params = [
     *  'username' => 'xxx',
     *  'password' => 'xxx',
     *  'verifyCode' => 'xxx', //optional
     *  'verifyCodeStub' => 'xxx' //optional
     * ]
     * @return 
     * 登陆成功：
     * {
     *      'identity':
     *      {
     *          {
      "resultCode": null,
      "resultDescription": null,
      "userId": 7133727038931809260,
      "identities":[
      {
      "type": "mobile",
      "identity": "xxx"
      },
      {
      "type": "username",
      "identity": "xxx"
      }
      ],
      "allowAttempts": 0,
      "logonAttempts": 0
      }
     *       }
     * }
     */
    public function logon($params)
    {
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
    
    /**
     * 动态密码登录
     * @input param:
     * $params = [
     *  'mobile' => 'xxx',
     *  'code' => 'xxx',
     *  'validationStub' => 'xxx'
     * ]
     * @return 
     * 
     */ 

    public function dynamicPwdLogon($params)
    {
        if ($params['mobile'] && $params['code'] && $params['validationStub'])
        {//&& $params['verifyCode'] && $params['verifyCodeStub'] 这俩参数可选
            $tmp_url = $this->_baseUri . 'dynamicpwd/logon';
            return $this->create(['identity' => $tmp_url], $params);
        } else
        {
            $msg = YII_DEBUG ? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'logon input param error' . $msg);
        }
    }
    
    /**
     * 重置密码
     * @input param:
     * $params = [
     *  'mobile' => 'xxx',
     *  'smsCode' => 'xxx',
     *  'smsCodeStub' => 'xxx',
     *  'newPassword' => 'xxx'
     * ]
     * @return 
     * 
     */
    public function resetPwd($params)
    {
        if ($params['mobile'] && $params['smsCode'] && $params['smsCodeStub'] && $params['newPassword'])
        {
            $tmp_url = $this->_baseUri . 'resetpwd';
            return $this->create(['identity' => $tmp_url], $params);
        } else
        {
            $msg = YII_DEBUG ? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'resetPwd input param error' . $msg);
        }
    }

    /**
     * 更改密码
     * @input param:
     * $params = [
     *  'userId' => 'xxx',
     *  'oldPassword' => 'xxx',
     *  'password' => 'xxx'
     * ]
     * @return 
     * 成功：
     * {
     *     'identity':
     *     {
     *         {
      "resultCode": "00",
      "resultDescription": null
      }
     *     }
     * }
     */
    public function changePwd($params)
    {
        if ($params['userId'] && $params['oldPassword'] && $params['password'])
        {
            $tmp_url = $this->_baseUri . 'changepwd';
            return $this->create(['identity' => $tmp_url], $params);
        } else
        {
            //此处为用户输入密码错误时候的返回，应该直接返回false，而不应该抛出异常
//            $msg = YII_DEBUG? '----|input param is' . json_encode($params) . '|----' : '';
//            return Tools::error('99008', 'changePwd input param error' . $msg);
            return false;
        }
    }
    
    /**
     * 向邮箱发送找回密码的链接
     * @input param:
     * $params = [
     *  "baseUrl" = "xxxx",
     *  "email" => "xxx", //required,用户邮箱
     *  "type" => "xxx" //optional,email的类型，目前没用
     * ]
     * @return 
     * 成功：
     * {
     *     'identity':
     *     {
     *      "email": "xxx@xx.com",
     *       "validationStub": "xxxx"
     *      }
     * }
     */
    public function sendFindpwdUrl($params)
    {
        if ($params['email'] && $params['baseUrl'])
        {
            $tmp_url = $this->_baseUri . 'emailmsg';
//            $findPwdUrl = Url::to(['findpwd/checkidentity']); //baseUrl请参照这个来构造。
            return $this->create(['identity' => $tmp_url], $params);
        } else
        {
            $msg = YII_DEBUG? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'sendFindpwdUrl input param error' . $msg);
        }
    } 
    
    /**
     * 验证邮箱验证码
     * @input param:
     * $params = [
     *  "email" => "xxx", //required,用户邮箱
     *  "code" => "xxx", //required
     *  "validationStub" => "xxx" //required
     * ]
     * @return 
     * 成功/失败：
     * {
     *     'identity':
     *     {
                {
                "result": true/false
                }
     *      }
     * }
     */
    public function valEmailCode($params)
    {
        if ($params['email'] && $params['code'] && $params['validationStub'])
        {
            $tmp_url = $this->_baseUri . 'emailmsgval';
            return $this->create(['identity' => $tmp_url], $params);
        } else
        {
            $msg = YII_DEBUG? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'valEmailCode input param error' . $msg);
        }
    } 

}
