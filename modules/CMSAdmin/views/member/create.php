<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\cms\MemberCMS $model */

$this->title = 'Create Member Cms';
$this->params['breadcrumbs'][] = ['label' => 'Member Cms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-cms-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
