<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\Ktm */

$this->title = $model->kartu_tanda_mahasiswa_id;
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
