<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\web\JqueryAsset;
use yii\widgets\Pjax;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header id="header">
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav', ],

            'items' => [
                ['label' => 'Главная', 'url' => ['/site/index']],
                ['label' => 'Объявления', 'url' => ['/ads']],
                !Yii::$app->user->isGuest
                    ? ['label' => 'Мои объявления', 'url' => ['/ads/my']]
                    : '',
                Yii::$app->user->identity?->isAdmin
                    ? ['label' => 'Категории', 'url' => ['/category']]
                    : '',
                Yii::$app->user->identity?->isAdmin
                    ? ['label' => 'JSON', 'url' => ['/ads/json']]
                    : '',
                // Yii::$app->user->isGuest
                //     ? ['label' => 'Регистрация', 'url' => ['/site/register'], 'linkOptions' => ['class' => 'nav-link register']]
                //     : '',
                // Yii::$app->user->isGuest
                //     ? ['label' => 'Логин', 'url' => ['/site/login'], 'class' => 'modal login']
                //     : '<li class="nav-item">'
                //     . Html::beginForm(['/site/logout'])
                //     . Html::submitButton(
                //         'Logout (' . Yii::$app->user->identity->email . ')',
                //         ['class' => 'nav-link btn btn-link logout']
                //     )
                //     . Html::endForm()
                //     . '</li>'
            ]
        ]);
        ?>
        <?php if (Yii::$app->user->isGuest) { ?>
        <div id='nav' class="ms-3 d-flex align-center gap-3">
                <a href="/site/register" class="nav-link register text-white-50" >Регистрация</a>
                <a href="/site/login" class="nav-link login text-white" >Логин</a>
        </div>
        <?php } else { 
            echo '<a class="nav-item text-white-50">'
            . Html::beginForm(['/site/logout'])
            . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->email . ')',
                ['class' => 'nav-link btn btn-link logout']
            )
            . Html::endForm();
        } ?>
       <?php NavBar::end();
        ?>
    </header>

    <main id="main" class="flex-shrink-0" role="main">
        <div class="container">
            <?php if (!empty($this->params['breadcrumbs'])): ?>
                <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            <?php endif ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <footer id="footer" class="mt-auto py-3 bg-light">
        <div class="container">
            <div class="row text-muted">
                <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
                <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
            </div>
        </div>
    </footer>


    <?php Modal::begin([
        'headerOptions' => [],
        'id' => 'modal',
        'options' => ['data-url' => ''],
        'title' => "<div id='title'></div>",
    ]);

    Pjax::begin([
        'id' => 'pjax-modal',
        'enablePushState' => false,
        'enableReplaceState' =>false,
        'timeout' => 5000,
    ]);


    Pjax::end();

    Modal::end();

    ?>

    <?php $this->registerJsFile('js/modal.js', ['depends' => JqueryAsset::class]) ?>

    <?php $this->endBody() ?>

</body>

</html>
<?php $this->endPage() ?>