<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\grid\GridView;
    use yii\data\ActiveDataProvider;
    use app\models\KrkmKuliah;
    use yii\widgets\Pjax;
    use yii\db\Query;
    //use yii\console\widgets\Table;
    //$table = new Table();
    $this->params['header'] = 'Penugasan Pengajaran';
    $uiHelper=\Yii::$app->uiHelper;
?>
<html>
    <head>
        <title>Pengajuan RPP</title>
        <style>
            th{
                height: 40px;
                text-align: center;
                color: #3c8dbc;
                padding: 5px;
            }
            td{
                padding: 10px;
                text-align: center;
            }
            table{
                border: 1px solid #d2d6de;
            }
            select{
                border: 1px solid #d2d6de;
            }
        </style>
    </head>
    <body>
            <?php $form = ActiveForm::begin();?>
                <?= $uiHelper->renderContentSubHeader('Cari Penugasan', ['icon' => 'fa fa-search']);?>
                <?=$uiHelper->renderLine(); ?>
                <div style="margin:20px">
                    <h3>Tahun Ajaran</h3>
                    <?= Html::dropDownList('selectedProdi','',$list_prodi,['class'=>'form-control','prompt' => 'Pilih Prodi'])?>
                </div>
                <div style="margin:20px">
                    <h3>Prodi dan Jenjang</h3>
                    <?= Html::dropDownList('selectedProdi','',$list_prodi,['class'=>'form-control','prompt' => 'Pilih Prodi'])?>
                </div>
                <div style="margin:20px">
                    <h3>Tahun Ajaran</h3>
                    <?= Html::dropDownList('selectedProdi','',$list_prodi,['class'=>'form-control','prompt' => 'Pilih Prodi'])?>
                </div>
                <div style="margin:20px">
                    <?= Html::submitButton('Cari',['class'=>['btn btn-primary','custom-btn']]);?>
                </div>
                <!-- <h2 style="color:#3c8dbc"><b><?= $selectedProdi ?></b></h2>
                <table style="width:100%;" border="1">
                    <tr style="background : #f0f0f0">
                        <th rowspan="2">Kode Mata Kuliah</th>
                        <th rowspan="2">Nama Mata Kuliah</th>
                        <th colspan="3">SKS</th>
                        <th colspan="3">Kelas</th>
                        <th colspan="2">Dosen</th>
                        <th colspan="2">TA</th>
                    </tr>
                    <tr style="background : #f0f0f0">
                        <th>Teori</th>
                        <th>Praktikum</th>
                        <th>Total</th>
                        <th>Riil</th>
                        <th>Tatap Muka</th>
                        <th>Praktikum</th>
                        <th>Dosen</th>
                        <th>Beban</th>
                        <th>TA</th>
                        <th>Beban</th>
                    </tr>
                    <?php 
                        $i = 0; 
                        $ctr = 0;
                        foreach($list_matkul as $matkul){ 
                            if($i % 2 == 0){
                                $warna = '#f9f9f9';
                            }
                            else{
                                $warna = '#ffffff';
                            }
                        ?>
                    <tr style="background: <?= $warna ?>">
                        <td><?= $matkul['kode_mk'] ?></td>
                        <td><?= $matkul['nama_kul_ind'] ?></td>
                        <td><?= $matkul['sks_teori'] ?></td>
                        <td><?= $matkul['sks_praktikum'] ?></td>
                        <td><?= $matkul['sks'] ?></td>
                        <td><?= $matkul['kelas_riil'] ?></td>
                        <td><?= $matkul['kelas_tatap_muka'] ?></td>
                        <td><?= $matkul['kelas_praktikum'] ?></td>
                        <td><?= $matkul['alias']?></td>
                        <td><?= $matkul['persentasi_beban']."%" ?></td>
                        <td><?= 'RDS' ?></td>
                        <td><?= '100%' ?></td>
                    </tr>
                    <?php ++$i; }?>
                </table> -->

                <br>
            <?php $form = ActiveForm::end(); ?>
    </body>
</html>