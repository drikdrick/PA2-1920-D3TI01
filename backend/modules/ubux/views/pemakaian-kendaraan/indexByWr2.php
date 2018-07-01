<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\ubux\models\PemakaianKendaraanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permohonan Pemakaian untuk Keperluan Pribadi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubux-transaksi-kendaraan-mahasiswa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'pemakaian_kendaraan_id',
            'desc',
            'tujuan',
//            'jumlah_penumpang_kendaraan',
//            'rencana_waktu_keberangkatan',
//             'rencana_waktu_kembali',
//             'status_request_kemahasiswaan',
//             'jenis_keperluan_id',
//             'proposal',
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
            [
                'attribute' => 'Status Request Sekretaris Rektorat',
                'value' => 'statusRequestSekretarisRektorat.status',
            ],
            [
                'attribute' => 'status_request_kabiro_KSD',
                'value' => 'statusRequestKabiroKSD.status',
            ],
            [
                'attribute' => 'status_request_hrd',
                'value' => 'statusRequestHRD.status',
            ],
            [
                'attribute' => 'status_request_keuangan',
                'value' => 'statusRequestKeuangan.status',
            ],
            [
                'attribute' => 'status_request_wr2',
                'value' => 'statusRequestWr2.status',
            ],
//            'status_request_kabiro_KSD',
//            'status_request_hrd',
//            'status_request_keuangan',
//            'status_request_wr2',
            [
                'class' => 'common\components\ToolsColumn',
                'template' => '{view}{acc}{rej}',
                'urlCreator' => function($action, $model, $key, $index){
                    if($action === 'view'){
                        return Url::toRoute(['view-by-wr2', 'id' => $key]);
                    }
                    if($action === 'acc'){
                        return Url::toRoute(['accept-by-wr2', 'id' => $key]);
                    }
                    if($action === 'rej'){
                        return Url::toRoute(['reject-by-wr2', 'id' => $key]);
                    }
                }
            ],
        ],
    ]); ?>


</div>
