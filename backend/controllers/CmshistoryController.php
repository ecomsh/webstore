<?php

namespace backend\controllers;

use Yii;
use backend\models\CmsHistory;
use backend\models\Cms;
use backend\models\CmsHistorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\Url;
use common\helpers\Tools;

/**
 * CmsHistoryController implements the CRUD actions for CmsHistory model.
 */
class CmshistoryController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all CmsHistory models.
     * @return mixed
     */
    public function actionIndex($pagesize = 10)
    {
        $searchModel = new CmsHistorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        /**
         * 这里是处理搜索与每页显示条数的参数，是GridView使用js的必须参数
         */
        $filterSelector = "#DataTables_Table_0_filter input, #DataTables_Table_0_length select";
        $options = [
            'filterUrl' => Url::to(['cmshistory/index']),
            'filterSelector' => $filterSelector,
        ];
        
        /**
         * 处理分页，设置每页显示的条数
         */
        $dataProvider->pagination->setPageSize($pagesize,true);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'options' => Json::htmlEncode($options),
            'pagesize' => $pagesize,
        ]);
    }

    /**
     * Displays a single CmsHistory model.
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
     * Creates a new CmsHistory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CmsHistory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CmsHistory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$historyId)
    {
        $model = Cms::findOne($id);
        
        /**
         * 注意此处为ajax验证，需要在html中的$form->field($model, 'identityNumber',['enableAjaxValidation'=>true])...
         * 多用于验证规则复杂或者需要调用后端接口的时候
         */
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) ) {
            Tools::checkRepeatSubmit();
            
            $model->time = time();
            $model->layout = Yii::$app->params['activityConf'][$model->platform][$model->activity]['layout'];
            
            if(CmsHistory::createHistory($id) && $model->save()) {
                return $this->redirect(['//cms/index']);
            }
        } else {
            $historyModel = $this->findModel($historyId);
            $model->template = $historyModel->template;
            
            $history = new CmsHistory();
            $dataProvider = $history->getCmsHistoryById($id);
            $platform = isset($_COOKIE['platform']) ? $_COOKIE['platform'] : setcookie('platform',1 , time() + 3600 * 24 * 30, '/');
            foreach(Yii::$app->params['activityConf'][$platform] as $key => $val){
                $activity[$key] = Yii::t('app',$val['name']);
            }
            return $this->render('//cms/update', [
                'model' => $model,
                'activity' => $activity,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Deletes an existing CmsHistory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionGettemplate(){
        $post = Yii::$app->request->post();
        $model = $this->findModel($post['id']);
        echo $model->template;
    }
    
    public function actionPreview($view, $platform){
        if($platform == 1){
            $url = Yii::getAlias('@frontendUrl') . Url::to(['sandbox/Histories','view'=>$view]);
        }else{
            $url = Yii::getAlias('@mobileUrl') . Url::to(['sandbox/Histories','view'=>$view]);
        }
        $this->redirect($url, 301);
    }

    /**
     * Finds the CmsHistory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CmsHistory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmsHistory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('ssss');
        }
    }
}
