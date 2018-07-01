<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\Ktm */

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
                echo Html::a('Reject', ['edit-decline', 'id' => $model->kartu_tanda_mahasiswa_id], [
                    'class' => 'btn btn-danger',
                    'data-method' => 'POST',
                    'data' => [
                        'confirm' => 'Reject request surat tugas?',
                    ],
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

            echo Html::a('Back', ['index-admin'], [
                    'class' => 'btn btn-primary',
                    'data-method' => 'POST',
                ]);
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '-',
        ],
        'attributes' => [
            'alasan',
            'dim.nama',
            'pegawai.nama',
            'statusPengajuan.name',
            'waktu_pengambilan',
        ],
    ]) ?>

</div>
