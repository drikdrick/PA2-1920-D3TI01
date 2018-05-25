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

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\search\IzinTambahanJamKolaboratifSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Izin Tambahan Jam Kolaboratif';
$this->params['breadcrumbs'][] = $this->title;
$this->params['header'] = 'Izin Tambahan Jam Kolaboratif';
$status_url = urldecode('IzinKolaboratifSearch%5Bstatus_request_id%5D');

$uiHelper=\Yii::$app->uiHelper;
?>
<div class="izin-kolaboratif-index">

    <!-- <?= $uiHelper->renderContentSubHeader(' Daftar '.$this->title, ['icon' => 'fa fa-list']);?>
    <?= $uiHelper->renderLine(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?> -->

    <p>
        <?= Html::a('Request izin', ['izin-by-mahasiswa-add'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?php
        $status1 = ($status_request_id == 0)?'active':'';
        $status2 = ($status_request_id == 1)?'active':'';
        $status3 = ($status_request_id == 2)?'active':'';
        $status4 = ($status_request_id == 3)?'active':'';

        $toolbarItemStatusRequest =  
            "<a href='".Url::to(['izin-by-mahasiswa-index'])."' class='btn btn-default ".$status1."'><i class='fa fa-list'></i><span class='toolbar-label'>All</span></a>
            <a href='".Url::to(['izin-by-mahasiswa-index', $status_url => 1])."' class='btn btn-info ".$status2."'><i class='fa fa-info'></i><span class='toolbar-label'>Requested</span></a>
            <a href='".Url::to(['izin-by-mahasiswa-index', $status_url => 2])."' class='btn btn-success ".$status3."'><i class='fa fa-check'></i><span class='toolbar-label'>Accepted</span></a>
            <a href='".Url::to(['izin-by-mahasiswa-index', $status_url => 3])."' class='btn btn-danger ".$status4."'><i class='fa fa-ban'></i><span class='toolbar-label'>Rejected</span></a>
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
            // [
            // 'attribute' => 'dim_id',
            // 'label' => 'Nama Mahasiswa',
            // 'value' => 'dim.nama',
            // ],
            'rencana_mulai',
            'rencana_berakhir',
            'batas_waktu',
            'desc:ntext',
            // [
            //     'attribute'=>'status_request_id',
            //     'label' => 'Status Request',
            //     'filter'=>ArrayHelper::map(StatusRequest::find()->asArray()->all(), 'status_request_id', 'status_request'),
            //     'value' => 'statusRequest.status_request',
            // ],
            
            // 'baak_id',

            ['class' => 'common\components\ToolsColumn',
                 'template' => '{view} {edit} {cancel}',
                'header' => 'Aksi',
                'buttons' => [
                    'view' => function ($url, $model){
                        return ToolsColumn::renderCustomButton($url, $model, 'View Detail', 'fa fa-eye');
                    },
                    'edit' => function ($url, $model){
                        if ($model->status_request_id == 2 || $model->status_request_id == 3 || $model->status_request_id == 4) {
                            return "";
                        }else{
                            return ToolsColumn::renderCustomButton($url, $model, 'Edit', 'fa fa-pencil');
                        }
                    },
                    'cancel' => function ($url, $model){
                        if ($model->status_request_id == 2 || $model->status_request_id == 3 || $model->status_request_id == 4) {
                            return "";
                        }else{
                            return ToolsColumn::renderCustomButton($url, $model, 'Cancel', 'fa fa-times');
                        }
                    }
                ],
                'urlCreator' => function ($action, $model, $key, $index){
                    if ($action === 'view') {
                        return Url::toRoute(['izin-by-mahasiswa-view', 'id' => $key]);
                    }else if ($action === 'edit') {
                        return Url::toRoute(['izin-by-mahasiswa-edit', 'id' => $key]);
                    }
                    else if ($action === 'cancel') {
                        return Url::toRoute(['cancel-by-mahasiswa', 'id' => $key]);
                    }
                    
                }
            ],
        ],
    ]); ?>
</div>

