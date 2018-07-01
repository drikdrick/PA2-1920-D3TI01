<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\base\Model;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\ubux\models\PemakaianKendaraanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Semua Permohonan Pemakaian';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubux-transaksi-kendaraan-mahasiswa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<!--
    <p>
        <?= Html::a('Permintaan Kendaraan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model){
            if($model->status_req_sekretaris_rektorat == 3) return ['class' => 'danger'];
            elseif($model->status_req_sekretaris_rektorat == 2) return ['class' => 'success'];
            else return [];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'pegawai_id',
            [
                    'attribute' => 'Nama',
                'value' => function(Model $model){
                    if($model->pegawai_id == null){
                        return 'Kemahasiswaan';
                    }else{
                        return $model->pegawai->nama;
                    }
                }
            ],
            'desc',
            'tujuan',
//            'jumlah_penumpang_kendaraan',
//            'rencana_waktu_keberangkatan',
//             'rencana_waktu_kembali',
//             'status_request_kemahasiswaan',
//            'jenis_keperluan_id',
            [
                    'attribute' => 'Jenis Permintaan',
                'value' => 'jenisKeperluan.jenis_keperluan',
            ],
//             'proposal',
            // 'deleted',
            // 'deleted_at',
            // 'deleted_by',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',
//            'kendaraan_id',
            [
                    'attribute' => 'Kendaraan',
                'value' => function(Model $model){
                    if($model->kendaraan_id != null){
                        return $model->kendaraan->kendaraan;
                    }else{
                        return '-';
                    }
                }
            ],
//            'status_req_sekretaris_rektorat',
            [
                    'attribute' => 'Status',
                'value' => 'statusRequestSekretarisRektorat.status'
            ],
            [
                    'attribute' => 'Laporan Pemakaian',
                'value' => function(Model $model){
                    if($model->laporan == 0) return 'Belum Ada';
                    else return 'Sudah Dibuat';
                }
            ],
            [
                'class' => 'common\components\ToolsColumn',
                'template' => '{view}{acc}{edit}{rej}{laporan}',
                'urlCreator' => function($action, $model, $key, $index){
                    if($action === 'view'){
                        return Url::toRoute(['view-by-sekretaris-rektorat', 'id' => $key]);
                    }
                    if($action === 'acc'){
                        return Url::toRoute(['accept-by-sekretaris-rektorat', 'id' => $key]);
                    }
                    if($action === 'edit'){
                        return Url::toRoute(['edit-by-sekretaris-rektorat', 'id' => $key]);
                    }
                    if($action === 'rej'){
                        return Url::toRoute(['reject-by-sekretaris-rektorat', 'id' => $key]);
                    }
                    if($action === 'laporan'){
                        return Url::toRoute(['laporan-pemakaian-kendaraan/add-laporan-pemakaian', 'id' => $key]);
                    }
                }
            ],
        ],
    ]); ?>
</div>
