<?php
/* @var $this yii\web\View */
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\grid\GridView;

    defined('YII_ENV') or define('YII_ENV', 'dev');
?>
<html>
    <head>
        <title>RPP IT DEL</title>
        <style>
        </style>
    </head>
    <body>
    <?php $form = ActiveForm::begin(); ?>
        <h2>Request Penugasan Dosen</h2>
            <!-- <table style="width:100%;">
                <tr style="background : #f0f0f0">
                    <th>Kode Mata Kuliah</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Action</th>
                </tr>
                <?php 
                    // $i = 0; 
                    // foreach($list_matkul as $matkul){
                    //     if($i % 2 == 0){
                    //         $warna = '#f9f9f9';
                    //     }
                    //     else{
                    //         $warna = '#ffffff';
                    //     }
                    ?>
                <tr style="background: <?= 1//$warna ?>">
                    <td><?= 1//$matkul['kode_mk'] ?></td>
                    <td><?= 1//$matkul['nama_kul_ind'] ?></td>
                    <td><?= 1//$matkul['sks'] ?></td>
                    <td><?= 1//Html::a('Request',['/user/req-dosen'],['class'=>['btn btn-success','custom-btn']])?></td>
                </tr>
                <?php //++$i; }?>
            </table> -->
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
                      'sks',
                      [   
                          'class' => 'yii\grid\ActionColumn',
                          'template' => '{Approve}  {Decline}',
                          'buttons' => 
                                [
                                    'Approve' => function($url, $model) {
                                    return Html::a('<span class="btn btn-success btn-sm"><b class="">Isi Request</b></span>',
                                                ['/user/form-request' , 'id' => $model['kode_mk']], 
                                                ['title' => 'Approve', 
                                                'kode_mk' => 'modal-btn-view']);
                                    },
                                ]
                      ],
                  ]
                ]);
            ?>
            <br>
        <?php $form = ActiveForm::end(); ?>
    </body>
</html>

