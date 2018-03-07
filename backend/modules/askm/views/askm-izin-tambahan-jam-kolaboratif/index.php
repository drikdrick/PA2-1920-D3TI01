<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\AskmIzinTambahanJamKolaboratifSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Askm Izin Tambahan Jam Kolaboratifs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askm-izin-tambahan-jam-kolaboratif-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Askm Izin Tambahan Jam Kolaboratif', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'izin_tambahan_jam_kolaboratif_id',
            'rencana_mulai',
            'rencana_berakhir',
            'decs:ntext',
            'dim_id',
            // 'status_request_id',
            // 'staf_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
