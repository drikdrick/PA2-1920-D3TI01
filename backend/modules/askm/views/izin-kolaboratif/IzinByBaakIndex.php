<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\components\SwitchColumn;
use common\components\ToolsColumn;
use common\helpers\LinkHelper;
use backend\modules\askm\models\StatusRequest;
use backend\modules\askm\models\Pegawai;
use backend\modules\askm\models\Pedoman;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\search\IzinTambahanJamKolaboratifSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Izin Tambahan Jam Kolaboratif';
$this->params['breadcrumbs'][] = $this->title;
$this->params['header'] = 'Izin Tambahan Jam Kolaboratif';
$status_url = urldecode('IzinKolaboratifSearch%5Bstatus_request_id%5D');
$pedoman = Pedoman::find()->where('deleted!=1')->andWhere(['jenis_izin' => 4])->one();

$uiHelper=\Yii::$app->uiHelper;
?>
<div class="izin-kolaboratif-index">

    <!-- <div class="pull-right">
        Manage Request
        <?= $uiHelper->renderButtonSet([
                'template' => ['approve-all', 'reject-all'],
                'buttons' => [
                    'approve-all' => ['url' => Url::toRoute(['approve-all', 'id_baak' => 1]), 'label'=> 'Setujui semua request', 'icon'=>'fa fa-check'],
                    'reject-all' => ['url' => Url::toRoute(['reject-all', 'id_baak' => 1]), 'label'=> 'Tolak semua request', 'icon'=>'fa fa-times'],
                ],
            ]) ?>
    </div> -->

    <?php
        $status1 = ($status_request_id == 0)?'active':'';
        $status2 = ($status_request_id == 1)?'active':'';
        $status3 = ($status_request_id == 2)?'active':'';
        $status4 = ($status_request_id == 3)?'active':'';

        $toolbarItemStatusRequest =  
            "<a href='".Url::to(['izin-by-baak-index'])."' class='btn btn-default ".$status1."'><i class='fa fa-list'></i><span class='toolbar-label'>All</span></a>
            <a href='".Url::to(['izin-by-baak-index', $status_url => 1])."' class='btn btn-info ".$status2."'><i class='fa fa-info'></i><span class='toolbar-label'>Requested</span></a>
            <a href='".Url::to(['izin-by-baak-index', $status_url => 2])."' class='btn btn-success ".$status3."'><i class='fa fa-check'></i><span class='toolbar-label'>Accepted</span></a>
            <a href='".Url::to(['izin-by-baak-index', $status_url => 3])."' class='btn btn-danger ".$status4."'><i class='fa fa-ban'></i><span class='toolbar-label'>Rejected</span></a>
            <a href='".Url::to(['izin-by-baak-index', $status_url => 4])."' class='btn btn-warning ".$status4."'><i class='fa fa-times'></i><span class='toolbar-label'>Canceled</span></a>
            "
            ;

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
        'filterModel' => $searchModel,
        'options' => ['style' => 'font-size:12px;'],
        'rowOptions' => function($model){
            if($model->status_request_id == 1){
                return ['class' => 'info'];
            } else if($model->status_request_id == 2){
                return ['class' => 'success'];
            } else if($model->status_request_id == 3){
                return ['class' => 'danger'];
            } else {
                return ['class' => 'warning'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'izin_kolaboratif_id',
            [
                'attribute' => 'dim_nama',
                'label'=>'Nama Mahasiswa',
                'format' => 'raw',
                'value'=>function ($model) {
                    return "<a href='".Url::toRoute(['/dimx/dim/mahasiswa-view', 'dim_id' => $model->dim_id])."'>".$model->dim->nama."</a>";
                },
            ],
            [
                'attribute'=>'rencana_mulai',
                'label' => 'Rencana Mulai',
                'format'=> 'raw',
                'headerOptions' => ['style' => 'color:#3c8dbc'],
                'value'=>function($model,$key,$index){
                    if($model->rencana_mulai==NULL){
                        return '-';
                    }
                    else{
                        return date('d M Y', strtotime($model->rencana_mulai));
                    }
                },
                'filter'=>DateTimePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'rencana_mulai',
                    'template'=>'{input}{reset}{button}',
                        'clientOptions' => [
                            'startView' => 2,
                            'minView' => 2,
                            'maxView' => 2,
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                        ],
                ])
            ],
            [
                'attribute'=>'rencana_berakhir',
                'label' => 'Rencana Berakhir',
                'format'=> 'raw',
                'headerOptions' => ['style' => 'color:#3c8dbc'],
                'value'=>function($model,$key,$index){
                    if($model->rencana_berakhir==NULL){
                        return '-';
                    }
                    else{
                        return date('d M Y', strtotime($model->rencana_berakhir));
                    }
                },
                'filter'=>DateTimePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'rencana_berakhir',
                    'template'=>'{input}{reset}{button}',
                        'clientOptions' => [
                            'startView' => 2,
                            'minView' => 2,
                            'maxView' => 2,
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                        ],
                ])
            ],
            [
                'attribute' => 'batas_waktu',
                'value' => function($model){return date('H:i', strtotime($model->batas_waktu));},
            ],
            'desc:ntext',
            // 'status_request_id',
            // [
            //     'attribute'=>'status_request_id',
            //     'label' => 'Status Request',
            //     'filter'=>ArrayHelper::map(StatusRequest::find()->asArray()->all(), 'status_request_id', 'status_request'),
            //     'value' => 'statusRequest.status_request',
            // ],
            // 'baak_id',

            ['class' => 'common\components\ToolsColumn',
                 'template' => '{view} {edit} {approve} {reject}',
                'header' => 'Aksi',
                'buttons' => [
                    'view' => function ($url, $model){
                        return ToolsColumn::renderCustomButton($url, $model, 'View Detail', 'fa fa-eye');
                    },
                    'approve' => function ($url, $model){
                        if ($model->status_request_id == 2 || $model->status_request_id == 3 || $model->status_request_id == 4) {
                            return "";
                        }else{
                            return ToolsColumn::renderCustomButton($url, $model, 'Approve', 'fa fa-check');
                        }
                    },
                    'reject' => function ($url, $model){
                        if ($model->status_request_id == 2 || $model->status_request_id == 3 || $model->status_request_id == 4) {
                            return "";
                        }else{
                            return ToolsColumn::renderCustomButton($url, $model, 'Reject', 'fa fa-times');
                        }
                    },
                    'edit' => function ($url, $model){
                        if ($model->status_request_id == 2 || $model->status_request_id == 3 || $model->status_request_id == 4) {
                            return "";
                        }else{
                            return ToolsColumn::renderCustomButton($url, $model, 'Edit', 'fa fa-pencil');
                        }
                    }
                ],
                'urlCreator' => function ($action, $model, $key, $index){
                    $baak = Pegawai::find()->where('deleted != 1')->andWhere(['user_id' => Yii::$app->user->identity->user_id])->one();
                    if ($action === 'view') {
                        return Url::toRoute(['izin-by-baak-view', 'id' => $key]);
                    }else if ($action === 'approve') {
                        return Url::toRoute(['izin-by-baak-approve', 'id' => $key, 'id_baak' => $baak->pegawai_id]);
                    }else if ($action === 'edit') {
                        return Url::toRoute(['izin-by-baak-edit', 'id' => $key]);
                    }else if ($action === 'reject') {
                        return Url::toRoute(['izin-by-baak-reject', 'id' => $key, 'id_baak' => $baak->pegawai_id]);
                    }
                    
                }
            ],
        ],
    ]); ?>

    <?=$uiHelper->beginContentRow() ?>

        <?=$uiHelper->beginContentBlock(['id' => 'grid-system2',
            'header' => $pedoman->judul,
            'type' => 'danger',
            'width' => 12,
        ]); ?>

        <?= $pedoman->isi ?>

        <?= $uiHelper->endContentBlock()?>

    <?=$uiHelper->endContentRow() ?>
    
</div>

