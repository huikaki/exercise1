<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\cms\MemberCMS $model */

$this->title = 'Update Member Cms: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Member Cms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="member-cms-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>