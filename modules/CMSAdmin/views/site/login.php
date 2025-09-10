<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\modules\CMSAdmin\models\forms\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use app\components\Utility;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row login-wrapper">
        <div class="col-md-6 col-12">
            <div class="login-ban">
                <img src="<?= Yii::getAlias('@web/image/login.jpg') ?>">
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="">
                <div class="card-body login-card-body">
                    <div class="card-cover">
                    </div>
                    <div class="card-content">
                        <h1 class="login-box-msg mb-2">Login</h1>
                        <div class="ver-msg text-danger mb-3">
                            <?= Utility::getSystemEnvironment() != null ?
                                '<span style="font-weight: bold; ' . (Utility::getSystemEnvironmentColor() != null ?
                                    'color: ' . Utility::getSystemEnvironmentColor() . ';' :
                                    ''
                                ) . '">' . Utility::getSystemEnvironment() . '</span>' :
                                ''
                            ?>
                        </div>
                        <!--<div class="ver-msg small mb-3">V1.1</div>-->
                        <?php $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'fieldConfig' => [
                                'template' => "{input}\n{hint}\n{error}",
                            ],
                        ]); ?>

                        <?= $form->field($model, 'username', [
                            'options' => ['class' => 'input-group mb-3 has-validation'],
                        ])->textInput([
                            'placeholder' => $model->getAttributeLabel('username'),
                            'autofocus' => true,
                        ]) ?>
                        <?= $form->field($model, 'password', [
                            'options' => ['class' => 'input-group mb-3 has-validation'],
                        ])->passwordInput([
                            'placeholder' => $model->getAttributeLabel('password'),
                        ]) ?>

                        <div class="row">
                            <?= $form->field($model, 'rememberMe', [
                                'options' => ['class' => 'col-8'],
                            ])->checkbox([
                                'template' => '<div class=\"form-check\">{input} {label} {error}</div>',
                            ]) ?>

                        </div>

                        <div class="row">
                            <div class="col-12 mt-4">
                                <div class="d-grid gap-2">
                                    <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary rounded-pill']) ?>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="d-grid gap-2 justify-content-center">
                                    <?= Html::a(Yii::t('app', 'Forgot Password'), ['site/forget-password'], ['class' => 'text-underline']) ?>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>