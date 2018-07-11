<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\Ktm */

$this->title = 'Detail Pengajuan';
$this->params['breadcrumbs'][] = ['label' => 'Kartu Tanda Mahasiswa', 'url' => ['index']];
?>
<div class="kartu-tanda-mahasiswa-view">

    <h1></h1>

    <p>
        <?php
            if($model->status_pengajuan_id == 1){
                echo Html::a('Update', ['edit', 'id' => $model->kartu_tanda_mahasiswa_id], [
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
                'alasan',
                'pemohon.nama',
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
                'alasan',
                'pemohon.nama',
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
                'alasan',
                'pemohon.nama',
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
                'alasan',
                'pemohon.nama',
                'statusPengajuan.name',
                'pegawai.nama',
                'waktu_pengambilan',
            ],
        ]) ?>
    <?php } ?>
</div>
