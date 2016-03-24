<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\FindPwdForm;
use frontend\models\IdentityApi;

/**
 * Description of findpwdController
 *
 * @author wzhijun
 */
class FindpwdController extends Controller {

    public $layout = 'main';

    public function actions() {
        return [
        ];
    }

    public function actionIndex() {
        $request = Yii::$app->request;

        $session = Yii::$app->session;
        $session->open();

        $postData = $request->post();
        $model = new FindPwdForm();
        $model->scenario = 'index';

        $model->load($postData);

        if ($request->isGet) {//get 请求
            return $this->render('index', ['model' => $model,
            ]);
        } elseif ($request->getIsAjax() && $request->isPost) {
            $model->scenario = 'checkusername';
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        } else {//($request->isPost)
            if ($model->validate()) {//在model 中执行了checkIdentity //
                //
                $session->set('passCheckVerifyCode', true);
    			$session->set('userId', $model->userId); //TODO: 不需要
                $session->set('type', $model->type); //账号类型，email，mobile，username
                $session->set('identity', $model->identity); // 用户的identity 用于登陆的用户名，必然存在 email，mobile，username中的一个
                $session->set('mobile', $model->mobile); //对应用户的手机，可能为空
                $session->set('email', $model->email); //对应用户的邮箱，可能为空
                return $this->redirect(['findpwd/checkidentity']);
            }
        }
    }

    public function actionCheckidentity() {
        $this->checkAccess();

        $request = Yii::$app->request;
        $session = Yii::$app->session;
        $model = new FindPwdForm();
        $model->scenario = 'checkidentity';

        /**
         * verifyMethod
         * username
         * mobile
         * msgVerifyCode
         * */
        //session 取值付给model
        $type = $session->get('type');
        $model->identity = $session->get('identity');
        $model->mobile = $session->get('mobile');
        $model->email = $session->get('email');

        $isMobile = true;
        if ($type == 'mobile') {
            $isMobile = true;
            $model->verifyMethod = '手机验证';
        } else if ($type == 'email') {
            $isMobile = false;
            $model->verifyMethod = '邮箱验证';
        } else {//用户名用户
            // 不能通过用户直接重置密码，需要借助于，用户的手机或者邮箱，
            // 1. 优先使用手机号找回密码
            // 2. 没有手机使用邮箱找回
            // 3. 没有手机和和邮箱，无法找回密码
            // 4. 根据使用找回密码的途径，重新设置type
            if (isset($model->mobile)) {
                $isMobile = true;
                $model->verifyMethod = '手机验证';
                $session->set('type', 'mobile');
            }
            if (isset($model->email)) {
                $isMobile = false;
                $model->verifyMethod = '邮箱验证';
                $session->set('type', 'email');
            }
        }

        $postData = $request->post();
        if ($request->isGet) {
            /*             * ****邮箱重置密码走这里 begin***** */
            //get 方式取得三个值
            $email = $request->get('email');
            $id = $request->get('id');
            $code = $request->get('code');
            $stub = $request->get('stub');
            if ( isset($email) && isset($code) && isset($stub)) {//邮箱连接进来的url
                $model->scenario = 'verifyemailcode';
                $model->email = $email;
                $model->emailVerifyCode = $code;
                $model->emailVerifyCodeStub = $stub;

                if ($model->validate()) {//这三个值都存在的话，就写入session 并重定向
                	if(isset($id)){//email 不是登录名的情况下，URL 会带入id的值，这里取出id值
                		$session->set('id', $id);
                	}
                    $session->set('email', $model->email);
                    $session->set('code', $model->emailVerifyCode);
                    $session->set('stub', $model->emailVerifyCodeStub);
                    return $this->redirect(['findpwd/resetpwd']);
                }
//     			else{
//     				var_dump($model); 
//     				print_r("验证失败~~~~~~~~~~~~~~~");//TODO:
//     				exit();
//     			}
            }
            /*             * ****邮箱重置密码走这里 end***** */
            //第一次进入checkidentity 界面
            return $this->render('checkidentity', ['model' => $model, 'isMobile' => $isMobile]);
        } else if ($request->isAjax && $model->load($postData) && $request->isPost) {
            $model->scenario = 'checkidentity';
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        } else {//post
            $model->load($postData);
            if ($model->validate()) {
                $session->set('code', $model->msgVerifyCode);
                return $this->redirect(['findpwd/resetpwd']);
            }
        }
    }

    public function actionResetpwd() {
        $request = Yii::$app->request;

        $session = Yii::$app->session;
        $model = new FindPwdForm();

        $model->scenario = 'resetpwd';

        if (empty($session->get('stub')) || empty($session->get('code'))) {
            return $this->redirect('checkidentity');
        }

        $username = $session->get('id');
        if (empty($username)) {//不是通过email 发送url或者email 是用户的登陆名字， 不会存在该变量，
            //用户的identity 
            $username = $session->get('identity');
        }

        //默认从session 取mobile 值，
        //如果没有mobile 值，再去取email
        //能执行到这个步骤，必然其中一个不为空值
        $mobileValue = $session->get('mobile');
        if (empty($mobileValue)) {
            $mobileValue = $session->get('email');
        }

        //get 请求
        if ($request->isGet) {
            return $this->render('resetpwd', ['model' => $model]);
        } else {//post
            $postdata = $request->post();
            $model->load($postdata);
            if ($model->validate()) {
                $params = [
                    'username' => $username,
                    'mobile' => $mobileValue, // $session->get($session->get('type')),
                    'smsCode' => $session->get('code'),
                    'smsCodeStub' => $session->get('stub'),
                    'newPassword' => $model->password,
                ];

                $identityApi = new IdentityApi();

                $result = $identityApi->resetPwd($params);
                $result = $result[key($result)];
                if ($result['resultCode'] == '00') {
                    return $this->redirect(['complete']);
                } else {
                    return $this->refresh();
                }
            }
        }
    }

    public function actionCheckemail() {
        $this->checkAccess();
        $session = Yii::$app->session;
        $email = $session->get('email');
        return $this->render('checkemail', ['email' => $email]);
    }

    public function actionComplete() {
        $session = Yii::$app->session;
        if (empty($session->get('code')) && empty($session->get('stub'))) {
            return $this->redirect(['findpwd/index']);
        }
        $session->destroy();
        $timeout = 5;
        return $this->render('complete', ['time' => $timeout]);
    }

    /*     * ***************************************************** */

    /**
     * 获取验证码
     */
    public function actionGetsmscode() {
        $request = Yii::$app->request;
	$session = Yii::$app->session;
		
	$session->set('trytimes', 0);
        
        if($session->get('passCheckVerifyCode')){
             $session->set('passCheckVerifyCode', false);
            $mobilenumber = $request->get('mobile');
            $type = $request->get('type');

            $IdApi = new IdentityApi ();
            $stub = $IdApi->getSMSCode($mobilenumber, $type);

            $session = Yii::$app->session;
            $session ['stub'] = $stub ['identity'] ['validationStub'];
            return json_encode($stub);
        }else{
            return json_encode('error');
        }
        
    }

    public function actionSendemail() {
        $request = Yii::$app->request;
        $session = Yii::$app->session;

        $poastData = $request->post();

        $identity = $session->get('identity');

        $findpwdApi = new FindPwdForm();
        $type = $findpwdApi->getType($identity);

        /**
         * 1. 构造重置密码的 URL，需要传入用户identity，需要用identity 去数据库查找用户
         * 	  靠session 的值，在用户使用不同浏览器打开重置密码link 的情况，无法重置成功
         * 2. email 邮箱需要传递原因需要验证用户信息
         * 
         */
        $identityKV = ''; //
        if ($type == 'username') {//如果是username 的重置密码，需要传入identity
            $identityKV = "&id=" . $identity;
        }
        $link = '';
        if (strpos($poastData['baseUrl'], '?') == false) {
            $link = $poastData['baseUrl'] . "?email=" . $poastData['email'] . $identityKV;
        } else {
            $link = $poastData['baseUrl'] . "&email=" . $poastData['email'] . $identityKV;
        }

        $IdApi = new IdentityApi ();
        $params = [
            'baseUrl' => $link,
            'email' => $poastData['email'],
            'type' => $poastData['type']
        ];
        $stub = $IdApi->sendFindpwdUrl($params);
        $session = Yii::$app->session;
        $session ['stub'] = $stub ['identity'] ['validationStub'];
        return json_encode($stub);
    }

    private function checkAccess() {

        $session = Yii::$app->session;

        if (empty($session->get('userId')) && empty($session->get('type')) && empty($session->get('identity'))) {
            return $this->redirect(['findpwd/index']);
        }
    }

}
