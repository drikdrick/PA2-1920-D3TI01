<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\ToolsColumn;
use yii\helpers\Url;
use yii\jui \DatePicker;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\ubux\models\search\DataTamuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Tamu';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-tamu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
        $toolbarItemStatusRequest =
            "<a href='".Url::to(['index'])."' class='btn btn-info '><i class='fa fa-refresh'></i> <span class='toolbar-label'>Refresh</span></a>";

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
        'tableOptions' => ['class' => 'table table-bordered table-responsive-xl'],
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'data_tamu_id',
            [
                'attribute'=>'nik',                
                'value'=>function($model,$key,$index){
                    if($model->nik==NULL){
                        return '-';
                    }
                    else{
                       return $model->nik;
                    }
                }
            ],
            'nama',
            [
                'label'=>'Keperluan',
                'attribute'=>'desc',
                'value'=>'desc',
            ],
            [
                'attribute'=>'waktu_kedatangan',
                'label'=>'Masuk Kampus',
                'format'=>['Date','php: d M y H:i'],
                'filter'=>DatePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'waktu_kedatangan',
                    'dateFormat' => 'yyyy-MM-dd'
                ])
            ],

            [
                'label'=>'Keluar Kampus',
                'format'=> 'raw',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'value'=>function($model,$key,$index){
                    if($model->waktu_kembali==NULL){
                        return '-';
                    }
                    else{
                        return Yii::$app->formatter->asDateTime($model->waktu_kembali, 'php:d M Y H:i');
                    }
                }
            ],
            [
                'attribute'=>'kendaraan',
                'value'=>function($model,$key,$index){
                    if($model->kendaraan==NULL){
                        return '-';
                    }
                    else{
                        return $model->kendaraan;
                    }
                },
                'filter'=>array('Tidak Berkendara'=>'Tidak Berkendara',
                        'Kendaraan Roda 2'=>'Kendaraan Roda 2',
                        'Kendaraan Roda 4'=>'Kendaraan Roda 4'),
            ],


            ['class' => 'common\components\ToolsColumn',
             'template' => '{view} {delete}',
             'buttons' => [
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
                if ($action === 'delete') {
                    return Url::toRoute(['tamu-del', 'id' => $key]);
                }
                if($action === 'view'){
                    return Url::toRoute(['tamu-view','id'=>$key]);
                }
            }
            ],
        ],
    ]); ?>

</div>
