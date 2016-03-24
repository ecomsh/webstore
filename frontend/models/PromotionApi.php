<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author yyjia@cn.ibm.com
 */

namespace frontend\models;

use common\models\PromotionBaseApi;

/**
 * 用于请求收藏夹数据的类
 */
class PromotionApi extends PromotionBaseApi
{
    public function __construct($userid)
    {
        parent::__construct($userid);
    }
    
}
