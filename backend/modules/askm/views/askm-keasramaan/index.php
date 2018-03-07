<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\AskmKeasramaanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Askm Keasramaans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askm-keasramaan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Askm Keasramaan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'keasramaan_id',
            'aktif_start',
            'aktif_end',
            'pegawai_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
