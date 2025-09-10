<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use app\models\cms\MemberCMS;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\cms\MemberCMS $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="member-cms-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'] // 如果有 file upload
    ]); ?>

    <?= $form->field($model, 'maid_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'age')->textInput() ?>

    <?= $form->field($model, 'nationality')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList(['M' => 'M', 'F' => 'F',], ['prompt' => '']) ?>

    <?= $form->field($model, 'marital_status')->dropDownList(['SINGLE' => 'SINGLE', 'MARRIED' => 'MARRIED', 'DIVORCED' => 'DIVORCED', 'WIDOWED' => 'WIDOWED',], ['prompt' => '']) ?>

    <?= $form->field($model, 'height_cm')->textInput() ?>

    <?= $form->field($model, 'weight_kg')->textInput() ?>

    <?= $form->field($model, 'education')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'chinese_zodiac')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'religion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'horoscope')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'work_experience_years')->textInput() ?>


    <div class="form-group">
        <?= Html::label('Languages', null, ['class' => 'control-label']) ?>
        <div id="languages-container">
            <!-- 語言 rows 會動態加喺呢度 -->
        </div>
        <?= Html::button('Add Language', [
            'class' => 'btn btn-secondary',
            'onClick' => 'addLanguageRow()'
        ]) ?>
    </div>

    <div class="form-group">
        <?= Html::label('Skills', null, ['class' => 'control-label']) ?>
        <div id="skills-container">
            <?php
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
            $skillsArray = $model->getSkillsArray();


            $skillsMap = array_column($skillsArray, 'value', 'skill');

            foreach ($availableSkills as $index => $skill) {
                $checked = isset($skillsMap[$skill]) && $skillsMap[$skill] === true;
                \Yii::debug("Skill: $skill, Checked: " . var_export($checked, true), 'skill_checked');
            ?>
                <div class="form-check">
                    <input type="checkbox" name="MemberCMS[skills][<?= $index ?>][value]" value="1"
                        class="form-check-input" id="skill_<?= Html::encode(str_replace(' ', '_', $skill)) ?>"
                        <?= $checked ? 'checked' : '' ?>>
                    <input type="hidden" name="MemberCMS[skills][<?= $index ?>][skill]" value="<?= Html::encode($skill) ?>">
                    <label class="form-check-label" for="skill_<?= Html::encode(str_replace(' ', '_', $skill)) ?>">
                        <?= Html::encode($skill) ?>
                    </label>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::label('Previous Employment', null, ['class' => 'control-label']) ?>
        <div id="previous-container">
            <!-- 語言 rows 會動態加喺呢度 -->
        </div>
        <?= Html::button('add experience', [
            'class' => 'btn btn-secondary',
            'onClick' => 'addPreviousExp()'
        ]) ?>
    </div>

    <?= $form->field($model, 'profile_photo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['AVAILABLE' => 'AVAILABLE', 'HIRED' => 'HIRED', 'PENDING' => 'PENDING', 'TERMINATED' => 'TERMINATED',], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<script>
    let languageRowIndex = 0;

    function addLanguageRow(language = '', level = '') {
        const container = document.getElementById('languages-container');
        const newRow = document.createElement('div');
        newRow.className = 'language-row mb-3';
        newRow.innerHTML = `
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="MemberCMS[languages][${languageRowIndex}][language]" 
                           value="${language}" placeholder="Language (e.g. Chinese)" class="form-control">
                </div>
                <div class="col-md-6">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" 
                               name="MemberCMS[languages][${languageRowIndex}][level]" 
                               value="Good" id="lang_${languageRowIndex}_good"
                               ${level === 'Good' ? 'checked' : ''}>
                        <label class="form-check-label" for="lang_${languageRowIndex}_good">Good</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" 
                               name="MemberCMS[languages][${languageRowIndex}][level]" 
                               value="Fair" id="lang_${languageRowIndex}_fair"
                               ${level === 'Fair' ? 'checked' : ''}>
                        <label class="form-check-label" for="lang_${languageRowIndex}_fair">Fair</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" 
                               name="MemberCMS[languages][${languageRowIndex}][level]" 
                               value="Poor" id="lang_${languageRowIndex}_poor"
                               ${level === 'Poor' ? 'checked' : ''}>
                        <label class="form-check-label" for="lang_${languageRowIndex}_poor">Poor</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeLanguageRow(this)">Remove</button>
                </div>
            </div>
        `;
        container.appendChild(newRow);
        languageRowIndex++;
    }

    function removeLanguageRow(button) {
        button.closest('.language-row').remove();
        reindexLanguageRows();
    }

    function reindexLanguageRows() {
        const rows = document.querySelectorAll('.language-row');
        rows.forEach((row, index) => {
            const inputs = row.querySelectorAll('input');
            inputs.forEach(input => {
                if (input.type === 'text') {
                    input.name = `MemberCMS[languages][${index}][language]`;
                } else if (input.type === 'radio') {
                    input.name = `MemberCMS[languages][${index}][level]`;
                    input.id = `lang_${index}_${input.value.toLowerCase()}`;
                }
            });
            const labels = row.querySelectorAll('label');
            labels.forEach(label => {
                const forAttr = label.getAttribute('for');
                if (forAttr && forAttr.startsWith('lang_')) {
                    const level = forAttr.split('_')[2];
                    label.setAttribute('for', `lang_${index}_${level}`);
                }
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        <?php
        $languagesArray = $model->getLanguagesArray();
        if (!empty($languagesArray)): ?>
            <?php foreach ($languagesArray as $lang): ?>
                addLanguageRow('<?= Html::encode($lang['language'] ?? '') ?>', '<?= Html::encode($lang['level'] ?? '') ?>');
            <?php endforeach; ?>
        <?php else: ?>
            addLanguageRow();
        <?php endif; ?>
    });
</script>

<script>
    let expRowIndex = 0;

    function addPreviousExp(employer = '', location = '', period = '', duties = '') {
        const container = document.getElementById('previous-container');
        const newRow = document.createElement('div');
        newRow.className = 'prev-row mb-3';
        newRow.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="MemberCMS[previous_employment][${expRowIndex}][employer]" 
                           value="${employer}" placeholder="Employer Name: " class="form-control">
                </div>
                <div class="col-md-6">
                    <div class="form-check form-check-inline">
                        <input type="text" name="MemberCMS[previous_employment][${expRowIndex}][location]" 
                           value="${location}" placeholder="Location: " class="form-control">
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-check form-check-inline">
                        <input type="text" name="MemberCMS[previous_employment][${expRowIndex}][period]" 
                           value="${period}" placeholder="Period: " class="form-control">
                    </div>
                </div>
                  <div class="col-md-6">
                    <div class="form-check form-check-inline">
                        <input type="text" name="MemberCMS[previous_employment][${expRowIndex}][duties]" 
                           value="${duties}" placeholder="Duties: " class="form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeExpRow(this)">Remove</button>
                </div>
            </div>
        `;
        container.appendChild(newRow);
        expRowIndex++;
    }

    function removeExpRow(button) {
        button.closest('.prev-row').remove();
        reindexPreRows();
    }

    function reindexPreRows() {
        const rows = document.querySelectorAll('.prev-row');
        rows.forEach((row, index) => {
            const inputs = row.querySelectorAll('input');
            inputs.forEach(input => {
                if (input.type === 'text') {
                    input.name = `MemberCMS[previous_employment][${index}][employer]`;
                } else if (input.type === 'text') {
                    input.name = `MemberCMS[previous_employment][${index}][location]`
                } else if (input.type === 'text') {
                    input.name = `MemberCMS[previous_employment][${index}][period]`
                } else if (input.type === 'text') {
                    input.name = `MemberCMS[previous_employment][${index}][duties]`
                }
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        <?php
        $expArray = $model->getPreviousArray();
        if (!empty($expArray)): ?>
            <?php foreach ($expArray as $exp): ?>
                addPreviousExp(
                    '<?= Html::encode($exp['employer'] ?? '') ?>',
                    '<?= Html::encode($exp['location'] ?? '') ?>',
                    '<?= Html::encode($exp['period'] ?? '') ?>',
                    '<?= Html::encode($exp['duties'] ?? '') ?>'
                );
            <?php endforeach; ?>
        <?php else: ?>
            addPreviousExp();
        <?php endif; ?>
    });
</script>