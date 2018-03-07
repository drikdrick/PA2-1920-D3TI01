<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\AskmAsramaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Askm Asramas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askm-asrama-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Askm Asrama', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'asrama_id',
            'name',
            'lokasi',
            'jumlah_mahasiswa',
            'kapasitas',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
