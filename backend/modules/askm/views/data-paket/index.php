<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\DataPaketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Paket';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-paket-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <!--
    <p>
        <?= Html::a('Create Data Paket', ['create'], ['class' => 'btn btn-success']) ?> 
    </p>
    -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'penerima',
            'pengirim',
            'tanggal_kedatangan',
            'desc:ntext',
            'tanggal_diambil',
            //'data_paket_id',
            // 'diambil_oleh',
            // 'pegawai_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
