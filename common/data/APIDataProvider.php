<?php

namespace common\data;

use Yii;
use yii\data\BaseDataProvider;
use yii\base\InvalidConfigException;
use yii\base\Exception;
use common\models\BaseApi;
use yii\helpers\ArrayHelper;

/**
 *
 * attentions : can only sort ONE field at each time
 *
 * $provider = new APIDataProvider([
 *    'url' => $url,
 *    'header' => $header
 * 	  'key' => $key,
 * 	  'dataKey' =>$dataKey,
 *    'pagination' => [
 *        'pageSize' => 10, 
 *    ],
 *    'sort' => [
 *        'defaultOrder' => [created_at' => SORT_DESC],
 * 		  'attributes' => [
 * 					'name'=>[ 'asc' => ['first_name' => SORT_ASC],
 * 							  'desc' => ['first_name' => SORT_DESC],
 * 							  'default'=>'SORT_DESC',
 * 							  'label' =>'按姓名排序',
 * 					 ],
 *         ],
 *    ],
 * ]);
 *
 *
 *
 *
 *
 * @author liang jingxi<jingxil@cn.ibm.com>
 *
 */
class APIDataProvider extends BaseDataProvider
{

    /**
     * @var string|callable the column that is used as the key of the data models.
     */
    public $key;

    /**
     * @var string the url of RESTful API.
     */
    public $url;
    public $header;

    /**
     * @var string the key of page information in the return value
     */
    public $pageKey = 'page_info';

    /**
     * @var string the key of data information in the return value
     */
    public $dataKey;

    /**
     * @var array API params to be sent with each request
     */
    public $params = [];
    public $extdata = [];

    /**
     * @var Curl.
     */
    protected $model;

    /**
     * Initializes the Curl component.
     */
    public function init()
    {
        parent::init();

        if ($this->url == null)
        {
            throw new InvalidConfigException("url Value must be set");
        }

        if ($this->key == null)
        {
            throw new InvalidConfigException("key Value must be set");
        }

        if ($this->dataKey == null)
        {
            throw new InvalidConfigException("dataKey Value must be set");
        }


        if ($this->getPagination() === false)
        {
            throw new InvalidConfigException("Pagination must be set");
        }

        if ($this->header == null)
        {
            throw new InvalidConfigException("Header must be set");
        }

        $this->model = new BaseApi();
    }

    /**
     * @inheritdoc
     */
    protected function prepareModels()
    {
        $pagination = $this->getPagination();
        $sort = $this->getSort();
        $params = $this->params;
        $pagination->totalCount = $this->prepareTotalCount();
        $params['pageSize'] = $pagination->getLimit();
        $params['currentPage'] = $pagination->getPage();
        $orders = $sort->getOrders();
        if (!empty($orders))
        {
            $params['sortField'] = key($orders);
            $params['sortType'] = strtoupper($orders[$params['sortField']]);
        }
        $this->model->header = $this->header;
        $response = $this->model->get([$this->key => $this->url], $params, 'GET',false); //count cache
        if (isset($response[$this->key][$this->dataKey]))
        {
            $resp = $response[$this->key][$this->dataKey];
            $value = \yii\helpers\ArrayHelper::remove($response[$this->key], 'pageInfo');
            $value = \yii\helpers\ArrayHelper::remove($response[$this->key], 'result');
            foreach ($response[$this->key] as $k => $v)
            {
                $this->extdata[$k] = $v;
            }
            return $resp;
        } else
        {
            return [];
        }
    }

    /**
     * @inheritdoc
     */
    protected function prepareKeys($models)
    {
        if ($this->key !== null)
        {
            $keys = [];

            foreach ($models as $model)
            {
                if (is_string($this->key) & isset($model[$this->key]))
                {
                    $keys[] = $model[$this->key];
                } else if (class_exists($this->key))
                {
                    $keys[] = call_user_func($this->key, $model);
                }
            }

            return $keys;
        } else
        {
            return array_keys($models);
        }
    }

    /**
     * @inheritdoc
     * #todo hezll   
     */
    protected function prepareTotalCount()
    {

        $params = $this->params;

        $params['pageSize'] = 1;
        $params['currentPage'] = 1;

        $response = $this->model->get([$this->pageKey => $this->url], $params,'GET',false);//#todo search cache

        if (isset($response[$this->pageKey][$this->pageKey]['totalResult']))
        {
            return $response[$this->pageKey][$this->pageKey]['totalResult'];
        } else
        {
            throw new InvalidConfigException("Can not get total count from the api!");
        }
    }

}
