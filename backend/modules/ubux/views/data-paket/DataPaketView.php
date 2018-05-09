<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\DataPaket */

if($model->dim_id!=null){
    $this->title = $model->dim->nama;
}
else if($model->pegawai_id!=null){
    $this->title = $model->pegawai->nama;
}
else{
    $this->title = "Paket tidak diketahui";
}
$this->params['breadcrumbs'][] = ['label' => 'Data Paket', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-paket-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
                'attribute'=>'posisi_paket_id',
                'label'=>'Posisi Paket',
                'value'=>$model->posisiPaket->name,
            ],
            [
                'attribute'=>'status_paket_id',
                'label'=>'Status',
                'format'=>'raw',
                'value'=>function($model){
                    if($model->status_paket_id==1){
                        return '<b class="text-danger">'.$model->statusPaket->status.'</b>';
                    }
                    else{
                        return '<b class="text-success">'.$model->statusPaket->status.'</b>';
                    }
                }
            ],
            [
                'attribute'=>'desc',
                'label'=>'Deskripsi',
                'value'=>function($model){
                    if($model->desc==NULL){
                        return '-';
                    }
                    else{
                        return $model->desc;
                    }
                }
            ],
        ],
    ])?>

</div>
