<?php

namespace app\modules\CMSAdmin\controllers;

use Yii;

use app\models\cms\MemberCMS;
use app\models\cms\MemberCMSSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\Utility;
use yii\helpers\Html;

/**
 * MemberController implements the CRUD actions for MemberCMS model.
 */
class MemberController extends Controller
{
    protected $modelClass = MemberCMS::class;
    protected $searchModelClass = MemberCMSSearch::class;
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all MemberCMS models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MemberCMSSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MemberCMS model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MemberCMS model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MemberCMS();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MemberCMS model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionResetSkills($id)
    // {
    //     \Yii::debug('Resetting skills for ID: ' . $id, 'reset_skills');
    //     $model = $this->findModel($id);
    //     \Yii::debug('Before reset - skills: ' . var_export($model->skills, true), 'skills_before_reset');

    //     $model->skills = [
    //         ['skill' => 'Caring babies', 'value' => true],
    //         ['skill' => 'Caring toddler', 'value' => true],
    //         ['skill' => 'Caring children', 'value' => true],
    //         ['skill' => 'Caring elderly', 'value' => true],
    //         ['skill' => 'Cooking', 'value' => true]
    //     ];
    //     \Yii::debug('Skills set to: ' . var_export($model->skills, true), 'skills_before_save');

    //     // 跳過驗證以強制儲存
    //     if ($model->save(false)) {
    //         \Yii::debug('After save - skills: ' . var_export($model->skills, true), 'skills_after_save');
    //         // 重新從資料庫加載，確認儲存結果
    //         $model->refresh();
    //         \Yii::debug('DB skills after save: ' . var_export($model->skills, true), 'db_skills_after_save');
    //         Yii::$app->session->setFlash('success', 'Skills reset successfully.');
    //     } else {
    //         \Yii::debug($model->errors, 'model_errors');
    //         Yii::$app->session->setFlash('error', 'Failed to reset skills: ' . json_encode($model->errors));
    //     }
    //     return $this->redirect(['view', 'id' => $model->id]);
    // }
    public function actionUpdate($id)
    {
        \Yii::debug('Received ID: ' . $id, 'action_update_id');
        $model = $this->findModel($id);
        \Yii::debug($model->attributes, 'model_attributes');

        if ($model->load(Yii::$app->request->post())) {
            $postData = Yii::$app->request->post('MemberCMS');
            \Yii::debug($postData, 'post_data');

            $availableSkills = [
                'Caring babies',
                'Caring toddler',
                'Caring children',
                'Caring elderly',
                'Cooking',
                'Household Cleaning & Organization',
                'Other Household Tasks & Management',
                'Personal Qualities & Soft Skills',
                'Driving'
            ];
            $skills = [];
            $submittedSkills = isset($postData['skills']) ? array_column($postData['skills'], 'value', 'skill') : [];
            foreach ($availableSkills as $skill) {
                $skills[] = [
                    'skill' => $skill,
                    'value' => isset($submittedSkills[$skill]) && $submittedSkills[$skill] == '1'
                ];
            }
            $model->skills = $skills;

            \Yii::debug($model->skills, 'skills_before_save');
            if ($model->save(false)) { // 跳過驗證
                \Yii::debug($model->skills, 'skills_after_save');
                $model->refresh();
                \Yii::debug('DB skills after save: ' . var_export($model->skills, true), 'db_skills_after_save');
                Yii::$app->session->setFlash('success', 'Update successful.');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                \Yii::debug($model->errors, 'model_errors');
                Yii::$app->session->setFlash('error', 'Failed to save: ' . json_encode($model->errors));
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MemberCMS model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }




    /**
     * Finds the MemberCMS model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return MemberCMS the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MemberCMS::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
