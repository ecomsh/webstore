<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\RegisterUserForm;
use yii\captcha\Captcha;
use frontend\models\IdentityApi;
use frontend\models\MemberApi;

/**
 * Site controller
 */
class RegisterController extends Controller
{

    public $layout = "main-login-register";
    public $fixcode = 'HlI0O0XSUIICIXYSB';
    private $passVerifyCodeCheck = false;

    public function actionLogin()
    {
        $model = new RegisterUserForm();
        return $this->render('/login/login', [
                    'model' => $model,
        ]);
    }

    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'height' => 50,
                'width' => 80,
                'testLimit' => 5,
                'minLength' => 4,
                'maxLength' => 4
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new RegisterUserForm();

        $userId = Yii::$app->user->getId();
        
        if (isset($userId))
        {
            //已登录用户，
            return $this->goHome();
        }

        $request = Yii::$app->request;
        $session = Yii::$app->session;

        $postData = $request->post();
        $model->scenario = 'index';
        //是ajax 进行验证码 验证
         $model->load($postData);

        if (Yii::$app->request->isAjax)
        {
            if (!empty($postData['RegisterUserForm']['smsCode']))
            {
                $model->scenario = 'ajaxsmsCode';
            } else if (!empty($postData['RegisterUserForm']['mobile']))
            {
                $model->scenario = 'ajaxMobile';
            } else
            {
                $model->scenario = 'ajaxPassword';
            }
// 	var_dump($model->scenario ); exit();
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }

        if ($request->isPost)
        { // 是post
            $model->scenario = 'create';
            if ($model->validate())
            {
                $user = $model->register();
                if ($user !== false)
                {
                    $userId = $user['identity']['userId'];
                    $gender = $postData['RegisterUserForm']['gender'];
                    //TODO: 
                    $memberAPI = new MemberApi($userId);
                    $memberAPI->updateGender($gender);
                    //
                    $username = $user['identity']['username'];
                    $firstLoginCode = $user['identity']['firstLoginCode'];
                    //重定向URL
                    //TODO: need to 移植配置到配置文件
                    $tmp_url = Yii::$app->params['CAS']['loginUrl'] . '&username=' . $username . '&code=' . $firstLoginCode;
                    //$tmp_url = 'https://passport.soupian.me/passport-cas/login?service=http%3A%2F%2Fwww.soupian.me%2Flogin.html&username='. $username . '&code='. $firstLoginCode;
                    //$tmp_url =  Yii::$app->params['sm']['passport']['appBaseUrl'] . 'register';
                    return $this->redirect($tmp_url);
                } else
                {
                    $session->setFlash('error', '注册失败');
                    return $this->refresh();
                }
            }
            
        }
        return $this->render('/register/index', ['model' => $model]);
    }

    /**
     * 获取验证码
     */
    public function actionGetsmscode()
    {
        $model = new RegisterUserForm();
        
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        
        if($request->get('mobile') !== null){
            return "Don't support Get method";
        }
        
        $postData = $request->post();
        if($postData !== null && !empty($postData)){
            $postData = $postData[key($postData)];
        }
        
      $this->passVerifyCodeCheck = $session->get('passVerifyCodeCheck');
        
        if( !$this->passVerifyCodeCheck ){//$model->validate()  在第二次验证 captcha 的时候，总是false，所以采用全景变量记录该检查结果
            
            $data = ['verifyCodeError' => '输入验证码错误'];	
            return json_encode($data) ;
          }
          
        $session['passVerifyCodeCheck'] = false;
        unset($session['passVerifyCodeCheck']);//验证成功以后,直接删掉该值
        if ( $request->isPost){
        	
        	if (isset($postData['mobile']) && $postData['fixcode'] && $postData['type']) {
        		$mobilenumber = $postData['mobile'];
        		$fc = $postData['fixcode'];
        		$type = $postData['type'];
        	}else{
        		Yii::error('前端提交了异常数据，可能是被攻击');
        		return json_encode('shadacuA') ;
        	}
        	
        	if(md5($this->fixcode) !== $fc){
        		return json_encode('shadacuB') ;
        	}
        	$IdApi = new IdentityApi ();
        	
        	$stub = $IdApi->getSMSCode($mobilenumber, $type);
        	$session ['smsStub'] = $stub ['identity'] ['validationStub'];
                
        	return json_encode($stub);
        }
         
    }
     
    public function actionValregmobile()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new RegisterUserForm();
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        
        $data = $request->post();
//         var_dump($data);
        $model->scenario = 'ajaxsmsCode';
        $model->load($data);
        $this->passVerifyCodeCheck = $model->validate();
//         var_dump($model);
//         var_dump($this->passVerifyCodeCheck);
//         exit();
        $session->set('passVerifyCodeCheck', $this->passVerifyCodeCheck);
        $error = $model->getErrors();
        return $error;
    }
    
}
