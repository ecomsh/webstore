<?php

namespace common\helpers;

use Yii;

//use common\helpers\DeviceDetect;
/**
 * DeviceDetect
 *
 * @author Alexander Nestorov <alexandernst@gmail.com>
 * @version 0.0.8
 */
class DeviceDetect extends \alexandernst\devicedetect\DeviceDetect
{

    private $_mobileDetect;

    public function init()
    {
        $this->_mobileDetect = new \Detection\MobileDetect();
        parent::init();

        \Yii::$app->on(\yii\base\Application::EVENT_BEFORE_REQUEST, function($event)
        {
            \Yii::$app->params['devicedetect'] = [
                'isMobile' => \Yii::$app->devicedetect->isMobile(),
                'isTablet' => \Yii::$app->devicedetect->isTablet(),
                'isWeixin' => $this->isWeixin(),
            ];

            \Yii::$app->params['devicedetect']['isDesktop'] = !\Yii::$app->params['devicedetect']['isMobile'] &&
                    !\Yii::$app->params['devicedetect']['isTablet'];
        });
    }

    public function isWeixin()
    {
        $headers = Yii::$app->request->headers;
        $userAgent = $headers->get('User-Agent');
        
        if (strpos($userAgent, 'MicroMessenger') !== false) {
            return true;
        }
        return false;
    }

}
