<?php

namespace mobile\models;

use Yii;
use yii\helpers\Url;
use common\pay\wxpay\JsApiPay;
use common\models\BaseApi;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MobileUser extends BaseApi implements \yii\web\IdentityInterface {

    private $mobile;		//手机号码
    private $openid;			//被$identityCode取代了
    private $userIdentities;
        private $_user = false;
        private $_userId;

    public function __construct($userId = "") {
        parent::__construct($userId);
        $this->_userId = $userId;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
    	
    	$session = Yii::$app->getSession();
    	
//     	echo 'mobileUser: '. Yii::$app->mobileUser->getId();
//     	$id = $session->getHasSessionId() || $session->getIsActive() ? $session->get('__id') : null;
    	$userInfo_unserilze = $session->getHasSessionId() || $session->getIsActive() ? $session->get('__mobileUser') : null;
    	$userInfo = unserialize($userInfo_unserilze);
    	if ($id === null || $userInfo === null) {
    		return  null;
    	} else {
    		$user = new self($id);
    		$user->_userId = $id;
    		$user->_user = $userInfo;
//     		echo 'from -------------session-------------<br>';
//     		echo var_dump($userInfo);
//     		echo 'from -----------end--session-------------<br>';
    		$user->userIdentities = $userInfo['userIdentities'];
    		$user->mobile = $user->getIdentifyByType('mobile');
    		return $user;
    	}
    }
    

    /**
     * @inheritdoc
     */
    public function getId() {
    	
        return $this->_userId;
    }

    /**
     * @inheritdoc
     */
    public function getMobileId() {
    	
        return $this->mobile;
    }
    
	public function getUserIdentities(){
		return $this->userIdentities;
	}
	
	public function getOpenid(){
		return $this->openid;
	}
    
    /**
     * 用户存在，返回用户信息，用户不存在返回false
     * @return Ambigous <\mobile\models\MobileUser, boolean>
     */
    
    public function loginByWeiXin(){
    	//获取openid
        
    	$tools = new JsApiPay ('cbt');//dcj  为了支持多个微信支付账号,对获取openid应该没影响
    	$openId = $tools->GetOpenid ();
        if(empty($openId)){
            Yii::warning("GetOpenid is empty when login by weixin");
             return false;
         }
    	$session = Yii::$app->session;
    	$session->open();
    	//赋值到session
    	$session['identityType'] = Yii::$app->params['idendityType']['wx'];//这个hardCode 的千万别改，否则bind微信openid 会失败。需要统一改动
    	$session['identityCode'] = $openId;
    	 
    	$user = $this->checkIdentity($session['identityType'], $session['identityCode']);
    	if ($user) {
    		$session['__mobileUser'] = serialize($user);
    		return Yii::$app->mobileUser->login($user, 0);
    	}else{
    		return false;
    	}
    }
    
    public function bindWeiXin()
    {
    	$session = Yii::$app->session;
    	 
    	$idApi = new IdentityApi();
    	
    	$params = [
    			'identityType'=> $session['identityType'],
    			'identityCode'=> $session['identityCode'],			//openid
    			'sourceType'=>  $session['st'],			//wx001
    			'sourceCode'=>  $session['sc'],			//商店编号
    			'userId'=> Yii::$app->mobileUser->getId(),				//手机号码
    	];
    	 
    	
    	$user = $idApi->bindUser($params);
    	if (isset($user['identity']['userId'])) {
    		return $user;
    	}else{
    		return null;
    	}
    
    
    }
    
 
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }
    /**
    *
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
     
    public function validatePassword($password) {
        return $this->password === $password;
    }


    public function getUser() {
        if ($this->_user === false) {
            $this->_user = $this->findIdentity($this->_userId);
        }
        return $this->_user;
    }

    public function login_new($postData) {
    	if (isset($postData)) {
    		$this->login($postData);
    	}else{
    		$this->loginByWeiXin();
    	}
    }
    
    public function loginAfterSignup($userInfo){
    	//设置Session
    	$session = Yii::$app->session;
    	$userid = $userInfo['identity']['userId'];
    	$this->_userId = $userid;
    	$this->userIdentities =  $userInfo['identity']['identities'];
    	$session['__mobileUser'] = serialize($this);
    	yii::info("登陆成功");
    	return Yii::$app->mobileUser->login($this->getUser(), 0);
    }
    
    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login($params) {

        	$IdAPIs = new IdentityApi();
        	
        	/*
        	 *  {
        	 *  'identity': {
        	 *   { "resultCode": null, "resultDescription": null, "userId": 7133727038931809260,
        	 *   "identities":[ { "type": "mobile", "identity": "xxx" }, { "type": "username", "identity": "xxx" } ],
        	 *    "allowAttempts": 0, "logonAttempts": 0 } } }
        	* */
        	$user = $IdAPIs->logon($params);
        	if (isset($user['identity']['userId'])) {//登陆成功
        		$session = Yii::$app->session;
        		$userid = $user['identity']['userId'];
        		$this->_userId = $userid;
        		$this->userIdentities =  $user['identity']['identities'];
        		$session['__mobileUser'] = serialize($this);
        		yii::info("登陆成功");
        		Yii::$app->mobileUser->login($this->getUser(), 0);
        		
        		return $user;
        	}else{
        		//返回登陆失败的具体信息到api 调用者
        		return $user;
        	}
        
    }
    
        public function dynamicPwdlogin($params) {

        	$IdAPIs = new IdentityApi();
        	
        	$user = $IdAPIs->dynamicPwdLogon($params);
        	if (isset($user['identity']['userId'])) {//登陆成功
        		$session = Yii::$app->session;
        		$userid = $user['identity']['userId'];
        		$this->_userId = $userid;
        		$this->userIdentities =  $user['identity']['identities'];
        		$session['__mobileUser'] = serialize($this);
        		yii::info("登陆成功");
        		Yii::$app->mobileUser->login($this->getUser(), 0);
        		
        		return $user;
        	}else{
        		//失败返回具体失败信息到api 调用者
        		return $user;
        	}
        
    }
    
    public function logout() {
        Yii::$app->mobileUser->logout();
    }

    public function getAuthKey() {
        
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        
    }
    
    /*
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


     * */
    public function checkIdentity($type, $id){
    	 
    	$session = Yii::$app->session;
    	$session->open();
    	//检测微信是否存在
    	$IdApi = new IdentityApi();
    	$params = ['type'=>$type, 'identity'=>$id];
    	

    	$result = $IdApi->checkIdentity($params);
    	//用户是否存在
    	
    	$session['mobileExist'] = $result['identity']['result'];
    	if($result['identity']['result'] == true){//微信用户已经存在，
    		$session['verifyBySMS']= true;
    
    		$this->_userId = $result['identity']['userId'];
    		$this->userIdentities = $result['identity']['identities'];
    		
    		$this->mobile  = $this->getIdentifyByType('mobile');
    		$this->openid = $this->getIdentifyByType('wx001');
    		return $this;
    	}else {//用户不存在。
    		$session['verifyBySMS']= true;
    		return false;
    	}
    	 
    }
    
   public function isBindIdentity($type){
   	
//    			echo var_dump($this->userIdentities);
		   	$count_json = count($this->userIdentities);
		   	for ($i = 0; $i < $count_json; $i++){
		   		if ($this->userIdentities[$i]['type'] == $type) {
		   			return isset( $this->userIdentities[$i]['identity']);
		   		}
		   	}
		   	return false;
    }
    
    public function getIdentifyByType($type){
    
//     	echo var_dump($this->userIdentities);
    	$count_json = count($this->userIdentities);
    	for ($i = 0; $i < $count_json; $i++){
    		if ($this->userIdentities[$i]['type'] == $type) {
    			return $this->userIdentities[$i]['identity'];
    		}
    	}
    	return false;
    }
    
    
   public function isBindAddress(){
    	//拿到登录信息
    	$userId = Yii::$app->mobileUser->getId();
    	$addressAPI = new AddressApi($userId);
    	$addlist = $addressAPI->getList();
    	if (count($addlist['address']) == 0) {//没有地址
    		return false;
    	}else {//已经添加了地址
    		return true;
    	}
    }
    

}
