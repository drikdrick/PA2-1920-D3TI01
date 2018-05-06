<?php

use yii\helpers\Html;
<<<<<<< HEAD
use yii\grid\GridView;
use common\components\ToolsColumn;
=======
>>>>>>> 632da2a3fd8d3bc8a6bd5414175823c36dc49aa5
use yii\helpers\Url;
use yii\grid\GridView;
use common\components\ToolsColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\search\IzinBermalamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

<<<<<<< HEAD
?>
<div class="paket-index">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
=======
$this->title = 'Paket';
$this->params['breadcrumbs'][] = $this->title;
$uiHelper=\Yii::$app->uiHelper;
?>
<div class="paket-index">

    <?= $uiHelper->renderContentHeader($this->title);?>
    <?= $uiHelper->renderLine(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?><br>
>>>>>>> 632da2a3fd8d3bc8a6bd5414175823c36dc49aa5

    <p>
        <?php //echo Html::a('Create Paket', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<<<<<<< HEAD

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'data_paket_id',
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
            'pengirim',
            [
                'attribute'=>'tanggal_kedatangan',
                'format'=>['Date','php: d M y H:i']
            ],
             [
                 'attribute'=>'posisi',
                 'value'=>'posisis.nama_posisi'
             ],
             [
                 'attribute'=>'status',
                 'format'=>'raw',
                 'value'=>function($model,$key,$index){
                     if($model->status==1){
                         return '<b class="text-danger">'.$model->statuss->status.'</b>';
                     }
                     else{
                        return '<b class="text-success">'.$model->statuss->status.'</b>';
                     }
                 }
                 
             ],
             ['class' => 'common\components\ToolsColumn',
             'template' => '{view} {update} {delete}',
             'buttons' => [
                 'update' => function ($url, $model){
                     $url = 'paket-edit?id='.$model->data_paket_id;
                     return ToolsColumn::renderCustomButton($url, $model, 'Update', 'fa fa-pencil');
                 },
                 'delete' => function ($url, $model){
                         return "<li>".Html::a('<span class="fa fa-trash"></span> Delete', $url, [
                             'title' => Yii::t('yii', 'Hapus'),
                             'data-confirm' => Yii::t('yii', 'Are you sure to delete the data ?'),
                             'data-method' => 'post',
                              'data-pjax' => '0',
                         ])."</li>";
                 },
             ],
             'urlCreator' => function ($action, $model, $key, $index){
                 if ($action === 'view') {
                     return Url::toRoute(['paket-view', 'id' => $key]);
                 } 
                 if ($action === 'delete') {
                     return Url::toRoute(['paket-del', 'id' => $key]);
                 }
                 if ($action === 'update') {
                     return Url::toRoute(['paket-edit', 'id' => $key]);
                 }
             }
         ]
        ],
    ]); ?>
=======
        
        <?=$uiHelper->beginContentBlock(['id' => 'grid-system2',
            'header' => 'Request terbaru',
            'width' => 12,
        ]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'options' => ['style' => 'font-size:12px;'],
                // 'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                        //'data_paket_id',
                        'penerima',
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
                        }
                    ],

                    'posisi',
                    //'desc:ntext',
                    [
                        'attribute'=>'desc',
                        'value'=>'desc',
                        'label'=>'Deskripsi',
                    ],
>>>>>>> 632da2a3fd8d3bc8a6bd5414175823c36dc49aa5

                    // ['class' => 'yii\grid\ActionColumn','header' => 'Action',],
                    ['class' => 'common\components\ToolsColumn',
                        'template' => '{view} {update} {delete}',
                        'header' => 'Aksi',
                        'buttons' => [
                            'view' => function ($url, $model){
                                return ToolsColumn::renderCustomButton($url, $model, 'View Detail', 'fa fa-eye');
                            },
                            'update' => function ($url, $model){
                                $url = 'paket-edit?id='.$model->data_paket_id;
                                return ToolsColumn::renderCustomButton($url, $model, 'Update', 'fa fa-pencil');
                            },
                            /*'delete' => function ($url, $model){
                                $url = Url::to(['del','id' => $model->data_paket_id]);
                                return Html::a('<span class="fa fa-trash">Delete</span>', $url, [
                                    'title' => 'delete',
                                    'data-confirm' => Yii::t('yii', 'Yakin hapus ?'),
                                    'data-method' => 'post',
                                ]);
                            },*/
                        ],

                    ],
                ],
                ]); ?>
</div>
