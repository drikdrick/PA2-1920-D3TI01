<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\DetailView;
use backend\modules\cist\models\Pegawai;
use backend\modules\cist\models\Status;
use backend\modules\cist\models\SuratTugas;
use backend\modules\inst\models\InstApiModel;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use common\widgets\Redactor;
use common\helpers\LinkHelper;

/* @var $this yii\web\View */
/* @var $model backend\modules\cist\models\SuratTugas */

$this->title = $model->agenda;
$this->params['breadcrumbs'][] = ['label' => 'Surat Tugas', 'url' => ['index-pegawai']];
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
                'attribute' => 'no_surat',
                'label' => 'Nomor Surat',
            ],
            'agenda',
            'tempat',
            [
                'attribute' => 'tanggal_berangkat',
                'value' => function($data){
                    return date('d M Y', strtotime($data->tanggal_berangkat)).' '.date('H:i', strtotime($data->tanggal_berangkat));
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'tanggal_kembali',
                'value' => function($data){
                    return date('d M Y', strtotime($data->tanggal_kembali)).' '.date('H:i', strtotime($data->tanggal_kembali));
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'tanggal_mulai',
                'value' => function($data){
                    return date('d M Y', strtotime($data->tanggal_mulai)).' '.date('H:i', strtotime($data->tanggal_mulai));
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'tanggal_selesai',
                'value' => function($data){
                    return date('d M Y', strtotime($data->tanggal_selesai)).' '.date('H:i', strtotime($data->tanggal_selesai));
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'desc_surat_tugas',
                'format' => 'html',
            ],
            [
                'label' => 'Peserta',
                'value' => function($model){
                    $pegawais = SuratTugas::getAssignee($model->surat_tugas_id);
                    return implode(', ', array_column($pegawais, 'nama'));
                }
            ],
            [
                'label' => 'Atasan',
                'value' => function($model){
                    $pegawais = SuratTugas::getAtasan($model->surat_tugas_id);
                    return implode(', ', array_column($pegawais, 'nama'));
                }
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
                'label' => 'Status',
                'value' => function($model){ return $model->statusName->name; }
            ],
        ],
    ]) ?>

    <!-- Untuk list lampiran -->
    <?php
        if($modelFile != null){
            $idx = 1;
            echo "<b>List Lampiran</b>:<br/>"; 
            foreach($modelFile as $data){
                echo $idx . ". " . LinkHelper::renderLink(['options'=>'target = _blank', 'label'=>$data->nama_file, 'url'=>\Yii::$app->fileManager->generateUri($data->kode_file)]) . "<br/>";
                //echo $idx . ". " . Html::a($data->nama_file, ['download-attachments', 'id' => $data->surat_tugas_file_id]) . "<br/>";
            }
            echo "<br/>";
        }
    ?>

    <?php
        if($modelLaporan != null){  //If there are Laporan in this Surat Tugas
            foreach($modelLaporan as $data){
                if($data->nama_file != null){
                    echo "<b>Laporan</b>:<br/>";
                    echo LinkHelper::renderLink(['options'=>'target = _blank', 'label'=>$data->nama_file, 'url'=>\Yii::$app->fileManager->generateUri($data->kode_laporan)]) . "<br/><br/>";
                    //echo Html::a($data->nama_file, ['download-reports', 'id' => $data->laporan_surat_tugas_id]) . "<br/><br/>";
                }
                echo "<b>Batas Submission</b>:<br/>"; 
                echo $data->batas_submit . "<br/><br/>";
                if(SuratTugas::getStatus($data->status_id) != null){
                    $status = $data->status_id;
                    echo "<b>Status Laporan</b>:<br/>"; 
                    echo SuratTugas::getStatus($data->status_id) . "<br/>";
                }
            }
        }
    ?>
    
    <br/>

    <?php
        $link = ($model->jenis_surat_id == 1) ? 'edit-luar-kampus' : 'edit-dalam-kampus';   
        if($modelLaporan != null){
            $label = (SuratTugas::getLaporan($model->surat_tugas_id)->nama_file == null) ? 'Submit Laporan' : 'Ubah Laporan';

            if($model->status_id == 3 
                && (SuratTugas::getLaporan($model->surat_tugas_id)->status_id == 7
                || SuratTugas::getLaporan($model->surat_tugas_id)->status_id == 8)
            ){   //If Surat Tugas Status is Diterbitkan
                Modal::begin([
                    'header' => '<h2>Submit Laporan Tugas</h2>',
                    'toggleButton' => ['label' => $label, 'class' => 'btn btn-success'],
                ]);

                $form = ActiveForm::begin(['action' => 'submit-laporan?id=' . $model->surat_tugas_id]);

                echo $form->field($model, 'files[]')->fileInput(['multiple' => true]);
                echo Html::submitButton('Submit', ['class' => 'btn btn-success']);

                ActiveForm::end();
                
                Modal::end();
            }
        } 
        
        
        if($model->status_id == 1 || $model->status_id == 2){   //If Surat Tugas status is Memohon or Review
            echo Html::a('Ubah', [$link, 'id' => $model->surat_tugas_id], ['class' => 'btn btn-warning']) . " ";
        }

        echo Html::a('Kembali', ['index-pegawai'], ['class' => 'btn btn-primary']);
    ?>

</div>
