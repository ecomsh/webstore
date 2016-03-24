<?php

namespace mobile\modules\act2016\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "{{%cms_game_wechat}}"
 */
class GameAddress extends \yii\db\ActiveRecord
{
	/**
	 * 获取会员地址
	 * @param unknown_type $openId
	 * @param unknown_type $memberId
	 * @return Ambigous <multitype:, boolean>
	 */
    public function getUserAddress($openId,$memberId)
    {
    	$sql = "select * from cms_game_address where add_open_id = '{$openId}' and add_member_id = '{$memberId}'";
    	return Yii::$app->db->createCommand($sql)->queryOne();
    }
    
    /**
     * 设置会员地址
     * @param unknown_type $data
     * @return Ambigous <multitype:, boolean>
     */
    public function setUserAddress($data)
    {
    	$date = date('Y/m/d H:i:s',time());
    	
    	$address = $this->getUserAddress($data['add_open_id'], $data['add_member_id']);
    	
    	if ( $address )
    	{
    		$sql = "update cms_game_address set add_name = '{$data['add_name']}',add_phone='{$data['add_phone']}',add_address='{$data['add_address']}',add_update_time='{$date}' where add_open_id = '{$data['add_open_id']}' and add_member_id = '{$data['add_member_id']}'";
    	}
    	else
    	{
    		$sql = "insert into cms_game_address (add_open_id,add_member_id,add_name,add_phone,add_address,add_insert_time) values ('{$data['add_open_id']}','{$data['add_member_id']}','{$data['add_name']}','{$data['add_phone']}','{$data['add_address']}','{$date}')";
    	}
    	
    	return Yii::$app->db->createCommand($sql)->execute();
    }
}
