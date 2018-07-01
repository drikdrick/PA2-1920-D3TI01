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

    <div class="col-md-9">
        <?= Html::a('Buat Permohonan Pemakaian', ['add-by-pribadi'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="col-md-3">
        <p style="color: red;"><b>Nomor yang dapat dihubungi: Ibu Cori : 0822 7335 4777 (WA) atau 0812 6219 9995 (HP)</b></p>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model){
            if($model->status_req_sekretaris_rektorat == 3) return ['class' => 'danger'];
            else return ['class' => 'Pasif'];
        },
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
                'attribute' => 'status_req_sekretaris_rektorat',
                'label' => 'Status Persetujuan Sekretaris Rektorat',
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
                'template' => '{view}{edit}{del}',
                'urlCreator' => function($action, $model, $key, $index){
                    if($action === 'view'){
                        return Url::toRoute(['view-by-pribadi', 'id' => $key]);
                    }
                    if($model->status_req_sekretaris_rektorat == 1 && $model->status_request_kemahasiswaan == 1 && $model->status_request_hrd == 1 && $model->status_request_kabiro_KSD == 1 && $model->status_request_keuangan == 1 && $model->status_request_wr2 == 1){
                        if($action == 'edit'){
                            return Url::toRoute(['edit-by-pribadi', 'id' => $key]);
                        }
                        if($action == 'del'){
                            return Url::toRoute(['del', 'id' => $key]);
                        }
                    }else{
                        return Url::toRoute(['pop-up-pribadi', 'id' => $key]);
                    }
                }
            ],
        ],
    ]); ?>


</div>
