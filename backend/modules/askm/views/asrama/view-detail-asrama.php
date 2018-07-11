<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\Asrama */

$this->title = 'Asrama '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Asrama', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$uiHelper=\Yii::$app->uiHelper;
?>
<div class="asrama-view">



    <div class="pull-right">
        Pengaturan
        <?php 
        if ($model->jumlah_mahasiswa == 0) {
            echo $uiHelper->renderButtonSet([
                'template' => ['edit', 'keasramaan', 'kamar', 'del' /* ,'import' */, 'export'],
                'buttons' => [
                    'edit' => ['url' => Url::toRoute(['edit', 'id' => $model->asrama_id]), 'label'=> 'Edit Asrama', 'icon'=>'fa fa-pencil'],
                    'keasramaan' => ['url' => Url::toRoute(['keasramaan/add-pengurus', 'id_asrama' => $model->asrama_id]), 'label'=> 'Tambah Pengurus', 'icon'=>'fa fa-users'],
                    'kamar' => ['url' => Url::toRoute(['kamar/index', 'KamarSearch[asrama_id]' => $model->asrama_id, 'id_asrama' => $model->asrama_id]), 'label'=> 'Daftar Kamar', 'icon'=>'fa fa-list'],
                    'del' => ['url' => Url::toRoute(['del', 'asrama_id' => $model->asrama_id]), 'label'=> 'Hapus Asrama', 'icon'=>'fa fa-trash'],
                    // 'import' => ['url' => Url::toRoute(['dim-kamar/import-excel', 'asrama_id' => $model->asrama_id]), 'label'=> 'Import Data Penghuni', 'icon'=>'fa fa-download'],
                    'export' => ['url' => Url::toRoute(['export-excel', 'asrama_id' => $model->asrama_id]), 'label'=> 'Export Data Penghuni', 'icon'=>'fa fa-upload'],
                ],
                
            ]);
        } else {
            echo $uiHelper->renderButtonSet([
                'template' => ['edit', 'keasramaan', 'kamar' /* ,'import' */, 'export'],
                'buttons' => [
                    'edit' => ['url' => Url::toRoute(['edit', 'id' => $model->asrama_id]), 'label'=> 'Edit Asrama', 'icon'=>'fa fa-pencil'],
                    'keasramaan' => ['url' => Url::toRoute(['keasramaan/add-pengurus', 'id_asrama' => $model->asrama_id]), 'label'=> 'Tambah Pengurus', 'icon'=>'fa fa-users'],
                    'kamar' => ['url' => Url::toRoute(['kamar/index', 'KamarSearch[asrama_id]' => $model->asrama_id, 'id_asrama' => $model->asrama_id]), 'label'=> 'Daftar Kamar', 'icon'=>'fa fa-list'],
                    // 'import' => ['url' => Url::toRoute(['dim-kamar/import-excel', 'asrama_id' => $model->asrama_id]), 'label'=> 'Import Data Penghuni', 'icon'=>'fa fa-download'],
                    'export' => ['url' => Url::toRoute(['export-excel', 'asrama_id' => $model->asrama_id]), 'label'=> 'Export Data Penghuni', 'icon'=>'fa fa-upload'],
                ],
                
            ]);
        }
        ?>
    </div>

    <h1><?= $this->title ?></h1>
    <hr/>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'asrama_id',
            'name',
            'lokasi',
            'jumlah_mahasiswa',
            'kapasitas',
            // 'keasramaan_id',
            // 'deleted',
            // 'deleted_at',
            // 'deleted_by',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',
        ],
    ]) ?>
    <br>
    <h1>Pengurus Asrama <?= $model['name']?></h1>
    <hr/>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'pegawai_id',
                'value' => 'pegawai.nama',
            ],
            // 'deleted_by',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{del}',
                'contentOptions' => ['style' => 'width: 8.7%'],
                'buttons'=>[
                    'del'=>function ($url, $model) {
                        return Html::a('<i class="fa fa-times"></i> Hapus', ['keasramaan/del-pengurus', 'id' => $model->keasramaan_id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

</div>
