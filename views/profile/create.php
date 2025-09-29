<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\profile $model */

$this->title = 'Создать новое объявление';
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'category' => $category,
    ]) ?>

</div>
