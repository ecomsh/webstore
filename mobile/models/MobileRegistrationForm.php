<?php

namespace mobile\models;

use common\models\User;
use yii\base\Model;
use Yii;
use mobile\models\MemberApi;
use common\models\cps\BaseCps;

/**
 * Signup form
 */
class MobileRegistrationForm extends Model {

    public $identityType;  //wx001
    public $identityCode; //这里就是openId
    public $sourceType;  //wx001|Store
    public $sourceCode;  //商店编号
    public $mobile;  //手机号码
    public $gender;
    public $mobileExist; //手机是否被注册过	
    public $verifyBySMS; //是否通过手机短信方式验证
    public $password;  //如果不是手机短信方式验证，需要用户输入用户密码
    public $confirmPassword;
    public $smsCode;  //如果是通过短信方式验证，输入短信验证码
    public $smsStub;  //生成短信码时 对应的 uuid
    public $openid;   //被$identityCode取代了
    public $verifyCode;

    public function attributeLabels() {
        return [
            'mobile' => '手机号',
            'gender' => '性别',
            'password' => '密码',
            'confirmPassword' => '确认密码',
            'smsCode' => '短信验证码',
            'verifyCode' => '验证码'
        ];
    }

    public function scenarios() {
        return [
            'index' => ['mobile', 'password', 'verifyCode','confirmPassword', 'smsCode', 'gender'],
            'create' => ['mobile', 'password', 'confirmPassword','smsCode', 'gender'],
            'bind' => ['smsCode', 'identityType', 'identityCode'],
            'ajaxMobile' => ['mobile'],
            'ajaxsmsCode' => ['mobile', 'verifyCode'],
            'ajaxPassword' => ['password'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['mobile', 'password', 'confirmPassword', 'smsCode', 'gender'], 'required'],
            ['mobile', 'trim'],
            [['password','confirmPassword'], 'string', 'min' => 6, 'max' => 20],
        	//根据2015-12-08 panjiaming 从18 那里拿到的需求，把数字字母组合密码策略去掉
//             ['password', 'mobile\validators\PasswordValidator'],
            ["confirmPassword","compare","compareAttribute"=>"password","message"=>"两次密码不一致"],
            [['mobile'], '\mobile\validators\MobileValidator'],
            ['mobile', 'checkUniqueUser'],
            ['smsCode', 'verifySMSCode'],
            ['verifyCode', 'captcha']
            
        ];
    }

    public function checkUniqueUser($attribute, $params) {
        $user = new MobileUser();
        $userExist = $user->checkIdentity('mobile', $this->mobile);
        if ($userExist) {
            $this->addError($attribute, '该手机已经被注册');
        }
        else{
            $usernameExit = $user->checkIdentity('username', $this->mobile);
            if ($usernameExit) {
                $this->addError($attribute, '该手机已被注册为用户名，请使用普通方式登录');
            }
        }
    }

    public function verifySMSCode($attribute, $params) {

        $session = Yii::$app->session;
        $validationStub = $session ['smsStub'];

        if (!isset($validationStub)) {
            $this->addError($attribute, '验证码错误，请获取验证码');
            return;
        }
        
        $IdApi = new IdentityApi ();
        $params = [
            'mobile' => $this->mobile,
            'code' => $this->smsCode,
            'validationStub' => $validationStub
        ];

        $result = $IdApi->validateSMSCode($params);

        if ($result['identity']['result'] !== true) {
            $this->addError($attribute, '验证码错误');
        }
    }

    /**
     * Signs user up.
     *
     * * $params = [
     *  'identityType'=> "",			//wx001 
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
     *
     * @return User|null the saved model or null if saving fails
     */
    public function wx_signup() {
        if ($this->validate()) {

            $idApi = new IdentityApi();
            $params = [
                'identityType' => $this->identityType,
                'identityCode' => $this->identityCode, //openid
                'sourceType' => $this->sourceType, //wx001
                'sourceCode' => $this->sourceCode, //商店编号
                'mobile' => $this->mobile, //手机号码
                'mobileExist' => $this->mobileExist, //手机是否被注册过
// 		 		'verifyBySMS'=> false,					//是否通过手机短信方式验证
                'password' => $this->password, //如果不是手机短信方式验证，需要用户输入用户密码
                'smsCode' => $this->smsCode, //如果是通过短信方式验证，输入短信验证码
                'smsStub' => $this->smsStub    //生成短信码时 对应的 uuid
            ];
            $user = $idApi->bindUser($params);
            if (isset($user['identity']['userId'])) {
                return $user;
            } else {
                return null;
            }
        }

        return null;
    }

    public function bindUser($type) {
        $session = Yii::$app->session;

        $idApi = new IdentityApi();
        $params = [];
        if ($type == Yii::$app->params['idendityType']['wx']) {
            $params = [
                'identityType' => $session['identityType'],
                'identityCode' => $session['identityCode'], //openid
                'sourceType' => $session['st'], //wx001
                'sourceCode' => $session['sc'], //商店编号
                'userId' => Yii::$app->mobileUser->getId(), //手机号码
            ];
        } else if ($type == Yii::$app->params['idendityType']['mobile']) {
            $params = [
                'identityType' => $this->identityType,
                'identityCode' => $this->identityCode,
                'userId' => Yii::$app->mobileUser->getId(),
            ];
        }
        $user = $idApi->bindUser($params);
        if (isset($user['identity']['userId'])) {
            return $user;
        } else {
            return null;
        }
    }

    /**
     * 非微信用户注册
     * @return unknown|NULL
     */
    public function m_signup() {

        $session = Yii::$app->session;

        $cpsApi = new BaseCps();
        $cpsData = $cpsApi->getDataFromCookie();
        $sourceCode = 0;
        if (isset($cpsData->unionId)) {
        	$sourceCode = $cpsData->unionId;
        }else{
        	if ($session->get('sc')) {
        		$sourceCode = $session->get('sc');
        	}else{
        		$sourceCode = '0';
        	}
        }
        $idApi = new IdentityApi();
        $params = [
            'mobile' => $this->mobile, //手机号码
            'password' => $this->password, //如果不是手机短信方式验证，需要用户输入用户密码
            'smsCode' => $this->smsCode, //如果是通过短信方式验证，输入短信验证码
            'smsCodeStub' => $session['smsStub'],   //生成短信码时 对应的 uuid
        	'sourceType' => Yii::$app->params['platform'],	//平台
        	'sourceCode' => $sourceCode		//用户来源渠道
        ];
        $user = $idApi->registerUser($params);
        if (isset($user['identity']['userId'])) {//注册成功， 更新性别信息到member
            $memmodel = new MemberApi($user['identity']['userId']);
            $rc = $memmodel->updateGender($this->gender);
            $key = key($rc);
            $rc = isset($rc[$key])? $rc[$key]:[];
            if(isset($rc['userId'])){
                Yii::info('Successfully update userid:' . $user['identity']['userId'] . ' gender info:' . $this->gender);
            }
            else{
                Yii::error('Failed update userid:' . $user['identity']['userId'] . ' gender info：' . $this->gender);
            }
            $userObj = new MobileUser();
            return $userObj->loginAfterSignup($user);
        } else {
            $session->setFlash('error', '注册失败');
            return false;
        }
    }


    public function setOpenId($openid) {
        $this->openid = $openid;
    }

}
