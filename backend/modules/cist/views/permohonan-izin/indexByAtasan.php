<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\helpers\LinkHelper;
use common\components\ToolsColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\cist\models\search\PermohonanIzinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permohonan Izin';
$this->params['breadcrumbs'][] = $this->title;
$uiHelper=\Yii::$app->uiHelper;
?>
<div class="permohonan-izin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $uiHelper->renderLine(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['style' => 'font-size:12px;'],
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'pegawai_nama',
                'value' => 'permohonanIzin.pegawai.nama',
                'label' => 'Pemohon',
            ],
            // [
            //     'attribute' => 'lama_izin',
            //     'value' => 'permohonanIzin.lama_izin',
            //     'label' => 'Lama Izin (Hari)',
            // ],
            [
                //'attribute' => 'waktu_pelaksanaan',
                'value' => function($model){
                    $date = explode(',', $model->permohonanIzin->waktu_pelaksanaan);
                    $date2 = '';
                    $first = true;
                    foreach ($date as $d) {
                        $d = trim($d);
                        if(!$first){
                             $date2.= '<br />';
                        }
                        $date2.= '- '.date('d M Y', strtotime($d));
                        if ($first) {
                             $first = false;
                        }
                    }
                    return $date2;
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'alasan_izin',
                'value' => 'permohonanIzin.alasan_izin',
                'label' => 'Alasan Izin',
            ],
            [
                'attribute' => 'pengalihan_tugas',
                'value' => 'permohonanIzin.pengalihan_tugas',
                'label' => 'Pengalihan Tugas',
            ],
            [
                'label' => 'Status Request',
                'filter' => '',
                'value' => function($model){
                    if ($model->permohonanIzin->statusIzin->status_by_atasan == 5 || $model->permohonanIzin->statusIzin->status_by_hrd == 5 || $model->permohonanIzin->statusIzin->status_by_wr2 == 5) {
                        return 'Dibatalkan';
                    } elseif ($model->permohonanIzin->statusIzin->status_by_atasan == 1) {
                        return 'Menunggu Persetujuan Atasan';
                    } elseif ($model->permohonanIzin->statusIzin->status_by_wr2 == 1) {
                        return 'Menunggu Persetujuan WR2';
                    } elseif ($model->permohonanIzin->statusIzin->status_by_atasan == 4) {
                        return 'Ditolak oleh Atasan';
                    } elseif ($model->permohonanIzin->statusIzin->status_by_wr2 == 4) {
                        return 'Ditolak oleh WR2';
                    } else {
                        return 'Disetujui';
                    }
                },
            ],

            ['class' => 'common\components\ToolsColumn',
                'template' => '{view} {setuju} {tolak}',
                'header' => 'Action',
                'buttons' => [
                    'view' => function ($url, $model){
                        return ToolsColumn::renderCustomButton($url, $model, 'View Detail', 'fa fa-eye');
                    },
                    'setuju' => function ($url, $model){
                        if ($model->permohonanIzin->statusIzin->status_by_wr2 == 1 && $model->permohonanIzin->statusIzin->status_by_atasan == 1) {
                            return ToolsColumn::renderCustomButton($url, $model, 'Approve', 'fa fa-check');
                        }
                        else{
                            return "";
                        }
                    },
                    'tolak' => function ($url, $model){
                        if ($model->permohonanIzin->statusIzin->status_by_wr2 == 1) {
                            return ToolsColumn::renderCustomButton($url, $model, 'Reject', 'fa fa-times');
                        }else{
                            return "";
                        }
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index){
                    if ($action === 'view') {
                        return Url::toRoute(['view-by-atasan', 'id' => $model->permohonan_izin_id]);
                    } else if ($action === 'setuju') {
                        return Url::toRoute(['accept-by-atasan', 'id' => $model->permohonan_izin_id]);
                    } else if ($action === 'tolak') {
                        return Url::toRoute(['reject-by-atasan', 'id' => $model->permohonan_izin_id]);
                    }
                }

            ],

        ],
    ]); ?>

</div>
