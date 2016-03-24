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
class CommentApi extends BaseApi
{
    
    public $userId; //": "Long",
    public $productId; //": "Long", 
    public $content; //": "string", 评论内容
    public $point; //": Integer, 评分
    public $orderItemId; //": "Long", 订单号
    public $langId; //": "String", 语言,ZH - for Chinese,EN – for English
    public $anonymous; //": "Boolean",是否匿名, True - 匿名,False – 不匿名  
    public $commentId; //"String",评论编号
    public $currentPage; //Integer
    public $pagesize; //Integer
    public $sortField; //String, 排序方式，按什么排序
    public $sortType; //String, 升序降序 ASC DESC
    private $_baseUri;
    public $isNewRecord;

    /**
     * 验证器，验证规则
     * @return type
     */
    public function rules()
    {
        return [
            [['content', 'point','anonymous'], 'required', 'message' => '此项为必填'],  
            [['content'], 'string', 'max' => Yii::$app->params['sm']['store']['maxAmount']],
            //       [['receiverMobile','mobile']]

        ];
    }

    /**
     * 只有在这里的属性，才会在对应的场景中可以用
     * @return type
     */
    public function scenarios()
    {
        return [
            'index' => ['productId', 'content', 'point', 'orderItemId', 'anonymous'],
            'create' => ['productId', 'content', 'point', 'orderItemId', 'anonymous'],
            'supplement' => ['content', 'commentId'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'point' => '商品评分:',
            'anonymous' => '匿名发表',
            'content' => '',
        ];
    }

    public function __construct()
    {
        parent::__construct();        
        $this->_baseUri = Yii::$app->params['sm']['comment']['baseUrl'];  
        $userId = 'anonymousUser'; //Fix me, userid should be input param
//        $header = ['X-dbecom-OperatorId:'.$userId, 'X-dbecom-AppId:Web'];
//        $this->header = array_merge($header, $this->header);
    }

    public function getByUserId($userId , $pagesize = 5 , $currentPage = 0)
    {
        $url = $this->_baseUri . 'userCommentList/'. $userId . '?pagesize=' . $pagesize . '&currentPage=' .$currentPage;       
        return parent::get(['comment' => $url], $params = [], 'GET', FALSE);
    }

    public function getByProductId($productId , $pagesize = 10 , $currentPage = 0)
    {
        $url = $this->_baseUri . 'prdCommentList/'. $productId . '?pagesize=' . $pagesize . '&currentPage=' .$currentPage;    
        return parent::get(['comment' => $url], $params = [] , 'GET', FALSE);
    }
    
    public function getByCommentId($commentId)
    {
        $url = $this->_baseUri . 'mgmtComment/'. $commentId;    
        return parent::get(['comment' => $url], $params = [] , 'GET', FALSE);
    }

    public function createComment($params = array())
    {
        $url = $this->_baseUri . 'comment';
        return parent::create(['comment'=>$url], $params);
    }
    
    public function supplement($params = array())
    {
        $url = $this->_baseUri . 'supplement';
        return parent::create(['comment'=>$url], $params);
    }

    public function delete($id)
    {
        $url = $this->_baseUri . '/' . $id;
        return parent::delete($url);
    }

    public function update($id, $params = [])
    {
        $url = $this->_baseUri . '/' . $id;
        return parent::update(['comment' => $url], $params);
    }

    public function setDefault($id, $params = [])
    {
        $url = $this->_baseUri . '/' . $id . '/_setDefault';
        return parent::create(['comment' => $url], $params);
    }

    public function getAll()
    {
        
    }

}
