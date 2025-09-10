<?php

namespace app\controllers;

use Yii;
use kartik\mpdf\Pdf;
use app\models\Member;
use app\models\MemberSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\data\Pagination;
use yii\helpers\Json;

/**
 * MemberController implements the CRUD actions for Member model.
 */
class MemberController extends Controller
{

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
     * Lists all Member models.
     *
     * @return string
     */

    public function actionIndex()
    {
        $searchModel = new MemberSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $models = $dataProvider->getModels();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'models' => $models,
            'pagination' => $dataProvider->pagination, // 使用 dataProvider 的 pagination
        ]);
    }

    /**
     * Displays a single Member model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($maid_no)
    {
        $model = $this->findModel($maid_no);
        return $this->render('view', [
            'model' => $model,
        ]);
    }
    /**
     * Creates a new Member model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    // public function actionCreate()
    // {
    //     $model = new Member();

    //     if ($this->request->isPost) {
    //         if ($model->load($this->request->post()) && $model->save()) {
    //             return $this->redirect(['view', 'id' => $model->id]);
    //         }
    //     } else {
    //         $model->loadDefaultValues();
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Updates an existing Member model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('update', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Deletes an existing Member model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionDelete($id)
    // {
    //     $this->findModel($id)->delete();

    //     return $this->redirect(['index']);
    // }

    /**
     * Finds the Member model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Member the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */


    public function actionGeneratePdf($maid_no)
    {
        // Find the member record
        $model = $this->findModel($maid_no);

        // Process languages
        $exp = is_array($model->previous_employment) ? $model->previous_employment : ($model->previous_employment && is_string($model->previous_employment) ? json_decode($model->previous_employment, true) : []);
        $expText = 'No Previous Employment';
        if ($exp && is_array($exp)) {
            $result = [];
            $result[] = '<div><strong>Total Previous Employments: ' . count($exp) . '</strong></div>';

            foreach ($exp as $previous) {
                if (isset($previous['employer']) && isset($previous['location']) && isset($previous['period']) && isset($previous['duties'])) {
                    $result[] = '<div>Employer Name: ' . Html::encode($previous['employer']) . '</div> 
                    <div class="previous-set">
                    <div>Previous Location: ' . Html::encode($previous['location']) . '</div> 
                       <div>Previous Employment Period: ' . Html::encode($previous['period']) . '</div> 
                     <div>Previous Work Duty: ' . Html::encode($previous['duties']) . '</div> </div>
                    ';
                }
            }
            $expText = implode(' <br>', $result);
        }

        // 
        $languages = is_array($model->languages) ? $model->languages : ($model->languages && is_string($model->languages) ? json_decode($model->languages, true) : []);
        $languagesText = 'No languages specified';
        if ($languages && is_array($languages)) {
            $result = [];
            foreach ($languages as $lang) {
                if (isset($lang['language']) && isset($lang['level'])) {
                    $result[] = $lang['language'] . ': ' . $lang['level'];
                }
            }
            $languagesText = implode(', ', $result);
        }

        // Process skills
        $skills = $model->getSkillsArray();
        $skillsText = 'No skills specified';
        if ($skills && is_array($skills)) {
            $result = [];
            foreach ($skills as $skill) {
                $value = $skill['value'] ? 'Yes' : 'No';
                // 使用 Unicode 複選框符號
                $checkbox = $skill['value'] ? '☑' : '☐';
                $result[] = '<div><span style="margin-right: 10px;">' . $checkbox . ' ' . Html::encode($skill['skill']) . '</span></div>';
            }
            $skillsText = implode(' ', $result);
        }

        // Handle profile photo
        $photoPath = $model->profile_photo ? Yii::getAlias('@web') . '/uploads/' . ltrim($model->profile_photo, '/') : null;
        $filePath = $model->profile_photo ? Yii::getAlias('@webroot') . '/uploads/' . ltrim($model->profile_photo, '/') : null;
        $photoHtml = 'No photo available';
        if ($photoPath && file_exists($filePath)) {
            $photoHtml = '<img src="' . $photoPath . '" width="100" alt="Profile Photo">';
        } else {
            \Yii::warning("Profile photo not found at: " . ($filePath ?: 'No path provided'), __METHOD__);
        }
        // LaTeX content with two-column layout
        $content = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Member Profile</title>
        </head>
        <body>
            <h1 style="text-align: center;">Member Profile</h1>
            <div style="text-align: center;">' . $photoHtml . '</div>
            <div style="display: flex; justify-content: space-between;">
                <div style="width: 45%;">
                    <p><strong>Maid No:</strong> ' . Html::encode($model->maid_no) . '</p>
                    <p><strong>Name:</strong> ' . Html::encode($model->name) . '</p>
                    <p><strong>Age:</strong> ' . Html::encode($model->age) . '</p>
                    <p><strong>Nationality:</strong> ' . Html::encode($model->nationality) . '</p>
                    <p><strong>Gender:</strong> ' . Html::encode($model->gender) . '</p>
                    <p><strong>Marital Status:</strong> ' . Html::encode($model->marital_status) . '</p>
                </div>
                <div style="width: 45%;">
                    <p><strong>Height (cm):</strong> ' . Html::encode($model->height_cm) . '</p>
                    <p><strong>Weight (kg):</strong> ' . Html::encode($model->weight_kg) . '</p>
                    <p><strong>Education:</strong> ' . Html::encode($model->education) . '</p>
                    <p><strong>Chinese Zodiac:</strong> ' . Html::encode($model->chinese_zodiac) . '</p>
                    <p><strong>Religion:</strong> ' . Html::encode($model->religion) . '</p>
                    <p><strong>Horoscope:</strong> ' . Html::encode($model->horoscope) . '</p>
                    <p><strong>Work Experience (Years):</strong> ' . Html::encode($model->work_experience_years) . '</p>
                </div>
            </div>
            <h2>Additional Information</h2>
            <div style="display: flex; justify-content: space-between;">
                <div style="width: 45%;">
                    <p><strong>Languages:</strong> ' . Html::encode($languagesText) . '</p>
                </div>
                <div style="width: 45%;">
                            <p><strong>Skills:</strong> ' . $skillsText . '</p>
                        </div>
            </div>
            <p><strong>Previous Employment: </strong> ' . $expText . '</p>
        </body>
        </html>
        ';

        // Configure mPDF
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER, // Display in browser
            'content' => $content,
            'options' => [
                'title' => 'Member Profile PDF',
            ],
            'cssInline' => '
        h1 { font-family: serif; text-align: center; }
        p { margin: 5px 0; }
        div { margin-bottom: 10px; }
        img { max-width: 100px; }
        span { font-size: 14px; }
    ',
            'methods' => [
                'SetHeader' => Html::encode($model->name),
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        // Return PDF output
        return $pdf->render();
    }



    protected function findModel($maid_no)
    {
        if (($model = Member::findOne(['maid_no' => $maid_no])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
