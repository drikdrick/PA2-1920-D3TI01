<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\base\Model;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\PemakaianKendaraan */

$this->title = 'Permohonan Pemakaian';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Pemakaian', 'url' => ['index-all']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubux-transaksi-kendaraan-mahasiswa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if($model->status_req_sekretaris_rektorat == 2){
        echo Html::a('Ubah', ['edit-by-sekretaris-rektorat', 'id' => $model->pemakaian_kendaraan_id], ['class' => 'btn btn-warning']); echo '&nbsp';
        echo Html::a('Buat Laporan Pemakaian', ['laporan-pemakaian-kendaraan/add-laporan-pemakaian', 'id' => $model->pemakaian_kendaraan_id], ['class' => 'btn btn-primary']);
    }else
        echo Html::a('Terima', ['accept-by-sekretaris-rektorat', 'id' => $model->pemakaian_kendaraan_id], ['class' => 'btn btn-success']); echo '&nbsp';
    echo Html::a('Tolak', ['reject-by-sekretaris-rektorat', 'id' => $model->pemakaian_kendaraan_id], ['class' => 'btn btn-danger']); echo '&nbsp';
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'pemakaian_kendaraan_id',
            'desc',
            'tujuan',
            'jumlah_penumpang_kendaraan',
            'rencana_waktu_keberangkatan',
            'rencana_waktu_kembali',
//            'status_req_sekretaris_rektorat',
//            'status_request_kemahasiswaan',
            [
                'attribute' => 'status_req_sekretaris_rektorat',
                'value' => $model->statusRequestSekretarisRektorat->status,
            ],
            [
                'attribute' => 'status_request_kemahasiswaan',
                'value' => $model->statusRequestKemahasiswaan->status,
            ],
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
