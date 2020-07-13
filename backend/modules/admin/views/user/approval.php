<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;
use yii\db\Query;
use yii\grid\GridView;
use yii\grid\CheckboxColumn;
use yii\grid\ActionColumn;

$this->params['header'] = 'Approval Request Dosen';
$uiHelper=\Yii::$app->uiHelper;
?>

<?php if (Yii::$app->session->hasFlash('msgSuccess')): ?>
            <div class="alert alert-success alert-dismissable">
                <?= Yii::$app->session->getFlash('msgSuccess')?>
            </div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('msgFailed')): ?>
            <div class="alert alert-danger alert-dismissable">
            <?= Yii::$app->session->getFlash('msgFailed')?>
            </div>
<?php endif; ?>   
    <?= $uiHelper->renderContentSubHeader('List Request Dosen', ['icon' => 'fa fa-list']);?>
        <?=$uiHelper->renderLine(); ?>
   
          <?php
                
         
                echo  GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' =>[
                      [
                          'attribute' => 'nama',
                          'label' => 'Nama'
                      ],
                      [
                          'attribute' => 'alias',
                          'label' => 'Kode Dosen'
                      ],
                      [
                        'attribute' => 'singkatan_prodi',
                        'label' => 'Asal Prodi'
                      ],
                      [
                        'attribute' => 'nama_kul_ind',
                        'label' => 'Mata Kuliah'
                      ],
                      [
                        'attribute' => 'load',
                        'label' => 'Load Sekarang'
                      ],
                      // [
                      //   'attribute' => 'load_setelah_approve',
                      //   'label' => 'Load Setelah Approve'
                      // ],
                      [   
                          'class' => 'yii\grid\ActionColumn',
                          'template' => '{Approve}  {Decline}',
                          'buttons' => ['Approve' => function($url, $model) {
                            return Html::a('<span class="btn btn-success btn-sm"><b class="">Approve</b></span>',
                                          ['approves', 'id' => $model['pengajuan_id']], 
                                          ['title' => 'Approve', 
                                          'pengajaran_id' => 'modal-btn-view']);
                        },
                          'Decline' => function($url, $model) {
                              return Html::a('<span class="btn btn-danger btn-sm"><b class="">Decline</b></span>',
                                          ['declines', 'id' => $model['pengajuan_id']],
                                          ['title' => 'Decline', 'class' => '',
                                          'data' => ['confirm' => 'Apakah anda yakin akan menolak permintaan tersebut?',
                                          'method' => 'post', 'data-pjax' => false],]);
                          }
                          ]
                      ],

                  ]
                ]);
                    
            ?>