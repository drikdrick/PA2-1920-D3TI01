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

    <div class="pull-right">
        <p>
            <?= Html::a('<i class="fa fa-envelope"></i> Request Izin', ['add-by-staf'], ['class' => 'btn btn-default btn-flat btn-set btn-sm']) ?>
        </p>
    </div>

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $uiHelper->renderLine(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['style' => 'font-size:12px;'],
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // [
            //     'attribute' => 'lama_izin',
            //     'label' => 'Lama Izin (Hari)',
            //     'value' => 'lama_izin',
            // ],
            [
                'attribute' => 'waktu_pelaksanaan',
                'value' => function($model){
                    $date = explode(',', $model->waktu_pelaksanaan);
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
                'value' => 'alasan_izin',
            ],
            [
                'attribute' => 'pengalihan_tugas',
                'value' => 'pengalihan_tugas',
            ],
            [
                'label' => 'Status Request',
                'filter' => '',
                'value' => function($model){
                    if ($model->statusIzin->status_by_atasan == 5 || $model->statusIzin->status_by_hrd == 5 || $model->statusIzin->status_by_wr2 == 5) {
                        return 'Dibatalkan';
                    } elseif ($model->statusIzin->status_by_atasan == 1) {
                        return 'Menunggu Persetujuan Atasan';
                    } elseif ($model->statusIzin->status_by_wr2 == 1) {
                        return 'Menunggu Persetujuan WR2';
                    } elseif ($model->statusIzin->status_by_atasan == 4) {
                        return 'Ditolak oleh Atasan';
                    } elseif ($model->statusIzin->status_by_wr2 == 4) {
                        return 'Ditolak oleh WR2';
                    } else {
                        return 'Disetujui';
                    }
                },
            ],

            ['class' => 'common\components\ToolsColumn',
                'template' => '{view} {cancel}',
                'header' => 'Action',
                'buttons' => [
                    'view' => function ($url, $model){
                        return ToolsColumn::renderCustomButton($url, $model, 'View Detail', 'fa fa-eye');
                    },
                    'cancel' => function ($url, $model){
                        if ($model->statusIzin->status_by_atasan == 1 || $model->statusIzin->status_by_wr2 == 1) {
                            return ToolsColumn::renderCustomButton($url, $model, 'Batal', 'fa fa-times');
                        }else if ($model->statusIzin->status_by_atasan != 1 || $model->statusIzin->status_by_wr2 != 1){
                            return "";
                        }
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index){
                    if ($action === 'view') {
                        return Url::toRoute(['view-by-staf', 'id' => $key]);
                    } else if ($action === 'cancel') {
                        return Url::toRoute(['cancel-by-staf', 'id' => $key]);
                    }
                }

            ],

        ],
    ]); ?>

</div>
