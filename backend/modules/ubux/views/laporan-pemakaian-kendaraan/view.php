<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\base\Model;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\LaporanPemakaianKendaraan */

$this->title = 'Laporan Pemakaian Kendaraan';
$this->params['breadcrumbs'][] = ['label' => 'Ubux Laporan Pemakaian Kendaraan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubux-laporan-pemakaian-kendaraan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ubah', ['edit', 'id' => $model->laporan_pemakaian_kendaraan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['del', 'id' => $model->laporan_pemakaian_kendaraan_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Apakah anda yakin ?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Cetak', ['sample-pdf', 'id' => $model->laporan_pemakaian_kendaraan_id], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'laporan_pemakaian_kendaraan_id',
            'tujuan',
            'desc',
            'jumlah_penumpang',
            'keperluan',
            'waktu_keberangkatan',
            'waktu_tiba',
//            'deleted',
//            'deleted_at',
//            'deleted_by',
//            'created_at',
//            'created_by',
//            'updated_at',
//            'updated_by',
//            'kendaraan_id',
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
        ],
    ]) ?>

</div>
