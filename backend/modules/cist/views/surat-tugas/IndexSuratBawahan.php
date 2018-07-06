<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\data\Sort;
use common\components\ToolsColumn;
use backend\modules\cist\models\SuratTugas;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $searchModel backend\modules\cist\models\search\SuratTugasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Surat Tugas Bawahan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-tugas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
        // echo "<pre>"; print_r($model); die();
        // $dataProvider =  new ArrayDataProvider([
        //     'allModels' => $model,
        //     'pagination' => [
        //         'pageSize' => 7,
        //     ],
        //     'sort' => [
        //         'defaultOrder' => [
        //             // 'updated_at'  => SORT_DESC,
        //             // 'created_at' => SORT_DESC
        //         ],
        //     ],
        // ]);
        // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '-',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [   
                'label' => 'Nama',
                'value' => 'perequest0.nama',
                'filter' => '',
            ],
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
                'template' => '{view}{confirm}{reject}',
                'header' => 'Aksi',
                'buttons' => [
                    'view' => function($url, $model){
                        return ToolsColumn::renderCustomButton($url, $model, 'Lihat Surat Tugas', 'fa fa-eye');
                    },
                    'confirm' => function($url, $model){
                        return "<li>".Html::a('<span class="fa fa-check"></span> Terima Surat Tugas', $url, [
                            'title' => Yii::t('yii', 'Terima Surat Tugas'),
                            'data-confirm' => Yii::t('yii', 'Terima surat tugas?'),
                            'data-method' => 'post',
                             'data-pjax' => '0',
                        ])."</li>";
                    },
                    'reject' => function($url, $model){
                        return "<li>".Html::a('<span class="fa fa-times"></span> Tolak Surat Tugas', $url, [
                            'title' => Yii::t('yii', 'Tolak Surat Tugas'),
                            'data-confirm' => Yii::t('yii', 'Yakin untuk menolak surat tugas?'),
                            'data-method' => 'post',
                             'data-pjax' => '0',
                        ])."</li>";
                    },
                ],
                'urlCreator' => function($action, $model, $key, $index){
                    if($action === 'view'){
                        $url = 'view-surat-bawahan?id=' . $model['surat_tugas_id'];
                        
                        return $url;
                    }else if($action === 'confirm'){
                        $url = 'terima?id=' . $model['surat_tugas_id'];
                        
                        return $url;
                    }else if($action === 'reject'){
                        $url = 'tolak-surat-tugas?id=' . $model['surat_tugas_id'];
                        
                        return $url;
                    }
                }
            ],
        ],
    ]); ?>

</div>
