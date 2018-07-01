<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratMahasiswaAktif */

$this->params['breadcrumbs'][] = ['label' => 'Surat Mahasiswa Aktif', 'url' => ['index-admin']];
?>
<div class="surat-mahasiswa-aktif-view">

    <h1></h1>

    <p>
        <?php
            if($model->status_pengajuan_id == 1){
                echo Html::a('Accept', ['edit-accept', 'id' => $model->surat_mahasiswa_aktif_id], [ 
                    'class' => 'btn btn-success',
                    'data-method' => 'POST',
                ]);
                echo "&nbsp";
                echo Html::a('Reject', ['edit-decline', 'id' => $model->surat_mahasiswa_aktif_id], [
                    'class' => 'btn btn-danger',
                    'data-method' => 'POST',
                    'data' => [
                        'confirm' => 'Reject request surat tugas?',
                    ],
                ]);
                echo "&nbsp";
            }
            else if($model->status_pengajuan_id == 2){
                echo Html::a('Ready to Take', ['edit-ready', 'id' => $model->surat_mahasiswa_aktif_id], [ 
                    'class' => 'btn btn-success',
                    'data-method' => 'POST',
                ]);
                echo "&nbsp";
                echo Html::a('Print', ['edit-pdf', 'id' => $model->surat_mahasiswa_aktif_id], [
                    'class' => 'btn btn-info',
                    'data-method' => 'POST',
                ]);
                echo "&nbsp";
            }
            else if($model->status_pengajuan_id == 4){
                echo Html::a('Print', ['edit-pdf', 'id' => $model->surat_mahasiswa_aktif_id], [
                    'class' => 'btn btn-info',
                    'data-method' => 'POST',
                ]);
                echo "&nbsp";
            }

            echo Html::a('Back', ['index-admin'], [
                    'class' => 'btn btn-primary',
                    'data-method' => 'POST',
                ]);
        ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '-',
        ],
        'attributes' => [
            'tujuan',
            'pemohon.nama',
            'statusPengajuan.name',
            'pegawai.nama',
            'waktu_pengambilan',
        ],
    ]) ?>

</div>