<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\grid\GridView;
    use yii\data\ActiveDataProvider;
    use app\models\RppxLoadPengajaran;
    use yii\widgets\Pjax;
    use yii\db\Query;
    //use yii\console\widgets\Table;
    //$table = new Table();
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
                text-align: left;
            }
            table{
                border: 1px solid #d2d6de;
            }
            select{
                border: 1px solid #d2d6de;
            }
            /* div{
                border: 1px solid black;
            } */

        </style>
    </head>
    <body>
        <div class="col-xs-12">
            <?php $form = ActiveForm::begin();?>
                <h2 style="color: #3c8dbc;"><b>Request Penugasan Pengajaran</b></h2>
                    <h2 style="color:#3c8dbc"><b><?= $selectedProdi ?></b></h2>
                    <div class="col-xs-9">
                        <table style="width:100%;" border="1">
                            <tr style="background : #f0f0f0">
                                <th style="width: 20%">Nama Matkul</th>
                                <th>Kode Matkul</th>
                                <th>SKS</th>
                                <th>Dosen</th>
                                <th style="width: 100px">Persen Beban</th>
                            </tr>
                            <?php foreach($list_matkul as $matkul){?>
                            <tr>
                                <td><?= $matkul['nama_kul_ind']?></td>
                                <td><?= $matkul['kode_mk']?></td>
                                <td><?= $matkul['sks']?></td>
                                <td>
                                    <div class="col-xs-9">
                                    <select class="form-control">
                                        <?php foreach($list_pegawai as $pegawai){?>
                                            <option><?= $pegawai['alias'] ?></option>
                                        <?php }?>
                                    </select>
                                    </div>
                                    <div class="col-xs-3">
                                        <button type="button" name="add" id="add" class="btn btn-success">+</button>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                            </tr>
                            <?php }?>
                        </table>
                    </div>
                    <div class="col-xs-3">
                        <table style="width:100%;" border="1">
                            <tr style="background : #f0f0f0">
                                <th>Kode</th>
                                <th>NIP</th>
                                <th>Load</th>
                            </tr>
                            <?php
                                $i = 0; 
                                foreach($load_dosen as $load){
                                if($i % 2 == 0){
                                    $warna = '#f9f9f9';
                                }
                                else{
                                    $warna = '#ffffff';
                                }
                                ?>

                                <tr style="background: <?= $warna ?>">
                                    <td><?= $load['alias']?></td>
                                    <td><?= $load['nip']?></td>
                                    <td><?= $load['load']?></td>
                                </tr>
                            <?php ++$i; }?>
                        </table>
                    </div>
            <?php $form = ActiveForm::end(); ?>       
        </div>
        <?= Html::a('Submit',['/user/penugasan-dosen'],['class'=>['btn btn-success','custom-btn'],'style' => 'margin: 20px 0% 0% 63%'])?>
    </body>
</html>