<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\PemakaianKendaraanMahasiswaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ubux-transaksi-kendaraan-mahasiswa-baru-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'transaksi_kendaraan_id') ?>

    <?= $form->field($model, 'dim_id') ?>

    <?= $form->field($model, 'nama_perequest_kendaraan') ?>

    <?= $form->field($model, 'desc') ?>

    <?= $form->field($model, 'tujuan') ?>

    <?php // echo $form->field($model, 'jumlah_penumpang_kendaraan') ?>

    <?php // echo $form->field($model, 'rencana_waktu_keberangkatan') ?>

    <?php // echo $form->field($model, 'rencana_waktu_kembali') ?>

    <?php // echo $form->field($model, 'status_req_sekretaris_rektorat') ?>

    <?php // echo $form->field($model, 'status_request_kemahasiswaan') ?>

    <?php // echo $form->field($model, 'proposal') ?>

    <?php // echo $form->field($model, 'no_telepon') ?>

    <?php // echo $form->field($model, 'deleted') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'kendaraan_id') ?>

    <?php // echo $form->field($model, 'supir_id') ?>

    <?php // echo $form->field($model, 'no_hp_supir') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
