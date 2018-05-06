<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\search\PosisiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posisi Paket';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posisi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Posisi', ['posisi-add'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'posisi_id',
            'nama_posisi',
            //'deleted',
            //'deleted_at',
            //'deleted_by',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',
        ],
    ]); ?>

</div>
