<?php

namespace app\modules\CMSAdmin;

use Yii;

/**
 * CMSAdmin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */

    public $controllerNamespace = 'app\modules\CMSAdmin\controllers';
    public $defaultRoute = 'site/main';
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->layout = 'main';
        // 移除這行：$this->defaultRoute = 'site/main';
        Yii::$app->errorHandler->errorAction = $this->id . '/site/error';
        Yii::$app->homeUrl = ['/' . $this->id . '/site/main'];
        Yii::$app->user->loginUrl = ['/' . $this->id . '/site/login'];

        //reset bootstrap assets
        if (isset(Yii::$app->assetManager) && isset(Yii::$app->assetManager->bundles)) {
            if (isset(Yii::$app->assetManager->bundles['yii\bootstrap5\BootstrapAsset'])) {
                unset(Yii::$app->assetManager->bundles['yii\bootstrap5\BootstrapAsset']);
            }
            if (isset(Yii::$app->assetManager->bundles['yii\bootstrap5\BootstrapPluginAsset'])) {
                unset(Yii::$app->assetManager->bundles['yii\bootstrap5\BootstrapPluginAsset']);
            }
        }
        if (!Yii::$app->user->isGuest) {
            $cookies = Yii::$app->request->cookies;
            if ($cookies['user_valid_time'] && $cookies['user_valid_time']->value < time()) {
                Yii::$app->user->logout();
            } else {
                Yii::$app->response->cookies->add(new \yii\web\Cookie([
                    'name' => 'user_valid_time',
                    'value' => time() + (24 * 60 * 60), // one day
                ]));
            }
        }
    }
}
