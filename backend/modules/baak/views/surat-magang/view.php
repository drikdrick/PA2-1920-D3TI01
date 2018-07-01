<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratMagang */

$this->params['breadcrumbs'][] = ['label' => 'Surat Magang', 'url' => ['index']];
?>
<div class="surat-magang-view">

    <h1></h1>

    <p>
        <?php
            if($model->status_pengajuan_id == 1){
                echo Html::a('Add Student', ['edit-dim', 'id' => $model->surat_magang_id], [ 
                    'class' => 'btn btn-success',
                    'data-method' => 'POST',
                ]);
                echo "&nbsp";
                echo Html::a('Update', ['edit', 'id' => $model->surat_magang_id], [
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

    <?= DetailView::widget([
        'model' => $model,
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '-',
        ],
        'attributes' => [
            'nama_perusahaan',
            'alamat_perusahaan',
            'waktu_awal_magang',
            'waktu_akhir_magang',
            'dims',
            'statusPengajuan.name',
            'pegawai.nama',
            'waktu_pengambilan',
        ],
    ]) ?>

</div>
