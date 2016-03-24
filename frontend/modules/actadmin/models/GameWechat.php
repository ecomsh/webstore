<?php

namespace frontend\modules\actadmin\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "{{%cms_game_wechat}}"
 */
class GameWechat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%game_wechat}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wechat_money'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wechat_id' => 'ID',
            'wechat_money' => Yii::t('app','金额'),
            'wechat_is_use' => Yii::t('app','是否使用'),
        ];
    }
    
    public function getWechatCount()
    {
    	$wechatCount['num_total'] = GameWechat::find()->andWhere(['wechat_is_use' => '1'])->count('wechat_id');
    	
    	$res = GameWechat::findBySql("select sum(wechat_money) as wechat_money from cms_game_wechat where wechat_is_use = '1'")->one();
    	$wechatCount['use_total_amount'] = $res['wechat_money']?$res['wechat_money']:0;
    	
    	$res = GameWechat::findBySql("select sum(wechat_money) as wechat_money from cms_game_wechat where wechat_is_use = '0'")->one();
    	$wechatCount['not_use_total_amount'] = $res['wechat_money']?$res['wechat_money']:0;
    	return $wechatCount;
    }
    
    public function findModel($id)
    {
    	if (($model = GameWechat::findOne($id)) !== null)
    	{
    		return $model;
    	} else
    	{
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }
}
