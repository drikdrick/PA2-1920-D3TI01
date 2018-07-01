<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\base\Model;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\PemakaianKendaraan */

$this->title = 'Permohonan Pemakaian';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Pemakaian untuk Keperluan Pribadi', 'url' => ['index-by-pegawai']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubux-transaksi-kendaraan-mahasiswa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if($model->status_req_sekretaris_rektorat == 1) {
        echo Html::a('Ubah', ['edit-by-pegawai', 'id' => $model->pemakaian_kendaraan_id], ['class' => 'btn btn-primary']);
        echo Html::a('Hapus', ['del', 'id' => $model->pemakaian_kendaraan_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);
    }else if($model->status_req_sekretaris_rektorat == 2){
        echo Html::a('Cetak', ['pegawai-pdf', 'id' => $model->pemakaian_kendaraan_id], ['class' => 'btn btn-warning']);
    }
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'pemakaian_kendaraan_id',
            // [
            //         'attribute' => 'Nama',
            //     'value' => $model->pegawai->nama,
            // ],
            'desc',
            'tujuan',
            'jumlah_penumpang_kendaraan',
            'rencana_waktu_keberangkatan',
            'rencana_waktu_kembali',
//            'status_req_sekretaris_rektorat',
            [
                'attribute' => 'Status Request Sekretaris Rektorat',
                'value' => $model->statusRequestSekretarisRektorat->status,
            ],
//            'status_request_kemahasiswaan',
            'no_telepon',
//            'jenis_keperluan_id',
            [
                    'attribute' => 'Jenis Permintaan',
                'value' => $model->jenisKeperluan->jenis_keperluan,
            ],
//            'proposal',
//            'deleted',
//            'deleted_at',
//            'deleted_by',
//            'created_at',
//            'created_by',
//            'updated_at',
//            'updated_by',
            [
                'attribute' => 'Kendaraan',
                'value' => function(Model $model){
                    if ($model->kendaraan_id != null) {
                        return $model->kendaraan->kendaraan;
                    } else {
                        return '-';
                    }
                },
            ],
            [
                'attribute' => 'Supir',
                'value' => function(Model $model){
                    if($model->supir_id != null){
                        return $model->supir->pegawai->nama;
                    }else{
                        return '-';
                    }
                },
            ],
//            'no_hp_supir',
            [
                'attribute' => 'no_hp_supir',
                'value' => function(Model $model){
                    if($model->supir_id != null){
                        return $model->supir->no_telepon_supir;
                    }else{
                        return '-';
                    }
                },
            ],
        ],
    ]) ?>

</div>
