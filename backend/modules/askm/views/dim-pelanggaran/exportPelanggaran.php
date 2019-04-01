<?php $date = date('Y-m-d h:i:s'); ?>
<?= common\helpers\GridViewExporter::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'filename'=>'List Pelanggaran -'.$date,
        'properties' =>[],
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