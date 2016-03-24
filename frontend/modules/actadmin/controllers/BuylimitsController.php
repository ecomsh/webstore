<?php

namespace frontend\modules\actadmin\controllers;

use Yii;
use frontend\modules\actadmin\models\Buylimits;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\Url;
use common\helpers\Tools;

class BuylimitsController extends Controller
{
	public function actionIndex($pagesize = 10)
	{
		$buylimitsModel = new Buylimits();
		$itemData = $buylimitsModel->getBuylimitsItems();
		$itemData['count'] = $itemData['limits_item'] ? count(explode(',', $itemData['limits_item'])) : 0;
		
		$this->layout = 'main';
		return $this->render('index', [
							'itemData' => $itemData,
						]);
	}
	
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		
		if ($model->load(Yii::$app->request->post())&&$model->validate())
		{
			Tools::checkRepeatSubmit();
		
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
			$buylimitsModel = new Buylimits();
			$dataProvider = $buylimitsModel->getBuylimitsById($id);
				
			$this->layout = 'main';
			return $this->render('update', [
					'model' => $model,
					'dataProvider' => $dataProvider,
					]);
		}
	}
	
	protected function findModel($id)
	{
		if (($model = Buylimits::findOne($id)) !== null)
		{
			return $model;
		}
		else
		{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}