<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use kartik\datetime\DateTimePicker;
use common\components\ToolsColumn;

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
        'columns' => [
            ['class' => 'backend\modules\baak\assets\SerialColumn'],

            [
                'attribute'=>'pemohon_id',
                'value'=>'dim.nama',
            ],

            'alasan',
            [
                'attribute'=>'status_pengajuan_id',
                'value'=>'statusPengajuan.name',
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
                'template' => '{view} {accept} {decline} {ready}',
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
                }
            ],
        ],
    ]); ?>

</div>