<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\components\ToolsColumn;
use yii\base\Model;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\ubux\models\LaporanPemakaianKendaraanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laporan Pemakaian Kendaraan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubux-laporan-pemakaian-kendaraan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        <?= Html::a('Tambah Laporan Pemakaian Kendaraan', ['add'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'laporan_pemakaian_kendaraan_id',
            'tujuan',
            'desc',
            'jumlah_penumpang',
            'keperluan',
             'waktu_keberangkatan',
             'waktu_tiba',
            // 'deleted',
            // 'deleted_at',
            // 'deleted_by',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',
//             'kendaraan_id',
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

            ['class' => 'common\components\ToolsColumn',
                'template' => '{view} {update} {delete}',// {edit} {cancel}',
                'header' => 'Aksi',
                'buttons' => [
                    'view' => function ($url, $model){
                        return ToolsColumn::renderCustomButton($url, $model, 'Lihat Rincian', 'fa fa-eye');
                    },
                    'update' => function ($url, $model){
                        return ToolsColumn::renderCustomButton($url, $model, 'Ubah', 'fa fa-pencil');
                    },
                    'delete' => function ($url, $model){
                        return "<li>".Html::a('<span class="fa fa-trash"></span> Hapus', $url, [
                                'title' => Yii::t('yii', 'Legitimate'),
                                'data-confirm' => Yii::t('yii', 'Apakah anda yakin ingin menghapus ?'),
                                'data-method' => 'post',
                                'data-pjax' => '0',
                            ])."</li>";

                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index){
                    if ($action === 'view') {
                        return Url::toRoute(['view', 'id' => $key]);
                    }else if ($action === 'edit') {
                        return Url::toRoute(['update', 'id' => $key]);
                    }else if ($action === 'delete') {
                        return Url::toRoute(['del', 'id' => $key]);
                    }
                }

            ],
        ],
    ]); ?>

</div>
