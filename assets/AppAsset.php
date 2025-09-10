<?php

/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.css',
        'css/style.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css',
        'js/swiper/swiper-bundle.min.css',
    ];
    public $js = [
        'js/jquery-3.7.1.js',

        // 'https://code.jquery.com/ui/1.14.1/jquery-ui.js',
        'js/jquery.cookie.js',
        'js/bootstrap.bundle.min.js',
        'https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js',
        'https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/i18n/defaults-*.min.js',
        // 'js/aos/aos.js',
        'js/swiper/swiper-bundle.min.js',
        // 'js/swiper/swiper-custom.js',
        // 'js/changefontsize.js',
        // 'js/glightbox.min.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
