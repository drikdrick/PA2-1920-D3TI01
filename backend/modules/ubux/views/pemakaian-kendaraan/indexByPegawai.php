<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\base\Model;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\ubux\models\PemakaianKendaraanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permohonan Pemakaian untuk Keperluan Dinas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubux-transaksi-kendaraan-mahasiswa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Buat Permohonan Pemakaian', ['add-by-pegawai'], ['class' => 'btn btn-success']) ?>
    </p>

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
            // [
            //     'attribute' => 'Nama',
            //     'value' => function(Model $model){
            //         if($model->pegawai_id == null){
            //             return 'Kemahasiswaan';
            //         }else{
            //             return $model->pegawai->nama;
            //         }
            //     }
            // ],
            'desc',
            'tujuan',
            'jumlah_penumpang_kendaraan',
            'rencana_waktu_keberangkatan',
//            'rencana_waktu_kembali',
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
//             'status_req_sekretaris_rektorat',
            [
                'attribute' => 'status_req_sekretaris_rektorat',
                'value' => 'statusRequestSekretarisRektorat.status',
            ],
            [
                'class' => 'common\components\ToolsColumn',
                'template' => '{view}{edit}{del}',
                'urlCreator' => function($action, $model, $key, $index){
                    if($action === 'view'){
                        return Url::toRoute(['view-by-pegawai', 'id' => $key]);
                    }
                    if($model->status_req_sekretaris_rektorat == 1){
                        if($action == 'edit'){
                            return Url::toRoute(['edit-by-pegawai', 'id' => $key]);
                        }
                        if($action == 'del'){
                            return Url::toRoute(['del', 'id' => $key]);
                        }
                    }else{
                        return Url::toRoute(['pop-up-pegawai', 'id' => $key]);
                    }
                }
            ],
        ],
    ]); ?>

</div>
