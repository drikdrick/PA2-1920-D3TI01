<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\AskmRuanganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Askm Ruangans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askm-ruangan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Askm Ruangan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ruangan_id',
            'name',
            'izin_tambahan_jam_kolaboratif_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
