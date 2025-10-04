<?php

use app\models\ads;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\adsSeacrh $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'JSON';
$this->params['breadcrumbs'][] = 'JSON';
?>
<div class="ads-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= HTML::a('Скачать', ['download', 'json' => $json], ['class' => 'btn btn-outline-success']) ?>

    <div>
       

            <code>
                <?= $json ?>
                
            </code>
       

    </div>


</div>