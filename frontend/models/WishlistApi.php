<?php

/**
 * @link http://www.ftzmall.com/
 * @copyright Copyright (c) 2015 IBM
 * @author hezonglin@cn.ibm.com
 */

namespace frontend\models;

use common\models\WishlistBaseApi;

/**
 * 用于请求收藏夹数据的类
 */
class WishlistApi extends WishlistBaseApi
{
    public function rules()
    {
        return parent::rules();
    }
    
    public function __construct($userid = '')
    {
        parent::__construct($userid);
    }  
}
