<?php

namespace cashier\models;

use Yii;
use common\data\APIDataProvider;

/**
 *
 * @author jia yuanyuan<yyjia@cn.ibm.com>
 *
 */
class UserAPIDataProvider extends APIDataProvider {

    public function init() {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    protected function prepareModels() {
        $pagination = $this->getPagination();
        $sort = $this->getSort();
        $params = $this->params;
        $pagination->totalCount = $this->prepareTotalCount();
        $params['pageSize'] = $pagination->getLimit();
        $params['currentPage'] = $pagination->getPage();
        $orders = $sort->getOrders();
        if (!empty($orders)) {
            $params['sortField'] = key($orders);
            $params['sortType'] = strtoupper($orders[$params['sortField']]);
        }
        $this->model->header = $this->header;
        $response = $this->model->get([$this->key => $this->url], $params, 'GET', false); //count cache
        if (isset($response[$this->key][$this->dataKey]) && !empty($response[$this->key][$this->dataKey])) {
            $resp = $response[$this->key][$this->dataKey];
//            print_r($resp);
            $uids = \yii\helpers\ArrayHelper::getColumn($resp, 'userId');
            foreach ($uids as $k => $v) {
                $realname_url[$k] = Yii::$app->params['sm']['realname']['baseUrl'] . $v . '/realNameVerification';
            }
            $realnameinfo = $this->model->get($realname_url, [], 'GET', false);//由于multifetch的结果没有按顺序返回，需要对两种api的返回值进行结果merge
            $realname = \yii\helpers\ArrayHelper::index($realnameinfo, 'userId');
//            print_r($realname);
            foreach($resp as $k=>$v){
                $resp[$k]['realName']= $realname[$v['userId']]['realName'];
            }
//            print_r($resp);
            return $resp;
        } else {
            return [];
        }
    }

}
