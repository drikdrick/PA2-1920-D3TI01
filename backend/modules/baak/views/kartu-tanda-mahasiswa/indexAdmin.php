<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use kartik\datetime\DateTimePicker;
use common\components\ToolsColumn;
use yii\helpers\ArrayHelper;
use backend\modules\baak\models\StatusPengajuan;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\baak\models\KtmSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kartu Tanda Mahasiswa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ktm-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '-',
        ],
        'filterModel' => $searchModel,
        'rowOptions' => function($model){
            if($model->status_pengajuan_id == 2){
                return ['class' => 'info'];
            } else if($model->status_pengajuan_id == 3){
                return ['class' => 'danger'];
            } else if($model->status_pengajuan_id == 4){
                return ['class' => 'warning'];
            }else if($model->status_pengajuan_id == 5){
                return ['class' => 'success'];
            }
        },

        'columns' => [
            ['class' => 'backend\modules\baak\assets\SerialColumn'],

            [
                'attribute'=>'pemohon_id',
                'value'=>'pemohon.nama',
            ],

            'alasan',

            [
                'attribute'=>'status_pengajuan_id',
                'label' => 'Status',
                'filter'=>ArrayHelper::map(StatusPengajuan::find()->asArray()->all(), 'status_pengajuan_id', 'name'),
                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Semua Status'],
                'value' => 'statusPengajuan.name',
            ],


            [
                'attribute'=>'waktu_pengambilan',
                'value'=>'waktu_pengambilan',
                'format'=>'raw',
                'filter'=>DateTimePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'waktu_pengambilan',
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd h:i',
                        ]
                ])
            ],

            ['class' => 'common\components\ToolsColumn',
                'template' => '{view} {accept} {decline} {ready} {done}',
                'header' => 'Action',
                'buttons' => [
                    'accept' => function ($url, $model){
                        if($model->status_pengajuan_id == 1){
                            return "<li>".Html::a('<span class="fa fa-check"></span> Accept', $url)."</li>";
                        }
                    },
                    'decline' => function ($url, $model){
                        if($model->status_pengajuan_id == 1){
                            return "<li>".Html::a('<span class="fa fa-remove"></span> Decline', $url)."</li>";
                        }
                    },
                    'ready' => function ($url, $model){
                        if($model->status_pengajuan_id == 2){
                            return "<li>".Html::a('<span class="fa fa-thumbs-up"></span> Ready to Take', $url)."</li>";
                        }
                    },
                    'done' => function ($url, $model){
                        if($model->status_pengajuan_id == 4){
                            return "<li>".Html::a('<span class="fa fa-check"></span> Done', $url)."</li>";
                        }
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index){
                    if ($action === 'view') {
                        return Url::toRoute(['view-admin', 'id' => $key]);
                    } 
                    if ($action === 'accept') {
                        return Url::toRoute(['edit-accept', 'id' => $key]);
                    }
                    if ($action === 'decline') {
                        return Url::toRoute(['edit-decline', 'id' => $key]);
                    }
                    if ($action === 'ready') {
                        return Url::toRoute(['edit-ready', 'id' => $key]);
                    }
                    if ($action === 'done') {
                        return Url::toRoute(['edit-done', 'id' => $key]);
                    }
                }
            ],
        ],
    ]); ?>

</div>
