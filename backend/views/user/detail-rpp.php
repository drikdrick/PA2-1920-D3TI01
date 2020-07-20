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
        </style>
    </head>
    <body>
    <?php $form = ActiveForm::begin(); ?>
        <h2>Penugasan Dosen</h2>
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

