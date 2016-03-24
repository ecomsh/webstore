<?php



namespace frontend\models\cps;

use Yii;
use common\models\cps\BaseCps;

/**
 * 多麦Cps
 */
class DuomaiCps extends BaseCps {

    protected $expire = 60*60*24*5;
    /**
     * 解析广告联盟信息
     * 将从url、header里解析所需内容
     * @param $物
     * @return 无
     * @override
     */
    public function loadData($xx,$yy,$zz,$dd) {
        $request = Yii::$app->request;
        $this->unionId = "duomai";
        $this->unionPublisherId = $request->get('euid');
        $this->unionCampaignId = $request->get('mid');
        $this->unionReferer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        $this->unionClickTimestamp = time();
    }
}