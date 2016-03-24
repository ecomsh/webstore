<?php

namespace frontend\controllers;

use Yii;
use frontend\models\AddressApi;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use common\models\StatisticClient;
use common\helpers\Tools;

/**
 * Site controller
 */
class AddressController extends Controller
{

    //创建一条记录
    const CREATE = 'create';
    //更新一条记录
    const UPDATE = 'update';
    //获取所有列表
    const INDEX = 'index';

    public $layout = "main";

    public function behaviors()
    {
        return [
            'access' => Yii::$app->params['pageAccess']['address']
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
    public function actionIndex($id = 0)
    {
        //现阶段用户模块并没有完成，但是将来用下面的方法获取用户id
        //Yii::$app->user->getId() = 'e468a389-19c1-11e5-bba0-00ffaa3562cc';
        $userId = Yii::$app->user->getId();
        
        //初始化api
        $model = new AddressApi($userId);


        //预定义当前场景状态  
        $model->scenario = self::INDEX;
        //判断当前model中的记录是否是全新记录，一般情况下，url中有id就代表旧的数据
        if ($id)
            $model->isNewRecord = false;
        else
            $model->isNewRecord = true;

        $postData = Yii::$app->request->post();

        if ($postData && $id)
        {
            $model->scenario = self::UPDATE;
        } else
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

        if ($model->load($postData) && $model->validate())
        {
            // Url::remember();
            if ($model->scenario == self::CREATE && Tools::checkRepeatSubmit())
            {
                $info = $model->createAddress($postData['AddressApi']);
            } else if ($model->scenario == self::UPDATE && Tools::checkRepeatSubmit())
            {
                $tmp = $this->_isMyAddressId($id, $userId, $model);

                if ($tmp)
                    $info = $model->updateById($id, $postData['AddressApi']);
                else
                {
                    //异常情况处理，记录错误日志，抛出异常
                    Tools::error('您没有该权限');
                }
            }


            if ($info && is_array($info))
            {
                Yii::$app->session->setFlash('address_success', '操作成功');
            } else
            {
                //用户操作错误处理，将错误放置于错误flash中，同时记录log日志
                $d = Tools::error('99007', '', 'raw', $model->scenario);
                Yii::$app->session->setFlash('address_error', $d['errorMsg']);
            }
            Yii::info('post');
            return $this->refresh();
        } else
        {
            $d = $model->setErrors('raw');
            Yii::$app->session->setFlash('address_error', $d['errorMsg']);
            
            $data = $model->getList();
            $key = key($data);
            $data = isset($data[$key]) ? $data[$key] : [];
            $editData = [];
            if ($id)
            {
                if (!$this->_getAddressById($id, $data, $model))
                {
                    $model->isNewRecord = true;
                } else
                {
                    $model->isNewRecord = false;
                }
            }
            return $this->render('index', [
                        'model' => $model,
                        'data' => $data,
            ]);
        }
    }
    
    public function actionEdit($addressId = ''){
        $this->layout = false;
        $userId = Yii::$app->user->getId();
        
        //初始化api
        $model = new AddressApi($userId);

        //预定义当前场景状态  
        $model->scenario = self::INDEX;
      
        $postData = Yii::$app->request->post();

        if ($postData)
        {
            $model->scenario = 'ajaxcreate';
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }
        
        if ($model->scenario == 'ajaxcreate' && $model->load($postData) && $model->validate())
        {
            $addressId = $postData['addressId'];
            $info = $model->updateById($addressId,$postData['AddressApi']);
            if ($info && is_array($info))
            {
                if (isset($info['errorCode']))
                {
                    return ['status' => false, 'message' => $info['errorMsg']];
                }
                $info['address']['receiverName'] = Tools::substr_mb($info['address']['receiverName'],4);
                $info['address']['address'] = Tools::substr_mb($info['address']['address']);
                return ['status' => true, 'info' => $info['address']];
            } else
            {
                Tools::error($model->scenario . '地址薄的时候，系统异常，请稍后重试');
                return ['status' => false, 'message' => '系统异常，请稍后重试'];
            }
        } else if($model->scenario == 'ajaxcreate'){
            $d = $model->setErrors();
            return $d;
        }else{
            $d = $model->setErrors('raw');
            Yii::$app->session->setFlash('address_error', $d['errorMsg']);
            
            $data = $model->getById($addressId);
            $key = key($data);
            $data = isset($data[$key]) ? $data[$key] : [];
            $model->load(['AddressApi' => $data]);
            return $this->render('edit', [
                        'model' => $model,
                        'addressId' => $addressId,
            ]);
        }
    }

    /**
     * TODO list
     * @return type
     */
    public function actionAjaxcreate()
    {
        $userId = Yii::$app->user->getId();
        $postData = Yii::$app->request->post();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        //初始化api
        $model = new AddressApi($userId);

        $model->scenario = 'ajaxcreate';
        if (Yii::$app->request->isAjax && $model->load($postData, 'AddressApi') && $model->validate())
        {
            $info = $model->createAddress($postData['AddressApi']);
            if ($info && is_array($info))
            {
                if (isset($info['errorCode']))
                {
                    return ['status' => false, 'message' => $info['errorMsg']];
                }
                $info['address']['receiverName'] = Tools::substr_mb($info['address']['receiverName'],4);
                $info['address']['address'] = Tools::substr_mb($info['address']['address']);
                return ['status' => true, 'info' => $info['address']];
            } else
            {
                Tools::error($model->scenario . '地址薄的时候，系统异常，请稍后重试');
                return ['status' => false, 'message' => '系统异常，请稍后重试'];
            }
        }else{
            $d = $model->setErrors();
            return $d;
        }
    }
    
    public function actionAjaxdelete()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $userId = Yii::$app->user->getId();
        $model = new AddressApi($userId);
        
        $addressId = Yii::$app->request->post('addressId');
        
        if (Yii::$app->request->isAjax && $this->_isMyAddressId($addressId, $userId, $model))
        {
            $info = $model->deleteById($addressId);
        }
        
        if (isset($info))
            return ['status' => true];
        else
        {
            $d = Tools::error('99007', '', 'raw');
            return ['status' => false, 'message' => $d['errorMsg']];
        }
    }
    
    public function actionAjaxSetDefault()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $userId = Yii::$app->user->getId();
        $model = new AddressApi($userId);
        
        $addressId = Yii::$app->request->post('addressId');
        
        if (Yii::$app->request->isAjax && $this->_isMyAddressId($addressId, $userId, $model))
        {
            $info = $model->setDefaultById($addressId);
        }
        if (isset($info['address']) && isset($info['address']['isDefault']) && $info['address']['isDefault'])
            return ['status' => true];
        else
        {
            $d = Tools::error('99007', '', 'raw');
            return ['status' => false, 'message' => $d['errorMsg']];
        }
    }
    
    public function actionAjaxUnsetDefault()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $userId = Yii::$app->user->getId();
        $model = new AddressApi($userId);
        
        $addressId = Yii::$app->request->post('addressId');
        
        if (Yii::$app->request->isAjax && $this->_isMyAddressId($addressId, $userId, $model))
        {
            $addressInfo = $model->getById($addressId);
            $addressInfo['address']['isDefault'] = 0;
            
            $info = $model->updateById($addressId, $addressInfo['address']);
        }
        
        if (isset($info['address']))
            return ['status' => true];
        else
        {
            $d = Tools::error('99007', '', 'raw');
            return ['status' => false, 'message' => $d['errorMsg']];
        }
    }

    /**
     * 此处处理较为特殊，因为接口返回的list已经包含完整信息，因此采用遍历的方式去获取需要修改的某一条记录的具体内容
     * 一般情况需要去单独的detail页面进行修改
     * @param type $id
     * @param type $list
     * @param type $model
     * @throws BadRequestHttpException
     */
    private function _getAddressById($id, $list = [], $model)
    {
        if ($id && is_array($list))
        {
            foreach ($list as $k => $v)
            {

                if (isset($v['addressId']) && $v['addressId'] == $id)
                {
                    $tmp['AddressApi'] = $v;
                    if ($model->load($tmp))
                    {
                        return true;
                    }
                }
            }
        } else
        {
            Yii::error('获取地址异常');
            throw new BadRequestHttpException('获取地址异常');
        }
    }

//    public function actionCreate()
//    {
//    }
//
//    public function actionUpdate($id)
//    {
//        
//    }
    public function actionDelete($id)
    {
        //现阶段用户模块并没有完成，但是将来用下面的方法获取用户id
        //Yii::$app->user->getId() = 'e468a389-19c1-11e5-bba0-00ffaa3562cc';

        $userId = Yii::$app->user->getId();
        $model = new AddressApi($userId);
        if ($this->_isMyAddressId($id, $userId, $model)&& Tools::checkRepeatSubmit())
        {
            $info = $model->deleteById($id);
        }
        if (isset($info))
            Yii::$app->session->setFlash('address_success', '操作成功');
        else
        {
            $d = Tools::error('99007', '', 'raw');
            Yii::$app->session->setFlash('address_error', $d['errorMsg']);
        }
        return $this->redirect(['/address/index']);
    }

    public function actionDefault($id)
    {
        //现阶段用户模块并没有完成，但是将来用下面的方法获取用户id
        //Yii::$app->user->getId() = 'e468a389-19c1-11e5-bba0-00ffaa3562cc';

        $userId = Yii::$app->user->getId();
        $model = new AddressApi($userId);
        if ($this->_isMyAddressId($id, $userId, $model))
        {
            $info = $model->setDefaultById($id);
        }
        if (isset($info['address']) && isset($info['address']['isDefault']) && $info['address']['isDefault'])
            Yii::$app->session->setFlash('address_success', '操作成功');
        else
        {
            $d = Tools::error('99007', '', 'raw');
            Yii::$app->session->setFlash('address_error', $d['errorMsg']);
        }
        return $this->redirect(['/address/index']);
    }

    // /member/users/{userId}/addresses/{addressId}/_setDefault
    private function _isMyAddressId($id, $userId, $model)
    {

        $info = $model->getById($id);

        if (isset($info['address']['userId']) && $info['address']['userId'] == $userId)
        {
            return true;
        } else
        {
            return false;
        }
    }

}
