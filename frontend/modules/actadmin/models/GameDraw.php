<?php

namespace frontend\modules\actadmin\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "{{%cms_game_draw}}"
 */
class GameDraw extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%game_draw}}';
    }
    
    public function getDrawReportData( $startDate , $endDate )
    {
    	$reportData = array();
    	
    	//参与抽奖人数
    	$drawCountSql = "select count(*) from cms_game_draw where draw_update_time between '{$startDate}' and '{$endDate}' group by draw_wechat_openid";
    	$reportData['draw_count'] = count(Yii::$app->db->createCommand($drawCountSql)->queryAll());
    	
    	//中奖人数
    	$winCountSql = "select count(*) from cms_game_draw where draw_is_use = '1' and draw_is_winning ='1' and draw_update_time between '{$startDate}' and '{$endDate}' group by draw_wechat_openid";
    	$reportData['win_count'] = count(Yii::$app->db->createCommand($winCountSql)->queryAll());
    	
    	//抽奖4次的人数
    	$draw4CountSql = "select count(*) from cms_game_draw where draw_is_use = '1' and draw_update_time between '{$startDate}' and '{$endDate}' group by draw_wechat_openid having count(*)=4";
    	$reportData['draw4_count'] = count(Yii::$app->db->createCommand($draw4CountSql)->queryAll());
    	
    	//抽奖5次的人数
    	$draw5CountSql = "select count(*) from cms_game_draw where draw_is_use = '1' and draw_update_time between '{$startDate}' and '{$endDate}' group by draw_wechat_openid having count(*)=5";
    	$reportData['draw5_count'] = count(Yii::$app->db->createCommand($draw5CountSql)->queryAll());
    	
    	//抽奖6次的人数
    	$draw6CountSql = "select count(*) from cms_game_draw where draw_is_use = '1' and draw_update_time between '{$startDate}' and '{$endDate}' group by draw_wechat_openid having count(*)=6";
    	$reportData['draw6_count'] = count(Yii::$app->db->createCommand($draw6CountSql)->queryAll());
    	
    	//抽奖7次的人数
    	$draw7CountSql = "select count(*) from cms_game_draw where draw_is_use = '1' and draw_update_time between '{$startDate}' and '{$endDate}' group by draw_wechat_openid having count(*)=7";
    	$reportData['draw7_count'] = count(Yii::$app->db->createCommand($draw7CountSql)->queryAll());
    	
    	//抽奖8次的人数
    	$draw8CountSql = "select count(*) from cms_game_draw where draw_is_use = '1' and draw_update_time between '{$startDate}' and '{$endDate}' group by draw_wechat_openid having count(*)=8";
    	$reportData['draw8_count'] = count(Yii::$app->db->createCommand($draw8CountSql)->queryAll());
    	
    	//抽奖大于8次的人数
    	$drawMoreCountSql = "select count(*) from cms_game_draw where draw_is_use = '1' and draw_update_time between '{$startDate}' and '{$endDate}' group by draw_wechat_openid having count(*)>8";
    	$reportData['draw_more_count'] = count(Yii::$app->db->createCommand($drawMoreCountSql)->queryAll());
    	
    	//红包发放总数
    	$packetCountSql = "select count(*) as num from cms_game_wechat where wechat_is_use = '1' and wechat_update_time between '{$startDate}' and '{$endDate}'";
    	$res = Yii::$app->db->createCommand($packetCountSql)->queryAll();
    	$reportData['packet_count'] = $res[0]['num']?$res[0]['num']:0;
    	
    	//红包发放总金额
    	$packetTotalSql = "select sum(wechat_money) as total from cms_game_wechat where wechat_is_use = '1' and wechat_update_time between '{$startDate}' and '{$endDate}'";
    	$res = Yii::$app->db->createCommand($packetTotalSql)->queryAll();
    	$reportData['packet_total'] = $res[0]['total']?$res[0]['total']:0;
    	
    	//优惠券发放
    	$couponCountSql = "select count(*) as num from cms_game_draw where draw_is_use = '1' and draw_is_winning ='1' and draw_award_type = '2' and draw_update_time between '{$startDate}' and '{$endDate}'";
    	$res = Yii::$app->db->createCommand($couponCountSql)->queryAll();
    	$reportData['coupon_count'] = $res[0]['num']?$res[0]['num']:0;
    	
    	return $reportData;
    }
    
    public function findModel($id)
    {
    	if (($model = GameDraw::findOne($id)) !== null)
    	{
    		return $model;
    	} else
    	{
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }
}
