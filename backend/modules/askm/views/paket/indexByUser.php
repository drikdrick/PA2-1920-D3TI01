<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\search\PaketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Paket';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paket-index">
    <?php  echo $this->render('_searchByUser', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $userProvider,
        //'filterModel'=>$searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'tag',
            [
                'attribute'=>'penerima',
                'format'=>'raw',
                'value'=>function($model,$key,$index){
                    if($model->mahasiswa){
                        return $model->mahasiswa->nama;
                    }
                    else if($model->pegawai){
                        return $model->pegawai->nama;
                    }
                    else{
                        return '-';
                    }
                }
            ],
            [
              'attribute'=>'tanggal_kedatangan',
              'format' => ['date', 'php:d M Y'],
            ],
            //'tanggal_kedatangan',
            'pengirim',
            [
                'attribute'=>'tanggal_diambil',
                'label' => 'Status',
                'format'=>'raw',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'value'=>function($model,$key,$index){
                    if($model->tanggal_diambil==NULL){
                        return '<b class="text-danger">Belum diambil</b>';
                    }
                    else{
                        return '<b class="text-success">Sudah diambil</b>';
                    }
                }
            ],
            
            [
                'attribute'=>'diambil_oleh',
                'format'=>'raw',
                'value'=>function($model,$key,$index){
                    if($model->diambil_oleh==NULL){
                        return '';
                    }
                    else{
                        return '<b>'.$model['diambil_oleh'].'</b>';
                    }
                },
                'contentOptions'=>['style'=>'max-width: 100px;']
            ],
            [
                'attribute'=>'posisi',
                'value'=>'posisis.nama_posisi',
            ],

            [
                'attribute'=>'desc',
                'value'=>'desc',
                'label'=>'Deskripsi',
                'contentOptions'=>['style'=>'max-width: 105px;']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Aksi',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{view}',
                'buttons' => [
                  'view' => function ($url, $model) {
                      $url = 'paket-view-user?id='.$model->data_paket_id;
                      return Html::a('<button class="btn btn-info btn-sm">Rincian</button>', $url, [
                                  'title' => Yii::t('app', 'view'),
                      ]);
                  },
                ],
            ],
        ],
    ]); ?>

</div>
