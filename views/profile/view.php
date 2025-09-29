<?php

use app\models\Status;
use yii\helpers\Html;
use yii\helpers\VarDumper;
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
        <?= HTML::a('Назад', ['index'], ['class' => 'btn btn-outline-primary']) ?>
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
            [
                'attribute' => 'status_id',
                'value' => Status::getTitle($model->status_id)
            ],
        ],
    ]) ?>

    <?php if ($model->image) {  ?>
        <img src="../web/image/<?= $model->image[0]->title . '.' . $model->image[0]->extension ?>">

    <?php } ?>


    <p>
        <?=
        Html::a('Перейти')
        ?>
    </p>

</div>