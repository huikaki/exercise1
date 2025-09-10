<?php

use yii\helpers\Url;
use yii\bootstrap5\Html;
use app\components\Utility;
use yii\web\View;
?>

<header class="main">
    <div class="fixed-header">
        <div class="mainnav " id="mainNavbar">

            <nav class="navbar navbar-expand-xl navbar-light">


                <div class="mobile-menu-header">
                    <a class="navbar-brand" href="<?= Url::to(['site/index']) ?>" aria-label="前往首頁" title="前往首頁">
                        <img src="<?= Yii::getAlias('@web/image/logo.png') ?>" alt="logo">
                    </a>

                </div>
                <div class="show-1200px mobile-header">
                    <div class="d-flex align-items-center">
                        <button class="btn custom-toggle collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="sr-only">Menu</span>
                            <span class="icon-bar bar1"></span>
                            <span class="icon-bar bar2"></span>
                            <span class="icon-bar bar3"></span>
                            <span class="icon-bar bar4"></span>
                        </button>

                    </div>
                </div>
                <div class="collapse navbar-collapse setMenuHeight justify-content-end" id="navbarTogglerDemo02">
                    <div class="mobile-scroll">
                        <ul class="navbar-nav mx-auto mt-2 mt-lg-0 align-items-xl-center gx-15px gy-10px">
                            <li class="nav-item  my-auto">
                                <a class="nav-link house d-flex align-items-center gx-5px" href="<?= Url::to(['site/index']) ?>" aria-label="前往首頁" title="前往首頁">
                                    <span class="show-1200px">
                                        Home
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item  my-auto">
                                <a class="nav-link house d-flex align-items-center gx-5px" href="<?= Url::to(['site/about']) ?>" aria-label="前往首頁" title="前往首頁">
                                    <span class="show-1200px">
                                        About
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item  my-auto">
                                <a class="nav-link house d-flex align-items-center gx-5px" href="<?= Url::to(['member/index']) ?>" aria-label="前往首頁" title="前往首頁">
                                    <span class="show-1200px">
                                        Member
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>


        </div>
    </div>
</header>