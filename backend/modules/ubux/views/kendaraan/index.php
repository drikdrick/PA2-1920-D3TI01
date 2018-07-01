<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\components\ToolsColumn;
use yii\base\Model;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\ubux\models\KendaraanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manajemen Kendaraan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubux-kendaraan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Kendaraan', ['add'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model){
            if($model->status == 0)
                return ['class' => 'pasif'];
            else return ['class' => 'danger'];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'kendaraan_id',
            'kendaraan',
            'plat_nomor',
            'daya_tampung_kendaraan',
            [
                'attribute' => 'Ketersediaan',
                'value' => function(Model $model){
                    if($model->status == 0) return 'Tersedia';
                    else return 'Terpakai';
                }
            ],
//            'deleted',
            // 'deleted_at',
            // 'deleted_by',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            ['class' => 'common\components\ToolsColumn',
                'template' => '{view} {update} {delete}',// {edit} {cancel}',
                'header' => 'Aksi',
                'buttons' => [
                    'view' => function ($url, $model){
                        return ToolsColumn::renderCustomButton($url, $model, 'Lihat Rincian', 'fa fa-eye');
                    },
                    'update' => function ($url, $model){
                        return ToolsColumn::renderCustomButton($url, $model, 'Ubah', 'fa fa-pencil');
                    },
                    'delete' => function ($url, $model){
                        return "<li>".Html::a('<span class="fa fa-trash"></span> Hapus', $url, [
                                'title' => Yii::t('yii', 'Legitimate'),
                                'data-confirm' => Yii::t('yii', 'Apakah anda yakin ingin menghapus ?'),
                                'data-method' => 'post',
                                'data-pjax' => '0',
                            ])."</li>";

                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index){
                    if ($action === 'view') {
                        return Url::toRoute(['view', 'id' => $key]);
                    }else if ($action === 'update') {
                        return Url::toRoute(['edit', 'id' => $key]);
                    }else if ($action === 'delete') {
                        return Url::toRoute(['del', 'id' => $key]);
                    }
                }

            ],

        ],
    ]); ?>

</div>
