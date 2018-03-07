<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\AskmIzinKeluarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Askm Izin Keluars';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askm-izin-keluar-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Askm Izin Keluar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'izin_keluar_id',
            'rencana_berangkat',
            'rencana_kembali',
            'realisasi_berangkat',
            'realisasi_kembali',
            // 'desc:ntext',
            // 'dim_id',
            // 'dosen_id',
            // 'staf_id',
            // 'status_request_id',
            // 'keasramaan_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
