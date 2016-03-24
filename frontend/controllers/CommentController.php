<?php

namespace frontend\controllers;
use Yii;
use frontend\models\CommentApi;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * Site controller
 */
class CommentController extends Controller
{

    //创建一条记录
    const CREATE = 'create';
    //补充一条记录
    const SUPPLEMENT = 'supplement';
    //获取所有列表
    const INDEX = 'index';

    public $layout = "main";

    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\HttpCache',
//              'only' => ['index'],
//                'etagSeed' => function ($action, $params)
//                {
//                    return serialize(['xxxdsdddd', 'dddsd']);
//                },
            ],
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
        $model = new CommentApi();
        //预定义当前场景状态  
        $model->scenario = self::INDEX;        
        $getData = Yii::$app->request->get();        
        $currentPage = isset($getData['page'])?intval($getData['page'])-1:0;//他那边page从0开始算，插件page从1开始
        //$query = Article::find()->where(['status' => 1]);
        //$countQuery = clone $query;
       
       

        /*if ($postData && $id)
        {
            $model->scenario = self::UPDATE;
        } else
        {
            $model->scenario = self::CREATE;
        }*/
        
//TODO::防止重复提交       
//        if(isset($postData['_csrf'])&&Yii::$app->getRequest()->validateCsrfToken($postData['_csrf'])){
//             var_dump($postData['_csrf'],Yii::$app->getRequest()->getCsrfToken());exit;
//             //异常情况处理，记录错误日志，抛出异常
//            Yii::error('操作过于频繁，请稍后...');
//            throw new BadRequestHttpException('操作过于频繁，请稍后...');
//        }

        $this->_setErrors($model);
        $data = $model->getByUserId($userId , 5 , $currentPage);    
        $key = key($data);
        $data = isset($data[$key]) ? $data[$key] : [];
        $pageinfo = $data['pageInfo'];
        $totalCount = intval($pageinfo['totalPage'])* intval($pageinfo['pageSize']);    //算总共的comment的个数
        $key = key($data);
        $data = isset($data[$key]) ? $data[$key] : [];                
        $pages = new Pagination(['totalCount' => $totalCount , 'pageSize' => 5]);
        $editData = [];
        /*if ($id)
        {
            if (!$this->_getAddressById($id, $data, $model))
            {
                $model->isNewRecord = true;
            }else{
                $model->isNewRecord = false;
            }
        }*/
        $this -> layout = "user_main";
        return $this->render('index', [
                    'model' => $model,
                    'data' => $data,       
                    'pages' => $pages,
        ]);
    }
    /**
     * 此处处理较为特殊，因为接口返回的list已经包含完整信息，因此采用遍历的方式去获取需要修改的某一条记录的具体内容
     * 一般情况需要去单独的detail页面进行修改
     * @param type $id
     * @param type $list
     * @param type $model
     * @throws BadRequestHttpException
     */
   
    private function _setErrors($model)
    {
        $e = $model->getErrors();
        $msg = '';
        if ($e & is_array($e))
        {
            foreach ($e as $k => $v)
            {
                if (is_array($v))
                {
                    foreach ($v as $sv)
                    {
                        $msg .= $model->getAttributeLabel($k) . "" . $sv . '</br>';
                    }
                } else
                {
                    $msg .= $model->getAttributeLabel($k) . "" . $v . '</br>';
                }
            }
            Yii::$app->session->setFlash('error', $msg);
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
    public function actionCreate()           
    {
        $userId = Yii::$app->user->getId();
        //初始化api
        $model = new CommentApi();
        //预定义当前场景状态  
        $model->scenario = self::CREATE;
        //判断当前model中的记录是否是全新记录，一般情况下，url中有id就代表旧的数据
        /*if ($id)
            $model->isNewRecord = FALSE;
        else
            $model->isNewRecord = true;*/

        $postData = Yii::$app->request->post();
       
        /*if ($postData && $id)
        {
            $model->scenario = self::UPDATE;
        } else
        {
            $model->scenario = self::CREATE;
        }*/
        
//TODO::防止重复提交       
//        if(isset($postData['_csrf'])&&Yii::$app->getRequest()->validateCsrfToken($postData['_csrf'])){
//             var_dump($postData['_csrf'],Yii::$app->getRequest()->getCsrfToken());exit;
//             //异常情况处理，记录错误日志，抛出异常
//            Yii::error('操作过于频繁，请稍后...');
//            throw new BadRequestHttpException('操作过于频繁，请稍后...');
//        }

        if ($model->load($postData) && $model->validate())
        {
                  
            $postData['CommentApi']['userId'] = $userId;
            $postData['CommentApi']['langId'] = "en-us";             
            $info = $model->createComment($postData['CommentApi']);  
    
            if ($info && is_array($info))
            {
                Yii::$app->session->setFlash('success', '操作成功');
            } else
            {
                //用户操作错误处理，将错误放置于错误flash中，同时记录log日志
                Yii::$app->session->setFlash('error', '系统异常，请稍后重试');
                Yii::error($model->scenario . '地址薄的时候，系统异常，请稍后重试');
            }
            Yii::info('post');
            return $this->redirect(Url::to(['comment/index']));
        }         
        
        else
        {
            //$get =  Yii::$app->request->get();
            $data['productId'] = '10001';  //未来可能是订单列表直接跳转评论添加页面，productId直接get到
            $data['orderItemId'] = time();   //未来可能是订单列表直接跳转评论添加页面，orderItemId直接get到,由于订单不能重复,所以先用时间戳代替
            return $this->render('comment-create', [
                'model' => $model,  
                'data' => $data,
            ]);
        }        
    }
    
    public function actionSupplement()           
    {
        $userId = Yii::$app->user->getId();
        //初始化api
        $model = new CommentApi();
        //预定义当前场景状态  
        $model->scenario = self::SUPPLEMENT;       
        $postData = Yii::$app->request->post();     
           
//TODO::防止重复提交       
//        if(isset($postData['_csrf'])&&Yii::$app->getRequest()->validateCsrfToken($postData['_csrf'])){
//             var_dump($postData['_csrf'],Yii::$app->getRequest()->getCsrfToken());exit;
//             //异常情况处理，记录错误日志，抛出异常
//            Yii::error('操作过于频繁，请稍后...');
//            throw new BadRequestHttpException('操作过于频繁，请稍后...');
//        }
        if ($model->load($postData) && $model->validate())
        {
            $postData['CommentApi']['userId'] = $userId;                      
            $info = $model->supplement($postData['CommentApi']);    
            if ($info && is_array($info))            
            {                
                Yii::$app->session->setFlash('success', '操作成功');                 
            } 
            
            else
            {
                //用户操作错误处理，将错误放置于错误flash中，同时记录log日志
                Yii::$app->session->setFlash('error', '系统异常，请稍后重试');
                Yii::error($model->scenario . '地址薄的时候，系统异常，请稍后重试');
            }            
            
            Yii::info('post');
            return $this->redirect(Url::to(['comment/index']));
        }         
        
        else
        {
            $get =  Yii::$app->request->get();
            $commentId = $get['commentId'];
            //$commentId = 'P12345U876O234';  //未来可能是订单列表直接跳转评论添加页面，productId直接get到 
            $this->_setErrors($model);
            $data = $model->getByCommentId($commentId); 
            $key = key($data);
            $data = isset($data[$key]) ? $data[$key] : [];     
           // var_dump($data);
            return $this->render('comment-supplement', [
                'model' => $model,  
                'data' => $data,
            ]);
        }        
    }


}
