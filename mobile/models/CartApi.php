<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace mobile\models;

use Yii;
use common\models\CartBaseApi;
use mobile\models\ProductApi;

/**
 * 用于请求mobile端购物车的类
 */
class CartApi extends CartBaseApi
{
    
    public function __construct($operatorId='')
    {
        parent::__construct($operatorId);
    }

    public function rules()
    {
		return [
            [['itemId', 'cartlineQuantity'], 'required'],// 'itemDisplayText',先去了测试
//            [['cartlineQuantity', 'shopId', 'tariffno'], 'integer'],

        ];
        /* return [
            [['itemId', 'cartlineQuantity', 'itemOfferPrice','itemPriceListId','cartlineType', 'shopDisplayText', 'userId', 
                'shopContactId',  'itemListPrice', 'channelType', 'channelId', 'itemOwnerId', 'itemLink', 'itemImageLink', 'itemSalestype',
                'shopId', 'shopLink', 'itemWeight', 'itemVolumn', 'itemPartNumber', 'tariffno'], 'required'],// 'itemDisplayText',先去了测试
//            [['cartlineQuantity', 'shopId', 'tariffno'], 'integer'],

        ];*/
    }
    /**
     * 
     * 加入购物车 //弃用
     */
//    public function addToCart($params = array()){       
//        $promodel = new ProductApi($this->operatorId);
//        $id = $params['itemId'];
//        $product = $promodel->getProductById($id);
//        $key = key($product);
//        $product = isset($product[$key]) ? $product[$key] : [];     
//        $params['itemPriceListId'] = "offer";                  //购物车项商品的采用的价格列表 required
//        $params['cartlineType'] = 1;                           //买家类型，游客0，登录用户1 , required
//        $params['itemDisplayText'] = $product['desc']['name'];
//        $params['shopDisplayText'] = "自贸区直购专场";             //购物车项商品所属店铺显示的文本,自营情况下可以为空，或者默认 required   
//        $params['shopContactId'] = "1111";                      //...听完了也没懂，跟店小二有关？
//        $params['channelType'] = Yii::$app->params['platform']; //购物车来源类型,app,pc,wechat等,required
//        $params['channelId'] = "ftzmall";                       //购物车来源Id , required
//        $params['itemImageLink'] = "{\"img\":\"".$product['desc']['thumbnail']."\",\"img_large\":\"".$product['desc']['fullImage']."\"}";
//        $params['itemSalestype'] = $product['salesType'];       //商品销售来源,一般贸易（DIG，供应商直送），跨境贸易（自营，分销），海外直邮 required
//        $params['shopId'] = $product['memberId'];               //购物车项商品所属店铺的Id,自营情况下可以为空，或者默认,required
//        $params['shopLink'] = "http://www.ftzmall.com.cn";      //required
//	$params['itemOwnerId'] = "ftzmall";						//购物车项商品的货主Id required
//        $params['itemListPrice'] = isset($product['listPriceInfo'][0]['price'])?$product['listPriceInfo'][0]['price']:0;    //购物车项商品的标价，显示用 required
//        $params['itemMfname'] = $product['manufactureName'];    //供应商 required   manufactureName
//        $params['itemWeight']= 12;                              //商品重量 required
//        $params['itemVolumn']= 0;                               //商品体积 required
//        $params['cartlineComment']= "";                          //买家留言
//        $params['itemOfferPrice'] = isset($product['offerPriceInfo'][0]['price'])?$product['offerPriceInfo'][0]['price']:0; //购物车项商品的售价，显示用(没懂，自己算？)
//        $params['tariffno'] = isset($product['tax']['taxSerialNumber']) ? $product['tax']['taxSerialNumber'] : '0';        //税则号，一定要，tax里的
//	$params['isGift'] = 0;						
//        $tmp_url = $this->_baseUri . 'cartline';
//        return $this->create(['cart' =>$tmp_url], $params);
//    }
}
