<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use kartik\datetime\DateTimePicker;
use common\components\ToolsColumn;
use yii\helpers\ArrayHelper;
use backend\modules\baak\models\StatusPengajuan;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\baak\models\SuratLombaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Riwayat Pengajuan Surat Kompetisi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-lomba-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Request Surat', ['add'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '-',
        ],
        'filterModel' => $searchModel,
        'rowOptions' => function($model){
            if($model->status_pengajuan_id == 5 ){
                return ['class' => 'success'];
            } else if($model->status_pengajuan_id == 3 ){
                return ['class' => 'danger'];
            } else if($model->status_pengajuan_id == 4){
                return ['class' => 'warning'];
            } else if($model->status_pengajuan_id == 2){
                return ['class' => 'info'];
            }
              else if($model->status_pengajuan_id == 1)
              {
                  return ['class'=>'default'];
              }
        },
        'columns' => [
            ['class' => 'backend\modules\baak\assets\SerialColumn'],

            'nama_lomba',
            [
                'attribute'=>'status_pengajuan_id',
                'label' => 'Status',
                'filter'=>ArrayHelper::map(StatusPengajuan::find()->asArray()->all(), 'status_pengajuan_id', 'name'),
                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Semua Status'],
                'value' => 'statusPengajuan.name',
            ],


            [
                'attribute'=>'waktu_pengambilan',
                'value'=>'waktu_pengambilan',
                'format'=>'raw',
                'filter'=>DateTimePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'waktu_pengambilan',
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd h:i',
                        ]
                ])
            ],

            ['class' => 'common\components\ToolsColumn',
                'template' => '{view} {edit-dim} {edit}',
                'header' => 'Action',
                'buttons' => [
                    'edit-dim' => function ($url, $model){
                        if($model->status_pengajuan_id == 1){
                            return "<li>".Html::a('<span class="fa fa-plus"></span> Add Student', $url)."</li>";
                        }
                    },
                    'edit' => function ($url, $model){
                        if($model->status_pengajuan_id == 1){
                            return "<li>".Html::a('<span class="fa fa-pencil"></span> Update', $url)."</li>";
                        }
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index){
                    if ($action === 'view') {
                        return Url::toRoute(['view', 'id' => $key]);
                    } 
                    if ($action === 'edit-dim') {
                        return Url::toRoute(['edit-dim', 'id' => $key]);
                    }
                    if ($action === 'edit') {
                        return Url::toRoute(['edit', 'id' => $key]);
                    }
                }
            ],
        ],
    ]); ?>

</div>
