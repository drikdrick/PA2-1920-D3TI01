<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmDataPaketSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="askm-data-paket-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'data_paket_id') ?>

    <?= $form->field($model, 'tanggal_kedatangan') ?>

    <?= $form->field($model, 'desc') ?>

    <?= $form->field($model, 'penerima') ?>

    <?= $form->field($model, 'pengirim') ?>

    <?php // echo $form->field($model, 'diambil_oleh') ?>

    <?php // echo $form->field($model, 'tanggal_diambil') ?>

    <?php // echo $form->field($model, 'pegawai_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
