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
            'template' => '{view}',
            'header'=>'Tools',
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span>Rincian</span>', $url, [
                                'title' => Yii::t('app', 'Rincian'),
                    ]);
                },
                ],
            ],
        ],
    ]); ?>
</div>
