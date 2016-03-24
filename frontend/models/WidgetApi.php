<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace frontend\models;

use Yii;
use common\models\BaseApi;

/**
 * 用于请求其他数据的基类
 */
class WidgetApi extends BaseApi
{
    public $itemId;
    public $cartlineQuantity;
    public $shopId;
    public $itemListPrice;
    public $itemOfferPrice;
    public $priceContentId;
    private $_baseUri;
    
    public function __construct()
    {
        $userId = 'anonymousUser';
        parent::__construct($userId);
//        $header = ['X-dbecom-OperatorId:'.$userId, 'X-dbecom-AppId:Web'];
//        $this->header = array_merge($header, $this->header);
        $this->_baseUri = Yii::$app->params['sm']['widget']['baseUrl'];
    }

    public function rules()
    {
        return [
            [['itemId', 'cartlineQuantity'], 'required'],
            [['cartlineQuantity', 'shopId', 'itemListPrice', 'itemOfferPrice', 'priceContentId'], 'integer'],
//            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
//            [['auth_key'], 'string', 'max' => 32]
        ];
    }
    public function getWidget($id){
        $url = $this->_baseUri .$id;
        return $this->get(['widget'=>$url],null,'GET',false);
    }
    
//    public function create($params = array())
//    {
//        $api = new BaseApi();
//        $api->call('cart', $params, 'POST');
//    }
//
//    public function delete()
//    {
//        
//    }
//
//    public function update()
//    {
//        parent::call('cart', $params, 'PUT');
//    }
//
//    public function getAll()
//    {
//        
//    }

}
