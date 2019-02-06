<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\cist\models\PermohonanIzin */

$this->title = $model->pmhnn_izin_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Izins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-izin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['edit', 'id' => $model->pmhnn_izin_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['del', 'id' => $model->pmhnn_izin_id], [
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
            'pmhnn_izin_id',
            'waktu_pelaksanaan',
            'alasan_izin',
            'pengalihan_tugas',
            'kategori_id',
            'lama_izin',
            'atasan',
            'status_oleh_hrd',
            'status_oleh_atasan',
            'status_oleh_wr2',
            'pegawai_id',
            'deleted',
            'deleted_at',
            'deleted_by',
            'created_by',
            'created_at',
            'updated_by',
            'updated_at',
        ],
    ]) ?>

</div>
