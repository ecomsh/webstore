<?php

namespace frontend\controllers;

use Yii;
use frontend\models\AccountApi;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\helpers\Tools;


/**
 * Site controller
 */
class AccountController extends Controller {

    public $layout = "main";
    
    public function behaviors()
    {
        return [
            'access' => Yii::$app->params['pageAccess']['account']
        ];
    }
    
     public function actionIndex($id = 0)
    {
         $userId = Yii::$app->user->getId();
         //初始化api
         $model = new AccountApi($userId);
         $balance = $model->getAccountInfo();
         $remain = 0;
         if ($balance && is_array($balance) && isset($balance['account']))
         {
             $remain = isset($balance['account']['remainingAmount']) ? $balance['account']['remainingAmount']:0;

             //TODO Check whether the userId is authorized
         }
         else{
             Tools::error('99002', '获取账户余额失败, user id is' . $userId);
         }
//         $record = $model->getAccountRecord();
//         if ($record && is_array($record) && isset($record['account']))
//         {
//             $record = isset($record['account']) ? $record['account']:[];
//         }
//         else{
//              Tools::error('99002', '获取账户记录失败');
//         }
         return $this->render('index', [
                        'remain' => $remain,
//                        'record' => $record
            ]);
     }
     /*
     public function actionDeposit()
     {
        $userId = Yii::$app->user->getId();
         $userId = 'jiayy'; //fixme
         //初始化api
         $model = new AccountApi($userId);
         $balance = $model->getAccountInfo();
         if ($balance && is_array($balance) && isset($balance['account']))
         {
             $remain = isset($balance['account']['remainingAmount']) ? $balance['account']['remainingAmount']:'';

             //TODO Check whether the userId is authorized
         }
         else{
             Tools::error('99002', '获取账户余额失败');
         }
         
        return $this->render('deposit', [
                        'remain' => $remain
            ]);
     }
     
     public function actionPay()
     {
        $userId = Yii::$app->user->getId();
         $userId = 'jiayy'; //fixme
         $payment = Yii::$app->request->post('payment');
         $amount = $payment['money'];
         //初始化api
         $model = new AccountApi($userId);
         $rc = $model->depositForAccount($amount);
         if ($rc && is_array($rc) && isset($rc['account']))
         {
             $rc = $rc['account'];
             if ($rc['format'] === 'html') {
                $result = $rc['data'];
              } else {
                $result = array();
              }
         }
         else{
             Tools::error('99002', '充值失败');
         }
        return $this->render('pay', [
                        'payPage' => $result
            ]);
     }
      */
}

