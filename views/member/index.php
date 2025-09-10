<?php

use app\models\Member;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var app\models\MemberSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Members';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="my-3">
    <div class="container">
        <form id="filter-form" class="filter" class="mb-4">
            <div class="row g-3">
                <!-- Maid Number -->
                <div class="col-md-3">
                    <label for="maid_no" class="form-label"><?= Yii::t('app', 'Maid Number') ?></label>
                    <input type="text" class="form-control" id="maid_no" name="MemberSearch[maid_no]" placeholder="e.g. AA1234">
                </div>

                <!-- Skills -->
                <div class="col-md-3">
                    <label for="skills" class="form-label"><?= Yii::t('app', 'Skills') ?></label>
                    <div>
                        <select class="selectpicker " id="skills" name="MemberSearch[skills][]" multiple data-live-search="true">
                            <?php foreach (Member::getAvailableSkills() as $skill): ?>
                                <option value="<?= Html::encode($skill) ?>"><?= Html::encode($skill) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                </div>
                <!-- Nationality -->
                <div class="col-md-3">
                    <label for="nationality" class="form-label"><?= Yii::t('app', 'Nationality') ?></label>
                    <div>
                        <select class="selectpicker " id="nationality" name="MemberSearch[nationality]" multiple data-live-search="true">
                            <option value=""><?= Yii::t('app', 'All Nationalities') ?></option>
                            <?php foreach (Member::getUniqueNationalities() as $nationality): ?>
                                <option value="<?= Html::encode($nationality) ?>"><?= Html::encode($nationality) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>
                <!-- Languages -->
                <div class="col-md-3">
                    <label for="languages" class="form-label"><?= Yii::t('app', 'Languages') ?></label>
                    <div>
                        <select class="selectpicker " id="languages" name="MemberSearch[languages][]" multiple data-live-search="true">
                            <?php foreach (Member::getAvailableLanguages() as $language): ?>
                                <option value="<?= Html::encode($language) ?>"><?= Html::encode($language) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">Filter</button>
                <button type="submit" class="btn btn-secondary rounded-pill px-4 py-2" id="reset-filter">Reset</button>
            </div>
        </form>
    </div>
</section>

<section class=" overflow-hidden sectionPadding pt-0">
    <div class="member-index container">


        <div id="blog-list-container" class=" row gx-4 gy-5 mt-3">
            <?= $this->render('_worker_list', ['models' => $models]) ?>

        </div>


        <div class="pagination m-5">
            <?= \yii\widgets\LinkPager::widget([
                'pagination' => $dataProvider->pagination,
                'options' => ['class' => 'pagination'],
                'linkOptions' => ['data-ajax' => true], // Mark links for AJAX handling
            ]) ?>
        </div>


    </div>
</section>

<?php

$this->registerJs(
    <<<'JS'
$(document).ready(function() {
    // 初始化 selectpicker
    $('#skills, #languages, #nationality').selectpicker({
        liveSearch: true,
        width: '100%',
        title: 'Select options'
    });

    // 提交過濾表單
    $('#filter-form').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        loadMemberList(formData);
    });

    // 重置過濾
    $('#reset-filter').on('click', function() {
        $('#filter-form')[0].reset();
        $('#skills, #languages, #nationality').selectpicker('refresh');
        $('#filter-form').trigger('submit');
        console.log('Reset filter');
    });

    // 處理分頁鏈接點擊
    // $(document).on('click', '.pagination a[data-ajax]', function(e) {
    //     e.preventDefault();
    //     var url = $(this).attr('href');
    //     var formData = $('#filter-form').serialize() + '&' + (url.split('?')[1] || '');
    //     loadMemberList(formData);
    // });

    // 加載成員列表的 AJAX 函數
    function loadMemberList(formData) {
        
        $.ajax({
            url: '<?= Url::to(['member/index']) ?>',
            type: 'GET',
            data: formData,
            dataType: 'html',
            success: function(response) {
                console.log('Raw AJAX response:', response);
                try {
                    var $response = $(response);
                    $('#blog-list-container').html($response.find('#blog-list-container').html());
                    $('.pagination').html($response.find('.pagination').html());
                } catch (e) {
                    console.error('Error parsing response:', e, response);
                    alert('Failed to load data. Please try again.');
                }
            },
            error: function(xhr) {
                console.error('AJAX error:', xhr.responseText);
                alert('Error: ' + xhr.responseText);
            }
        });
    }
});
JS
);
?>