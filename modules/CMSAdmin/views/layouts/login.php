<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\components\Utility;
// use app\modules\CMSAdmin\assets\LoginAsset;
use app\modules\CMSAdmin\assets\AppAsset;

AppAsset::register($this);
// LoginAsset::register($this);

$this->registerCsrfMetaTags();

$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/images/favicon128.ico')]);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>

<head>
    <title><?= Yii::t('app', 'Login') ?> | <?= Yii::t('app', 'Housing Society Elderly Resources Centre') ?> </title>
    <?php $this->head() ?>
</head>

<body class="login-page vsc-initialized app-loaded">
    <div>

    </div>
    <?php $this->beginBody() ?>
    <div class="login-box">
        <?= $content ?>
    </div>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>