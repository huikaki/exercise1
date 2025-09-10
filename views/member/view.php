<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Member $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<section>
    <div class="container">
        <div class="member-view">

            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a('Generate PDF', ['generate-pdf', 'maid_no' => $model->maid_no], ['class' => 'btn btn-primary', 'target' => '_blank']) ?>

            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'maid_no',
                    [
                        'attribute' => 'profile_photo',
                        'format' => 'raw',
                        'value' => function ($model) {
                            if ($model->profile_photo && !empty($model->profile_photo)) {
                                // 手動添加 /web/uploads/ 前綴
                                $imageUrl = Yii::getAlias('@web') . '/web/uploads/' . ltrim($model->profile_photo, '/');
                                return Html::img($imageUrl, [
                                    'alt' => 'Profile Photo',
                                    'style' => 'max-width: 200px; max-height: 200px;'
                                ]);
                            }
                            return 'No photo available';
                        },
                    ],
                    'name',
                    'age',
                    'nationality',
                    'gender',
                    'marital_status',
                    'height_cm',
                    'weight_kg',
                    'education',
                    'chinese_zodiac',
                    'religion',
                    'horoscope',
                    'work_experience_years',
                    [
                        'attribute' => 'languages',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $languages = is_array($model->languages) ? $model->languages : ($model->languages && is_string($model->languages) ? json_decode($model->languages, true) : []);
                            if ($languages && is_array($languages)) {
                                $result = [];
                                foreach ($languages as $lang) {
                                    if (isset($lang['language']) && isset($lang['level'])) {
                                        $result[] = Html::encode($lang['language'] . ': ' . $lang['level']);
                                    }
                                }
                                return implode('<br>', $result) ?: 'No languages specified';
                            }
                            return 'No languages specified';
                        },
                    ],
                    [
                        'attribute' => 'skills',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $skills = $model->getSkillsArray();
                            \Yii::debug($skills, 'skills_in_view');
                            if ($skills && is_array($skills)) {
                                $result = [];
                                foreach ($skills as $skill) {
                                    $value = $skill['value'] ? 'Yes' : 'No';
                                    $checkbox = $skill['value'] ? '☑' : '☐';
                                    $result[] = '<div><span style="margin-right: 10px;">' . $checkbox . ' ' . Html::encode($skill['skill']) . '</span></div>';

                                    // $result[] = Html::encode($skill['skill'] . ': ' . $value);
                                }
                                return implode(' ', $result) ?: 'No skills specified';
                            }
                            return 'No skills specified';
                        },
                    ],
                    [
                        'attribute' => 'previous_employment',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $previous_employment = is_array($model->previous_employment) ? $model->previous_employment : ($model->previous_employment && is_string($model->previous_employment) ? json_decode($model->previous_employment, true) : []);
                            if ($previous_employment && is_array($previous_employment)) {
                                $result = [];
                                $result[] = '<div><strong>Total Previous Employments: ' . count($previous_employment) . '</strong></div>';
                                foreach ($previous_employment as $previous) {
                                    if (isset($previous['employer']) && isset($previous['location']) && isset($previous['period']) && isset($previous['duties'])) {
                                        // $result[] = Html::encode($previous['language'] . ': ' . $previous['level']);
                                        $result[] = '<div>Employer Name: ' . Html::encode($previous['employer']) . '</div> 
                            <div class="previous-set">
                            <div>Previous Location: ' . Html::encode($previous['location']) . '</div> 
                               <div>Previous Employment Period: ' . Html::encode($previous['period']) . '</div> 
                             <div>Previous Work Duty: ' . Html::encode($previous['duties']) . '</div> </div>
                            ';
                                    }
                                }
                                return implode('<br>', $result) ?: 'No Previous Employment';
                            }
                            return 'No Previous Employment';
                        },
                    ],


                ],
            ]) ?>

        </div>
    </div>
</section>