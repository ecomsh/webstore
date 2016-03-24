<?php

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use common\data\APIDataProvider;
use yii\helpers\Url;
use common\models\BaseApi;
use yii\helpers\Html;

/**
 * Test controller
 */
class TestController extends Controller
{

    public $enableCsrfValidation = false;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
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
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'page' => ['class' => 'yii\web\ViewAction'],
        ];
    }

    /**
     * 这是一个action限制的测试
     * @param type $action
     * @return type
     */
    public function beforeAction($action)
    {

        //  判断action是否为ss;
        if ($action->id == 'ss')
        {

            #todo something
            $result = ['ddd'];
          //  echo json_encode(['status' => '0', 'message' => '如果错误了需要,beforAction']);
            //or throw new BadRequestHttpException('直接异常');
            //   return false;  //or return false
        }


        return parent::beforeAction($action);
    }

    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);

        var_dump($result['id']);//this is the method for get params from action,if the action is not ajax, you can remove the FORMAT_JSON,and return a string.
    //    echo 'afterAction';
        return $result;
    }

    public function actionSs()
    {
        //  exit;
        //  var_dump(Yii::$app->user->user);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//        $cookies = Yii::$app->response->cookies;
//        $cookies->add(new \yii\web\Cookie([
//            'name' => 'language',
//            'value' => 'zh-CN',
//        ]));
        // exit('111111');
        return ['id'=>123];
    //    return 'asdfads';
    }

    
    
    
    
    
    
    
    public function actionTc()
    {
        $t = [];
        $t = ['extdata' => ['subject' => 'descritpion', 'userIp' => '127.0.0.1']];
        echo json_encode($t);
        exit;

        $model = new \common\models\BaseApi();
        $url = 'http://www.15kdy.com/test/tclog.html';
        $model->create(['ddd' => $url], ['aaa' => 'bbb']);
        exit;

//        $userId = 
//        $model = new AddressApi($userId);
//        $data = $model->getList();
//        var_dump($data);
    }

    public function actionTclog()
    {
        Yii::info($_POST, 'tclog');
        exit('aaa');
    }

    public function actionIndex()
    {
        /**
         * get(['xxx','ddd'])
         * call('ddd',['ddd'=>'aaa'],'POST')
         */
        //    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        //  echo Yii::$app->response->format;
        $mail = Yii::$app->mailer->compose();
        $mail->setTo('ftzmall@sohu.com')
                ->setFrom('ftzmall@sohu.com')
                ->setSubject('您好')
                ->setTextBody('我只是一个邮件测试');

        if ($mail->send())
            echo "成功";
        else
            echo "失败";
        die();
        Yii::$app->response->format = 'html';
        Yii::$app->response->format = 'json';

        //  Yii::$app->response->format = 'json';
        //   Yii::$app->response->format = 'xml';
        $d = \common\helpers\Tools::error(100024, ['ss' => 'ddaaa', 'ddd']);
        //  for raw
        //   var_dump($d);



        echo \frontend\widgets\Alert::widget();
    }

    public function actionQrcode($url = '', $size = 3)
    {
        return \dosamigos\qrcode\QrCode::png($url, false, 1, $size);
    }

    public function actionQrtest()
    {
        $qr = [];
        for ($i = 1; $i <= 20; $i++)
        {
            $qr[$i]['url'] = 'http://m.soupian.me' . \yii\helpers\Url::to(['pay/wx', 'id' => $i]);
            $qr[$i]['size'] = $i;
        }
        return $this->render('qrtest', ['qr' => $qr]);
    }

    public function actionXxx()
    {

//        $this->layout = false;
        $session = Yii::$app->session;

        $session['language'] = '我是设置的session';

        echo "设置session成功，请查看";
        echo Html::a('点我', ['test/ccc']);

//
//        $session->set('ddd', '我是session');
//        echo '设置session';
//        var_dump($session);
//        var_dump($session);
//        $cookies = Yii::$app->request->cookies;
// get the "language" cookie value. If the cookie does not exist, return "en" as the default value.
//        $language = $cookies->getValue('_rn', 'xxoo');
//        return $language;
//        Yii::$app->getSession()->set('__returnUrl', Yii::$app->getRequest()->getUrl());
//        $name = $cookies->getValue('_rn');
//        return $this->render('loginwidget', ['cookies' => $cookies, 'seesion' => $session, 'name' => $name]);
        ; //exit;
//        $session = Yii::$app->session;
//        echo $session['user'] . '|||';
//        $rq = Yii::$app->request;
//        Yii::info('ddd');
//        exit('ddd');
    }

    public function actionCcc()
    {
        $dependency = new \yii\caching\ExpressionDependency([
            'expression' => "false",
        ]);

        Yii::$app->cache->set('__NII', 'dddaaaaaa', 3600, $dependency);
        echo Yii::$app->cache->get('__NII');
        exit;


        Yii::$app->response->format = 'xml';

        //new xxx()  xxx->get();
        $d = \common\helpers\Tools::error(111, 'asdfa', ['1231' => 'json', '111' => 'raw']);

        var_dump($d);
        $this->layout = false;
        $session = Yii::$app->session;

//        var_dump($session);
//        $cookies = Yii::$app->request->cookies;
// get the "language" cookie value. If the cookie does not exist, return "en" as the default value.
//        $language = $cookies->getValue('_rn', 'xxoo');
//        return $language;
//        Yii::$app->getSession()->set('__returnUrl', Yii::$app->getRequest()->getUrl());
//        $name = $cookies->getValue('_rn');
//        return $this->render('loginwidget', ['cookies' => $cookies, 'seesion' => $session, 'name' => $name]);
        ; //exit;
//        $session = Yii::$app->session;
        if (isset($session['language']))
        {
            echo ($session['language']) . '|||设置成功';
        } else
        {
            echo Html::a('重设session', ['test/xxx']);
        }
//        $rq = Yii::$app->request;
//        Yii::info('ddd');
//        exit('ddd');
    }

    public function actionUser()
    {
        $session = Yii::$app->session;
        $session['user'] = 1;
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

    public function actionCaoqi()
    {
        $this->layout = false;
        //  $name = $this->getUniqueId();
        //  echo $this->id;
        //echo $this->action;
        //  echo $name;
        return $this->render('index');
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

    public function actionDataProvider()
    {

        \Yii::beginProfile('actionDataProvider');

        $url = 'http://192.168.110.24:8080/catalog-core-webapp/rest/v1/catalog/16676668/product/_all';
        $key = 'catentryKey';

        $productProvider = new APIDataProvider([
            'url' => $url,
            'key' => $key,
            'dataKey' => 'catentry',
            'pagination' => [
                'pageSize' => 2,
            ],
            'sort' => [
                'attributes' => [
                    'name' => [ 'asc' => ['first_name' => SORT_ASC],
                        'desc' => ['first_name' => SORT_DESC],
                        'default' => 'SORT_DESC',
                        'label' => 'NAME!',
                    ],
                ],
            ],
        ]);


        \Yii::endProfile('actionDataProvider');

        return $this->render('grid', ['productProvider' => $productProvider,]);
    }

}
