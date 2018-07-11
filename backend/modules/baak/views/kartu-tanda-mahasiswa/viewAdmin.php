<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\Ktm */

$this->title = 'Detail Pengajuan';
$this->params['breadcrumbs'][] = ['label' => 'Kartu Tanda Mahasiswa', 'url' => ['index-admin']];
?>
<div class="ktm-view">

    <p>
        <br>
        <?php
            if($model->status_pengajuan_id == 1){
                echo Html::a('Accept', ['edit-accept', 'id' => $model->kartu_tanda_mahasiswa_id], [ 
                    'class' => 'btn btn-success',
                    'data-method' => 'POST',
                ]);
                echo "&nbsp";
                echo Html::a('Decline', ['edit-decline', 'id' => $model->kartu_tanda_mahasiswa_id], [
                    'class' => 'btn btn-danger',
                    'data-method' => 'POST',
                ]);
                echo "&nbsp";
            }
            else if($model->status_pengajuan_id == 2){
                echo Html::a('Ready to Take', ['edit-ready', 'id' => $model->kartu_tanda_mahasiswa_id], [ 
                    'class' => 'btn btn-success',
                    'data-method' => 'POST',
                ]);
                echo "&nbsp";
            }
            else if($model->status_pengajuan_id == 4){
                echo Html::a('Done', ['edit-done', 'id' => $model->kartu_tanda_mahasiswa_id], [
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
    </p>

    <?php if($model->status_pengajuan_id == 1){ ?>
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
                'alasan',
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
                [
                    'label' => 'Pemohon',
                    'value' => $model->pemohon->nama,
                ],
                'alasan',
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
                [
                    'label' => 'Pemohon',
                    'value' => $model->pemohon->nama,
                ],
                'alasan',
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
                [
                    'label' => 'Pemohon',
                    'value' => $model->pemohon->nama,
                ],
                'alasan',
                'statusPengajuan.name',
                'pegawai.nama',
                'waktu_pengambilan',
            ],
        ]) ?>
    <?php } ?>

</div>
