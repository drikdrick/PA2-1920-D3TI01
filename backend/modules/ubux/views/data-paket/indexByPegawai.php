<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\ubux\models\search\DataPaketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Paket';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-paket-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'pegawai_id',
                'format'=>'raw',
                'label'=>'Nama',
                'value'=>function($model,$key,$index){
                    if($model->pegawai!=NULL){
                        return $model->pegawai->nama;
                    }
                    else {
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
                 'attribute'=>'posisi_paket_id',
                 'label'=>'Posisi',
                 'value'=>'posisiPaket.name'
             ],
             [
                 'attribute'=>'status_paket_id',
                 'format'=>'raw',
                 'label'=>'Status Paket',
                 'value'=>function($model,$key,$index){
                     if($model->status_paket_id==1){
                         return '<b class="text-danger">'.$model->statusPaket->status.'</b>';
                     }
                     else{
                        return '<b class="text-success">'.$model->statusPaket->status.'</b>';
                     }
                 }
                 
             ],
             ['class' => 'common\components\ToolsColumn',
             'template' => '{view}',
             'urlCreator' => function ($action, $model, $key, $index){
                 if ($action === 'view') {
                     return Url::toRoute(['data-paket-view', 'id' => $key]);
                 } 
             }
         ]
        ],
    ]); ?>

</div>
