<?php

namespace frontend\modules\actadmin\controllers;

use Yii;
use frontend\modules\actadmin\models\AwardConf;
use frontend\modules\actadmin\models\GameWechat;
use frontend\modules\actadmin\models\GameDraw;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\Url;
use common\helpers\Tools;

class AwardController extends Controller
{
	/**
	 * 摇一摇奖品列表页
	 * @param unknown_type $pagesize
	 */
	public function actionIndex($pagesize = 10)
	{
		$searchModel = new AwardConf();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		//这里是处理搜索与每页显示条数的参数，是GridView使用js的必须参数
		$filterSelector = "#DataTables_Table_0_filter input, #DataTables_Table_0_length select";
		$options = [
			'filterUrl' => Yii::$app->request->url,
			'filterSelector' => $filterSelector,
		];
		
		$en_options = Json::htmlEncode($options);
		
		//处理分页，设置每页显示的条数
		$dataProvider->pagination->pageSizeLimit = [1, 100];
		$dataProvider->pagination->setPageSize($pagesize, true);
		
		//记录当前页面URL，以便操作之后返回
		Url::remember();
		$this->layout = 'main';
		return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'options' => $en_options,
                    'pagesize' => $pagesize,
        ]);
	}
	
	/**
	 * 更改奖品状态
	 */
	public function actionChangestate()
	{
		$id = Yii::$app->request->get('id');
		
		$model = $this->findModel($id);
		$model->award_state = Yii::$app->request->get('state');
		$model->award_update_time = date('Y/m/d H:i:s',time());
		
		if ( $model->save() )
		{
			Yii::$app->session->setFlash('success', '操作成功');
		}
		else
		{
			$errors = $model->getErrors();
			$key = key($errors);
			Yii::$app->session->setFlash('error', $errors[$key][0]);
		}
		return $this->redirect(['index']);
	}
	
	/**
	 * 创建奖品
	 * @throws NotFoundHttpException
	 */
	public function actionCreate()
	{
		$model = new AwardConf();
		
		if ($model->load(Yii::$app->request->post())&&$model->validate())
		{
			Tools::checkRepeatSubmit();
			
			$model->award_insert_time = date('Y/m/d H:i:s',time());
			$model->award_update_time = date('Y/m/d H:i:s',time());
			
			if ($model->save())
            {
            	Yii::$app->session->setFlash('success', '操作成功');
            } 
            else
            {
            	$errors = $model->getErrors();
            	$key = key($errors);
            	Yii::$app->session->setFlash('error', $errors[$key][0]);
            }
            return $this->redirect(['index']);
		}
		else 
		{
			$this->layout = 'main';
			return $this->render('create', [
						'model' => $model,
					]);
		}
	}
	
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		
		if ($model->load(Yii::$app->request->post())&&$model->validate())
		{
			Tools::checkRepeatSubmit();
			
			$model->award_update_time = date('Y/m/d H:i:s',time());
				
			if ($model->save())
			{
				Yii::$app->session->setFlash('success', '操作成功');
			}
			else
			{
				$errors = $model->getErrors();
				$key = key($errors);
				Yii::$app->session->setFlash('error', $errors[$key][0]);
			}
			return $this->redirect(['index']);
		}
		else
		{
			$awardConf = new AwardConf();
			$dataProvider = $awardConf->getAwardConfById($id);
			
			$this->layout = 'main';
			return $this->render('update', [
						'model' => $model,
						'dataProvider' => $dataProvider,
					]);
		}
	}
	
	public function actionWechat()
	{
		$gameWechatModel = new GameWechat();
		$wechatCount = $gameWechatModel->getWechatCount();
		
		$this->layout = 'main';
		return $this->render('wechat_index', [
				'wechatCount' => $wechatCount,
				]);
	}
	
	public function actionReport()
	{
		$date = Yii::$app->request->post('date');
		$date = $date ? $date : date('Y-m-d',time());
		$startDate = $date.' 00:00:00';
		$endDate = $date.' 23:59:59';
		
		$drawModel = new GameDraw();
		$reportData = $drawModel->getDrawReportData($startDate, $endDate);
		
		$this->layout = 'main';
		return $this->render('report', [
				'today' => $date,
				'reportData' => $reportData,
				]);
	}
	
	public function actionCreatewechat()
	{
		@ini_set('memory_limit','1G');
		set_time_limit(1800);
		
		$randArray = $this->getRandArray();
		
		echo array_sum($randArray).'<br>';
		print_r($randArray);
		
		die;
		//Yii::$app->session['rand_arr'] = $randArray;
		//$randArray = Yii::$app->session['rand_arr'];
		
		$date = date( 'Y/m/d H:i:s' , time() );
		foreach ( $randArray as $key => $value )
		{
			$model = new GameWechat();
			
			$model->wechat_money = $value;
			$model->wechat_insert_time = $date;
			$model->wechat_update_time = $date;
			$model->save();
			
			unset($model);
		}
		echo 'create OK';
	}
	
	private function getRandArray()
	{
		$wechatConfig = array(
				'total' => 30000,//总金额
				'count' => 15000,//总数
				'min' => 1,//最小金额
				'max' => 5,//最大金额
		);
		
		$avg = $wechatConfig['total'] / $wechatConfig['count'];
		
		$rand2 = round( 3 + mt_rand() / mt_getrandmax() * $wechatConfig['min'] , 2 );
		//echo $rand2;die;
		$arr = array();
		for ( $i=0; $i<$wechatConfig['count']; $i++ )
		{
			$rand = round( $wechatConfig['min'] + mt_rand() / mt_getrandmax() * ( $wechatConfig['max'] - $wechatConfig['min'] ) , 2 );
			
			if ( $rand >= $avg )
			{
				$money = round($rand/$rand2,2);
			}
			else
			{
				$money = $rand;
			}
				
			$arr[$i] = $money;
		}
		
		if ( array_sum( $arr ) < $wechatConfig['total'] )
		{
			return $arr;
		}
		else
		{
			$this->getRandArray();
		}
	}
	
	protected function findModel($id)
	{
		if (($model = AwardConf::findOne($id)) !== null)
		{
			return $model;
		} 
		else
		{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}