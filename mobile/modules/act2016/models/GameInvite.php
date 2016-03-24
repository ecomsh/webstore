<?php

namespace mobile\modules\act2016\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "{{%cms_game_invite}}"
 */
class GameInvite extends \yii\db\ActiveRecord
{
	/**
	 * 添加邀请数据
	 * @param unknown_type $openId
	 * @param unknown_type $referOpenId
	 */
    public function insertInviteData($openId,$referOpenId)
    {
    	//查询该用户是否邀请过
    	$count = GameInvite::find()->
			    	andWhere(['invite_openid' => $openId])->
			    	andWhere(['invite_refer_openid' => $referOpenId])->
			    	count('invite_id');
    	
    	if ( $count == 0 )
    	{
    		$this->invite_openid = $openId;
	    	$this->invite_refer_openid = $referOpenId;
	    	$this->invite_insert_time = date('Y/m/d H:i:s',time());
	    	return $this->save();
    	}
    	
    }
    
    /**
     * 获取未兑换的邀请次数
     * @param unknown_type $referOpenId
     * @return unknown
     */
    public function getNotConvertCount($referOpenId)
    {
    	$count = GameInvite::find()->
					andWhere(['invite_refer_openid' => $referOpenId])->
					andWhere(['invite_is_convert' => '0'])->
					count('invite_id');
    	return $count;
    }
}
