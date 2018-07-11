<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratMagang */

$this->title = 'Detail Surat';
$this->params['breadcrumbs'][] = ['label' => 'Surat Magang', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detail Surat'];
?>
<div class="surat-magang-view">

    <h1></h1>

    <p>
        <?php
            if($model->status_pengajuan_id == 1){
                echo Html::a('Add Student', ['edit-dim', 'id' => $model->surat_magang_id], [ 
                    'class' => 'btn btn-success',
                    'data-method' => 'POST',
                ]);
                echo "&nbsp";
                echo Html::a('Update', ['edit', 'id' => $model->surat_magang_id], [
                    'class' => 'btn btn-primary',
                    'data-method' => 'POST',
                ]);
                echo "&nbsp";
            }

            echo Html::a('Back', ['index'], [
                    'class' => 'btn btn-primary',
                    'data-method' => 'POST',
                ]);
        ?>
    </p>

    <?php 
        if($model->status_pengajuan_id == 1){?>
            <?= DetailView::widget([
                'model' => $model,
                'formatter' => [
                    'class' => 'yii\i18n\Formatter',
                    'nullDisplay' => '-',
                ],
                'attributes' => [
                    'nama_perusahaan',
                    'alamat_perusahaan',
                    'waktu_awal_magang',
                    'waktu_akhir_magang',
                    'dims',
                    'statusPengajuan.name',
                ],
            ]) ?>
        <?php }?>
    <?php 
        if($model->status_pengajuan_id == 2){?>
            <?= DetailView::widget([
                'model' => $model,
                'formatter' => [
                    'class' => 'yii\i18n\Formatter',
                    'nullDisplay' => '-',
                ],
                'attributes' => [
                    'nama_perusahaan',
                    'alamat_perusahaan',
                    'waktu_awal_magang',
                    'waktu_akhir_magang',
                    'dims',
                    'statusPengajuan.name',
                    'pegawai.nama',
                ],
            ]) ?>
        <?php }?>
    <?php 
        if($model->status_pengajuan_id == 3){?>
            <?= DetailView::widget([
                'model' => $model,
                'formatter' => [
                    'class' => 'yii\i18n\Formatter',
                    'nullDisplay' => '-',
                ],
                'attributes' => [
                    'nama_perusahaan',
                    'alamat_perusahaan',
                    'waktu_awal_magang',
                    'waktu_akhir_magang',
                    'dims',
                    'statusPengajuan.name',
                    'pegawai.nama',
                    'alasan_penolakan',
                ],
            ]) ?>
        <?php }?>
    <?php 
        if($model->status_pengajuan_id == 4 || $model->status_pengajuan_id == 5){?>
            <?= DetailView::widget([
                'model' => $model,
                'formatter' => [
                    'class' => 'yii\i18n\Formatter',
                    'nullDisplay' => '-',
                ],
                'attributes' => [
                    'nama_perusahaan',
                    'alamat_perusahaan',
                    'waktu_awal_magang',
                    'waktu_akhir_magang',
                    'dims',
                    'statusPengajuan.name',
                    'pegawai.nama',
                    'waktu_pengambilan',
                ],
            ]) ?>
        <?php }?>
            

</div>
