<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class BindMobileForm extends Model
{

	public $mobile;
	public $smsCode;
	public $smsStub;
	
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
				[['mobile', 'smsCode'], 'required', 'message' => '此项必填'],
				['mobile', 'trim'],
				['mobile', 'frontend\validators\MobileValidator'],
				['mobile', 'checkMobileAvailable'],
				['smsCode', 'verifySMSCode']
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
				'mobile' => '手机号: ',
				'smsCode' => '短信验证码: ',
		];
	}
	
	
	/**
	 * 只有在这里的属性，才会在对应的场景中可以用
	 * @return type
	 */
	public function scenarios()
	{
		return [
				'index' =>['mobile', 'smsCode'],
				'ajaxMobile' => ['mobile'],
				'ajaxsmsCode' => ['mobile', 'smsCode'],
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
			$this->addError($attribute, '手机号已经被绑定');
		}
		 
	}
	
	private function getIdentifyByType($userIdentities, $type){
	
		//     	echo var_dump($this->userIdentities);
		$count_json = count($userIdentities);
		for ($i = 0; $i < $count_json; $i++){
			if ($userIdentities[$i]['type'] == $type) {
				return $userIdentities[$i]['identity'];
			}
		}
		return null;
	}
	
	
	public function verifySMSCode($attribute, $params) {
	
		$session = Yii::$app->session;
		$validationStub = $session ['smsStub'];
		if(!isset($validationStub)){
			$this->addError($attribute, '请先点击获取验证码');
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
				'code' => $this->smsCode,
				'validationStub' => $validationStub
		];
	
		$result = $IdApi->validateSMSCode ( $params );
	
		if($result['identity']['result'] !== true){
			$this->addError($attribute, '请填写正确的短信校验码');
		}
	
	}
	
	 
	
	
}
