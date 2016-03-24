<?php

namespace frontend\controllers;

use Yii;
use frontend\models\PassportApi;
use frontend\models\ChangePasswordForm;
use frontend\models\IdentityApi;
use frontend\models\BindMobileForm;
use yii\web\Controller;
use yii\helpers\Url;

/**
 * Site controller
 */
class UserController extends Controller
{

    const AJAXMOBILE = 'ajaxMobile';
    const AJAXSMSCODE = 'ajaxsmsCode';

    public function behaviors()
    {
        return [
            'access' => Yii::$app->params['pageAccess']['user']
        ];
    }

    public function actionIndex()
    {
//        $this->layout = "main";
//        return $this->render('/user/usercenter');
          $this->redirect(Url::to(['user/setting']));
    }

    public function actionFavorite()
    {
        $this->layout = "main";
        return $this->render('/user/favorite');
    }

    public function actionSfavorite()
    {
        $this->layout = "main";
        return $this->render('/user/sfavorite');
    }

    public function actionAsk()
    {
        $this->layout = "main";
        return $this->render('/user/ask');
    }

    public function actionHistory()
    {
        $this->layout = "main";
        return $this->render('/user/history');
    }

    public function actionBuy()
    {
        $this->layout = "main";
        return $this->render('/user/buy');
    }

    public function actionCoupon()
    {
        $this->layout = "main";
        return $this->render('/user/coupon');
    }

    public function actionBalance()
    {
        $this->layout = "main";
        return $this->render('/user/balance');
    }

    public function actionDeposit()
    {
        $this->layout = "main";
        return $this->render('/user/deposit');
    }

    public function actionEmails()
    {
        $this->layout = "main";
        return $this->render('/user/emails');
    }

    public function actionSetting()
    {
        $model = new BindMobileForm();

        $this->layout = "main";
        $userId = Yii::$app->user->getId();
        $request = Yii::$app->request;
        $session = Yii::$app->session;

        $postData = $request->post();
        $model->scenario = 'index';
        //是ajax 进行验证码 验证
        $model->load($postData);
        if ($request->getIsAjax())
        {
            if (isset($postData['BindMobileForm']['smsCode']))
            {
                $model->scenario = 'ajaxsmsCode';
            } else
            {
                $model->scenario = 'ajaxMobile';
            }
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }

        //是post 进行提交form 表单
        if ($request->isPost && isset($userId) && $model->validate())
        {
            $postData['BindMobileForm']['stub'] = $session['stubCode'];
            $api = new IdentityApi($userId);
            $params['identityType'] = 'mobile';
            $params['identityCode'] = $postData['BindMobileForm']['mobile'];
            $params['userId'] = $userId;

            $user = $api->bindUser($params);
            if (isset($user))
            {
                Yii::$app->session->setFlash('success', '绑定成功');
                return $this->render('setting', ['model' => $model]);
            } else
            {
                Yii::$app->session->setFlash('error', '绑定失败');
                return $this->refresh();
            }
        }

        //最后是get 默认处理
        if ($userId)
        {
            $passport = new PassportApi($userId);
            $userInfo = $passport->getPassportByUserId($userId);

            if (isset($userInfo) && $userInfo['passport'])
            {
            	if (isset($userInfo['passport']['mobile']) && $userInfo['passport']['mobileVerified'] == true)
            	{
            		$model->mobile = $userInfo['passport']['mobile'];
            	}
            }

            return $this->render('/user/setting', ['model' => $model]);
        } else
        {
            return $this->goHome();
        }
    }

    public function actionSecurity()
    {
        $this->layout = "main";
        $userId = Yii::$app->user->getId();
        $postData = Yii::$app->request->post();
        $session = Yii::$app->session;
        $model = new ChangePasswordForm();
        /**
         * 注意model validate 之后需要同时添加验证有
         */
          $model->scenario = 'index';
        if ($model->load($postData) && $model->validate())
        {
            if ($userId)
            {
                $idApi = new IdentityApi($userId);
                $postData['ChangePasswordForm']['userId'] = $userId;
                $params = [
                    'userId' => $userId,
                    'oldPassword' => $postData['ChangePasswordForm']['oldPassword'],
                    'password' => $postData['ChangePasswordForm']['password']
                ];
                $identity = $idApi->changePwd($params);

                if (isset($identity) && $identity['identity']['resultCode'] == '00')
                {
                    $session->setFlash('security_success', '修改密码成功！');
                    return $this->refresh();
                } else
                {
                    $session->setFlash('security_error', '旧密码错误');
                    return $this->refresh();
                }
            }
        } 
        if ($userId)
        {
            return $this->render('security', [
                        'model' => $model,
            ]);
        }
    }

    public function actionReceiver()
    {
        $this->layout = "main";
        return $this->render('/user/receiver');
    }

    public function actionPoint()
    {
        $this->layout = "main";
        return $this->render('/user/point');
    }

    public function actionViewhistory()
    {
        $this->layout = "main";
        return $this->render('/user/viewhistory');
    }

    public function actionComplain()
    {
        $this->layout = "main";
        return $this->render('/user/complain');
    }

    public function actionReports()
    {
        $this->layout = "main";
        return $this->render('/user/reports');
    }

    public function actionOrdermsg()
    {
        $this->layout = "main";
        return $this->render('/user/ordermsg');
    }

    public function actionRefund()
    {
        $this->layout = "main";
        return $this->render('/user/refund');
    }

    public function actionDofinish()
    {
        $this->layout = "main";
        return $this->render('/user/dofinish');
    }

    /**
     * 获取验证码
     */
    public function actionGetsmscode()
    {
        $request = Yii::$app->request;
        $mobilenumber = $request->get('mobile');
        $type = $request->get('type');
        $IdApi = new IdentityApi ();
        $stub = $IdApi->getSMSCode($mobilenumber, $type);
        $session = Yii::$app->session;
        $session ['smsStub'] = $stub ['identity'] ['validationStub'];
        return json_encode($stub);
    }

    public function actionValmobile()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new BindMobileForm();
        $request = Yii::$app->request;
        $data = $request->get();
        $model->scenario = 'ajaxMobile';
        $model->load($data);
        $val = $model->validate();
        $error = $model->getErrors();
        return $error;
    }

}
