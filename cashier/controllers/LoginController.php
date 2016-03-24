<?php

namespace cashier\controllers;

use Yii;
use cashier\models\WebPOSUser;
use yii\web\Controller;
use cashier\models\RealnameApi;
use cashier\models\LoginForm;
use yii\filters\AccessControl;
use yii\helpers\Url;

class LoginController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'user' => 'webPOSUser',
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout', 'getcookie'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex() {

        $id = Yii::$app->webPOSUser->getId();
        $request = Yii::$app->request;

        $session = Yii::$app->session;
        if (isset($id) && $session->get('channel') != null) {
            return $this->redirect(Url::to(['cashier/index']));
        }

        $model = new LoginForm();

        $model->scenario = 'index';

        if ($request->isGet) {
            return $this->render('index', ['model' => $model]);
        }

        $postdata = $request->post();
        $model->load($postdata);
//        if ($request->getIsAjax()) {
//            if (isset($postdata['LoginForm']['store'])) {
//                $model->scenario = 'ajaxStore';
//            } 
//            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//            return \yii\widgets\ActiveForm::validate($model);
//        }
        if ($request->isPost && $model->validate()) {

            $username = $postdata['LoginForm']['username']; //$request->post('username');
            $password = $postdata['LoginForm']['password']; //$request->post('password');
//            $store = $postdata['LoginForm']['store'];//$request->post('store');

            $params = ['username' => $username,
                'password' => $password];

            $muser = new WebPOSUser();
            $user = $muser->login($params);
            if (isset($user) && $user['identity']['loginCode'] == '00') {//登陆成功
                
//                if (!empty($user['identity']['passport']['roles'])) {
                    $uid = $user['identity']['passport']['userId'];
                    $store = $user['identity']['passport']['orgId'];
                    $session->set('isLogin', true);
                    $repo = Yii::$app->params['accounts'];
                    
                    $storeInfo = $repo['zunyi'];
                    var_dump($storeInfo);exit;
                    $session->set('channel', json_encode($storeInfo));
                    $session->set('username', $username);
                    return $this->redirect(Url::to(['cashier/index']));
//                }
//                else{
//                    $session->setFlash('error', '您没有权限登录此系统');
//                    Yii::error('您没有权限登录此系统');
//                    return $this->render('index', ['model' => $model]);
//                }
            } else {

                if (isset($user) && $user['identity']['loginCode'] == '11') {
                    $session->setFlash('error', '用户名或者密码错误。尝试次数超过5次，账户将被锁定。');
                    Yii::error('用户名或者密码错误。尝试次数超过5次，账户将被锁定。');
                } else if (isset($user) && $user['identity']['loginCode'] == '14') {
                    $session->setFlash('error', '密码尝试次数超过5次，您的账号已经锁定，请联系客服。');
                    Yii::error('密码尝试次数超过5次，您的账号已经锁定，请联系客服。');
                } else {
                    $session->setFlash('error', '登陆失败');
                    Yii::error('登陆失败');
                }
                return $this->render('index', ['model' => $model]);
            }
        }
    }

//    public function actionIndexold(){
//    
//    	$id = Yii::$app->webPOSUser->getId();
//    	 
//    	$request = Yii::$app->request;
//    
//    	$session = Yii::$app->session;
//    
//    
//    	if( $session->get('isLogin') == true && $session->get('channel') != null ){
//    		return $this->redirect( Url::to(['cashier/index']));
//    	}
//    
//    
//    	if($request->isGet){
//    
//    		return $this->render('index');
//    
//    	}
//    
//    
//    	if($request->isPost){
//    
//    		$repo = Yii::$app->params['accounts'];
//    
//    
//    		$username = $request->post('username');
//    		$password = $request->post('password');
//    
//    		if(isset($repo[$username.'-'.$password])){
//    
//    			$session->set('isLogin',true);
//    			$session->set('channel',json_encode($repo[$username.'-'.$password]));
//    
//    
//    			return $this->redirect(Url::to(['cashier/index']));
//    		}else{
//    			$session->setFlash('error','账号或密码错误');
//    			return $this->render('index');
//    		}
//    
//    
//    	}
//    }


    public function actionLogout() {

        $session = Yii::$app->session;
        $session->remove('isLogin');
        $session->remove('channel');
        $session->remove('username');
        $session->removeAllFlashes();
        Yii::$app->webPOSUser->logout();
        return $this->redirect(Url::to(['login/index']));
    }

    public function actionGetcookie() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $session = Yii::$app->session;
        $userName = $session->get('username');
        $channel = $session->get('channel');
        $channel = json_decode($channel, true);
        $data = [];
        if ($userName && $channel) {
            $data['userName'] = $userName;
            $data['storeName'] = $channel['storeName'];
        }
        return $data;
    }

    public function actionTest() {

        $html = \frontend\widgets\commercial\CommercialWidget::widget(["adClass" => '\frontend\models\commercial\CarouselAdvertisement', "adId" => "1"]);

        return $html;
    }

}
