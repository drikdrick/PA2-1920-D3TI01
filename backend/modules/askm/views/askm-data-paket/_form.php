<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmDataPaket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="askm-data-paket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data_paket_id')->textInput() ?>

    <?= $form->field($model, 'tanggal_kedatangan')->textInput() ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'penerima')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pengirim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diambil_oleh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_diambil')->textInput() ?>

    <?= $form->field($model, 'pegawai_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
