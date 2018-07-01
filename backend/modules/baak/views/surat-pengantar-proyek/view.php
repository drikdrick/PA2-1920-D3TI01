<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratPengantarPa */

$this->params['breadcrumbs'][] = ['label' => 'Surat Pengantar Proyek', 'url' => ['index']];
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

    <?= DetailView::widget([
        'model' => $model,
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '-',
        ],
        'attributes' => [
            'alamat_tujuan',
            'kuliah.nama_kul_ind',
            'pegawai.nama',
            'statusPengajuan.name',
            'waktu_pengambilan',
            'dims',
        ],
    ]) ?>

</div>
