<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\ToolsColumn;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\search\IzinBermalamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="paket-index">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Create Paket', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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