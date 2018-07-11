<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratLomba */

$this->title = 'Detail Surat';
$this->params['breadcrumbs'][] = ['label' => 'Surat Kompetisi', 'url' => ['index-admin']];
$this->params['breadcrumbs'][] = ['label' => 'Detail Surat'];
?>
<div class="surat-lomba-view">

    <h1></h1>

    <p>
        <?php
            if($model->status_pengajuan_id == 1){
                echo Html::a('Accept', ['edit-accept', 'id' => $model->surat_lomba_id], [ 
                    'class' => 'btn btn-success',
                    'data-method' => 'POST',
                ]);
                echo "&nbsp";
                echo Html::a('Decline', ['edit-decline', 'id' => $model->surat_lomba_id], [
                    'class' => 'btn btn-danger',
                    'data-method' => 'POST',
                ]);
                echo "&nbsp";
            }
            else if($model->status_pengajuan_id == 2){
                echo Html::a('Ready to Take', ['edit-ready', 'id' => $model->surat_lomba_id], [ 
                    'class' => 'btn btn-success',
                    'data-method' => 'POST',
                ]);
                echo "&nbsp";
                echo Html::a('Print', ['edit-pdf', 'id' => $model->surat_lomba_id], [
                    'class' => 'btn btn-info',
                    'data-method' => 'POST',
                ]);
                echo "&nbsp";
            }
            else if($model->status_pengajuan_id == 4){
                echo Html::a('Print', ['edit-pdf', 'id' => $model->surat_lomba_id], [
                    'class' => 'btn btn-info',
                    'data-method' => 'POST',
                ]);
                echo "&nbsp";
                echo Html::a('Done', ['edit-done', 'id' => $model->surat_lomba_id], [
                    'class' => 'btn btn-success',
                    'data-method' => 'POST',
                ]);
                echo "&nbsp";
            }

            echo Html::a('Back', ['index-admin'], [
                    'class' => 'btn btn-primary',
                    'data-method' => 'POST',
                ]);
        ?>


      <?php
        if($model->status_pengajuan_id == 1)
        {
    ?>
        <?= DetailView::widget([
            'model' => $model,
            'formatter' => [
                'class' => 'yii\i18n\Formatter',
                'nullDisplay' => '-',
            ],
            'attributes' => [   
                [
                    'label' => 'Pemohon',
                    'value' => $model->pemohon->nama,
                ],         
                'nama_lomba',
                'alamat_tujuan',
                'dims',
                'statusPengajuan.name',
            ],
        ]) ?>

    <?php
        }
        if($model->status_pengajuan_id == 3)
        {
    ?>
        <?= DetailView::widget([
            'model' => $model,
            'formatter' => [
                'class' => 'yii\i18n\Formatter',
                'nullDisplay' => '-',
            ],
            'attributes' => [  
                [
                    'label' => 'Pemohon',
                    'value' => $model->pemohon->nama,
                ],          
                'nama_lomba',
                'alamat_tujuan',
                'dims',
                'statusPengajuan.name',
                'pegawai.nama',
                'alasan_penolakan',
            ],
        ]) ?>
    <?php
        }
        if($model->status_pengajuan_id != 3 && $model->status_pengajuan_id != 1)
        {
    ?>
        
         <?= DetailView::widget([
            'model' => $model,
            'formatter' => [
                'class' => 'yii\i18n\Formatter',
                'nullDisplay' => '-',
            ],
            'attributes' => [ 
                [
                    'label' => 'Pemohon',
                    'value' => $model->pemohon->nama,
                ],           
                'nama_lomba',
                'alamat_tujuan',
                'dims',
                'statusPengajuan.name',
                'pegawai.nama',
                'waktu_pengambilan'
            ],
        ]) ?>

    <?php
        }
    ?>

    

</div>
