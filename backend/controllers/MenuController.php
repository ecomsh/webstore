<?php

namespace backend\controllers;

use Yii;
use backend\models\Menu;
use backend\models\MenuUrl;
use backend\models\MenuSearch;
use backend\models\Cms;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends Controller
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
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex($pagesize = 10)
    {
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        /**
         * 这里是处理搜索与每页显示条数的参数，是GridView使用js的必须参数
         */
        $filterSelector = "#DataTables_Table_0_filter input, #DataTables_Table_0_length select";
        $options = [
            'filterUrl' => Url::to(['menu/index']),
            'filterSelector' => $filterSelector,
        ];

        $en_options = Json::htmlEncode($options);

        /**
         * 处理分页，设置每页显示的条数
         */
        $dataProvider->pagination->pageSizeLimit = [1, 100];
        $dataProvider->pagination->setPageSize($pagesize, true);

        //记录当前页面URL，以便操作之后返回
        Url::remember('','menu');
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
     * Displays a single Menu model.
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
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Menu();
        $menuUrlModel = new MenuUrl();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $postData = Yii::$app->request->post();
            $menuUrlPost['menu_id'] = $model->id;
            if(isset($postData['select-url'])){
                $menuUrlPost['url'] = Yii::$app->request->post('MenuUrl')['url'];
            }else{
                $menuUrlPost['cms_view'] = Yii::$app->request->post('MenuUrl')['cms_view'];
            }
            $menuUrlPost['is_default'] = 1;
            $menuUrlPost['stime'] = 0;
            $menuUrlPost['etime'] = 0;

            if($menuUrlModel->load(['MenuUrl' => $menuUrlPost]) && $menuUrlModel->save()){
                return $this->redirect(['index']);
            }else{
                throw new NotFoundHttpException('设置默认URL失败');
            }
        } else {
            //获取urlList，显示前50个已发布的页面供用户使用
            $platform = isset($_COOKIE['platform']) ? $_COOKIE['platform'] : setcookie('platform',1 , time() + 3600 * 24 * 30, '/');
            $cmsModel = new Cms();
            $urlList = $cmsModel->find()->select(['desc','view'])->where(['platform' => $platform, 'status' => '1'])->orderBy('time desc')->limit(50)->asArray()->all();
            $urlList = ArrayHelper::map($urlList, 'view', 'desc');
            $model->platform = $platform;
            return $this->render('create', [
                'model' => $model,
                'menuUrl' => $menuUrlModel,
                'urlList' => $urlList,
            ]);
        }
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        MenuUrl::deleteAll(['menu_id' => $id]);

        return $this->redirect(['index']);
    }
    
    public function actionPlatform(){
        $platform = Yii::$app->request->get('platform');
        if ($platform)
        {
            setcookie('platform',$platform , time() + 3600 * 24 * 30, '/');
        }
        $this->redirect(Yii::$app->request->headers['Referer']);
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
