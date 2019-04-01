<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use common\helpers\LinkHelper;
use yii\helpers\ArrayHelper;
use common\components\ToolsColumn;
use backend\modules\askm\models\Prodi;
use backend\modules\askm\models\Asrama;
use backend\modules\askm\models\Pegawai;
use dosamigos\datetimepicker\DateTimePicker;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\search\LogMahasiswaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Log Mahasiswa';
$this->params['breadcrumbs'][] = $this->title;
$uiHelper=\Yii::$app->uiHelper;
?>
<div class="log-mahasiswa-index">

    <?= $uiHelper->renderContentSubHeader($this->title);?>
    <?= $uiHelper->renderLine(); ?>

    <div class="callout callout-info">
      <?php
        echo "<b>Keterangan</b><br/>";
        echo '1. Row berwarna kuning = Mahasiswa berada di luar kampus/asrama<br/>';
        echo '2. Row berwarna biru = Mahasiswa berada di dalam kampus/asrama<br/>';
        echo '3. Row berwarna merah = Mahasiswa terlambat memasuki kampus/asrama<br/>';
      ?>
    </div>

    <?= $uiHelper->beginContentRow(); ?>
    <?= $this->render('_search', ['searchModel' => $searchModel, 'prodi' => $prodi, 'dosen_wali' => $dosen_wali, 'asrama' => $asrama]); ?>
    <?= $uiHelper->endContentRow(); ?>
    <br /><br />
 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '{items}{pager}',
        'rowOptions' => function($model){
            if($model->ket != '-') return ['class' => 'danger'];
            else{
                if($model->jenis_log == 'Jam Keluar-Masuk'){
                    $tanggal = $model->waktu_kembali;
                    $day = date('Y-m-d H:i:s', strtotime($tanggal));//Yii::$app->formatter->asDate($tanggal,'EEEE');
                    $dayOut = date('Y-m-d H:i:s', strtotime($model->waktu_keluar));//Yii::$app->formatter->asDate($model->waktu_keluar,'EEEE');
                    $time = date('H:i', strtotime($tanggal));//Yii::$app->formatter->asTime($tanggal,'HH:mm');
                    if (is_null($tanggal) && $model->waktu_keluar!=NULL) {
                        return ['class' => 'warning'];
                    }
                }else{
                    if(is_null($model->waktu_kembali)){
                        return ['class' => 'warning'];
                    }
                }
                return ['class' => 'info'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'nama',
                'label'=>'Nama Mahasiswa',
                'format' => 'raw',
                'value'=>function ($model) {
                    return "<a href='".Url::toRoute(['/dimx/dim/mahasiswa-view', 'dim_id' => $model->dim_id])."'>".$model->nama."</a>";
                },
            ],
            [
                'attribute'=>'waktu_keluar',
                'label' => 'Waktu Keluar',
                'format'=> 'raw',
                'headerOptions' => ['style' => 'color:#3c8dbc'],
                'filter' => DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'tanggal_keluar',
                            'language' => 'en',
                            'size' => 'ms',
                            'inline' => false,
                            'clientOptions' => [
                                'pickerPosition' => 'bottom-left',
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd', // if inline = false
                            ]
                        ]),
                'value' => function($model){
                        if (is_null($model->waktu_keluar)) {
                            return '-';
                        }else{
                            return date('d M Y H:i', strtotime($model->waktu_keluar));
                        }
                    },
            ],
            [
                'attribute'=>'waktu_kembali',
                'label' => 'Waktu Kembali',
                'format'=> 'raw',
                'filter' => DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'tanggal_masuk',
                            'language' => 'en',
                            'size' => 'ms',
                            'inline' => false,
                            'clientOptions' => [
                                'pickerPosition' => 'bottom-left',
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd', // if inline = false
                            ]
                        ]),
                'headerOptions' => ['style' => 'color:#3c8dbc'],
                'value' => function($model){
                        if (is_null($model->waktu_kembali)) {
                            return '-';
                        }else{
                            return date('d M Y H:i', strtotime($model->waktu_kembali));
                        }
                    },
            ],
            [
                'attribute' => 'jenis_log',
                'label' => 'Jenis Log',
                'contentOptions' => ['style' => 'font-weight:bold;text-align:center'],
                'headerOptions' => ['style' => 'text-align:center'],
                'filter'=> Html::activeDropDownList($searchModel, 'jenis_log',$jenisLogData,['class'=>'form-control']),
            ],
            [
                'attribute' => 'ket',
                'label' => 'Keterangan',
                'headerOptions' => ['style' => 'width:40px'],
            ]
        ],
    ]); ?>

</div>
