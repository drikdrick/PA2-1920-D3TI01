<?php
     use yii\widgets\ActiveForm;
     use yii\helpers\Html;
?>
<html>
    <head>
        <title>Request Form</title>
        <style>
            td,th{
                padding: 10px;
            }
            table{
                border: 1px solid #d2d6de;
            }
            /* div{
                border: 1px solid black;
            } */
        </style>   
    </head>
    <body>
        <h2><b>Form Pengisian RPP</b></h2>
        <!-- <div class="col-xs-3"> -->
            <h3>Detail Mata Kuliah</h3>
            <?php $form = ActiveForm::begin(['method' => "post"]); ?>
            <table border="1">
                <tr>
                    <td><b>SKS Teori</b></td>
                    <td>:</td>
                    <td> <?= Html::input('text','sks_teori',$matkul[0]['sks_teori'],
                            ['readonly' => true, 'style' => ['border' => 'none', 'outline' => 'none']])?>
                    </td>
                </tr>
                <tr>
                    <td><b>SKS Praktikum</b></td>
                    <td>:</td>
                    <td> <?= Html::input('text','sks_praktikum',$matkul[0]['sks_praktikum'],
                            ['readonly' => true, 'style' => ['border' => 'none', 'outline' => 'none']])?>
                    </td>
                </tr>
                <tr>
                    <td><b>Total SKS</b></td>
                    <td>:</td>
                    <td> <?= Html::input('text','sks',$matkul[0]['sks'],
                            ['readonly' => true, 'style' => ['border' => 'none', 'outline' => 'none']])?>
                    </td>
                </tr>
                <tr>
                    <td><b>Kelas Teori</b></td>
                    <td>:</td>
                    <td> <?= Html::input('text','kelas_tatap_muka',$matkul[0]['kelas_tatap_muka'],
                            ['readonly' => true, 'style' => ['border' => 'none', 'outline' => 'none']])?>
                    </td>
                </tr>
                <tr>
                    <td><b>Kelas Praktikum</b></td>
                    <td>:</td>
                    <td> <?= Html::input('text','kelas_praktikum',$matkul[0]['kelas_praktikum'],
                            ['readonly' => true, 'style' => ['border' => 'none', 'outline' => 'none']])?>
                    </td>
                </tr>
                <tr>
                    <td><b>Kelas Riil</b></td>
                    <td>:</td>
                    <td> <?= Html::input('text','kelas_riil',$matkul[0]['kelas_riil'],
                            ['readonly' => true, 'style' => ['border' => 'none', 'outline' => 'none','text-color' => 'white']])?>
                    </td>
                </tr>
            </table>
            <?= Html::input('hidden','pengajaran_id',$matkul[0]['pengajaran_id'],
            ['readonly' => true, 'style' => ['border' => 'none', 'outline' => 'none']])?>
            <?= Html::input('hidden','kuliah_id',$matkul[0]['kuliah_id'],
            ['readonly' => true, 'style' => ['border' => 'none', 'outline' => 'none']])?>
        <!-- </div> -->
        <!-- <div class="col-xs-3"> -->
            <h3>Load Dosen</h3>
        <table border="1">
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
            <!-- </div> -->
        <!-- <div class="col-xs-6"> -->
                <h3>Form Pengisian</h3>
                
                <table border="1">
                    <tr>
                        <th colspan="2">Pengajar</th> 
                        <th>Persentase Beban</th>
                    </tr>
                    <tr>
                        <td><b>Koordinator</b></td>
                        <td>
                            <?= Html::dropDownList('koordinator','',$list_dosen,['class'=>'form-control','prompt' => 'Pilih Koordinator','required' => true])?>    
                        </td>
                        <td><?= Html::input('text', 'beban_koordinator','', ['class' => 'form-control','required' => true]) ?></td>
                    </tr>
                    <?php 
                        for($i = 1;$i<=6;$i++){?>
                        <tr>
                            <td><b>Lecturer <?= $i ?></b></td>    
                            <td><?= Html::dropDownList('dosen'.$i,'',$list_dosen,['class'=>'form-control','prompt' => 'Pilih Dosen'])?></td>
                            <td><?= Html::input('text', 'beban_dosen'.$i,'', ['class' => 'form-control']) ?></td>
                        </tr>
                    <?php }?>
                </table>
                <br> 
                <?= Html::submitButton('Submit',['class'=>['btn btn-primary','custom-btn']]);?>
                <?php   ActiveForm::end();?>        
        <!-- </div> -->
        <?php //print_r($data_post['kuliah_id']) ?>
    </body>
</html>
