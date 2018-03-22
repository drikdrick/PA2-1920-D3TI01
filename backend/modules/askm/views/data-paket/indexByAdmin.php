<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\DataPaketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Paket';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-paket-index">

    <h1><i class ="fa fa-archive"></i> <?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <br>
    <p>
        <?php echo Html::a('Tambah Data Paket', ['data-paket-add'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //'data_paket_id',
            'penerima',
            'tanggal_kedatangan',
            'pengirim',
            'diambil_oleh',
            [
                'attribute'=>'pegawai_id',
                'value'=>'pegawai.nama',
            ],
            'tanggal_diambil',
            //'desc:ntext',
            ['class' => 'yii\grid\ActionColumn', 
            'template' => '{view}{update}{delete}',
            'header'=>'Tools',
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"> </span>', $url, [
                                'title' => Yii::t('app', 'Rincian'),
                    ]);
                },
                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"> </span>', $url, [
                                'title' => Yii::t('app', 'edit'),
                    ]);
                    }
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'update') {
                        $url ='data-paket-edit?id='.$model->data_paket_id;
                        return $url;
                    }
                    if($action === 'view'){
                        $url ='view?id='.$model->data_paket_id;
                        return $url;
                    }
                }
            ],
        ],
    ]); ?>
</div>
