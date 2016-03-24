<?php

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\ContactForm;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                
                        'class' => 'common\models\CaptchaCustomizeAction',
                        'height' => 40,
                        'foreColor' => 0xff0000,
                        'width' => 80,
                        'minLength' => 4,
                        'maxLength' => 4,
                        'testLimit' => 5,
                        'letters' => '123456789012345678901',
                        'vowels' => '14798'
//                      'backColor' => 0xeb0f60,
//                        'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'page' => ['class' => 'yii\web\ViewAction'],
        ];
    }

    public function actionIndex()
    {
//        $curl = \common\models\Curl::getInstance();
////        $curl->header = $this->header;
//        $url = 'http://preapi.kjt.com/open.api ';
//        $params=[];
//        $params['method']=['preapi.kjt.com/open.api '];
//        $rs = $curl->fetch($url, $params, 'POST');
//        var_dump($rs);
//        exit;
        $menuObj = new \backend\models\Menu();
        $menuUrlObj = new \backend\models\MenuUrl();

        $menu = $menuObj->find()->where(['platform'=>1])->orderBy('index')->one();
        
        if(!$menu){
            $this->redirect(['act/page','view'=>'index']);
        }
        
        $list = $menuUrlObj->getMenuUrlList($menu->id);
        $cmsViewList = \yii\helpers\ArrayHelper::map($list, 'is_default', 'cms_view');
        $urlList = \yii\helpers\ArrayHelper::map($list, 'is_default', 'url');

        if(isset($cmsViewList[2])){
            if(empty($cmsViewList[2])){
                $this->redirect($urlList[2], 302);
            }else{
                $this->redirect(['act/page','view' => $cmsViewList[2]], 302);
            }
        }else{
            if(empty($cmsViewList[1])){
                $this->redirect($urlList[1],302);
            }else{
                $this->redirect(['act/page','view' => $cmsViewList[1]], 302);
            }
        }
//        $this->redirect(['act/page']);
//        $session = Yii::$app->session;
//        $this->layout = "main";
//        return $this->render('/site/index');


        // $base = new \common\models\BaseApi();
        // $rs = $base->get(["cart","product","http://www.baidu.com"]);
        //$rs = $base->call("http://www.baidu.com");
        //$info = var_dump($base->debugInfo);exit;
        // var_dump($rs);
//        $product = new \frontend\models\ProductApi;
//        $rs = $product->call("product");
//        var_dump($rs);
        //  exit;
        // return $this->render('index');
    }

    /*
      public function actionHello()
      {
      $this->layout = 'hello';
      $rs = "Hello,world";
      return $this->render('hello', [
      'rs' => $rs,
      ]);

      }

     */

    public function actionNotfound()
    {
        $this->redirect(['act/page']);
        $this->layout = "main";
        return $this->render('404');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
        {
            return $this->goBack();
        } else
        {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionContact()
    {
       // $this->layout = "main_test";
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if ($model->sendEmail(Yii::$app->params['adminEmail']))
            {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else
            {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else
        {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    public function actionDown()
    {
        $this -> layout = false;
        return $this->render('down');       
    }

/*
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {

        echo Yii::$app->getRequest()->getUserIP();
        if (!isset($_SERVER['HTTPS']))
        {
            //\yii\helpers\VarDumper::dump(Yii::$app->request);	
        }
        $http = new \yxdj\network\Http();
        $http->get("http://www.15kdy.com");
        echo $http->getCode();


        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()))
        {
            if ($user = $model->signup())
            {
                if (Yii::$app->getUser()->login($user))
                {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }


    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if ($model->sendEmail())
            {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else
            {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try
        {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e)
        {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword())
        {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }
    */
}
