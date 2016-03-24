<?php

namespace mobile\modules\act2016\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "{{%cms_game_wechat}}"
 */
class GameWechat extends \yii\db\ActiveRecord
{
	/**
	 * 随机获取一个微信红包信息
	 * @return Ambigous <multitype:, boolean>
	 */
	public function getOneWechat()
	{
		$sql = "select * from cms_game_wechat where wechat_is_use = '0' order by rand() limit 1";
		return Yii::$app->db->createCommand($sql)->queryOne();
	}
	
	/**
	 * 
	 * @param unknown_type $id
	 * @return Ambigous <multitype:, boolean>
	 */
	public function getWechatById($id)
	{
		$sql = "select * from cms_game_wechat where wechat_id = '{$id}'";
		return Yii::$app->db->createCommand($sql)->queryOne();
	}
}
