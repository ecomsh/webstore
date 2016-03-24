<?php

namespace mobile\widgets\commercial;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class CommercialWidget extends Widget
{

    //广告位的对应类型
    public $adClass;
    //广告位示例对应id
    public $adId;
    //广告位模版名
    public $tpl;
    private $advertisement;

    public function init()
    {
        parent::init();

        //var_dump($this->adClass);
        //   die();

        $this->advertisement = new $this->adClass;
        $this->advertisement->setTpl($this->tpl);
        $this->advertisement->fetch($this->adId);
    }

    public function run()
    {

        $view = $this->advertisement->getView();
        $viewFile = Yii::getAlias($this->getViewPath()) . DIRECTORY_SEPARATOR . $view . '.php';
        if (is_file($viewFile))
            return $this->renderFile($viewFile, ['advertisement' => $this->advertisement]);
        else
            Yii::error('Commercial view:' . $viewFile . ' does not exit, please check it online!');
    }
    /**
     * 重写模版路径
     * @override
     */
    public function getViewPath()
    {
        return '@app/widgets/commercial/views';
    }

}
