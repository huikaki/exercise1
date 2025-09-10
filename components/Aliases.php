<?php

namespace app\components;


use Yii;
use yii\base\BootstrapInterface;
use yii\base\Component;

class Aliases implements BootstrapInterface
{
    public function bootstrap($app)
    {
        Yii::setAlias('@uploadroot', Yii::getAlias('@webroot') . '/uploads');
        Yii::setAlias('@upload', Yii::getAlias('@web') . '/uploads');


        //normal file upload
        Yii::setAlias('@frontendupload', Yii::getAlias('@web') . '/uploads');
    }
}
