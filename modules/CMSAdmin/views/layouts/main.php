<?php

use yii\helpers\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use app\modules\CMSAdmin\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <header id="header" class="sticky-bar">
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark ']
        ]);

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => [
                ['label' => 'Home', 'url' => ['/CMSAdmin/site/main']],
                ['label' => 'Member', 'url' => ['/CMSAdmin/member/index']],
                [
                    'label' => 'Logout ( ' . (Yii::$app->user->identity->username) . ')',
                    'url' => ['/CMSAdmin/site/logout'],
                    'linkOptions' => ['data-method' => 'get'],  // 改為 GET
                    'visible' => !Yii::$app->user->isGuest,
                ],
            ]
        ]);

        NavBar::end();
        ?>
    </header>

    <div class="container">
        <?= $content ?>
    </div>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>