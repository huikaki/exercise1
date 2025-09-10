<?php

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<section>
    <div class="banner-container">
        <img src="<?= Yii::getAlias('@web/image/banner.jpg') ?>" alt="banner">

    </div>
    <section class="sectionPadding overflow-hidden">
        <div class="container">
            <h1 class="title">Our Member</h1>
            <div class="content">
                <div class="swiper mySwiper overflow-visible">
                    <div class="swiper-wrapper">
                        <?php foreach ($models as $model) {
                            if (!empty($model->profile_photo)) {
                                $cover = Url::to('@frontendupload' . $model->profile_photo);
                            }

                            $url = Url::to(['member/view/', 'maid_no' => $model->maid_no]);
                        ?>

                            <div class="swiper-slide">
                                <a href="<?= $url ?>" aria-label="" tabindex="-1">
                                    <div class="maid-card ">
                                        <div class="profile">
                                            <img loading="lazy" src="<?= $cover ?>" alt="">
                                        </div>
                                        <div class="info-box">
                                            <div class="">
                                                Maid Number:
                                                <span class="">
                                                    <?= Html::encode($model->maid_no) ?>
                                                </span>
                                            </div>
                                            <div class="">
                                                Name:
                                                <span>
                                                    <?= Html::encode($model->name) ?>
                                                </span>
                                            </div>
                                            <div class="">
                                                Age:
                                                <span>
                                                    <?= Html::encode($model->age) ?>
                                                </span>
                                            </div>
                                            <div class="">
                                                Age:
                                                <span>
                                                    <?= Html::encode($model->education) ?>
                                                </span>
                                            </div>
                                            <div>
                                                Skills:
                                                <?php
                                                $skills = is_array($model->skills) ? $model->skills : ($model->skills && is_string($model->skills) ? json_decode($model->skills, true) : []);
                                                if (!empty($skills) && is_array($skills)) {
                                                    $skillNames = [];
                                                    foreach ($skills as $skill) {
                                                        $value = $skill['value'] ? 'Yes' : 'No';
                                                        // 使用 Unicode 複選框符號
                                                        if ($value === "Yes") {
                                                            $checkbox = '☑';
                                                            $skillNames[] = '<div><span style="margin-right: 10px;">' . $checkbox . ' ' . Html::encode($skill['skill']) . '</span></div>';
                                                        }
                                                        // $skillNames[] = Html::encode($skill['skill'] ?? '');
                                                    }
                                                    echo implode(' ', $skillNames);
                                                } else {
                                                    echo 'No skills specified';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        <?php
                        } ?>
                    </div>
                </div>

            </div>

        </div>

    </section>

    <div class="container">

        <section class="sectionPadding">
            <div>
                <h1 class="title">Our Services</h1>
                <div class="content">
                    ....
                </div>

            </div>
        </section>
        <section class="sectionPadding">
            <div>
                <h1 class="title">Our Services</h1>
                <div class="content">
                    ....
                </div>

            </div>
        </section>
        <section class="sectionPadding">
            <div>
                <h1 class="title">Our Services</h1>
                <div class="content">
                    ....
                </div>

            </div>
        </section>
    </div>
</section>


<?php
$this->registerJs(
    "var swiper = new Swiper('.mySwiper', {  
        slidesPerView: 1,

     breakpoints: {
        640: {
          slidesPerView: 2,

        },
        768: {
          slidesPerView: 3,
 
        },
    1200    : {
          slidesPerView: 4,

        },
      },})",
    View::POS_READY
);


?>