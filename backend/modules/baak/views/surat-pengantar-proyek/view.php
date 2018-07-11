<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratPengantarPa */

$this->title = 'Detail Surat';
$this->params['breadcrumbs'][] = ['label' => 'Surat Pengantar Proyek', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detail Surat'];
?>
<div class="surat-pengantar-proyek-view">
    <br>
    <p>
        <?php
            if($model->status_pengajuan_id == 1){
                echo Html::a('Add Student', ['edit-dim', 'id' => $model->surat_pengantar_proyek_id], [ 
                    'class' => 'btn btn-success',
                    'data-method' => 'POST',
                ]);
                echo "&nbsp";
                echo Html::a('Update', ['edit', 'id' => $model->surat_pengantar_proyek_id], [
                    'class' => 'btn btn-primary',
                    'data-method' => 'POST',
                ]);
                echo "&nbsp";
            }

            echo Html::a('Back', ['index'], [
                    'class' => 'btn btn-primary',
                    'data-method' => 'POST',
                ]);
        ?>
    </p>

    <?php if($model->status_pengajuan_id == 1){ ?>
        <?= DetailView::widget([
            'model' => $model,
            'formatter' => [
                'class' => 'yii\i18n\Formatter',
                'nullDisplay' => '-',
            ],
            'attributes' => [
                'alamat_tujuan',
                'kuliah.nama_kul_ind',
                'dims',
                'statusPengajuan.name',
            ],
        ]) ?>
    <?php } ?>

    <?php if($model->status_pengajuan_id == 2){ ?>
        <?= DetailView::widget([
            'model' => $model,
            'formatter' => [
                'class' => 'yii\i18n\Formatter',
                'nullDisplay' => '-',
            ],
            'attributes' => [
                'alamat_tujuan',
                'kuliah.nama_kul_ind',
                'dims',
                'statusPengajuan.name',
                'pegawai.nama',
            ],
        ]) ?>
    <?php } ?>

    <?php if($model->status_pengajuan_id == 3){ ?>
        <?= DetailView::widget([
            'model' => $model,
            'formatter' => [
                'class' => 'yii\i18n\Formatter',
                'nullDisplay' => '-',
            ],
            'attributes' => [
                'alamat_tujuan',
                'kuliah.nama_kul_ind',
                'dims',
                'statusPengajuan.name',
                'pegawai.nama',
                'alasan_penolakan',
            ],
        ]) ?>
    <?php } ?>

    <?php if($model->status_pengajuan_id == 4 || $model->status_pengajuan_id == 5){ ?>
        <?= DetailView::widget([
            'model' => $model,
            'formatter' => [
                'class' => 'yii\i18n\Formatter',
                'nullDisplay' => '-',
            ],
            'attributes' => [
                'alamat_tujuan',
                'kuliah.nama_kul_ind',
                'dims',
                'statusPengajuan.name',
                'pegawai.nama',
                'waktu_pengambilan',
            ],
        ]) ?>
    <?php } ?>
        

</div>
