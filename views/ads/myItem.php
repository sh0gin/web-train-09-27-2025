<?php

use app\models\User;
use yii\bootstrap5\Html;
use yii\helpers\VarDumper;

?>
<div class="card mb-3 w-25">
    <div class="card-header text fw-bold fs-5">
        <?= $model->title ?>
    </div>
    <div class="card-body">
        <span>Описание: </span>
        <?= $model->description ?></br>
        <span>Почта: </span>
        <?= User::getEmail($model->user_id) ?></br>
        <span>Дата публикации: </span>
        <?= $model->date_created ?></br>
        <?php if ($model->image) {  ?>
        <img src="../web/image/<?= $model->image[0]->title . '.' . $model->image[0]->extension ?>">

        <?php } ?>    

        <?= HTML::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-primary'])?>
        <?= $model->status_id == 1
            ? HTML::a('Сделать неактивным', ['disable-status', 'id' => $model->id], ['class' => 'btn btn-outline-danger', 'data-method' => "post"])
            : HTML::a('Сделать активным', ['able-status', 'id' => $model->id], ['class' => 'btn btn-outline-primary', 'data-method' => "post"])
            
        ?>
    </div>
    <div class='d-flex gap-3 m-3 justify-content-end'>

    </div>
</div>