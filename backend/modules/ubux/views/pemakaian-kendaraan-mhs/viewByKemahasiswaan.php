<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\base\Model;
use common\helpers\LinkHelper;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\PemakaianKendaraanMhs */

$this->title = 'Rincian Permohonan Pemakaian';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Pemakaian oleh Mahasiswa', 'url' => ['index-by-kemahasiswaan']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubux-transaksi-kendaraan-mahasiswa-baru-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
            if($model->status_req_sekretaris_rektorat == 2){
                echo Html::a('Cetak', ['cetak', 'id' => $model->pemakaian_kendaraan_mhs_id], ['class' => 'btn btn-warning']);
            }if($model->status_request_kemahasiswaan == 1){
                echo Html::a('Terima', ['accept', 'id' => $model->pemakaian_kendaraan_mhs_id], ['class' => 'btn btn-success']);
                echo '&nbsp';
                echo Html::a('Tolak', ['reject', 'id' => $model->pemakaian_kendaraan_mhs_id], ['class' => 'btn btn-danger']);
            }if($model->status_request_kemahasiswaan == 2 && $model->status_req_sekretaris_rektorat == 1){
                echo '<p style="color:red;">Permintaan Telah disetuju. Menunggu persetujuan Sekretaris Rektorat</p>';
            }
        ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'dim_id',
            [
                'label' => 'NIM',
                'value' => $model->mahasiswa->nim,
            ],
            [
                'attribute' => 'Nama',
                'value' => $model->mahasiswa->nama,
            ],
            'desc',
            'tujuan',
            'jumlah_penumpang_kendaraan',
            'rencana_waktu_keberangkatan',
            'rencana_waktu_kembali',
            [
                'attribute' => 'status_req_sekretaris_rektorat',
                'value' => $model->statusRequestSekretarisRektorat->status,
            ],
            [
                'attribute' => 'status_request_kemahasiswaan',
                'value' => $model->statusRequestKemahasiswaan->status,
            ],
            'proposal',
            'no_telepon',
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
                        //or: return Html::encode($model->some_attribute)
                    } else {
                        return '-';
                    }
                },
            ],
//            'supir_id'
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
                'attribute' => 'proposal',
                'format' => 'html',
                'value' => isset($model->proposal) && $model->proposal!==''?LinkHelper::renderLink(['options'=>'target = _blank','label'=>$model->proposal, 'url'=>\Yii::$app->fileManager->generateUri($model->kode_proposal)]):'-',
            ],
        ],
    ]) ?>

    <!-- <?= Html::a('Download Proposal', ['pemakaian-kendaraan-mhs/download', 'id' => $model->pemakaian_kendaraan_mhs_id], ['class' => 'btn btn-success']) ?> -->

</div>
