<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\AskmIzinPenggunaanRuanganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Askm Izin Penggunaan Ruangans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askm-izin-penggunaan-ruangan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Askm Izin Penggunaan Ruangan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'izin_penggunaan_ruangan_id',
            'rencana_mulai',
            'rencana_berakhir',
            'desc:ntext',
            'dim_id',
            // 'staf_id',
            // 'status_request_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
