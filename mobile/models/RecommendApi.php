<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author yyjia@cn.ibm.com
 */

namespace mobile\models;

use common\models\RecommendBaseApi;

/**
 * 用于请求收藏夹数据的类
 */
class RecommendApi extends RecommendBaseApi
{
    public function __construct($userid = '')
    {
        parent::__construct($userid);
    }
    
}
