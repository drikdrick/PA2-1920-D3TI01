<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\ubux\models\PemakaianKendaraanMahasiswaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permohonan Pemakaian oleh Mahasiswa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubux-transaksi-kendaraan-mahasiswa-baru-index">

        <h1><?= Html::encode($this->title) ?></h1>
    <!-- <div class="col-md-3">
        <p style="color: red;"><b>Nomor yang dapat dihubungi: Ibu Cori : 0822 7335 4777 (WA) atau 0812 6219 9995 (HP)</b></p>
    </div> -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model){
            if($model->status_request_kemahasiswaan == 3) return ['class' => 'danger'];
            elseif($model->status_request_kemahasiswaan == 2) return ['class' => 'success'];
            else return [];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'dim_id',
            [
                    'attribute' => 'NIM',
                'value' => 'mahasiswa.nim',
            ],
            [
                'attribute' => 'Nama',
                'value' => 'mahasiswa.nama',
            ],
            'desc',
            'tujuan',
             'jumlah_penumpang_kendaraan',
//             'rencana_waktu_keberangkatan',
//             'rencana_waktu_kembali',
            
            [
                'attribute' => 'status_request_kemahasiswaan',
                'value' => 'statusRequestKemahasiswaan.status'
            ],
            [
                'attribute' => 'status_req_sekretaris_rektorat',
                'value' => 'statusRequestSekretarisRektorat.status',
                'label' => 'Status Akhir'
            ],
            // 'proposal',
//             'no_telepon',
            // 'deleted',
            // 'deleted_at',
            // 'deleted_by',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',
//             'kendaraan_id',
//            [
//                    'attribute' => 'Kendaraan',
//                'value' => 'kendaraan.kendaraan',
//            ],
//             'supir_id',
//             [
//                     'attribute' => 'Supir',
//                 'value' => 'supir.name_supir',
//             ],
//             'no_hp_supir',
            [
                'class' => 'common\components\ToolsColumn',
                'template' => '{view}{acc}{rej}',
                'urlCreator' => function($action, $model, $key, $index){
                    if($action === 'view'){
                        return Url::toRoute(['view-by-kemahasiswaan', 'id' => $key]);
                    }
                    if($action === 'acc'){
                        return Url::toRoute(['accept', 'id' => $key]);
                    }
                    if($action === 'rej'){
                        return Url::toRoute(['reject', 'id' => $key]);
                    }
                }
            ],

        ],
    ]); ?>

</div>
