<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\data\Sort;
use common\components\ToolsColumn;
use backend\modules\cist\models\SuratTugas;

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
        $dataProvider =  new ArrayDataProvider([
            'allModels' => $model,
            'pagination' => [
                'pageSize' => 15,
            ],
            'sort' => [
                'defaultOrder' => [
                    // 'updated_at' => SORT_DESC,
                    // 'created_at' => SORT_DESC
                ],
            ],
        ]);
        // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '-',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [   
                'label' => 'Perequest',
                'attribute' => 'perequest',
                'value' => 'perequest0.nama'
            ],
            'no_surat',
            'agenda',
            'tanggal_berangkat',
            'tanggal_kembali',
            [
                'label' => 'Status Surat Tugas',
                'attribute' => 'name',
                'value' => 'statusName.name',
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
                        return ToolsColumn::renderCustomButton($url, $model, 'Terima Surat Tugas', 'fa fa-check');
                    },
                    'reject' => function($url, $model){
                        return ToolsColumn::renderCustomButton($url, $model, 'Tolak Surat Tugas', 'fa fa-times');
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
                        $url = 'tolak?id=' . $model['surat_tugas_id'];
                        
                        return $url;
                    }
                }
            ],
        ],
    ]); ?>

</div>
