<?php

namespace mobile\controllers;

use Yii;
//use common\models\LoginForm;
//use mobile\models\PasswordResetRequestForm;
use mobile\models\ResetPasswordForm;
use mobile\models\SignupForm;
//use mobile\models\ContactForm;
//use mobile\models\IdentityApi;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
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
    public $layout = "mainnew";

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
        ];
    }

    public function actionIndex()
    {
        $menuObj = new \backend\models\Menu();
        $menuUrlObj = new \backend\models\MenuUrl();

        $menu = $menuObj->find()->where(['platform'=>2])->orderBy('index')->one();
        
        if(!$menu){
            $this->redirect(['act/page','view'=>'demo']);
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
//        $this->redirect(['act/page','view'=>'demo']);  //首页迁移到cms
//        $this->layout = "main-index"; //必须的，因为默认的error action，需要使用mainnew的模板
//        return $this->render('/site/index');
    }

    /**
     * 下面分别为移动版的几个专区，由于移动版页面少，现在暂时由开发人员结合广告位实现
     * @return type
     */
    public function actionMzgh()
    {
        $this->layout = "main-index";
        return $this->render('mzgh');
    }

    public function actionMyyp()
    {
        $this->layout = "main-index";
        return $this->render('myyp');
    }

    public function actionSpbj()
    {
        $this->layout = "main-index";
        return $this->render('spbj');
    }

    public function actionQssh()
    {
        $this->layout = "main-index";
        return $this->render('qssh');
    }

    public function actionTemai()
    {
        $this->layout = "main-index";
        return $this->render('temai');
    }

}
