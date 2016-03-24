<?php

namespace common\helpers;

use Yii;
use common\models\OrderBaseApi;

class Buylimits 
{
	private $time;
	private $items;
	private $config = array(
							'strat' => '2015-12-05 00:00:00',
							'end' => '2015-12-12 23:59:59',
							'timeOut' => 2400,
							'explain' => '您今天已购买过爆款商品baokuanshangpin',
						);
	
	public function __construct()
	{
		date_default_timezone_set("PRC");
		$this->time = time();
		$this->items = $this->getBuyLimisItems();
	}
	
	/**
	 * 判断指定商品是否购买过（爆款）
	 * @param unknown_type $memberId
	 * @param unknown_type $itemId
	 * @return boolean
	 */
	public function isBuyItem($memberId,$itemId)
	{
		//判断是否爆款商品
		if ( $this->time >= strtotime( $this->config['strat'] ) && $this->time <= strtotime( $this->config['end'] ) && in_array( $itemId , $this->items ) )
		{
			$itembuylog = $this->getUserTodayItemBuyLog($memberId, $itemId);
			if ( $itembuylog )
			{
				//判断是否购买
				if ( $itembuylog['ibl_order_state'] == 1 )
				{
					//订单交易完成
					$result['no_buy'] = true;
					$result['depict'] = $this->config['explain'];
				}
				elseif( $itembuylog['ibl_order_state'] == 0 )
				{
					//判断购买记录是否超时
					if ( $this->time - strtotime($itembuylog['ibl_insert_time']) <= $this->config['timeOut'] )
					{
						//订单未超时，不能购买
						$result['no_buy'] = true;
						$result['depict'] = $this->config['explain'];
					}
					else
					{
						$orderModel = new OrderBaseApi($memberId);
						
						$data = $orderModel->getOrderDetail($itembuylog['ibl_order_id']);
						
						//订单号不存在或未支付
						if( empty($data) || empty($data['order']['orderStatus']) || !($data['order']['orderStatus'] === 'PAID' || $data['order']['orderStatus'] === 'SCHEDULED' || $data['order']['orderStatus'] === 'RELEASED' || $data['order']['orderStatus'] === 'INCLUDED_IN_SHIPPMENT' || $data['order']['orderStatus'] === 'SHIPPED' || $data['order']['orderStatus'] === 'RETURN_CREATED' || $data['order']['orderStatus'] === 'RETURN_RECEIVED' || $data['order']['orderStatus'] === 'REFUND_CREATED' || $data['order']['orderStatus'] === 'REFUNDED' || $data['order']['orderStatus'] === 'RETURN_CANCELED'))
						{
							//delete
							$this->deleteItemBuyLog($itembuylog['ibl_id']);
							
							$result['no_buy'] = false;
						}
						else
						{
							//update
							$this->updateItemBuyLog($itembuylog['ibl_id']);
							
							$result['no_buy'] = true;
							$result['depict'] = $this->config['explain'];
						}
					}
				}
				else 
				{
					$result['no_buy'] = false;
				}
			}
			else
			{
				$result['no_buy'] = false;
			}
		}
		else
		{
			$result['no_buy'] = false;
		}
		
		return $result;
	}
	
	/**
	 * 保存活动商品下单记录
	 * @param unknown_type $memberId
	 * @param unknown_type $orderId
	 * @return Ambigous <number, unknown>|boolean
	 */
	public function saveBuyLog($memberId,$orderId)
	{
		$orderModel = new OrderBaseApi($memberId);
		$orderData = $orderModel->getOrderDetail($orderId);
		$itemId = array();
		
		if ( $orderData['order']['orderLineList'] )
		{
			foreach ( $orderData['order']['orderLineList'] as $key => $value )
			{
				$itemId[] = $value['itemPartnumber'];
			}
			
			$date = date('Y/m/d H:i:s',time());
			
			$insertArray = array();
			foreach ( $itemId as $key => $id )
			{
				if ( $this->time >= strtotime( $this->config['strat'] ) && $this->time <= strtotime( $this->config['end'] ) && in_array( $id , $this->items ) )
				{
					$insertArray[] = "('{$memberId}','{$id}','{$orderId}','{$date}')";
				}
			}
			
			if ( $insertArray )
			{
				$insertSql = "insert into cms_game_itembuylog (ibl_member_id,ibl_item_id,ibl_order_id,ibl_insert_time) values ";
				$insertSql .= implode( ',' , $insertArray );
				return Yii::$app->db->createCommand($insertSql)->execute();
			}
			return true;
		}
		return true;
	}
	
	/**
	 * 获取限购商品列表
	 * @return multitype:
	 */
	private function getBuyLimisItems()
	{
		$sql = "select limits_item from cms_game_buylimits limit 1";
		$itemsData = Yii::$app->db->createCommand($sql)->queryOne();
		return explode(',',$itemsData['limits_item']);
	}
	
	/**
	 * 获取用户当天下单商品记录
	 * @param unknown_type $memberId
	 * @param unknown_type $itemId
	 * @return Ambigous <multitype:, boolean>
	 */
	private function getUserTodayItemBuyLog($memberId,$itemId)
	{
		$todayStart = date('Y/m/d',$this->time).' 00:00:00';
		$todayEnd = date('Y/m/d',$this->time).' 23:59:59';
	
		$sql = "select * from cms_game_itembuylog where ibl_member_id = '{$memberId}' and ibl_item_id = '{$itemId}' and ( ibl_insert_time between '{$todayStart}' and '{$todayEnd}' ) order by ibl_id desc";
		return Yii::$app->db->createCommand($sql)->queryOne();
	}
	
	/**
	 * 更新订单状态
	 * @param unknown_type $id
	 * @return Ambigous <number, unknown>
	 */
	private function updateItemBuyLog($id)
	{
		$updateSql = "update cms_game_itembuylog set ibl_order_state = '1' where ibl_id = '{$id}'";
		return Yii::$app->db->createCommand($updateSql)->execute();
	}
	
	/**
	 * 删除购买记录
	 * @param unknown_type $id
	 * @return Ambigous <number, unknown>
	 */
	private function deleteItemBuyLog($id)
	{
		$deleteSql = "delete from cms_game_itembuylog where ibl_id = '{$id}'";
		return Yii::$app->db->createCommand($deleteSql)->execute();
	}
}

