<?php

namespace mobile\modules\act2016\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "{{%cms_award_conf}}"
 */
class AwardConf extends \yii\db\ActiveRecord
{
	/**
	 * 获取奖品列表
	 * @return multitype:
	 */
    public function getAwardList()
    {
    	$sql = "select * from cms_award_conf where award_state = '1' and award_store > '0'";
    	return Yii::$app->db->createCommand($sql)->queryAll();
    }
    
    /**
     * 获取奖品
     * @param unknown_type $id
     * @return Ambigous <multitype:, boolean>
     */
    public function getAwardById($id)
    {
    	$sql = "select * from cms_award_conf where award_id = '{$id}'";
    	return Yii::$app->db->createCommand($sql)->queryOne();
    }
}
