<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\cps\BaseCps;

/**
 * ContactForm is the model behind the contact form.
 */
class RegisterUserForm extends Model
{	
	
	
	
	
	public $registrationType;
	public $verifyCodeStub;
	public $verifyCode;
	public $smsCodeStub;
	
	public $mobile;
	public $gender;
	public $smsCode;
	public $password;
	public $confirmPassword;
	public $acceptAgreement;
	
	public $email;
	public $mobileVerified;
	public $emailVerifiend;
	
	
	/**
	 * 只有在这里的属性，才会在对应的场景中可以用
	 * @return type
	 */
// 	public $verifycode;
// 	public $auto_login;
	 
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
				[['mobile', 'confirmPassword', 'verifyCode', 'password', 'smsCode', 'gender'], 'required'],
				['mobile', 'trim'],
				['mobile', 'frontend\validators\MobileValidator'],
				['mobile', 'checkMobileAvailable'],
				['smsCode', 'verifySMSCode'],
				[['password','confirmPassword'], 'string', 'min' => 6, 'max' => 20],
				//根据2015-12-08 panjiaming 从18 那里拿到的需求，把数字字母组合密码策略去掉
// 				['password', 'frontend\validators\PasswordValidator'],
				["confirmPassword","compare","compareAttribute"=>"password","message"=>"两次密码不一致"],
				['verifyCode', 'captcha']
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
				'mobile' => '手机号',
				'password' => '密码',
				'confirmPassword' => '确认密码',
				'smsCode' => '短信校验码',
				'gender' => "性别",
				'verifyCode' => '验证码'
		];
	}
	
	/**
	 * 只有在这里的属性，才会在对应的场景中可以用
	 * @return type
	 */
	public function scenarios()
	{
		return [
				'index' =>['mobile', 'verifyCode','smsCode','password', 'confirmPassword', 'gender'],
				'create' =>['mobile', 'smsCode','password'],
				'ajaxMobile' => ['mobile'],
				'ajaxsmsCode' => ['mobile', 'verifyCode'],
				'ajaxPassword' => ['password'],
		];
	}
	
	public function checkMobileAvailable($attribute){
		$userId = Yii::$app->user->getId();
		$IdApi = new IdentityApi ($userId);
		$params = [
				'identity'=> $this->mobile,
				'type' => 'mobile'
		];
		 
		$result = $IdApi->checkIdentity( $params );
		 
		//     	$mobile = $this->getIdentifyByType($result['identity']['identities'], 'mobile');
		if($result['identity']['result'] === true){
			$this->addError($attribute, '该手机号已存在，请更换手机号或立刻登录');
		}else{//sho
			
			$params = [
					'identity'=> $this->mobile,
					'type' => 'username'
			];
			$result_username = $IdApi->checkIdentity( $params );
			if($result_username['identity']['result'] === true){
				$this->addError($attribute, '该手机号已经被注册为用户名，请使用普通登陆方式登陆');
			}
			
		}
		 
	}
	
// 	private function getIdentifyByType($userIdentities, $type){
	
// 		//     	echo var_dump($this->userIdentities);
// 		$count_json = count($userIdentities);
// 		for ($i = 0; $i < $count_json; $i++){
// 			if ($userIdentities[$i]['type'] == $type) {
// 				return $userIdentities[$i]['identity'];
// 			}
// 		}
// 		return null;
// 	}
	
	
	public function verifySMSCode($attribute) {
	
		$session = Yii::$app->session;
		
		
		$validationStub = $session ['smsStub'];
		if(!isset($validationStub)){
			$this->addError($attribute, '请先点击获取短信校验码');
			return;
		}
		
		$code = $this->smsCode;
		if(strlen($code) !== 6){
			$this->addError($attribute, '验证码错误');
			return;
		}
		
		$userId = Yii::$app->user->getId();
		$IdApi = new IdentityApi ($userId);
		
		$params = [
				'mobile' => $this->mobile,
				'code' => $code,
				'validationStub' => $validationStub
		];
		
// 		if ($this->validate()) {
			$result = $IdApi->validateSMSCode ( $params );
			if($result['identity']['result'] !== true){
				$this->addError($attribute, '请填写正确的短信校验码');
			}
// 		}
		
	}
	
	/**
	 * 非微信用户注册
	 * @return unknown|NULL
	 */
	public function register(){
		
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
				'mobile'=> $this->mobile,				//手机号码
				'password'=> $this->password,			//如果不是手机短信方式验证，需要用户输入用户密码
				'smsCode'=> $this->smsCode,				//如果是通过短信方式验证，输入短信验证码
				'smsCodeStub'=> $session['smsStub'],			//生成短信码时 对应的 uuid
				'sourceType' => Yii::$app->params['platform'],	//平台
				'sourceCode' => $sourceCode		//用户来源渠道
		];
		$user = $idApi->registerUser($params);
		if (isset($user['identity']['userId'])) {//登陆成功
// 			$userObj = new User();
			return $user;
// 			 $userObj->loginAfterSignup($user);
	
		}else{
			$session-> setFlash('error', '注册失败');
			return false;
		}
	}
	
}
