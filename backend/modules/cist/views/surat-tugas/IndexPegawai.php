<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use common\components\ToolsColumn;
use backend\modules\cist\models\SuratTugas;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\cist\models\search\SuratTugasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Surat Tugas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-tugas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php 
        // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <p>
        <?php //echo Html::a('Permohonan Surat Tugas Dalam Kampus', ['add-dalam-kampus'], ['class' => 'btn btn-success']); ?>
        <?= Html::a('Permohonan Surat Tugas Perjalanan Dinas', ['add-luar-kampus'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Penugasan Perjalanan Dinas', ['add-penugasan-luar-kampus'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '-',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'perequest0.nama',
            'no_surat',
            'agenda',
            // 'tanggal_berangkat',
            // 'tanggal_kembali',
            [
                'attribute' => 'tanggal_berangkat',
                'value' => function($data){
                    return date('d M Y', strtotime($data->tanggal_berangkat)).' '.date('H:i', strtotime($data->tanggal_berangkat));
                },
                'format' => 'html',
                'filter' => '',

            ],
            [
                'attribute' => 'tanggal_kembali',
                'value' => function($data){
                    return date('d M Y', strtotime($data->tanggal_kembali)).' '.date('H:i', strtotime($data->tanggal_kembali));
                },
                'format' => 'html',
                'filter' => '',

            ],
            // [
            //     'label' => 'Status Surat Tugas',
            //     'attribute' => 'name',
            //     'value' => 'statusName.name',
            // ],
            [
                    'label' => 'Status Surat Tugas',
                    'attribute' => 'status_id',
                    'value' => 'statusName.name',
                    'filter' => ArrayHelper::map($status, 'status_id', 'name'),
                    'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'ALL'],
                    'headerOptions' => ['style' => 'width:15%'],
            ],
            [
                'label' => 'Status Laporan',
                'value' => function($model){
                    return SuratTugas::getStatusLaporan($model->surat_tugas_id);
                }
            ],

            ['class' => 'common\components\ToolsColumn',
                'template' => '{view}{edit}',
                'header' => 'Aksi',
                'buttons' => [
                    'view' => function($url, $model){
                        return ToolsColumn::renderCustomButton($url, $model, 'Lihat Surat Tugas', 'fa fa-eye');
                    },
                    'edit' => function($url, $model){
                        if($model['status_id'] == 1)
                            return ToolsColumn::renderCustomButton($url, $model, 'Ubah Surat Tugas', 'fa fa-edit');
                    },
                ],
                'urlCreator' => function($action, $model, $key, $index){
                    if($action === 'view'){
                        $url = 'view-pegawai?id=' . $model['surat_tugas_id'];
                        
                        return $url;
                    }else if($action === 'edit'){
                        $url = 'index-pegawai';
                        
                        if($model['status_id'] == 1){
                            $url = 'edit-luar-kampus?id=' . $model['surat_tugas_id'];
                        }

                        return $url;
                    }
                }
            ],
        ],
    ]); ?>

</div>
