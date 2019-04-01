<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\helpers\LinkHelper;

$this->title = 'Browse Pelanggaran';
$this->params['breadcrumbs'][] = $this->title;
$uiHelper=\Yii::$app->uiHelper;
?>

<div class="dim-pelanggaran-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $uiHelper->renderLine(); ?>
    <?php echo $this->render('_searchPelanggaran', ['model' => $searchModel, 'dataAsrama' => $dataAsrama]); ?>

    <?php if($dataProvider){ ?> 
        <?=Yii::$app->uiHelper->renderToolbar([
                'pull-right' => true,
                'groupTemplate' => ['groupExport'],
                'groups' => [
                    'groupExport' => [
                        'template' => ['export'],
                        'buttons' => [
                            'export' => ['id' => 'toolbar-export', 'url' => Url::to(['dim-pelanggaran/browse',
                                                                                    'export'=> 1,'tanggal_awal'=>$tanggal_awal,'tanggal_akhir'=>$tanggal_akhir,'asrama_id'=>$asrama_id]), 'label' => 'Export', 'icon' => 'fa fa-file-excel-o']
                        ]
                    ],
                ],
         ])?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'tanggal',
            [
                'attribute'=>'dim_name',
                'label' => 'Nama Mahasiswa',
                'value' => 'penilaian.dim.nama',
            ],
            [
                'attribute'=>'pelanggaran_name',
                'label' => 'Jenis Pelanggaran',
                'value' => 'poin.name',
            ],
            [
                'attribute'=>'pelanggaran_poin',
                'label' => 'Poin Pelanggaran',
                'value' => 'poin.poin',
            ],
        ],
    ]); ?>
     <?php } ?> 
    
</div>
