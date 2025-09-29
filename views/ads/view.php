<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\ads $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Объявления', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ads-view">
    
    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= HTML::a('Назад', ['index'], ['class' => 'btn btn-outline-primary'])?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description',
            'user_id',
            'category_id',
            'date_created',
        ],
    ]) ?>

    <p>
        <?=
            Html::a('Перейти')
        ?>
    </p>

</div>
