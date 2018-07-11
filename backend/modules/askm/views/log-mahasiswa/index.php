<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\search\LogMahasiswaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Log Mahasiswa';
$this->params['breadcrumbs'][] = $this->title;
$uiHelper=\Yii::$app->uiHelper;
?>
<div class="log-mahasiswa-index">

    <?= $uiHelper->renderContentSubHeader($this->title);?>
    <?= $uiHelper->renderLine(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php

        // $status1 = ($status == NULL)?'active':'';
        // $status2 = ($status == 1)?'active':'';

        $toolbarItemStatusRequest =  
            "<a href='".Url::to(['index'])."' class='btn btn-default '><i class='fa fa-list'></i> <span class='toolbar-label'>All</span></a>
            <a href='".Url::to(['index-luar'])."' class='btn btn-warning'><i class='fa fa-sign-out'></i> <span class='toolbar-label'>Diluar</span></a>"
            /*<a href='".Url::to(['index'])."' class='btn btn-info'><i class='fa fa-road'></i> <span class='toolbar-label'>Izin Keluar</span></a>
            <a href='".Url::to(['index'])."' class='btn btn-success '><i class='fa fa-home'></i> <span class='toolbar-label'>Izin Bermalam</span></a>
            "*/
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
            if($model->tanggal_masuk == NULL){
                return ['class' => 'warning'];
            } else if($model->tanggal_masuk != NULL) {
                return ['class' => 'info'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'dim_nama',
                'label' => 'Nama',
                'value' => 'dim.nama'
            ],
            // [
            //     'attribute' => 'dim_nim',
            //     'label' => 'NIM',
            //     'value' => 'dim.nim'
            // ],
            [
            'attribute' => 'tanggal_keluar',
            'value' => function($model){
                    if (is_null($model->tanggal_keluar)) {
                        return '-';
                    }else{
                        return $model->tanggal_keluar;
                    }
                }
            ],
            [
            'attribute' => 'tanggal_masuk',
            'value' => function($model){
                    if (is_null($model->tanggal_masuk)) {
                        return '-';
                    }else{
                        return $model->tanggal_masuk;
                    }
                }
            ],
            // 'deleted',
            // 'deleted_at',
            // 'deleted_by',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
