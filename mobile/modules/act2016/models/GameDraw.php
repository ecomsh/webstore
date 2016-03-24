<?php

namespace mobile\modules\act2016\models;

use Yii;
use yii\data\ActiveDataProvider;
use mobile\modules\act2016\models\GameWechat;

/**
 * This is the model class for table "{{%cms_game_draw}}"
 */
class GameDraw extends \yii\db\ActiveRecord
{
    /**
     * 获取用户默认抽奖次数
     * @param unknown_type $openId
     * @return unknown
     */
    public function getUserDefaultDrawCount($openId)
    {
    	$count = GameDraw::find()->
    				andWhere(['draw_wechat_openid' => $openId])->
    				andWhere(['draw_type' => 'default'])->
    				count('draw_id');
    	return $count;
    }
    
    /**
     * 设置用户默认抽奖
     * @param unknown_type $count
     * @param unknown_type $openId
     * @param unknown_type $memberId
     * @return boolean
     */
    public function setUserDefaultDraw($count,$openId,$memberId)
    {
    	$date = date('Y/m/d H:i:s',time());
    	
    	$transaction = Yii::$app->db->beginTransaction();
    	try 
    	{
    		//添加默认抽奖
    		for( $i=0; $i<$count; $i++ )
    		{
    			$sql = "insert into cms_game_draw(draw_wechat_openid,draw_member_id,draw_insert_time,draw_update_time) values ('{$openId}','{$memberId}','{$date}','{$date}')";
    			Yii::$app->db->createCommand($sql)->execute();
    		}
    		$transaction->commit();
    		return true;
    	} 
    	catch(Exception $e)
    	{
    		$transaction->rollBack();
    		return false;
    	}
    }
    
    /**
     * 获取用户抽奖次数
     * @param unknown_type $openId
     * @return unknown
     */
    public function getUserDrawCount($openId)
    {
    	$count = GameDraw::find()->
			    	andWhere(['draw_is_use' => '0'])->
			    	andWhere(['draw_wechat_openid' => $openId])->
			    	count('draw_id');
    	return $count;
    }
    
    /**
     * 获取抽奖列表
     * @param unknown_type $openId
     * @return multitype:
     */
    public function getUserDrawList($openId)
    {
    	$sql = "select * from cms_game_draw where draw_wechat_openid = '{$openId}'";
    	return Yii::$app->db->createCommand($sql)->queryAll();
    }
    
    /**
     * 获取用户中奖列表
     * @param unknown_type $openId
     * @return multitype:
     */
    public function getUserWinDrawList($openId)
    {
    	$sql = "select draw.draw_type,draw.draw_award_type,draw.draw_update_time,award.award_name,award.award_bn,award.award_pic_url_s,award.award_pic_url_m,award.award_pic_url_b from cms_game_draw as draw , cms_award_conf as award where draw.draw_award_id = award.award_id and draw.draw_is_use = '1' and draw.draw_is_winning = '1' and draw.draw_wechat_openid = '{$openId}'";
    	
    	return Yii::$app->db->createCommand($sql)->queryAll();
    }
    
    /**
     * 获取一条用户未使用的抽奖信息
     * @param unknown_type $openId
     */
    public function getUserDrawOne($openId)
    {
    	$sql = "select * from cms_game_draw where draw_wechat_openid = '{$openId}' and draw_is_use = '0' order by draw_insert_time limit 1";
    	return Yii::$app->db->createCommand($sql)->queryOne();
    }
    
    /**
     * 根据ID获取用户抽奖信息
     * @param unknown_type $id
     * @return Ambigous <multitype:, boolean>
     */
    public function getUserDrawById($id)
    {
    	$sql = "select * from cms_game_draw where draw_id = '{$id}'";
    	return Yii::$app->db->createCommand($sql)->queryOne();
    }
    
    /**
     * 设置用户邀请抽奖
     * @param unknown_type $referOpenId
     * @return boolean
     */
    public function setUserInviteDraw($referOpenId)
    {
    	$date = date('Y/m/d H:i:s',time());
    	
    	$transaction = Yii::$app->db->beginTransaction();
    	try 
    	{
    		//更新邀请数据
    		$updateInviteSql = "update cms_game_invite set invite_is_convert = '1' , invite_update_time = '{$date}' where invite_refer_openid = '{$referOpenId}' and invite_is_convert = '0' order by invite_insert_time limit 3";
    		Yii::$app->db->createCommand($updateInviteSql)->execute();
    		
    		//添加邀请抽奖
    		$this->draw_wechat_openid = $referOpenId;
    		$this->draw_type = 'invite';
    		$this->draw_rate = 100;
    		$this->draw_award_type = '2';
    		$this->draw_insert_time = $date;
    		$this->save();
    		
    		$transaction->commit();
    		return true;
    	}
    	catch(Exception $e)
    	{
    		$transaction->rollBack();
    		return false;
    	}
    }
    
    /**
     * 设置用户订单抽奖
     * @param unknown_type $memberId
     * @return boolean
     */
    public function setUserOrderDraw($memberId,$rate=100)
    {
    	$date = date('Y/m/d H:i:s',time());
    	$this->draw_wechat_openid = Yii::$app->session['wechat_openId'];
    	$this->draw_member_id = $memberId;
    	$this->draw_type = 'order';
    	$this->draw_rate = $rate;
    	$this->draw_insert_time = $date;
    	return $this->save();
    }
    
    /**
     * 获取用户默认抽奖的是否中奖次数
     * @param unknown_type $openId
     * @return unknown
     */
    public function getUserIsWinDefaultDrawCount($openId,$isWin)
    {
    	$count = GameDraw::find()->
			    	andWhere(['draw_wechat_openid' => $openId])->
			    	andWhere(['draw_type' => 'default'])->
			    	andWhere(['draw_is_use' => '1'])->
			    	andWhere(['draw_is_winning' => $isWin])->
			    	count('draw_id');
    	return $count;
    }
    
    /**
     * 获取商品中奖总数
     * @param unknown_type $openId
     * @param unknown_type $memberId
     * @return unknown
     */
    public function getUserGoodsDrawCount($openId,$memberId)
    {
    	$count = GameDraw::find()->
			    	andWhere(['draw_wechat_openid' => $openId])->
			    	andWhere(['draw_member_id' => $memberId])->
			    	andWhere(['draw_is_use' => '1'])->
			    	andWhere(['draw_is_winning' => '1'])->
			    	andWhere(['draw_award_type' => '3'])->
			    	count('draw_id');
    	
    	return $count;
    }
    
    /**
     * 更新用户抽奖
     * @param unknown_type $id
     * @param unknown_type $openId
     * @param unknown_type $isWin
     * @param unknown_type $data
     * @return Ambigous <number, unknown>
     */
    public function updateUserDraw($id,$openId,$isWin,$data=array())
    {
    	$date = date('Y/m/d H:i:s',time());
    	
    	$transaction = Yii::$app->db->beginTransaction();
    	
    	try 
    	{
	    	$updateSql = "update cms_game_draw set draw_is_use = '1',draw_is_winning='{$isWin}',draw_update_time = '{$date}'";
	    	
	    	if ( $isWin && $data )
	    	{
	    		if ( $data['award_type'] == 1 )
	    		{
	    			$wechatModel = new GameWechat();
	    			$wechatRedPacket = $wechatModel->getOneWechat();
	    			
	    			$updateSql .= ",draw_award_type='{$data['award_type']}',draw_award_id='{$wechatRedPacket['wechat_id']}'";
	    			$updateWechatSql = "update cms_game_wechat set wechat_is_use = '1' where wechat_id = '{$wechatRedPacket['wechat_id']}'";
	    			
	    			Yii::$app->db->createCommand($updateWechatSql)->execute();
	    		}
	    		else
	    		{
	    			$updateSql .= ",draw_award_type='{$data['award_type']}',draw_award_id='{$data['award_id']}'";
	    		}
	    		
	    		$updateAwardSql = "update cms_award_conf set award_store = award_store - 1 where award_id = '{$data['award_id']}'";
	    		
	    		Yii::$app->db->createCommand($updateAwardSql)->execute();
	    	}
	    	
	    	$updateSql .= " where draw_id = '{$id}' and draw_wechat_openid = '{$openId}'";
	    	Yii::$app->db->createCommand($updateSql)->execute();
	    	
	    	$transaction->commit();
	    	return true;
    	}
    	catch(Exception $e)
    	{
    		$transaction->rollBack();
    		return false;
    	}
    }
    
    public function updateDrawSend($id,$send)
    {
    	$updateSql = "update cms_game_draw set draw_is_send = '{$send}' where draw_id = '{$id}'";
    	return Yii::$app->db->createCommand($updateSql)->execute();
    }
}
