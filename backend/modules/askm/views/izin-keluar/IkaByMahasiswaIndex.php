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
use backend\modules\askm\models\Dim;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\search\IzinKeluarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Izin Keluar';
$this->params['breadcrumbs'][] = $this->title;
$uiHelper=\Yii::$app->uiHelper;
?>
<div class="izin-keluar-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Request Izin Keluar', ['ika-by-mahasiswa-add'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model){
            if($model->status_request_keasramaan == 2 && $model->status_request_dosen_wali == 2 && $model->status_request_baak == 2){
                return ['class' => 'success'];
            } else if($model->status_request_keasramaan == 3 || $model->status_request_dosen_wali == 3 || $model->status_request_baak == 3){
                return ['class' => 'danger'];
            } else if($model->status_request_keasramaan == 4 || $model->status_request_dosen_wali == 4 || $model->status_request_baak == 4){
                return ['class' => 'warning'];
            } else {
                return ['class' => 'info'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'izin_keluar_id',
            // [
            //     'attribute'=>'dim_nama',
            //     'label' => 'Pemohon',
            //     'value' => 'dim.nama',
            // ],
            [
                'attribute'=>'desc',
                'label' => 'Keperluan',
                'value' => 'desc',
            ],
            // 'rencana_berangkat',
            // 'rencana_kembali',
            // 'desc:ntext',
            // 'realisasi_berangkat',
            // 'realisasi_kembali',
            // 'dosen_id',
            // 'baak_id',
            // 'keasramaan_id',
            [
                'attribute'=>'status_request_dosen_wali',
                'label' => 'Persetujuan Dosen',
                'filter'=>ArrayHelper::map(StatusRequest::find()->asArray()->all(), 'status_request_id', 'status_request'),
                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'ALL'],
                'value' => 'statusRequestDosen.status_request',
            ],
            [
                'attribute'=>'status_request_keasramaan',
                'label' => 'Persetujuan Keasramaan',
                'filter'=>ArrayHelper::map(StatusRequest::find()->asArray()->all(), 'status_request_id', 'status_request'),
                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'ALL'],
                'value' => 'statusRequestKeasramaan.status_request',
            ],
            [
                'attribute'=>'status_request_baak',
                'label' => 'Persetujuan BAAK',
                'filter'=>ArrayHelper::map(StatusRequest::find()->asArray()->all(), 'status_request_id', 'status_request'),
                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'ALL'],
                'value' => 'statusRequestBaak.status_request',
            ],
            // 'deleted',
            // 'deleted_at',
            // 'deleted_by',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            ['class' => 'common\components\ToolsColumn',
                'template' => '{view} {edit} {cancel}',
                'header' => 'Aksi',
                'buttons' => [
                    'view' => function ($url, $model){
                        return ToolsColumn::renderCustomButton($url, $model, 'View Detail', 'fa fa-eye');
                    },
                    'cancel' => function ($url, $model){
                        if ($model->status_request_dosen_wali == 1 || $model->status_request_keasramaan == 1 || $model->status_request_baak == 1) {
                            return ToolsColumn::renderCustomButton($url, $model, 'Cancel', 'fa fa-times');
                        }else if ($model->status_request_dosen_wali != 1 || $model->status_request_keasramaan != 1 || $model->status_request_baak != 1){
                            return "";
                        }
                    },
                    'edit' => function ($url, $model){
                        if ($model->status_request_dosen_wali != 1 || $model->status_request_keasramaan != 1 || $model->status_request_baak != 1) {
                            return "";
                        }else{
                            return ToolsColumn::renderCustomButton($url, $model, 'Edit', 'fa fa-pencil');
                        }
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index){
                    if ($action === 'view') {
                        return Url::toRoute(['ika-by-mahasiswa-view', 'id' => $key]);
                    }else if ($action === 'edit') {
                        return Url::toRoute(['ika-by-mahasiswa-edit', 'id' => $key]);
                    }else if ($action === 'cancel') {
                        return Url::toRoute(['ika-by-mahasiswa-cancel', 'id' => $key]);
                    }
                }
            ],
        ],
    ]); ?>

</div>
