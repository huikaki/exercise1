<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\cms\MemberCMSSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="member-cms-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'maid_no') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'age') ?>

    <?= $form->field($model, 'nationality') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'marital_status') ?>

    <?php // echo $form->field($model, 'height_cm') ?>

    <?php // echo $form->field($model, 'weight_kg') ?>

    <?php // echo $form->field($model, 'education') ?>

    <?php // echo $form->field($model, 'chinese_zodiac') ?>

    <?php // echo $form->field($model, 'religion') ?>

    <?php // echo $form->field($model, 'horoscope') ?>

    <?php // echo $form->field($model, 'work_experience_years') ?>

    <?php // echo $form->field($model, 'languages') ?>

    <?php // echo $form->field($model, 'skills') ?>

    <?php // echo $form->field($model, 'previous_employment') ?>

    <?php // echo $form->field($model, 'profile_photo') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
