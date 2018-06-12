<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\DetailView;
use backend\modules\cist\models\Pegawai;
use backend\modules\inst\models\InstApiModel;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use common\widgets\Redactor;

/* @var $this yii\web\View */
/* @var $model backend\modules\cist\models\SuratTugas */

$this->title = $model->agenda;
$this->params['breadcrumbs'][] = ['label' => 'Surat Tugas Bawahan', 'url' => ['index-surat-bawahan']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-tugas-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php
        echo "<b>Pemohon</b>:<br/>";
        echo $model->getNama($model->perequest) . "<br/><br/>";
    ?>

    <?php
        if($model->no_surat != null){
            echo "<b>No. Surat</b>:<br/>";
            echo $model->no_surat . "<br/><br/>";
        }
    ?>

    <?php
        echo "<b>Agenda</b>:<br/>";
        echo $model->agenda . "<br/><br/>";
    ?>

    <?php
        echo "<b>Alamat</b>:<br/>";
        echo $model->tempat . "<br/><br/>";
    ?>

    <?php
        if($model->jenis_surat_id == 1){
            echo "<b>Tanggal Berangkat</b>:<br/>";
            echo $model->tanggal_berangkat . "<br/><br/>";
            echo "<b>Tanggal Kembali</b>:<br/>";
            echo $model->tanggal_kembali . "<br/><br/>";   
        }
        echo "<b>Tanggal Mulai Kegiatan</b>:<br/>";
        echo $model->tanggal_mulai . "<br/><br/>";
        echo "<b>Tanggal Selesai Kegiatan</b>:<br/>";
        echo $model->tanggal_selesai . "<br/><br/>";   
    ?>

    <!-- Untuk desc_surat_tugas gunakan HtmlPurifier -->
    <?= "<b>Keterangan</b>: " . HtmlPurifier::process($model->desc_surat_tugas); ?>

    <!-- Untuk Pengalihan Tugas -->
    <?= "<b>Pengalihan Tugas</b>: " . HtmlPurifier::process($model->pengalihan_tugas) ?>

    <!-- Untuk list peserta -->
    <?php
        $idx = 1;
        echo "<b>List Peserta</b>:<br/>"; 
        foreach($modelAssignee as $data){
            $pegawai = Pegawai::find()->where(['pegawai_id' => $data['id_pegawai']])->one();
            echo $idx . ". " . $pegawai->nama . "<br/>";
            $idx++;
        }
        echo "<br/>"
    ?>

    <?= "<b>Transportasi</b>: " . HtmlPurifier::process($model->transportasi) ?>    

    <!-- Untuk list lampiran -->
    <?php
        if($modelFile != null){
            $idx = 1;
            echo "<b>List Lampiran</b>:<br/>"; 
            foreach($modelFile as $data){
                echo $idx . ". " . Html::a($data->nama_file, ['download-attachments', 'id' => $data->file_id]) . "<br/>";
            }
            echo "<br/>";
        }
    ?>

    <!-- Untuk list atasan -->
    <?php
        $idx = 1;
        echo "<b>List Atasan</b>:<br/>";
        foreach($modelAtasan as $data){
            $pegawai = Pegawai::find()->where(['pegawai_id' => $data['id_pegawai']])->one();
            echo $idx . ". " . $pegawai->nama . "<br/>";
        }
        echo "<br/>";
    ?>

    <!-- Untuk review gunakan HtmlPurifier -->
    <?php
        if($model->review_surat != null && $model->name != 3 && $model->name != 6){   //If there is Review and Surat Tugas status is not diterbitkan or diterima
            echo "Review: " . HtmlPurifier::process($model->review_surat); 
        }
    ?>

    <?php
        echo "<b>Status Surat Tugas</b>:<br/>"; 
        echo $model->getStatus($model->name) . "<br/><br/>";
    ?>

    <p>
        <?php
            if($model->name != 3 && $model->name != 5 ){
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
    </p>

</div>
