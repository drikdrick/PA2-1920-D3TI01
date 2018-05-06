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
      <!-- <?= Html::a('Tambah Paket', ['create'], ['class' => 'btn btn-success']) ?>-->
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'data_paket_id',
            'penerima',
            [
                'attribute'=>'penerima',
                'value'=>'penerima.nama'
            ],
            [
                'attribute'=>'tanggal_kedatangan',
                'value'=>function($model,$index,$key){
                    if($model->tanggal_kedatangan==NULL){
                        return '-';
                    }
                    else{
                        return Yii::$app->formatter->asDateTime($model->tanggal_kedatangan,'php:d M Y H:m');
                    }
                }
            ],

            'pengirim',
            'diambil_oleh',
            'tanggal_diambil',
            [
                'attribute'=>'posisi',
                'value'=>'posisi',
            ],
            'desc:ntext',
            [
                'attribute'=>'desc',
                'label'=>'Deskripsi',
            ],

        ],
    ]); ?>

</div>
