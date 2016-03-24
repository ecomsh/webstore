<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author yyjia@cn.ibm.com
 */

namespace common\models;

use Yii;
use common\models\BaseApi;
use common\helpers\Tools;
use yii\helpers\ArrayHelper;
use common\data\APIDataProvider;

/**
 * 用于请求收藏夹数据的基类
 */
class WishlistBaseApi extends BaseApi
{
    private $_baseUri;
    

    public function __construct($operatorId)
    {
        parent::__construct($operatorId);
        $this->_baseUri = Yii::$app->params['sm']['user']['baseUrl'];
    }

    /**
     * 支持分页的查看某用户的收藏夹列表 
     * @input:
     * $params = [          //以下各项都是optional
     *    'userId' => 'xxx' //用户id
     *    'pageSize' => 'xxx' //每页大小，默认20
     *    'currentPage'=> 'xxx' //当前页，默认0
     *     'sortField' => 'xxx' //排序字段，可传入addtoWishlist()返回的所有字段，默认为加入收藏时间
     *     'sortType' => 'xxx' //排序类型，1代表增序，2代表降序，默认为2
     *  ]
     *
     */
        public function getWishlist($params = array()){
            $userId = '';
            if(isset($params['userId']))
            {
                $userId = $params['userId'];
                $query_param = ArrayHelper::remove($params, 'userId');
            }
            $tmpuid =  $userId? $userId : $this->operatorId;
            if(empty($tmpuid)){
                $msg = YII_DEBUG? '----|userid can not be empty|----' : '';
                return Tools::error('99008', $msg);
            }
            $tmp_url = $this->_baseUri . $tmpuid . '/wishlist';
            $pagesize = 20;
            if(!empty($params))
            {
                $tmp_url = $tmp_url . '?';
                if(isset($params['pageSize']))
                {
                    $pagesize = $params['pageSize'];
                }
            }
            
            $provider = new APIDataProvider([
            'url' => $tmp_url,
            'key' => 'key',
            'pageKey' => 'pageInfo',
            'header' => $this->header,
            'dataKey' =>'result',
            'pagination' => [
                'pageSize' => $pagesize,
            ],
            'params' => $params,
        ]);
        return $provider;
        }
        
    /**
     * 添加某商品到收藏。参数太多，php端未做参数校验。
     * 后端只是对入参的itemId进行了强制检查，其他项如果不传后端会返回对应项为null，是否可以只传收藏列表需要展示的项目？
     * @input:
     * $params = {
     * "channelId" => 'xxx', 
     * "channelType" => 'xxx',
     * "shopId" => "xxx",
     * "shopDisplayText" => "xxx",
     * "shopLink" => "xxx",
     * "shopContactId" => "xxx",
     * "itemId" => "xxx",
     * "itemPartnumber" => "xxx",
     * "itemOwnerId" => "xxx",
     * "itemPriceListId" => "xxx",
     * "itemDisplayText" => "xxx",
     * "itemLink" => "xxx",
     * "itemImageLink" => "xxx",
     * "itemListPrice" => "xxx",
     * "itemOfferPrice" => "xxx",
     * "itemSalestype" => "xxx",
     * "itemMfname" => "xxx",
     * "isGift" => "xxx",
     * "itemWeight" => "xxx",
     * "itemVolumn" => "xxx",
     * "tariffno" => "xxx",
     * "extensionData" => "xxx" 
     * }
     * 
     * @Return:
     * 除了post的信息，还返回wishlistentryId, userId, addedTime
     */
        public function addtoWishlist($params, $userid = ''){
            $tmpuid = $userid ? $userid : $this->operatorId;
            if(empty($tmpuid)){
                $msg = YII_DEBUG? '----|userid can not be empty|----' : '';
                return Tools::error('99008', $msg);
            }
            $tmp_url = $this->_baseUri . $tmpuid . '/wishlist';
            return $this->create(['wishlist' => $tmp_url], $params);
        }
        
    /**
     * 删除某项收藏 
     * @input:
     * $id: wishlist id,
     * $userid : 用户id (optional) 
     * @Return:
     * success -- 200, 空array 
     * fail -- 404
     */
    public function deleteById($id, $userid = ''){
        $tmpuid = $userid ? $userid : $this->operatorId;
        if(empty($tmpuid)){
            $msg = YII_DEBUG? '----|userid can not be empty|----' : '';
            return Tools::error('99008', $msg);
        }
        $tmp_url = $this->_baseUri . $tmpuid . '/wishlist/' . $id;
        return $this->delete($tmp_url);
    }
     
    /*
     *从收藏夹列表中获取某个item id的详细信息，也可以用于判断某个item是否在收藏列表中
     * @input:
     *   $itemid -- itemid
     *   $userid -- userid
     * @Return:
     *   若存在在收藏列表中，返回详细内容，
     *   若不存在收藏列表中，返回空array（需要把php封装的wishlist key去掉）
     */
     public function getItemFromWishlist($itemid, $userid = ''){
         $tmpuid = $userid ? $userid : $this->operatorId;
         if(empty($tmpuid)){
             $msg = YII_DEBUG? '----|userid can not be empty|----' : '';
             return Tools::error('99008', $msg);
         }
         $tmp_url = $this->_baseUri . $tmpuid . '/wishlist/byItemId/' . $itemid;
         return $this->get(['wishlist' => $tmp_url], $params = []);
     }
      
}
