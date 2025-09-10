<?php

use app\models\cms\MemberCMS;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\cms\MemberCMSSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Member Cms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-cms-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Member Cms', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'maid_no',
            'name',
            'age',
            'nationality',
            //'gender',
            //'marital_status',
            //'height_cm',
            //'weight_kg',
            //'education',
            //'chinese_zodiac',
            //'religion',
            //'horoscope',
            //'work_experience_years',
            //'languages:ntext',
            //'skills:ntext',
            //'previous_employment:ntext',
            //'profile_photo',
            //'status',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, MemberCMS $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
