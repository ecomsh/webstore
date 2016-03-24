<?php

namespace backend\controllers;

use Yii;
use backend\models\MenuUrl;
use backend\models\MenuUrlSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use backend\models\Cms;
/**
 * MenuUrlController implements the CRUD actions for MenuUrl model.
 */
class MenuurlController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all MenuUrl models.
     * @return mixed
     */
    public function actionIndex($pagesize = 10)
    {
        $searchModel = new MenuUrlSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        /**
         * 这里是处理搜索与每页显示条数的参数，是GridView使用js的必须参数
         */
        $filterSelector = "#DataTables_Table_0_filter input, #DataTables_Table_0_length select";
        $options = [
            'filterUrl' => Url::to(['menuurl/index']),
            'filterSelector' => $filterSelector,
        ];

        $en_options = Json::htmlEncode($options);

        /**
         * 处理分页，设置每页显示的条数
         */
        $dataProvider->pagination->pageSizeLimit = [1, 100];
        $dataProvider->pagination->setPageSize($pagesize, true);

        //记录当前页面URL，以便操作之后返回
        Url::remember();
        
        $platform = isset($_COOKIE['platform']) ? $_COOKIE['platform'] : setcookie('platform',1 , time() + 3600 * 24 * 30, '/');
        
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'options' => $en_options, //Json::htmlEncode($options),// ??
                    'pagesize' => $pagesize,
                    'platform' => $platform,
            
        ]);
    }

    /**
     * Displays a single MenuUrl model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MenuUrl model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MenuUrl();
        $postData = Yii::$app->request->post();
        if(!empty($postData)){
            if(isset($postData['MenuUrl']['stime'])){
                $postData['MenuUrl']['stime'] = strtotime($postData['MenuUrl']['stime']);
            }
            if(isset($postData['MenuUrl']['etime'])){
                $postData['MenuUrl']['etime'] = strtotime($postData['MenuUrl']['etime']);
            }
            $postData['MenuUrl']['is_default'] = 2;
            if(isset($postData['select-url'])){
                $postData['MenuUrl']['cms_view'] = '';
            }else{
                $postData['MenuUrl']['url'] = '';
            }
        }
        
        if ($model->load($postData)) {
            if($model->validate()){
                if($model->save()){
                    return $this->redirect(['index', 'MenuUrlSearch[menu_id]' => $model->menu_id]);
                }
            }else{
                $errors = $model->getErrors();
                $errors = reset($errors);
                \common\helpers\Tools::error('400000',$errors[0]);
            }
        } else {
            if(!empty($postData)){
                $model->stime = date('Y-m-d H:i:s', $postData['MenuUrl']['stime']);
                $model->etime = date('Y-m-d H:i:s', $postData['MenuUrl']['etime']);
            }
        
            //获取urlList，显示前50个已发布的页面供用户使用
            $platform = isset($_COOKIE['platform']) ? $_COOKIE['platform'] : setcookie('platform',1 , time() + 3600 * 24 * 30, '/');
            $cmsModel = new Cms();
            $urlList = $cmsModel->find()->select(['desc','view'])->where(['platform' => $platform, 'status' => '1'])->orderBy('time desc')->limit(50)->asArray()->all();
            $urlList = ArrayHelper::map($urlList, 'view', 'desc');
            
            //为使时间段不重复，指定新建的开始时间为上一个url时间段的结束时间，如果没有上一个url，则为当前时间
            $previousRow = $model->find()->where(['menu_id' => Yii::$app->request->get('menu_id'), 'is_default' => '2'])->orderBy('id desc')->asArray()->one();
            if(isset($previousRow)){
                $startDate = date('Y-m-d H:i:s',$previousRow['etime']);
            }else{
                $startDate = date('Y-m-d H:i:s',time());
            }
            
            $model->menu_id = Yii::$app->request->get('menu_id');
            
            return $this->render('create', [
                'model' => $model,
                'startDate' => $startDate,
                'endDate' => '',
                'urlList' => $urlList,
            ]);
        }
    }

    /**
     * Updates an existing MenuUrl model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $postData = Yii::$app->request->post();
        
        if(!empty($postData)){
            if(isset($postData['MenuUrl']['stime'])){
                $postData['MenuUrl']['stime'] = strtotime($postData['MenuUrl']['stime']);
            }
            if(isset($postData['MenuUrl']['etime'])){
                $postData['MenuUrl']['etime'] = strtotime($postData['MenuUrl']['etime']);
            }
            $postData['MenuUrl']['is_default'] = $model->is_default;
            if(isset($postData['select-url'])){
                $model->cms_view = '';
                $postData['MenuUrl']['cms_view'] = '';
            }else{
                $model->url = '';
                $postData['MenuUrl']['url'] = '';
            }
        }

        if ($model->load($postData) && $model->save()) {
            return $this->redirect(['index', 'MenuUrlSearch[menu_id]' => $model->menu_id]);
        } else {
            //获取urlList，显示前50个已发布的页面供用户使用
            $platform = isset($_COOKIE['platform']) ? $_COOKIE['platform'] : setcookie('platform',1 , time() + 3600 * 24 * 30, '/');
            $cmsModel = new Cms();
            $urlList = $cmsModel->find()->select(['desc','view'])->where(['platform' => $platform, 'status' => '1'])->orWhere(['view' => $model->url])->orderBy('time desc')->limit(50)->asArray()->all();
            $urlList = ArrayHelper::map($urlList, 'view', 'desc');
            
            //为使时间段不重复，指定开始时间为上一个url时间段的结束时间，如果没有上一个url，则为当前时间
            $previousRow = $model->find()->where(['menu_id' => $model->menu_id, 'is_default' => '2'])->andWhere(['<', 'id', $model->id])->orderBy('id desc')->asArray()->one();
            if(isset($previousRow)){
                $startDate = date('Y-m-d H:i:s',$previousRow['etime']);
            }else{
                $startDate = date('Y-m-d H:i:s',time());
            }
            
            //为使时间段不重复，指定结束时间为下一个url时间段的开始时间，如果没有下一个url，则不限制结束时间
            $afterRow = $model->find()->where(['menu_id' => $model->menu_id, 'is_default' => '2'])->andWhere(['>', 'id', $model->id])->asArray()->one();
            
            if(isset($afterRow)){
                $endDate = date('Y-m-d H:i:s',$afterRow['stime']);
            }else{
                $endDate = '';
            }

            $model->stime = date("Y-m-d H:i:s", $model->stime);
            $model->etime = date("Y-m-d H:i:s", $model->etime);
            return $this->render('update', [
                'model' => $model,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'urlList' => $urlList,
            ]);
        }
    }

    /**
     * Deletes an existing MenuUrl model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['index', 'MenuUrlSearch[menu_id]' => $model->menu_id]);
    }

    /**
     * Finds the MenuUrl model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MenuUrl the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MenuUrl::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
