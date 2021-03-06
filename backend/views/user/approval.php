<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;
use app\models\RppxRequestDosen;
use yii\widgets\Pjax;
use yii\db\Query;
use yii\grid\GridView;
use yii\grid\CheckboxColumn;
use yii\grid\ActionColumn;

$this->params['header'] = 'Approval Request Dosen';
$uiHelper=\Yii::$app->uiHelper;
?>
    <?= $uiHelper->renderContentSubHeader('List Request Dosen', ['icon' => 'fa fa-list']);?>
        <?=$uiHelper->renderLine(); ?>
          <?php         
                echo  GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' =>[
                      [
                          'attribute' => 'id_request',
                          'label' => 'No Request'
                      ],
                      [
                          'attribute' => 'pengajar_id',
                          'label' => 'ID Pengajar'
                      ],
                      [
                          'attribute' => 'kode_mk',
                          'label' => 'Kode Matakuliah'
                      ],
                      [   
                           
                           'class' => 'yii\grid\ActionColumn',
                          'template' => '{Approve}  {Decline}',
                          'buttons' => ['Approve' => function($url, $model) {
                            return Html::a('<span class="btn btn-success btn-sm"><b class="">Approve</b></span>',['Approve', 'id' => $model['id_request']], ['title' => 'Approve', 'id_request' => 'modal-btn-view']);
                        },
                          'Decline' => function($url, $model) {
                              return Html::a('<span class="btn btn-danger btn-sm"><b class="">Decline</b></span>', ['Decline', 'id' => $model['id_request']], ['title' => 'Decline', 'class' => '', 'data' => ['confirm' => 'Apakah anda yakin akan menolak permintaan tersebut?', 'method' => 'post', 'data-pjax' => false],]);
                          }
                          ]
                      ],

                  ]
                ]);
                    
            ?>