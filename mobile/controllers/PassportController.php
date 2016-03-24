<?php

namespace mobile\controllers;

use Yii;
use mobile\models\MobileRegistrationForm;
use mobile\models\MobileLoginForm;
use mobile\models\BindMobileForm;
use mobile\models\ChangePasswordForm;
use mobile\models\MobileUser;
use mobile\models\IdentityApi;
use mobile\models\AddressApi;
use mobile\models\RealnameApi;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use mobile\models\ResetPwdForm;
use mobile\models\SmsLoginForm;
use yii\helpers\Url;

/**
 * Site controller
 */
class PassportController extends Controller {

	public $fixcode = 'HlI0O0XSUICIXYSB';
        public $passVerifyCodeCheck = false;
	
    // 创建一条记录
    const CREATE = 'create';
    // 获取所有列表
    const INDEX = 'index';
    const UPDATE = 'update';
    const BIND = 'bind';

    public $layout = 'main-register-login';

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'user' => 'mobileUser', //指定mobile 指定的用户凭证信息。
                // 'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['reg', 'login4webpos', 'login', 'resetpassword', 'getsmscode', 'verifycode', 'valregmobile', 'checklogindata', 'valresetpwdmobile'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        // 'actions' => ['logout', 'realnamecert', 'createaddress'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ],
            'page' => [
                'class' => 'yii\web\ViewAction'
            ]
        ];
    }

    public function actionReg() {

        $session = Yii::$app->session;
        $request = Yii::$app->request;

        // 用于判定是不是o2o
        $type = $request->get('st');
        $code = $request->get('sc'); 
        //处理汕头二维码 sc 和st 设置反了的问题，加上了这个逻辑交换信息。
        if ($type == 'shantou' && $code == 'o2ostore') {
        	$code = 'shantou';
        }
        $type = Yii::$app->params['platform']; //record register source type as mobile

        $session ['st'] = $type;
        //$request->get('st'); //source type，用于标识用户类型
        $session ['sc'] = $code;//$request->get('sc'); //source code，用于标识店铺

        $headers = Yii::$app->request->headers;
        $userAgent = $headers->get('User-Agent');

        $userId = Yii::$app->mobileUser->getId();
        if ($userId) {//用户已经登陆，直接重定向
            return $this->redirect(['/user/index']);
        }

        //判断是否是微信。
        if ($this->isweixin($userAgent)) { // 微信
            $mobileUser = new MobileUser ();
            // 这里会给openid 赋值，放入session
            $user = $mobileUser->loginByWeiXin();
            if ($user) { // 微信用户已经存在，
//                Yii::$app->session->setFlash('success', '登陆成功');
                $url = Url::previous();
                if (!empty($url)) {
                    return $this->redirect($url);
                }
                return $this->render('loginsuccess');
            }
        }


        $model = new MobileRegistrationForm ();
        $data = $request->post();
        // 		指定初始场景
        $model->scenario = self::INDEX;
        $model->load($data);
        if ($request->getIsAjax()) {
            if (!empty($model->verifyCode)) {
                $model->scenario = 'ajaxsmsCode';
            } else if (!empty($model->mobile)) {
                $model->scenario = 'ajaxMobile';
            } else if(!empty($model->password))
            {
                $model->scenario = 'ajaxPassword';
            }
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }
        
        if ($request->isPost) { // 是post
            $model->scenario = self::CREATE;
            if ($model->validate()) {
                $this->signup($model, $data);
            }
        }

        //不是post 更改输入参数 选择render
        if (isset($session ['sc']) && isset($session ['st'])) {
//			return $this->render ( 'o2o', ['model' => $model] );
            return $this->render('register', ['model' => $model]);
        } else {
//			return $this->render ( 'not_o2o', ['model' => $model] );
            return $this->render('register', ['model' => $model]);
        }
    }

    /**
     * 登录页面
     * get 请求该页面会定向到index
     *
     * @return Ambigous <string, string>|\yii\web\Response
     */
    public function actionLogin() {
        Yii::$app->getSession()->open(); // fix the bug for redis session added by hezonglin 11.17
        $userId = Yii::$app->mobileUser->getId();
        if ($userId) {
            $url = Url::previous();
            if (!empty($url)) {
                return $this->redirect($url);
            }
            return $this->redirect(['passport/loginsuccess']); //TBD yyjia登陆成功之后需要跳转到首页
        }
        $headers = Yii::$app->request->headers;
        $userAgent = $headers->get('User-Agent'); //用来判断是否是微信用户登录
        //由于支持动态密码登录和普通登录方式，因此使用两种登录方式的form表单。下面代码可以尝试抽象出一个统一的函数，暂时直接实现功能，未考虑代码优化问题。
        $model = new MobileLoginForm ();
        $model->scenario = self::INDEX;
        $smsloginmodel = new SmsLoginForm(); //动态密码登录的form
        $smsloginmodel->scenario = self::INDEX;

        $request = Yii::$app->request;
        if ($request->getIsAjax()) {         //只有动态密码登录的表单才需要ajax验证
            $data = $request->post();  //activeform 的ajax验证是post
            if(isset($data['SmsLoginForm'])){
                $smsloginmodel->load($data);
                if (isset($data['SmsLoginForm']['smsCode'])) {
                    $smsloginmodel->scenario = 'ajaxsmsCode';
                } else if (isset($data['SmsLoginForm']['mobile'])) {
                    $smsloginmodel->scenario = 'ajaxMobile';
                } else {
//                $model->scenario = 'ajaxPassword';
                }
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \yii\widgets\ActiveForm::validate($smsloginmodel);
            }
            else{
                $model->load($data);
                if(isset($data['MobileLoginForm']['username'])){
                    $model->scenario = 'ajaxUsername';
                }
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \yii\widgets\ActiveForm::validate($model);
            }
        } else if ($request->isGet) {
            if ($this->isweixin($userAgent)) { // 微信
                $data = $request->get();
                if (isset($data['MobileLoginForm'])) {
                    $user = $model->loginByWeiXin();
                } else {
                    $user = $smsloginmodel->loginByWeiXin();
                }
                if ($user) { // 微信用户已经存在，
                    Yii::$app->getSession()->open(); // fix the bug for redis session added by hezonglin 11.17
                    $userId = Yii::$app->mobileUser->getId();
                    $realname = new RealnameApi($userId);
                    $usrInfo = $realname->getById();

                    //如果已经实名认证，直接返回到
                    if (isset($usrInfo['realname']['realName']) && isset($usrInfo['realname']['identityNumber'])) {

                        // 认证成功以后，去检查地址信息是否填写。
                        // -----------------Begin 跳转到地址界面-------------------
                        $UserApi = new MobileUser($userId);
                        if (!$UserApi->isBindAddress()) {
                            return $this->redirect([ 'passport/createaddress']);
                        } else {
                            // 如果没有绑定手机，绑定手机
                            if (!$model->isBindIdentity($user, Yii::$app->params['idendityType']['mobile'])) {
                                // 跳转到bind 手机页面
                                return $this->redirect(['passport/mobilebind']);
                            } else {
                                $url = Url::previous();
                                if (!empty($url)) {
                                    return $this->redirect($url);
                                }
                                return $this->render('loginsuccess'); //TBD yyjia首页或者之前页
                            }
                        }
                        // -----------------End 跳转到地址界面-------------------
                    } else {
                        // 注册成功之后需要检查是否实名认证，没有认证跳转到实名认证页面
                        return $this->redirect([
                                    'realname'
                        ]);
                    }
                }
            }
            return $this->render('login', [
                        'model' => $model,
                        'smsloginmodel' => $smsloginmodel,
            ]);
        } else if ($request->isPost) {

            $postData = Yii::$app->request->post();
            if (isset($postData['MobileLoginForm'])) {
                $model->scenario = self::CREATE;
                if ($model->load($postData) && $model->validate()) {
                    $user = $model->login($postData ['MobileLoginForm']);
                    if (isset($user) &&  $user['identity']['resultCode'] == '00') {

                        $userId = $user['identity']['userId'];
                        //如果在微信里，悄悄绑定微信。
                        if ($this->isweixin($userAgent)) {
                            $model->bindWeiXin();
                        }
                        // 微信用户已经存在，
                        $realname = new RealnameApi($userId);
                        $usrInfo = $realname->getById($userId);
                        //如果已经实名认证，直接返回到
                        if (isset($usrInfo['realname']['realName']) && isset($usrInfo['realname']['identityNumber'])) {

                            // 认证成功以后，去检查地址信息是否填写。
                            // -----------------Begin 跳转到地址界面-------------------
                            $UserApi = new MobileUser($userId);
                            if (!$UserApi->isBindAddress()) {
                                return $this->redirect([ 'passport/createaddress']);
                            } else {
                                // 如果没有绑定手机，绑定手机
                                if (!$model->isBindIdentity($user, Yii::$app->params['idendityType']['mobile'])) {
                                    // 跳转到bind 手机页面
                                    return $this->redirect(['passport/mobilebind']);
                                } else {
                                    $url = Url::previous();
                                    if (!empty($url)) {
                                        return $this->redirect($url);
                                    }
                                    return $this->render('loginsuccess'); //TBD yyjia首页或者之前页
                                }
                            }
                            // -----------------End 跳转到地址界面-------------------
                        } else {
                            // 注册成功之后需要检查是否实名认证，没有认证跳转到实名认证页面
                            return $this->redirect([
                                        'realname'
                            ]);
                        }
                    } else {
                    	
                    	if (isset($user) &&  $user['identity']['resultCode'] == '13'){
                    		Yii::$app->session->setFlash('login_error', '用户名或密码错误，超过6次后账户将被锁定');
                    		Yii::error('用户名或者密码错误。尝试次数超过6次，账户将被锁定。');
                    	}else if(isset($user) &&  $user['identity']['resultCode'] == '12'){
                    		Yii::$app->session->setFlash('login_error', '密码已输错6次，请联系客服解锁账号');
                    		Yii::error('密码尝试次数超过6次，您的账号已经锁定，请联系客服。');
                    	}else{
                    		Yii::$app->session->setFlash('login_error', '登陆失败');
                    		Yii::error('登陆失败');
                    	}
                      
                        return $this->refresh();
                    }
                }
            } else {
                $smsloginmodel->scenario = self::CREATE;
                if ($smsloginmodel->load($postData) && $smsloginmodel->validate()) {
                    $user = $smsloginmodel->login($postData ['SmsLoginForm']);
                    if (isset($user) &&   $user['identity']['resultCode'] == '00') {
                        $userId = $user['identity']['userId'];
                        //如果在微信里，悄悄绑定微信。
                        if ($this->isweixin($userAgent)) {
                            $smsloginmodel->bindWeiXin();
                        }

                        // 微信用户已经存在，
                        $realname = new RealnameApi($userId);
                        $usrInfo = $realname->getById();

                        //如果已经实名认证，直接返回到
                        if (isset($usrInfo['realname']['realName']) && isset($usrInfo['realname']['identityNumber'])) {

                            // 认证成功以后，去检查地址信息是否填写。
                            // -----------------Begin 跳转到地址界面-------------------
                            $UserApi = new MobileUser($userId);
                            if (!$UserApi->isBindAddress()) {
                                return $this->redirect([ 'passport/createaddress']);
                            } else {
                                // 如果没有绑定手机，绑定手机
                                if (!$model->isBindIdentity($user, Yii::$app->params['idendityType']['mobile'])) {
                                    // 跳转到bind 手机页面
                                    return $this->redirect(['passport/mobilebind']);
                                } else {
                                    $url = Url::previous();
                                    if (!empty($url)) {
                                        return $this->redirect($url);
                                    }
                                    return $this->render('loginsuccess'); //TBD yyjia首页或者之前页
                                }
                            }
                            // -----------------End 跳转到地址界面-------------------
                        } else {
                            // 注册成功之后需要检查是否实名认证，没有认证跳转到实名认证页面
                            return $this->redirect([
                                        'realname'
                            ]);
                        }
                    } else {
                    	
                    	if (isset($user) &&  $user['identity']['resultCode'] == '13'){
                    		Yii::$app->session->setFlash('login_error', '用户名或者密码错误。尝试次数超过5次，账户将被锁定。');
                    		Yii::error('用户名或者密码错误。尝试次数超过5次，账户将被锁定。');
                    	}else if(isset($user) &&  $user['identity']['resultCode'] == '12'){
                    		Yii::$app->session->setFlash('login_error', '密码尝试次数超过5次，您的账号已经锁定，请联系客服。');
                    		Yii::error('密码尝试次数超过5次，您的账号已经锁定，请联系客服。');
                    	}else{
                    		Yii::$app->session->setFlash('login_error', '登陆失败');
                    		Yii::error('登陆失败');
                    	}
                    	 
                    	return $this->refresh();
                    }
                }
            }
        }
    }

    public function actionLogin4webpos() {

        $userId = Yii::$app->mobileUser->getId();
        if ($userId) {
            $session['login'] = true;
            return $this->redirect(['/realname/certify']);
        }
        $headers = Yii::$app->request->headers;
        $userAgent = $headers->get('User-Agent');

        $model = new MobileLoginForm ();
        $model->scenario = self::INDEX;
        $smsloginmodel = new SmsLoginForm(); //动态密码登录的form
        $smsloginmodel->scenario = self::INDEX;

        $request = Yii::$app->request;
        if ($request->isGet) {

            return $this->render('login', [
                        'model' => $model,
                        'smsloginmodel' => $smsloginmodel,
            ]);
        } else if ($request->isPost) {

            $postData = Yii::$app->request->post();
            if ($postData) {
                $model->scenario = self::CREATE;
            }

            if ($model->load($postData) && $model->validate()) {
                $user = $model->login($postData ['MobileLoginForm']);
                if (isset($user) &&  $user['identity']['resultCode'] == '00') {
                    // Yii::app()->request->urlReferrer;
                    $session = Yii::$app->session;
                    $session['login'] = true;
                    return $this->redirect(['/realname/certify']);
                    //return $this->goBack();
                } else {
                	if (isset($user) &&  $user['identity']['resultCode'] == '13'){
                		Yii::$app->session->setFlash('login_error', '用户名或者密码错误。尝试次数超过5次，账户将被锁定。');
                		Yii::error('用户名或者密码错误。尝试次数超过5次，账户将被锁定。');
                	}else if(isset($user) &&  $user['identity']['resultCode'] == '12'){
                		Yii::$app->session->setFlash('login_error', '密码尝试次数超过5次，您的账号已经锁定，请联系客服。');
                		Yii::error('密码尝试次数超过5次，您的账号已经锁定，请联系客服。');
                	}else{
                		Yii::$app->session->setFlash('login_error', '登陆失败');
                		Yii::error('登陆失败');
                	}
                	
                	return $this->refresh();
                	
                }
            }
        }
    }

    /**
     * 实名认证
     * 
     * @return \yii\web\Response|string
     */
    public function actionRealname() {

        // 现阶段用户模块并没有完成，但是将来用下面的方法获取用户id
        // Yii::$app->mobileUser->getId() = 'e468a389-19c1-11e5-bba0-00ffaa3562cc';
        $userId = Yii::$app->mobileUser->getId();

        // 初始化api
        $model = new RealnameApi($userId);

        // 预定义当前场景状态
        $model->scenario = self::INDEX;
        // 判断当前model中的记录是否是全新记录，一般情况下，url中有id就代表旧的数据
        $postData = Yii::$app->request->post();

        if ($postData) {
            $model->scenario = self::CREATE;
        }

        if (Yii::$app->request->isAjax && $model->load($postData)) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }

        if ($model->load($postData) && $model->validate()) {

            if ($model->scenario == self::CREATE) {
                $info = $model->createRealname($postData ['RealnameApi']);
            }

            if (isset($info) && $info && is_array($info)) {
                Yii::$app->session->setFlash('success', '实名认证成功');
                // 认证成功以后，先检查是否有returnUrl，如果有则跳转到returnUrl，不必进行后面的验证。不用这个逻辑了。
//                                if(!empty($postData ['returnUrl'])){
//                                    return $this->redirect ( $postData ['returnUrl'] );
//                                }
                // 认证成功以后，去检查地址信息是否填写。
                // -----------------Begin 跳转到地址界面-------------------
                $UserApi = new MobileUser($userId);
                if (!$UserApi->isBindAddress()) {
                    return $this->redirect([ 'passport/createaddress']);
                } else {
                    Yii::info('post');
                    $url = Url::previous();
                    if (!empty($url)) {
                        return $this->redirect($url);
                    }
                    return $this->redirect([ 'passport/loginsuccess']);
                }
                // -----------------End 跳转到地址界面-------------------
            } else {
                // 用户操作错误处理，将错误放置于错误flash中，同时记录log日志
                Yii::$app->session->setFlash('error', '系统异常，请稍后重试');
                Yii::error($model->scenario . '系统异常，请稍后重试');
                return $this->refresh();
            }
        } else {//Get //TODO: add getErrors 
            $d = $model->setErrors('raw');
            Yii::$app->session->setFlash('realname_error', $d['errorMsg']);
            $data = $model->getById();
            if ($data) {
                $model->load($data, 'realname');
            }
            return $this->render('realname', [
                        'model' => $model,
            ]);
        }
    }

    /**
     *  添加地址
     * 
     * @return type
     */
    public function actionCreateaddress($id = 0) {
        $userId = Yii::$app->mobileUser->getId();
        // 初始化api
        $model = new AddressApi($userId);
        // 预定义当前场景状态
        if ($id)
            $model->isNewRecord = false;
        else
            $model->isNewRecord = true;

        $postData = Yii::$app->request->post();

        if ($postData && $id) {
            $model->scenario = self::UPDATE;
        } else {
            $model->scenario = self::CREATE;
        }

        if ($model->load($postData) && $model->validate()) {
            Yii::info('Post');
            if ($model->scenario == self::CREATE) {
                $info = $model->createAddress($postData ['AddressApi']);
            }

            if ($info && is_array($info)) {
// 				Yii::$app->session->setFlash ( 'success', '操作成功' );
                Yii::info('添加地址操作成功');

                // 如果没有绑定手机，绑定手机
                $mobile = Yii::$app->mobileUser->getMobile();
                if (empty($mobile)) {
                    // 跳转到bind 手机页面
                    return $this->redirect(['passport/mobilebind']);
                } else {
                    // 注册注册需要引导用户到绑定地址界面。操作成功后，需要重定向到注册完成页面。
                    // ----------------Begin------------------
                    return $this->render('registerfinish');
                    // -----------------End-----------------
                }
            } else {
                // 用户操作错误处理，将错误放置于错误flash中，同时记录log日志
                Yii::$app->session->setFlash('error', '系统异常，请稍后重试');
                Yii::error($model->scenario . '地址薄的时候，系统异常，请稍后重试');
            }
        } else {
            Yii::info('Get');

            $UserApi = new MobileUser($userId);
            if ($UserApi->isBindAddress()) {//有地址了，就重定向到绑定手机页面
                return $this->redirect(['passport/mobilebind']);
            }
            return $this->render('createaddress', [
                        'model' => $model
            ]);
        }
    }

    /**
     * local 传递时间戳价+六位随机数，从服务器端获取验证码，目前从php直接拿验证码, can be deleted
     * 
     * @return string
     */
    /*
      public function actionGetverifycode() {
      $IdAPIs = new IdentityApi ();
      $timestamp = time ();
      $rand6 = rand ( 100000, 999999 );
      $stub = $timestamp . $rand6;
      $verifyCode = $IdAPIs->getVerifycode ( $stub );
      $verifyCode ['identity'] ['stub'] = $stub;
      return json_encode ( $verifyCode );
      }
     */

    /**

      public function actionVerifycode() {
      $userId = Yii::$app->mobileUser->getId ();

      $request = Yii::$app->request;
      $code = $request->get ( 'code' );
      $stub = $request->get ( 'stub' );
      $param = [
      'code' => $code,
      'stub' => $stub
      ];

      $IdAPIs = new IdentityApi ( $userId );
      $verifyCode = $IdAPIs->verifyCodeVal ( $param );
      if ($verifyCode ['identity'] ['result']) {
      // Yii::$app->session->setFlash('success', '验证码输入正确');
      } else {
      Yii::$app->session->setFlash ( 'error', '验证码错误' );
      }
      return $verifyCode ['identity'] ['result'];
      }

     */
    //TBD yyjia
    public function actionMiddlepage() {
        return $this->render('middlepage');
    }

    public function actionLoginsuccess() {
        return $this->render('loginsuccess');
    }

    /**
     * 手机绑定成功后，检查实名认证信息
     * 
     * @return string
     */
    public function actionMobilebind() {
        $userId = Yii::$app->mobileUser->getId();

        $request = Yii::$app->request;
        $model = new BindMobileForm ();
        $postData = $request->post();
        $model->scenario = 'index';
        $model->load($postData);
       
        //是ajax 进行验证码 验证
       
        if ($request->getIsAjax()) {
            
            if (empty($postData['BindMobileForm']['smsCode'])) {
                 $model->scenario = 'ajaxMobile';
            } else {
               $model->scenario = 'indexexcluesevc';
            }
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        } 
        if ( $request->isPost) {//
             $model->scenario = 'indexexcluesevc';
             $model->load($postData);
             if($model->validate()){
                 $user = $model->bindUser('mobile');
                 if (isset($user)) {
//		Yii::$app->session->setFlash ( 'success', '绑定成功' );
                Yii::info('绑定成功手机操作成功');
                return $this->render('bindmobilesuccess');
                } else {
                    Yii::$app->session->setFlash('error', '绑定失败');
                    Yii::error('绑定失败');
                    return $this->refresh();
                }
             }
            
        } 
        if($request->isGet){//get 
            //如果手机已经绑定，重定向到登陆成功页面
            $mobile = Yii::$app->mobileUser->getMobile();
            if (empty($mobile)) {
                // 跳转到bind 手机页面
                return $this->render('mobilebind', ['model' => $model]);
            } else {
                $url = Url::previous();
                if (!empty($url)) {
                    return $this->redirect($url);
                }
                return $this->redirect(['passport/loginsuccess']);
            }
        }
    }

    public function actionRegisterfinish() {
        return $this->render('registerfinish');
    }

    public function actionLogout() {
        $muser = new MobileUser();
        $muser->logout();
        return $this->redirect(['site/index']);
    }

    /**
     * 注册
     */
    public function signup($registerModel, $data) {
        $session = Yii::$app->session;
        $user = $registerModel->m_signup();

        if ($user !== false) {
            // 注册后设置为登录状态
            $session->setFlash('success', '注册成功');
            $wxType = Yii::$app->params['idendityType']['wx'];
            // 如果是微信注册，需要绑定openId到用户信息
            if (isset($session ['identityType']) && $session ['identityType'] == $wxType && isset($session ['identityCode'])) {
                $userBindWX = $registerModel->bindUser($wxType);
                if (isset($userBindWX)) {
                    $session->setFlash('reg_success', '微信绑定成功');
                } else {
                    Yii::error('微信绑定失败');
                }
            }

            // 注册成功之后需要跳转到实名认证页面
            return $this->redirect([
                        'realname'
            ]);
        } else {
            $session->setFlash('error', '注册失败');
            return $this->refresh();
        }
    }

    /**
     * 获取验证码
     */
    public function actionGetsmscode() {
        
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        
        if($request->get('mobile') !== null){
            return "Don't support Get method";
        }
        $postData = $request->post();

        $this->passVerifyCodeCheck = $session->get('passVerifyCodeCheck');
        if( !$this->passVerifyCodeCheck ){//$model->validate()  在第二次验证 captcha 的时候，总是false，所以采用全景变量记录该检查结果
            $data = [ 'verifyCodeError' => '输入验证码错误'];	
            return json_encode($data) ;
        }
        $session['passVerifyCodeCheck'] = false;
        unset($session['passVerifyCodeCheck']);
         if ( $request->isPost){
            $postData = $postData[key($postData)];
           
                if (isset($postData['mobile']) && $postData['fixcode']) {
                      $mobilenumber = $postData['mobile'];
                      $fc = $postData['fixcode'];
                      $type = $postData['type'];
              }else{
                      Yii::error('mobile:前端提交了异常数据，可能是被攻击');
                      return json_encode("SDC") ;
              }

              if(md5($this->fixcode) !== $fc){
                      return json_encode('shadacuB') ;
              }
              $IdApi = new IdentityApi ();
              $stub = $IdApi->getSMSCode($mobilenumber, $type);

              $session = Yii::$app->session;
              $session ['smsStub'] = $stub ['identity'] ['validationStub'];
              return json_encode($stub);
         }
       
    }

    /**
     * 验证验证码
     */
    public function actionValidatecode() {
        $request = Yii::$app->request;
        $mobilenumber = $request->get('mobile');
        $code = $request->get('code');
        $session = Yii::$app->session;
        yii::info('smsStub: ' . $session ['smsStub']);
        $validationStub = $request->get('validationStub');
        $IdApi = new IdentityApi ();
        $params = [
            'mobile' => $mobilenumber,
            'code' => $code,
            'validationStub' => $validationStub
        ];
        $result = $IdApi->validateSMSCode($params);
        return json_encode($result);
    }

    /**
     * 通过API 更改密码
     * @return void|Ambigous <string, string>
     */
    public function actionChangepassword() {

        $userId = Yii::$app->mobileUser->getId();
        $request = Yii::$app->request;
        $session = Yii::$app->session;

        $postData = $request->post();
        $model = new ChangePasswordForm();
        $model->scenario = 'index';

        $model->load($postData);
        if ($request->getIsAjax() && $request->isPost) {
            $model->scenario = 'checkpassword';
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }

        if ($request->isGet) {

            return $this->render('changepassword', [
                        'model' => $model,
            ]);
        } else {
            if ($model->validate()) {
                if ($userId) {
                    $idApi = new IdentityApi($userId);
                    $postData['ChangePasswordForm']['userId'] = $userId;
                    $params = [
                        'userId' => $userId,
                        'oldPassword' => $postData['ChangePasswordForm']['oldPassword'],
                        'password' => $postData['ChangePasswordForm']['password']
                    ];
                    $identity = $idApi->changePwd($params);

                    if (isset($identity) && $identity['identity']['resultCode'] == '00') {
                        $session->setFlash('passport_success', '修改密码成功！');
                        return $this->redirect(['/user/index']);
                    } else if (isset($identity) && $identity['identity']['resultCode'] == '10') {
                        $session->setFlash('passport_error', '旧密码错误');
                        return $this->refresh();
                    } else {
                        $session->setFlash('passport_error', '修改密码失败');
                        return $this->refresh();
                    }
                }
            }
        }
    }

    /**
     * 通过API 重置密码
     * wzhijun
     * @return void|Ambigous <string, string>
     */
    //TBD yyjia
    public function actionResetpassword() {

        $userId = Yii::$app->mobileUser->getId();
        $request = Yii::$app->request;

        $postData = $request->post();

        $session = Yii::$app->session;
        $model = new ResetPwdForm();

        $model->scenario = 'index';
        $model->load($postData);

        if ($request->getIsAjax()) {
            $model->scenario = 'ajaxMobile';
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }

        if (Yii::$app->request->isPost) {
            $model->scenario = 'create';
            if ($model->validate()) {
                $idApi = new IdentityApi();
                $session = Yii::$app->session;
                $postData['ResetPwdForm']['smsCodeStub'] = $session['smsStub'];
                $params = [
                    'mobile' => $postData['ResetPwdForm']['mobile'],
                    'smsCode' => $postData['ResetPwdForm']['smsCode'],
                    'smsCodeStub' => $postData['ResetPwdForm']['smsCodeStub'],
                    'newPassword' => $postData['ResetPwdForm']['newPassword']
                ];
                $identity = $idApi->resetPwd($params);
                if (isset($identity) && $identity['identity']['resultCode'] == '00') {
                    $session->setFlash('success', '修改密码成功');
                    return $this->redirect(['passport/login']);
                } else {
                    $session->setFlash('error', '修改密码失败');
                    return $this->refresh();
                }
            }
        }
        return $this->render('resetpassword', [
                    'model' => $model,
        ]);
    }

    public function actionValmobile() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new BindMobileForm();
         $request = Yii::$app->request;
        $session = Yii::$app->session;
        $data = $request->post();
        $model->scenario = 'ajaxsmsCode';
        $model->load($data);
        $this->passVerifyCodeCheck = $model->validate();
        $session->set('passVerifyCodeCheck',$this->passVerifyCodeCheck);
        $error = $model->getErrors();
        return $error;
    }

    public function actionValresetpwdmobile() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new ResetPwdForm();
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        $data = $request->post();
        $model->scenario = 'ajaxsmsCode';
        $model->load($data);
//        var_dump($data);
//        var_dump($model);exit();
        $this->passVerifyCodeCheck = $model->validate();
        $session->set('passVerifyCodeCheck',$this->passVerifyCodeCheck);
        $error = $model->getErrors();
        return $error;
    }

    public function actionValregmobile() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new MobileRegistrationForm();
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        $data = $request->post();
        $model->scenario = 'ajaxsmsCode';
        $model->load($data);
//        var_dump($data);
//        var_dump($model);
        $this->passVerifyCodeCheck = $model->validate();
        $session->set('passVerifyCodeCheck',$this->passVerifyCodeCheck);
//        var_dump($this->passVerifyCodeCheck);exit;
        $error = $model->getErrors();
        return $error;
    }

    public function actionChecklogindata() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new SmsLoginForm();
        $request = Yii::$app->request;
         $session = Yii::$app->session;
        $data = $request->post();
        $model->scenario = 'ajaxsmsCode';
        $model->load($data);
        $this->passVerifyCodeCheck = $model->validate();
        $session->set('passVerifyCodeCheck',$this->passVerifyCodeCheck);
        $error = $model->getErrors();
        return $error;
    }

    private function isweixin($userAgent) {
        // $_SERVER['HTTP_USER_AGENT']
        if (strpos($userAgent, 'MicroMessenger') !== false) {
            return true;
        }
        return false;
    }

}
