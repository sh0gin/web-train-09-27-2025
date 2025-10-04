<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Alert;
use yii\bootstrap5\Html;
use yii\web\JqueryAsset;
use yii\widgets\Pjax;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>


    <div class="row">
        <div class="col-lg-5">

            <?php

            Pjax::begin([
                'id' => 'pjax-modal',
                'enablePushState' => false,
                'enableReplaceState' => false,
                'timeout' => 5000,
            ]);

            if (Yii::$app->session->hasFlash('error')) {
                echo Alert::widget();
            }

            $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => [
                    'data-pjax' => true,
                ],
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>


            <div class="form-group">
                <div>
                    <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end();
            $this->registerJsFile('js/password_handler.js', ['depends' => JqueryAsset::class]);

            Pjax::end()
            ?>


        </div>
    </div>
</div>