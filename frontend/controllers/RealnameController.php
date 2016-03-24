<?php

namespace frontend\controllers;

use Yii;
use frontend\models\RealnameApi;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\helpers\Tools;

/**
 * Site controller
 */
class RealnameController extends Controller
{

    //创建一条记录
    const CREATE = 'create';
    //获取所有列表
    const INDEX = 'index';

    public $layout = "main";

    public function behaviors()
    {
        return [
            'access' => Yii::$app->params['pageAccess']['realname'],
                /* [
                  'class' => 'yii\filters\HttpCache',
                  //  'only' => ['index'],
                  //                'etagSeed' => function ($action, $params)
                  //                {
                  //                    return serialize(['xxxdsdddd', 'dddsd']);
                  //                },
                  ], */
        ];
    }

    /**
     * 昨晚邮件里给了你一批新的测试id 

      3:25:59 AM: 6471120861615882072
      2888760349360512009
      1071972004169623239
      6296070117947500081
      4692625984968512990
      6828204151415112094
      9158401335075261813
      6482436603782325490
      8582210074373543566
     * @param type $id
     * @return type
     * @throws BadRequestHttpException
     * 
     */
    public function actionIndex()
    {

        //现阶段用户模块并没有完成，但是将来用下面的方法获取用户id
        //Yii::$app->user->getId() = 'e468a389-19c1-11e5-bba0-00ffaa3562cc';
        $userId = Yii::$app->user->getId();
        $getData = Yii::$app->request->get();
        //初始化api

        $model = new RealnameApi($userId);
        //预定义当前场景状态  
        $model->scenario = self::INDEX;
        //判断当前model中的记录是否是全新记录，一般情况下，url中有id就代表旧的数据 
        $postData = Yii::$app->request->post();

        if ($postData)
        {
            $model->scenario = self::CREATE;
        }

//TODO::防止重复提交       
//        if(isset($postData['_csrf'])&&Yii::$app->getRequest()->validateCsrfToken($postData['_csrf'])){
//             var_dump($postData['_csrf'],Yii::$app->getRequest()->getCsrfToken());exit;
//             //异常情况处理，记录错误日志，抛出异常
//            Yii::error('操作过于频繁，请稍后...');
//            throw new BadRequestHttpException('操作过于频繁，请稍后...');
//        }
        /**
         * 注意此处为ajax验证，需要在html中的$form->field($model, 'identityNumber',['enableAjaxValidation'=>true])...
         * 多用于验证规则复杂或者需要调用后端接口的时候
         */
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }

        if ($model->load($postData) && $model->validate())
        {

            if ($model->scenario == self::CREATE)
            {
                $info = $model->createRealname($postData['RealnameApi']);
            }
            if ($info && is_array($info))
            {
                Yii::$app->session->setFlash('realname_success', '操作成功');
            } else
            {
                //用户操作错误处理，将错误放置于错误flash中，同时记录log日志
                Yii::$app->session->setFlash('realname_error', '系统异常，请稍后重试');
                Yii::error($model->scenario . '系统异常，请稍后重试');
            }
            Yii::info('post');
            if (isset($getData['returnUrl']) && !empty($getData['returnUrl']))
            {
                return $this->redirect($getData['returnUrl']);
            } else
            {
                return $this->refresh();
            }
        } else
        {
            $d = $model->setErrors('raw');
            Yii::$app->session->setFlash('realname_error', $d['errorMsg']);
            $data = $model->getById();
            if ($data)
            {
                $model->load($data, 'realname');
            }
            return $this->render('index', [
                        'model' => $model,
            ]);
        }
    }

    public function actionAjaxcreate()
    {
        $userId = Yii::$app->user->getId();
        $postData = Yii::$app->request->post();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        //初始化api
        $model = new RealnameApi($userId);

        $model->scenario = self::CREATE;
        if (Yii::$app->request->isAjax && $model->load($postData, 'RealnameApi') && $model->validate())
        {
            $info = $model->createRealname($postData['RealnameApi']);
            if ($info && is_array($info))
            {
                if (isset($info['errorCode']))
                {
                    return ['status' => false, 'message' => $info['errorMsg']];
                }
                return ['status' => true, 'info' => $info['realname']];
            } else
            {
                Tools::error($model->scenario . '地址薄的时候，系统异常，请稍后重试');
                return ['status' => false, 'message' => '系统异常，请稍后重试'];
            }
        } else
        {
            $d = $model->setErrors();
            return $d;
        }
    }

}
