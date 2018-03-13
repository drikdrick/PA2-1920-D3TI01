<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\AskmDataPaketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Paket';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askm-data-paket-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // echo Html::a('Create Askm Data Paket', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'data_paket_id',
            'Penerima',
            'Pengirim',
            'Tanggal Kedatangan',
            'Deskripsi:ntext',
            'Tanggal Diambil',
            // 'diambil_oleh',
            // 'pegawai_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
