<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\DetailView;
use backend\modules\cist\models\Pegawai;
use backend\modules\cist\models\LaporanSuratTugas;
use backend\modules\cist\models\Status;
use backend\modules\cist\models\SuratTugas;
use backend\modules\inst\models\InstApiModel;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use common\widgets\Redactor;
use kartik\datetime\DateTimePicker;
use common\helpers\LinkHelper;

/* @var $this yii\web\View */
/* @var $model backend\modules\cist\models\SuratTugas */

$this->title = $model->agenda;
$this->params['breadcrumbs'][] = ['label' => 'Surat Tugas', 'url' => ['index-wr']];
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
            echo "<b>Lampiran</b>:<br/>"; 
            foreach($modelFile as $data){
                echo $idx . ". " . LinkHelper::renderLink(['options'=>'target = _blank', 'label'=>$data->nama_file, 'url'=>\Yii::$app->fileManager->generateUri($data->kode_file)]) . "<br/>";
                //echo $idx . ". " . Html::a($data->nama_file, ['download-attachments', 'id' => $data->file_id]) . "<br/>";
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
                    echo SuratTugas::getStatus($data->status_id) . "<br/><br/>";
                }
            }
        }
    ?>

    <p>
        <?php
            if($modelLaporan != null && $status != 9 && $status != 10){
                echo Html::a('Terima Laporan', ['terima-laporan', 'id' => $model->surat_tugas_id], [
                    'class' => 'btn btn-success',
                    'data-method' => 'post',
                ]) . " ";
                echo Html::a('Tolak Laporan', ['tolak-laporan', 'id' => $model->surat_tugas_id], [
                    'class' => 'btn btn-danger',
                    'data-method' => 'POST',
                    'data' => [
                        'confirm' => 'Tolak laporan surat tugas?',
                    ],
                ]) . " ";
            }
            echo Html::a('Kembali', ['index-wr'], ['class' => 'btn btn-primary']);
        ?>
    </p>
    
</div>
