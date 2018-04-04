<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use common\components\ToolsColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\search\IzinBermalamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Paket';
$this->params['breadcrumbs'][] = $this->title;
$uiHelper=\Yii::$app->uiHelper;
?>
<div class="paket-index">

    <?= $uiHelper->renderContentHeader($this->title);?>
    <?= $uiHelper->renderLine(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?><br>

    <p>
       <?= Html::a('Tambah Paket', ['paket-add'], ['class' => 'btn btn-success']) ?>
    </p>
        
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
