<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= Url::to('@web/images/favicon128.ico') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= Url::to('@web/images/favicon32.ico') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= Url::to('@web/images/favicon16.ico') ?>">
    <link rel="mask-icon" href="<?= Url::to('@web/images/safari-pinned-tab.svg') ?>" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta property="og:type" content="website">
    <meta property="og:description" content="">
    <meta property="og:image" content="<?= Url::to('@web/images/brandlogo.png') ?>">

    <script src="https://kit.fontawesome.com/99d6961117.js" crossorigin="anonymous"></script>

</head>

<body <?php if (isset($this->params['bodyClass'])) echo 'class="' . $this->params['bodyClass'] . '"'; ?>>
    <?php $this->beginBody() ?>

    <?= $this->render('_header') ?>

    <?= $content ?>

    <?= $this->render('_footer') ?>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>