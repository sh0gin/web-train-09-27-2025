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
       
        <?= HTML::a('Удалить', ['delete', 'id' => $model->id], ['class' => 'btn btn-outline-danger', 'data-method' => 'post']) ?>
        
    </div>
    <div class='d-flex gap-3 m-3 justify-content-end'>

    </div>
</div>