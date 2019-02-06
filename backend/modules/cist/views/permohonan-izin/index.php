<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\cist\models\search\PermohonanIzinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permohonan Izins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-izin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Permohonan Izin', ['add'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'permohonan_izin_id',
            'waktu_pelaksanaan',
            'alasan_izin',
            'pengalihan_tugas',
            'kategori_id',
            // 'lama_izin',
            // 'atasan',
            // 'status_oleh_hrd',
            // 'status_oleh_atasan',
            // 'status_oleh_wr2',
            // 'pegawai_id',
            // 'deleted',
            // 'deleted_at',
            // 'deleted_by',
            // 'created_by',
            // 'created_at',
            // 'updated_by',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
