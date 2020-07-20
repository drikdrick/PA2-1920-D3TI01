<?php
/* @var $this yii\web\View */
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\grid\GridView;

    defined('YII_ENV') or define('YII_ENV', 'dev');
?>
<html>
    <head>
        <title>Matkul Dosen</title>
        <style>
            td{
                padding: 10px;
            }
            h2{
                border-bottom : 1px solid black;
                padding: 10px;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
    <?php $form = ActiveForm::begin(); ?>
        <h2>Penugasan <?= $dataDosen[0]['nama'] ?></h2>
        <h2 class="fa fa-user">&nbsp Profiles</h2>
        <table>
            <tr>
                <td>Nama Pengajar</td>
                <td>:</td>
                <td><?= $dataDosen[0]['nama'] ?></td>
            </tr>
            <tr>
                <td>NIP</td>
                <td>:</td>
                <td><?= $dataDosen[0]['nip'] ?></td>
            </tr>
            <tr>
                <td>Tahun Ajaran</td>
                <td>:</td>
                <td><?= $dataDosen[0]['ta'] ?></td>
            </tr>
            <tr>
                <td>Load</td>
                <td>:</td>
                <td><?= $dataDosen[0]['load'] ?></td>
            </tr>
        </table>
        <h2>Detail Penugasan</h2>
        <?php $form = ActiveForm::begin(); ?>
        <table style="width:100%">
            <tr>
                <td>Tahun Ajaran</td>
                <td><?= Html::dropDownList('ta',NULL,$ta,['class'=>'form-control', 'prompt' => "Pilih Tahun Ajaran", 'required' => true])?></td>
                <td>Semester</td>
                <td><?= Html::dropDownList('semester',NULL,$sem_ta,['class'=>'form-control', 'prompt' => "Pilih Semester",'required' => true])?></td>
                <td><?= Html::submitButton('Cari',['class'=>['btn btn-primary','custom-btn']]);?></td>
            </tr>
        </table>            
        <?php $form = ActiveForm::end();?>
        <?php
            echo  GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' =>[
                      [
                          'attribute' => 'kode_mk',
                          'label' => 'Kode Mata Kuliah'
                      ],
                      [
                          'attribute' => 'nama_kul_ind',
                          'label' => 'Nama Mata Kuliah'
                      ],
                      [
                        'attribute' => 'nama',
                        'label' => 'Role Pengajar'
                      ],
                      [
                        'attribute' => 'ta',
                        'label' => 'Tahun Ajaran'
                      ],
                      [
                        'attribute' => 'sem_ta',
                        'label' => 'Semester'
                      ],
                  ]
                ]);
            ?>
            <br>
        <?php $form = ActiveForm::end(); ?>
    </body>
</html>

