<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\Paket */

$this->title = '#'.$model->tag;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paket-view">

    <h1><b><?= Html::encode($this->title) ?><b></h1>

    <p>
        <?= Html::a('Update', ['paket-edit', 'id' => $model->data_paket_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['paket-del', 'id' => $model->data_paket_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tag',
            [
                'attribute'=>'penerima',
                'format'=>'raw',
                'value'=>function($model){
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
                'label' => 'Tanggal kedatangan',
                'format'=> 'raw',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'value'=>function($model){
                    if($model->tanggal_kedatangan==NULL){
                        return '-';
                    }
                    else{
                        return Yii::$app->formatter->asDateTime($model->tanggal_kedatangan, 'php:d M Y H:i:s');
                    }
                }
            ],
            [
                'attribute'=>'diambil_oleh',
                'format'=>'raw',
                'value'=>function($model){
                    if($model->diambil_oleh!=NULL){
                        return $model->diambil_oleh;
                    }
                    else{
                        return '-';
                    }
                }
            ],
            [
                'attribute'=>'tanggal_diambil',
                'label' => 'Tanggal diambil',
                'format'=> 'raw',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'value'=>function($model){
                    if($model->tanggal_diambil==NULL){
                        return '-';
                    }
                    else{
                        return Yii::$app->formatter->asDateTime($model->tanggal_diambil, 'php:d M Y H:i:s');
                    }
                }
            ],
            //'posisi',
            [
                'attribute'=>'posisi',
                'value'=>$model->posisis->nama_posisi,
            ],
            [
                'attribute'=>'status',
                'format'=>'raw',
                'value'=>function($model){
                    if($model->status==1){
                        return '<b class="text-danger">'.$model->statuss->status.'</b>';
                    }
                    else{
                        return '<b class="text-success">'.$model->statuss->status.'</b>';
                    }
                }
            ],
            [
                'attribute'=>'desc',
                'label'=>'Deskripsi',
            ],
        ],
    ])?>

</div>
