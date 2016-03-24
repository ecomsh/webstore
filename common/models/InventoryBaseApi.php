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

/**
 * 用于请求库存数据的基类
 */
class InventoryBaseApi extends BaseApi
{

    public $Country;
    public $StateCode;
    public $params = [];
    private $_baseUri;

    public function __construct($operatorId = '')
    {
        parent::__construct($operatorId);
        $this->_baseUri = Yii::$app->params['sm']['inventory']['baseUrl'];
    }

    public function rules()
    {
        return [
            [['Country', 'StateCode'], 'required'],
            [['Country'], 'string'],
            [['StateCode'], 'integer']
        ];
    }

    /**
     * 查看单个sku的库存，可支持无地址查询，有地址时，需要传入country和statecode，city可传可不传。
     * $params = {
     * "itemPartNumber" => "xxx", (required)
     * "itemOrg" => "xxx",(required, 一期只支持ftzmall)
     * "shop" => "xxx",（required, 一期只支持ftzmall）
     * "country" => "CN",(optional, 一期只支持CN)
     * "stateCode" => "xxx",(optional, 比如北京：110000，上海：310000)
     * "city" => "xxx"(optional, 城市代码)
     * }
     */
    public function getInventory($params)
    {
        if ($params['itemPartNumber'] && $params['itemOrg'] && $params['shop'])
        {
            $itemNo = $params['itemPartNumber'];
            $itemNo = urlencode($itemNo);
            $itemOrg = $params['itemOrg'];
            $shop = $params['shop'];

            $tmp_url = $this->_baseUri . 'item/' . $itemNo . '/itemOrganization/' . $itemOrg . '/shop/' . $shop;
            if (isset($params['country']) && isset($params['stateCode']))
            {
                $country = $params['country'];
                $stateCode = $params['stateCode'];
                $tmp_url .= '?country=' . $country . '&state=' . $stateCode;
                if (isset($params['city']))
                {
                    $tmp_url .= '&city=' . $params['city'];
                }
            }
            return $this->get(['inventory' => $tmp_url], [], 'GET');
        } else
        {
            $msg = YII_DEBUG ? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'getInventory input param error' . $msg);
        }
    }

    /**
     * 查看多个sku的库存（支持单个）， 可支持无地址查询，有地址时，需要传入country和statecode，city可传可不传。
     * $params = {
     * "itemInfo" => [ //required
     *       "itempartnumber1" => "itemOrg1",
     *       "itempartnumber2" => ""itemOrg2"",
     *       "itempartnumber3" => "itemOrg3"
     * ],
     * "shop" => "xxx",（required, 一期只支持ftzmall）
     * "country" => "CN",(optional, 一期只支持CN)
     * "stateCode" => "xxx",(optional, 比如北京：110000，上海：310000)
     * "city" => "xxx" (optional, 城市代码)
     * }
     */
    public function getInventorys($params)
    {
        if ($params['itemInfo'] && $params['shop'])
        {
            if (count($params['itemInfo']) > 1)
            {
                $partnumber = array_keys($params['itemInfo']);
                $org = array_values($params['itemInfo']);
                $itemNo = implode('|', $partnumber);
                $itemOrg = implode('|', $org);
            } else
            {
                $itemNo = key($params['itemInfo']);
                $itemOrg = $params['itemInfo'][$itemNo];
            }
            $enItemNo = urlencode($itemNo);
            $enItemOrg = urlencode($itemOrg);
            $shop = $params['shop'];
            $tmp_url = $this->_baseUri . 'items/' . $enItemNo . '/itemOrganizations/' . $enItemOrg . '/shop/' . $shop;
            if (isset($params['country']) && isset($params['stateCode']))
            {
                $country = $params['country'];
                $stateCode = $params['stateCode'];
                $tmp_url .= '?country=' . $country . '&state=' . $stateCode;
                if (isset($params['city']))
                {
                    $tmp_url .= '&city=' . $params['city'];
                }
            }
            return $this->get(['inventory' => $tmp_url], [], 'GET');
        } else
        {
            $msg = YII_DEBUG ? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'getInventorys input param error' . $msg);
        }
    }

    /**
     * 查看多个sku的仓库库存的最大值（支持单个）， 可支持无地址查询，有地址时，需要传入country和statecode，city可传可不传。
     * @input:
     * $params = {
     * "itemInfo" => [ //required
     *       "itempartnumber1" => "itemOrg1",
     *       "itempartnumber2" => ""itemOrg2"",
     *       "itempartnumber3" => "itemOrg3",
     *       "xxx" => "xxx"
     * ],
     * "shop" => "xxx",（required, 一期只支持ftzmall）
     * "country" => "CN",(optional, 一期只支持CN)
     * "stateCode" => "xxx",(optional, 比如北京：110000，上海：310000)
     * "city" => "xxx" (optional, 城市代码)
     * }
     * @return 
     * {
     *      "itempartnumber1" => "maxffminv1",
     *      "itempartnumber2" => "maxffminv2",
     *      "itempartnumber3" => "maxffminv3",
     *      "xxx" => "xxx"
     * }
     */
    public function getMaxffmInvs($params)
    {
        if (isset($params['itemInfo']) && $params['shop'])
        {
            //为防止getInventorys api的url超长，前端进行限制，每size个为一批，分批查库存
            $size = 20;
            if (count($params['itemInfo']) <= $size)
            {
                $info = $this->getInventorys($params);
                $key = key($info);
                $info = isset($info[$key]) ? $info[$key] : [];
            } else
            {
                $rc = array_chunk($params['itemInfo'], $size, TRUE);
//                $json = json_encode($rc);
//                file_put_contents('test.txt','array_chunk returns :' . $json . "\r\n",FILE_APPEND);
                $info = array();
                foreach ($rc as $v)
                {
                    $params['itemInfo'] = $v;
                    $data = $this->getInventorys($params);
                    $key = key($data);
                    $data = isset($data[$key]) ? $data[$key] : [];
                    $info = array_merge($data, $info);
                }
            }

            if (empty($info))
            {
                return Tools::error('99008', 'getMaxffmInvs error: getInventorys returns null.');
            }
            $rc = array();
            foreach ($info as $v)
            {
                if (!empty($v['inventoryDetails']))
                {
                    $quantity_array = ArrayHelper::getColumn($v['inventoryDetails'], 'quantity');
                    $max = max($quantity_array);
                    $max = floor($max); //由于后端支持库存数量为小数，向下取整的工作在前端实现。
                } else
                {
                    $max = 0;
                }
                $partnumber = $v["itemPartnumber"];
                $rc[$partnumber] = $max;
            }
            return $rc;
        } else
        {
            $msg = YII_DEBUG ? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'getMaxffmInvs input param error' . $msg);
        }
    }

    public function ckeckInventorys($params)
    {
        if (!isset($params['country']) && !isset($params['ststeCode']) && !isset($params['city']))
        {
            $keyInfo = Yii::$app->cache->get('__NII' . Yii::$app->user->id);
            if ($keyInfo !== FALSE)
            {
                $key = '__NII' . $keyInfo['ipn'] . $keyInfo['ssc'];
                $NII = Yii::$app->cache->get($key);
                if ($NII !== FALSE)
                {
                    $params['country'] = 'CN';
                    $params['stateCode'] = $NII['shipStateCode'];
                    $params['city'] = $NII['shipCityCode'];
                }
            }
        }
        return $this->getMaxffmInvs($params);
    }

}
