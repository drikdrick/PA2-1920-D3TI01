<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use backend\modules\cist\models\SuratTugas;
use backend\modules\cist\models\LaporanSuratTugas;
use backend\modules\cist\models\SuratTugasFile;
use backend\modules\cist\models\Pegawai;
use backend\modules\inst\models\InstApiModel;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use common\widgets\Redactor;
use common\helpers\LinkHelper;

/* @var $this yii\web\View */
/* @var $model backend\modules\cist\models\SuratTugas */

$this->title = $model->agenda;
$this->params['breadcrumbs'][] = ['label' => 'Surat Tugas Bawahan', 'url' => ['index-surat-bawahan']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-tugas-view">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= DetailView::widget([
        'model' => $model,
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '-',
        ],
        'attributes' => [
            [
                'attribute' => 'perequest0.nama',
                'label' => 'Pemohon',
            ],
            [
                'label' => 'Nomor Surat',
                'attribute' => 'no_surat'
            ],
            'agenda',
            'tempat',
            'tanggal_berangkat',
            'tanggal_kembali',
            'tanggal_mulai',
            'tanggal_selesai',
            [
                'attribute' => 'desc_surat_tugas',
                'format' => 'html',
            ],
            [
                'label' => 'Peserta',
                'value' => function($model){
                    $pegawais = SuratTugas::getAssignee($model->surat_tugas_id);
                    $result = '';
                    foreach($pegawais as $pegawai){
                        $result .= "<a href='view-profil-pegawai?id=". $pegawai['pegawai_id'] ."&suratId=". $model->surat_tugas_id ."'>". $pegawai['nama'] ."</a><br/>";
                    }
                    return $result;
                },
                'format' => 'html',
            ],
            [
                'label' => 'Atasan',
                'value' => function($model){
                    $pegawais = SuratTugas::getAtasan($model->surat_tugas_id);
                    return implode('<br/>', array_column($pegawais, 'nama'));
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'pengalihan_tugas',
                'format' => 'html',
            ],
            [
                'attribute' => 'transportasi',
                'format' => 'html',
            ],
            [
                'attribute' => 'review_surat',
                'format' => 'html',
            ],
            [
                'attribute' => 'statusName.name',
                'label' => 'Status',
            ],
            [
                'label' => 'Lampiran',
                'value' => function($model){
                    $result = null;
                    $modelFile = SuratTugasFile::find()->where(['surat_tugas_id' => $model->surat_tugas_id])->all();
                    foreach($modelFile as $data){
                        //$result .= Html::a($data['nama_file'], ['download-attachments', 'id' => $data['surat_tugas_file_id']]) . "<br/>";
                        $result .= LinkHelper::renderLink(['options'=>'target = _blank', 'label'=>$data['nama_file'], 'url'=>\Yii::$app->fileManager->generateUri($data['kode_file'])]) . "<br/>";
                    }

                    return $result;
                },
                'format' => 'html',
            ],
            [
                'label' => 'Laporan',
                'value' => function($model){
                    $result = null;
                    $modelLaporan = $modelLaporan = LaporanSuratTugas::find()->where(['surat_tugas_id' => $model->surat_tugas_id])->all();
                    foreach($modelLaporan as $data){
                        if($data->nama_file != null){
                            //$result .= Html::a($data->nama_file, ['download-reports', 'id' => $data->laporan_surat_tugas_id]) . "<br/>";
                            $result .= LinkHelper::renderLink(['options'=>'target = _blank', 'label'=>$data->nama_file, 'url'=>\Yii::$app->fileManager->generateUri($data->kode_laporan)]) . "<br/>";
                        }
                    }
                    
                    return $result;
                },
                'format' => 'html',
            ],
            [
                'label' => 'Batas Submission',
                'value' => function($model){
                    $result = null;
                    $modelLaporan = $modelLaporan = LaporanSuratTugas::find()->where(['surat_tugas_id' => $model->surat_tugas_id])->all();
                    foreach($modelLaporan as $data){
                        $result .= $data->batas_submit . "<br/>";
                    }
                    
                    return $result;
                },
                'format' => 'html',
            ],
            [
                'label' => 'Status Laporan',
                'value' => function($model){
                    $result = null;
                    $modelLaporan = $modelLaporan = LaporanSuratTugas::find()->where(['surat_tugas_id' => $model->surat_tugas_id])->all();
                    foreach($modelLaporan as $data){
                        if(SuratTugas::getStatus($data->status_id) != null){
                            $status = $data->status_id;
                            $result .= SuratTugas::getStatus($data->status_id) . "<br/>";
                        }
                    }
                    
                    return $result;
                },
                'format' => 'html',
            ]
        ],
    ]) ?>

    <?php
        if($model->status_id != 3 && $model->status_id != 5 ){
            echo Html::a('Terima', ['terima',  'id' => $model->surat_tugas_id], [
                'class' => 'btn btn-success',
                'data-method' => 'POST',
            ]) . " ";
            
            //Review Modal
            Modal::begin([
                'header' => '<h2>Review Surat Tugas</h2>',
                'toggleButton' => ['label' => 'Review', 'class' => 'btn btn-warning'],
            ]);
            $form = ActiveForm::begin(['action' => 'review?id=' . $model->surat_tugas_id]);
            echo $form->field($model, 'review_surat')->widget(Redactor::className(), ['options' => [
                'minHeight' => 100,
            ], ]);
            
            echo Html::submitButton('Kirim', ['class' => 'btn btn-warning']);
            ActiveForm::end();
            Modal::end();

            //Tolak Button
            echo Html::a('Tolak', ['tolak', 'id' => $model->surat_tugas_id], [
                'class' => 'btn btn-danger',
                'data-method' => 'POST',
                'data' => [
                    'confirm' => 'Tolak permohonan surat tugas?',
                ],
            ]) . " ";
        }
        
        echo Html::a('Kembali', ['index-surat-bawahan'], ['class' => 'btn btn-primary']);
    ?>

</div>
