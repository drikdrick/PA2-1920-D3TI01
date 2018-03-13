<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\AskmDataPaketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Askm Data Pakets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askm-data-paket-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Askm Data Paket', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'data_paket_id',
            'tanggal_kedatangan',
            'desc:ntext',
            'penerima',
            'pengirim',
            // 'diambil_oleh',
            // 'tanggal_diambil',
            // 'pegawai_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
