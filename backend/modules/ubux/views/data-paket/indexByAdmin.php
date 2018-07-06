<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use backend\modules\ubux\models\PosisiPaket;
use backend\modules\ubux\models\StatusPaket;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\ubux\models\search\DataPaketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Paket';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-paket-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
        $toolbarItemStatusRequest =
            "<a href='".Url::to(['index-by-admin'])."' class='btn btn-info '><i class='fa fa-refresh'></i> <span class='toolbar-label'>Refresh</span></a>";

    ?>

    <?=Yii::$app->uiHelper->renderToolbar([
    'pull-right' => true,
    'groupTemplate' => ['groupStatusExpired'],
    'groups' => [
        'groupStatusExpired' => [
            'template' => ['filterStatus'],
            'buttons' => [
                'filterStatus' => $toolbarItemStatusRequest,
            ]
        ],
    ],
    ]) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'=>$searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // [
            //     'attribute'=>'tag',
            //     'value'=>function($model,$key,$index){
            //         if($model->tag==NULL){
            //             return '-';
            //         }
            //         return $model->tag;
            //     }
            
            // ],
            [
                'attribute'=>'dim_nama',
                'headerOptions' => ['style' => 'color:#3c8dbc'],
                'format'=>'raw',
                'label'=>'Nama Mahasiswa',
                'value'=>function($model,$key,$index){
                    if($model->dim_id!=NULL){
                        return $model->dim->nama;
                    }
                    else {
                        return '-';
                    }
                }
            ],

            [
                'attribute'=>'pegawai_nama',
                'headerOptions' => ['style' => 'color:#3c8dbc'],
                'format'=>'raw',
                'label'=>'Nama Pegawai',
                'value'=>function($model,$key,$index){
                    if($model->pegawai_id!=NULL){
                        return $model->pegawai->nama;
                    }
                    else{
                        return '-';
                    }
                },
            ],
            'pengirim',
            [
                'attribute'=>'tanggal_kedatangan',
                'format'=>['Date','php: d M y H:i'],
                'filter'=>DatePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'tanggal_kedatangan',
                    'dateFormat' => 'yyyy-MM-dd'
                ])
            ],
             [
                 'attribute'=>'posisi_paket_id',
                 'label'=>'Posisi',
                 'value'=>'posisiPaket.name',
                 'filter'=>ArrayHelper::map(PosisiPaket::find()->where('deleted!=1')->asArray()->all(),'posisi_paket_id','name'),
                 
             ],
             [
                 'attribute'=>'status_paket_id',
                 'format'=>'raw',
                 'label'=>'Status Paket',
                 'value'=>function($model,$key,$index){
                     if($model->status_paket_id==1){
                         return '<b class="text-danger">'.$model->statusPaket->status.'</b>';
                     }
                     else{
                        return '<b class="text-success">'.$model->statusPaket->status.'</b>';
                     }
                 },
                 'filter'=>ArrayHelper::map(StatusPaket::find()->where('deleted!=1')->asArray()->all(),'status_paket_id','status')
             ],
             ['class' => 'common\components\ToolsColumn',
             'template' => '{view}',
             'urlCreator' => function ($action, $model, $key, $index){
                 if ($action === 'view') {
                     return Url::toRoute(['data-paket-view', 'id' => $key]);
                 } 
             }
         ]
        ],
    ]); ?>

</div>
