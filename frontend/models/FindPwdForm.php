<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FindPwdForm extends Model
{
	//index 页面
	public $username;
	public $verifyCode;
	
	//checkIdentity 页面
	
	/**
	 * verifyMethod 
	 * username
	 * mobile
	 * msgVerifyCode
	 * */
	public $verifyMethod;
	public $mobile;	
	public $email;
	public $msgVerifyCode;
	
	//邮箱接收的验证码
	public $emailVerifyCode;
	public $emailVerifyCodeStub;
	
	//resetpwd 页面
	public $password;
	public $confirmPassword;
	
	//存储计算信息
	public $userId;
	public $type;
	public $identity;
	
	
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
				[['username', 'verifyCode','msgVerifyCode','password', 'confirmPassword', 'email', 'emailVerifyCode', 'emailVerifyCodeStub'], 'required'],
				['username', 'trim'],
				['username', 'checkUserName'],
				['msgVerifyCode','verifySMSCode'],
				['emailVerifyCode', 'verifyEmailCode'],
				['verifyCode', 'captcha'],
				[['password'], 'string', 'min' => 6, 'max' => 20],
				//根据2015-12-08 panjiaming 从18 那里拿到的需求，把数字字母组合密码策略去掉
// 				['password', 'common\validators\PasswordBaseValidator'],
				['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => '两次密码不一致'],
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
				'username' => '登录名:',
				'verifyCode' => '验证码',
				 'verifyMethod' => '验证身份方式:',
				'mobile' => '您的手机号:',
				'email' => '邮箱:',
				'msgVerifyCode' => '短信校验码',//这俩是选择性显示
				'emailVerifyCode' => '',//这俩是选择性显示
				'password' => '新登录密码',
				'confirmPassword' =>'确认新登录密码',
		];
	}
	
	
// 	/**
// 	 * 只有在这里的属性，才会在对应的场景中可以用
// 	 * @return type
// 	 */
	public function scenarios()
	{
		return [
				'index' =>['username', 'verifyCode'],
				'checkusername' => ['username'],
				'checkidentity' =>['msgVerifyCode'],
				'verifyemailcode' => ['email', 'emailVerifyCode','emailVerifyCodeStub'],
				'resetpwd' => ['password', 'confirmPassword'],
		];
	}
	
	public function checkUserName($attribute){
		
		$type = $this->getType($this->username);
		$IdApi = new IdentityApi ();
		$params = [
				'identity'=> $this->username,
				'type' => $type
		];
		
		$result = $IdApi->checkIdentity( $params );
		$result = $result[key($result)];
		$userfound = $result['result'];
		if($result['result'] !== true){
			
			if ($type == 'mobile') {
				$params = [
						'identity'=> $this->username,
						'type' => 'username'
				];
					
				$type = 'username';
				$res = $IdApi->checkIdentity( $params );
				$res = $res[key($res)];
				$userfound = $res['result'];
			}
		}
		if($userfound == false){
			$this->addError($attribute, '账号不存在');
		}else {
			$this->type = $type;
			
			//用户输入的信息就是identity
			$this->identity = $this->username;
			
			if ($type == 'username') {//使用用户名注册的用户找回密码。
				//1. 优先判定手机号是否存在
				if (isset($result['mobile']) && $this->isMobileFormat($result['mobile'])) {//有手机号，使用手机号找回面貌，验证方式设为mobile
					//$this->type = 'mobile';
					$this->mobile = $result['mobile'];
				}else if (isset($result['email']) && $this->isEmailFormat($result['email'])) {//没有手机号，判定邮箱
					//$this->type = 'email';
					$this->email = $result['email'];
				}else{
					$this->addError($attribute, '账号没有绑定手机和邮箱信息，无法验证身份，无法找回密码。请联系客服。');
				}
			}else{//邮箱或者手机用户
				$this->userId = $result['userId'];
				$this->type = $type;
				if ($this->type == 'mobile') {
					$this->mobile = $this->getIdentity($result, $type);
				}else{
					$this->email =  $this->getIdentity($result, $type);
				}
				
			}
			
		}
		 
	}
	
	//获取用户的登陆Id
	private  function getIdentity($user, $type){
		$identities = $user['identities'];
		$count_json = count($identities);
		 
		for ($i = 0; $i < $count_json; $i++){
			if ($identities[$i]['type'] == $type) {
				return  $identities[$i]['identity'];
			}
		}
		return null;
	}
	
	public function getType($value){
		 
		if ($this->isMobileFormat($value)) {
			return "mobile";	
		}
		if ($this->isEmailFormat($value)) {
			return "email";
		}
		return "username";
	}
	
	private function isMobileFormat($value){
		$phonePattern = '/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/';
		if (preg_match($phonePattern, $value)) {
			return true;
		}else{
			return false;
		}
	}
	
	private function isEmailFormat($value){
		
		 $emailPattern = '/^[a-zA-Z0-9_\\-]{1,}@[a-zA-Z0-9_\\-]{1,}\\.[a-zA-Z0-9_\\-.]{1,}$/';
		if (preg_match($emailPattern, $value)) {
			return true;
		}else{
			return false;
		}
	}
	
	public function verifySMSCode($attribute, $params) {
		$session = Yii::$app->session;
		
		$validationStub = $session->get('stub');
		if(!isset($validationStub)){
			$this->addError($attribute, '请先点击获取验证码');
			return;
		}
		if ($session['trytimes']) {
			
			$session['trytimes'] = $session['trytimes'] + 1;
		}else{
			$session['trytimes'] = 1;
		}
		
		if ($session['trytimes'] > 3) {
			$this->addError($attribute, '尝试次数超过三次，验证码已经失效，请重新获取。');
			 return;
		}
		
		$code = $this->msgVerifyCode;
// 		if(strlen($code) !== 6){
// 			$this->addError($attribute, '验证码错误');
// 			return;
// 		}
		$IdApi = new IdentityApi ();
		$params = [
				'mobile' =>  $this->mobile,
				'code' => $code,
				'validationStub' => $validationStub,
		];
	
		$result = $IdApi->validateSMSCode ( $params );
	
		if($result['identity']['result'] !== true){
			$this->addError($attribute, '请填写正确的短信校验码'.$result['identity']['result'] );
		}else{
			//验证成功，删除session值
			unset($session['trytimes']);
		}
	
	}
	
	public function verifyEmailCode($attribute, $params) {

		$IdApi = new IdentityApi ();
		$params = [
				'email' =>  $this->email,
				'code' => $this->emailVerifyCode,
				'validationStub' => $this->emailVerifyCodeStub,
		];
	
		$result = $IdApi->valEmailCode ( $params );
	
		if($result['identity']['result'] !== true){
			$this->addError($attribute, '该链接已经失效');
		}
	
	}
	
	 
	
	
}
