<?php

namespace frontend\modules\actadmin\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "{{%cms_award_conf}}"
 */
class AwardConf extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%award_conf}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['award_name', 'award_bn', 'award_type', 'award_pic_url_s', 'award_pic_url_m', 'award_pic_url_b', 'award_store', 'award_rate', 'award_depict', 'award_state'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'award_id' => 'ID',
            'award_type' => Yii::t('app','类型'),
            'award_name' => Yii::t('app','名称'),
            'award_bn' => Yii::t('app','编号'),
            'award_pic_url_s' => Yii::t('app','小图url'),
            'award_pic_url_m' => Yii::t('app','中图url'),
            'award_pic_url_b' => Yii::t('app','大图url'),
            'award_store' => Yii::t('app','库存'),
            'award_rate' => Yii::t('app','中奖概率（%）'),
            'award_depict' => Yii::t('app','描述'),
            'award_state' => Yii::t('app','状态'),
        ];
    }
    
    public function search($params)
    {
    	$query = AwardConf::find()->select(['award_id','award_type','award_name','award_bn','award_store','award_rate','award_state','award_insert_time','award_update_time']);
    
    	$dataProvider = new ActiveDataProvider([
    			'query' => $query,
    			]);
    
    	$this->load($params);
    
    	$query->orFilterWhere(['like', 'award_name', $this->award_name])
    	->orFilterWhere(['like', 'award_bn', $this->award_name]);
    	$query->orderBy('award_insert_time desc');
    	return $dataProvider;
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
    
	public function getAwardConfById($id)
	{
        $query = $this->find()->where(['award_id' => $id]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }
}
