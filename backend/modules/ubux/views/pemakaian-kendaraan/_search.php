<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\PemakaianKendaraanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ubux-transaksi-kendaraan-mahasiswa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pemakaian_kendaraan_id') ?>

    <?= $form->field($model, 'desc') ?>

    <?= $form->field($model, 'jumlah_penumpang_kendaraan') ?>

    <?= $form->field($model, 'rencana_waktu_keberangkatan') ?>

    <?php // echo $form->field($model, 'rencana_waktu_kembali') ?>

    <?php // echo $form->field($model, 'status_request_sekertaris_rektorat') ?>

    <?php // echo $form->field($model, 'status_request_kemahasiswaan') ?>

    <?php // echo $form->field($model, 'jenis_keperluan_id') ?>

    <?php // echo $form->field($model, 'proposal') ?>

    <?php // echo $form->field($model, 'deleted') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'kendaraan_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Cari', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Ulang', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
