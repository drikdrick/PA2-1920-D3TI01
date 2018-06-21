<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use backend\modules\cist\models\SuratTugas;
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
