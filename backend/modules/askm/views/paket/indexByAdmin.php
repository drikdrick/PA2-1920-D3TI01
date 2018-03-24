<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\search\PaketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Paket';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paket-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <br>
    <p>
       <?= Html::a('Tambah Paket', ['paket-add'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'data_paket_id',
            'penerima',
            'tanggal_kedatangan',
            'pengirim',
            'diambil_oleh',
            'tanggal_diambil',
            [
                'attribute'=>'created_by',
                'value'=>'created_by',
            ],

            'posisi',
            'desc:ntext',
            // 'deleted',
            // 'deleted_at',
            // 'deleted_by',
            // 'created_at',
            // 'updated_at',
            // 'updated_by',
            ['class' => 'yii\grid\ActionColumn',
            'header'=>'Aksi'
            ],
        ],
    ]); ?>

</div>
