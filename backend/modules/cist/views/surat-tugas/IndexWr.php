<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\ToolsColumn;
use backend\modules\cist\models\SuratTugas;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\cist\models\search\SuratTugasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Surat Tugas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-tugas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        Pjax::begin();
        echo GridView::widget([
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
                [
                    'attribute' => 'jenis_surat_id',
                    'label' => 'Jenis Surat',
                    'value' => 'idJenisSurat.jenis_surat',
                    'filter' => ArrayHelper::map($jenisSurat, 'jenis_surat_id', 'jenis_surat'),
                    'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'ALL'],
                    'headerOptions' => ['style' => 'width:15%'],
                ],
                ['class' => 'common\components\ToolsColumn',
                    'template' => '{view}{confirm}{reject}',
                    'header' => 'Aksi',
                    'buttons' => [
                        'view' => function($url, $model){
                            return ToolsColumn::renderCustomButton($url, $model, 'Lihat Surat Tugas', 'fa fa-eye');
                        },
                        'confirm' => function($url, $model){
                            return ToolsColumn::renderCustomButton($url, $model, 'Terima Laporan', 'fa fa-check');
                        },
                        'reject' => function($url, $model){
                            return ToolsColumn::renderCustomButton($url, $model, 'Tolak Laporan', 'fa fa-times');
                        },
                    ],
                    'urlCreator' => function($action, $model, $key, $index){
                        if($action === 'view'){
                            $url = 'view-wr?id=' . $model['surat_tugas_id'];
                            
                            return $url;
                        }else if($action === 'confirm'){
                            $url = 'terima-laporan?id=' . $model['surat_tugas_id'];
                            
                            return $url;
                        }else if($action === 'reject'){
                            $url = 'tolak-laporan-tugas?id=' . $model['surat_tugas_id'];
                            
                            return $url;
                        }
                    }
                ],
            ],
        ]); 
        Pjax::end();
    ?>

</div>
