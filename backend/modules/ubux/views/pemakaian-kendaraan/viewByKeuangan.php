<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\base\Model;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\PemakaianKendaraan */

$this->title = 'Permohonan Pemakaian';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Pemakaian untuk Keperluan Pribadi', 'url' => ['index-by-keuangan']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubux-transaksi-kendaraan-mahasiswa-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        echo Html::a('Setuju', ['accept-by-keuangan', 'id' => $model->pemakaian_kendaraan_id], ['class' => 'btn btn-success']);
        echo Html::a('Tolak', ['reject-by-keuangan', 'id' => $model->pemakaian_kendaraan_id], ['class' => 'btn btn-danger']);
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'pemakaian_kendaraan_id',
            [
                'attribute' => 'Nama',
                'value' => $model->pegawai->nama,
            ],
            'desc',
            'tujuan',
            'jumlah_penumpang_kendaraan',
            'rencana_waktu_keberangkatan',
            'rencana_waktu_kembali',
//            'status_request_kemahasiswaan',
//            'jenis_keperluan_id',
            'no_telepon',
//            'proposal',
//            'deleted',
//            'deleted_at',
//            'deleted_by',
//            'created_at',
//            'created_by',
//            'updated_at',
//            'updated_by',
//            'kendaraan_id',
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
            [
                'attribute' => 'Status Request Sekretaris Rektorat',
                'value' => $model->statusRequestSekretarisRektorat->status,
            ],
            [
                'attribute' => 'status_request_kabiro_KSD',
                'value' => $model->statusRequestKabiroKSD->status,
            ],
            [
                'attribute' => 'status_request_hrd',
                'value' => $model->statusRequestHRD->status,
            ],
            [
                'attribute' => 'status_request_keuangan',
                'value' => $model->statusRequestKeuangan->status,
            ],
            [
                'attribute' => 'status_request_wr2',
                'value' => $model->statusRequestWr2->status,
            ],
        ],
    ]) ?>

</div>
