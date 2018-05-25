<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\helpers\LinkHelper;
use yii\helpers\ArrayHelper;
use common\components\ToolsColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\search\AsramaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asrama';
$this->params['breadcrumbs'][] = $this->title;
$uiHelper=\Yii::$app->uiHelper;
?>
<div class="asrama-index">

     <div class="pull-right">
        Pengaturan
        <div class="btn-group">
            <button type="button" class="btn btn-default btn-flat btn-set btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><span style="font-size: 18px;" class="fa fa-gear"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                <li>
                    <a href="<?= Url::to(['asrama/add']) ?>"><i class="fa fa-plus"></i>Tambah Asrama</a>
                </li>
            </ul>
        </div>
    </div>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= $uiHelper->renderLine(); ?>

    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'asrama_id',
            [
                'attribute' => 'name',
                'label' => 'Nama Asrama',
                'value' => 'name',
            ],
            'lokasi',
            [
                'attribute' => 'jumlah_mahasiswa',
                'label' => 'Jumlah Mahasiswa',
                'value' => function($data){
                    return $data['jumlah_mahasiswa'].' orang';
                }
            ],
            [
                'attribute' => 'kapasitas',
                'label' => 'Kapasitas Maksimal',
                'value' => function($data){
                    return $data['kapasitas'].' orang';
                }
            ],
            // 'deleted',
            // 'deleted_at',
            // 'deleted_by',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            ['class' => 'common\components\ToolsColumn',
                'template' => '{view} {edit} {keasramaan} {kamar} {excel}',//' {delete-asrama}',
                'header' => 'Aksi',
                'buttons' => [
                    'view' => function ($url, $model){
                        return ToolsColumn::renderCustomButton($url, $model, 'View Detail Asrama', 'fa fa-eye');
                    },
                    'keasramaan' => function ($url, $model){
                        return ToolsColumn::renderCustomButton($url, $model, 'Tambah Pengurus', 'fa fa-users');
                    },
                    'edit' => function ($url, $model){
                        return ToolsColumn::renderCustomButton($url, $model, 'Edit Asrama', 'fa fa-pencil');
                    },
                    'kamar' => function ($url, $model){
                        return ToolsColumn::renderCustomButton($url, $model, 'Daftar Kamar', 'fa fa-list');
                    },
                                        
                    'excel' => function ($url, $model){
                        return ToolsColumn::renderCustomButton($url, $model, 'Export Data Asrama', 'fa fa-print');
                    },					
					'delete-asrama' => function ($url, $model){
                        return ToolsColumn::renderCustomButton($url, $model, 'Hapus Asrama', 'fa fa-times');
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index){
                    if ($action === 'view') {
                        return Url::toRoute(['view-detail-asrama', 'id' => $key]);
                    }else if ($action === 'edit') {
                        return Url::toRoute(['edit', 'id' => $key]);
                    }else if ($action === 'keasramaan') {
                        return Url::toRoute(['keasramaan/add-pengurus', 'id_asrama' => $key]);
                    }else if ($action === 'kamar') {
                        return Url::toRoute(['kamar/index', 'KamarSearch[asrama_id]' => $key, 'id_asrama' => $key]);
                       // return Url::toRoute(['asrama/view-kamar', 'asrama_id' => $key]);
					   
                    }else if($action==='excel'){
                        return Url::toRoute(['excel', 'asrama_id' => $key]);
                    }else if($action==='delete-asrama'){
						return Url::toRoute(['del-asrama', 'asrama_id' => $key]);
					}

                }
            ],
        ],
    ]); 
    Pjax::end();
    ?>

</div>
