<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\DetailView;
use backend\modules\cist\models\Pegawai;
use backend\modules\cist\models\LaporanSuratTugas;
use backend\modules\cist\models\SuratTugas;
use backend\modules\cist\models\Status;
use backend\modules\inst\models\InstApiModel;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use common\widgets\Redactor;
use kartik\datetime\DateTimePicker;
use common\helpers\LinkHelper;

/* @var $this yii\web\View */
/* @var $model backend\modules\cist\models\SuratTugas */

$this->title = $model->agenda;
$this->params['breadcrumbs'][] = ['label' => 'Surat Tugas', 'url' => ['index-hrd']];
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

    <?php    
        if($model->status_id == 6){   //If Surat Tugas status is diterima
            $month = convertToRome(date('n'));
            $year = date('y');

            //Terbitkan Modal
            Modal::begin([
                'header' => '<h2>Terbitkan Surat Tugas</h2>',
                'toggleButton' => ['label' => 'Terbitkan', 'class' => 'btn btn-success'],
            ]);

            $form = ActiveForm::begin(['action' => 'terbitkan?id=' . $model->surat_tugas_id]);

            echo $form->field($model, 'no_surat')->textInput(['maxlength' => true, 'value' => $model->surat_tugas_id.'/ITDel/WR2/SDM/ST/'.$month.'/'.$year]);
            
            echo Html::submitButton('Terbitkan', ['class' => 'btn btn-success']);
            
            ActiveForm::end();

            Modal::end();

            //Tambah Catatan
            Modal::begin([
                'header' => '<h2>Catatan Tambahan</h2>',
                'toggleButton' => ['label' => 'Tambah Catatan', 'class' => 'btn btn-warning'],
            ]);

            $form = ActiveForm::begin(['action' => 'add-catatan?id=' . $model->surat_tugas_id]);

            echo $form->field($model, 'catatan')->widget(Redactor::className(), ['options' => [
                'minHeight' => 100,
            ], ]);
            
            echo Html::submitButton('Tambah', ['class' => 'btn btn-warning']);
            
            ActiveForm::end();

            Modal::end();

            //Tambah Keterangan
            Modal::begin([
                'header' => '<h2>Keterangan Tambahan</h2>',
                'toggleButton' => ['label' => 'Tambah Keterangan', 'class' => 'btn btn-warning'],
            ]);

            $form = ActiveForm::begin(['action' => 'add-keterangan?id=' . $model->surat_tugas_id]);

            echo $form->field($model, 'desc_surat_tugas')->widget(Redactor::className(), ['options' => [
                'minHeight' => 100,
            ], ]);
            
            echo Html::submitButton('Tambah', ['class' => 'btn btn-warning']);
            
            ActiveForm::end();

            Modal::end();
        }

        $modelLaporan = SuratTugas::getLaporan($model->surat_tugas_id);
        if($modelLaporan != null){
            //Ubah Batas Submission Modal
            Modal::begin([
                'header' => '<h2>Edit Batas Submission Laporan</h2>',
                'toggleButton' => ['label' => 'Ubah Batas Submission', 'class' => 'btn btn-warning'],
            ]);

            $form = ActiveForm::begin(['action' => 'edit-submission?id=' . $model->surat_tugas_id]);

            echo "<label>Batas Submission</label>";
            echo DateTimePicker::widget([
                'model' => $modelLaporan,
                'attribute' => 'batas_submit',
                'options' => ['placeholder' => 'Pilih tanggal dan waktu'],
                'pluginOptions' => [
                    'autoclose' => 'true',
                    'todayHighlight' => true
                ]
            ]) . "<br/>";
            
            echo Html::submitButton('Ubah', ['class' => 'btn btn-warning']);

            ActiveForm::end();
            
            Modal::end();
        }

        if($model->status_id == 3){
            echo Html::a('Print Surat', ['create-pdf', 'id' => $model->surat_tugas_id], [
                'class' => 'btn btn-warning',
                'data-method' => 'POST',
            ]) . " ";
        }

        echo Html::a('Kembali', ['index-hrd'], ['class' => 'btn btn-primary']);
    ?>
    
</div>
<?php
    function convertToRome($month){
        switch ($month) {
            case 1:
                return 'I';
                break;
            case 2:
                return 'II';
                break;
            case 3:
                return 'III';
                break;
            case 4:
                return 'IV';
                break;
            case 5:
                return 'V';
                break;
            case 6:
                return 'VI';
                break;
            case 7:
                return 'VII';
                break;
            case 8:
                return 'VIII';
                break;
            case 9:
                return 'IX';
                break;
            case 10:
                return 'X';
                break;
            case 11:
                return 'XI';
                break;
            case 12:
                return 'XII';
                break;
        }
    }
?>