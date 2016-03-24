<?php

namespace frontend\modules\actadmin\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "{{%cms_game_buylimits}}"
 */
class Buylimits extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%game_buylimits}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['limits_item'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'limits_item' => Yii::t('app','限购商品编号')
        ];
    }
    
	public function getBuylimitsItems()
	{
        $sql = "select * from cms_game_buylimits limit 1";
		return Yii::$app->db->createCommand($sql)->queryOne();
    }
    
    public function findModel($id)
    {
    	if (($model = AwardConf::findOne($id)) !== null)
    	{
    		return $model;
    	} else
    	{
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }
    
    public function getBuylimitsById($id)
    {
    	$query = $this->find()->where(['limits_id' => $id]);
    
    	$dataProvider = new ActiveDataProvider([
    			'query' => $query,
    			]);
    	return $dataProvider;
    }
}
