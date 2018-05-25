<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\components\ToolsColumn;
use common\helpers\LinkHelper;
use backend\modules\askm\models\StatusRequest;
use backend\modules\askm\models\Asrama;
use backend\modules\askm\models\Prodi;
use backend\modules\askm\models\Pegawai;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\IzinBermalamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List Izin Bermalam';
$this->params['breadcrumbs'][] = ['label' => 'Izin Bermalam', 'url' => ['index-admin']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['header'] = 'Izin Bermalam';

$status_url = urldecode('IzinBermalamSearch%5Bstatus_request_id%5D');

$uiHelper=\Yii::$app->uiHelper;
?>
<div class="izin-bermalam-index">
    
    <!-- <div class="pull-right"> -->
        <!-- Manage Request -->
        <!-- <?= $uiHelper->renderButtonSet([
                'template' => ['approve', 'approve-all', 'reject', 'reject-all'],
                'buttons' => [
                    'approve-all' => ['url' => Url::toRoute(['approve-all', 'id_keasramaan' => 1]), 'label'=> 'Setujui semua request', 'icon'=>'fa fa-check'],
                    'approve' => ['url' => Url::to('approve-selected'), 'onclick' => "submit()", 'label'=> 'Setujui yang dipilih', 'icon'=>'fa fa-check'],
                    'reject-all' => ['url' => Url::toRoute(['reject-all', 'id_keasramaan' => 1]), 'label'=> 'Tolak semua request', 'icon'=>'fa fa-times'],
                    'reject' => ['url' => Url::toRoute(['reject-selected']), 'label'=> 'Tolak yang dipilih', 'icon'=>'fa fa-times'],
                ],
            ]) ?> -->
    <div class="pull-right">
        Manage Request
        <div class="btn-group">
            <button type="button" class="btn btn-default btn-flat btn-set btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><span style="font-size: 18px;" class="fa fa-gear"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                <li>
                    <!-- <button type="button" onclick="submit()">Setujui yang dipilih</button> -->
                    <a href="#" id="selected-approve"><i class="fa fa-check"></i>Setujui yang dipilih</a>
                </li>
                <!-- <li>
                    <a href="/cis-lite/backend/web/index.php/askm/izin-bermalam/approve-all?id_keasramaan=<?= Yii::$app->user->identity->user_id ?>"><i class="fa fa-check"></i>Setujui semua request</a>
                </li> -->
                <li>
                    <a href="#" id="selected-reject"><i class="fa fa-times"></i>Tolak yang dipilih</a>
                </li>
                <!-- <li>
                    <a href="/cis-lite/backend/web/index.php/askm/izin-bermalam/reject-all?id_keasramaan=<?= Yii::$app->user->identity->user_id ?>"><i class="fa fa-times"></i>Tolak semua request</a>
                </li> -->
            </ul>
        </div>
    </div>
    <!-- </div> -->
    <?= $uiHelper->renderContentSubHeader(' '.$this->title, ['icon' => 'fa fa-list']);?>
    <?= $uiHelper->renderLine(); ?>

    <?php // echo $this->render('_searchByAdmin', ['model' => $searchModel]); ?>

    <?php
        $status1 = ($status_request_id == 0)?'active':'';
        $status2 = ($status_request_id == 1)?'active':'';
        $status3 = ($status_request_id == 2)?'active':'';
        $status4 = ($status_request_id == 3)?'active':'';

        $toolbarItemStatusRequest =  
            "<a href='".Url::to(['izin-bermalam/izin-by-admin-index'])."' class='btn btn-default ".$status1."'><i class='fa fa-list'></i><span class='toolbar-label'>All</span></a>
            <a href='".Url::to(['izin-bermalam/izin-by-admin-index', $status_url => 1])."' class='btn btn-info ".$status2."'><i class='fa fa-info'></i><span class='toolbar-label'>Requested</span></a>
            <a href='".Url::to(['izin-bermalam/izin-by-admin-index', $status_url => 2])."' class='btn btn-success ".$status3."'><i class='fa fa-check'></i><span class='toolbar-label'>Accepted</span></a>
            <a href='".Url::to(['izin-bermalam/izin-by-admin-index', $status_url => 3])."' class='btn btn-danger ".$status4."'><i class='fa fa-ban'></i><span class='toolbar-label'>Rejected</span></a>
            "
            ;

    ?>

    <?=Yii::$app->uiHelper->renderToolbar([
    'pull-right' => true,
    'groupTemplate' => ['groupStatusExpired'],
    'groups' => [
        'groupStatusExpired' => [
            'template' => ['filterStatus'],
            'buttons' => [
                'filterStatus' => $toolbarItemStatusRequest,
            ]
        ],
    ],
    ]) ?>

    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => 'tabel-izin-bermalam',
        'tableOptions' => ['class' => 'table table-stripped table-condensed table-bordered', 'style' => 'font-size:12px;'],
        'rowOptions' => function($model){
            if($model->status_request_id == 1){
                return ['class' => 'info'];
            } else if($model->status_request_id == 2){
                return ['class' => 'success'];
            } else if($model->status_request_id == 3){
                return ['class' => 'danger'];
            } else {
                return ['class' => 'warning'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'realisasi_berangkat',
            // 'realisasi_kembali',
            // 'desc:ntext',
            // 'tujuan',
            [
            'attribute' => 'dim_nama',
            'label' => 'Nama Mahasiswa',
            'format' => 'raw',
            'value' => 'dim.nama',
            ],
            [
                'attribute'=>'dim_prodi',
                'label' => 'Prodi',
                'filter'=>ArrayHelper::map(Prodi::find()->where('deleted!=1')->andWhere(['is_hidden' => 0])->asArray()->all(), 'ref_kbk_id', 'singkatan_prodi'),
                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'ALL'],
                'value' => 'dim.refKbk.singkatan_prodi',
            ],
            [
                'attribute' => 'dim_angkatan',
                'label' => 'Angkatan',
                'headerOptions' => ['style' => 'width:20px'],
                'format' => 'raw',
                'value' => 'dim.thn_masuk',
            ],
            'desc',
            [
                'attribute' => 'tujuan',
                'label' => 'Tempat Tujuan',
                'format' => 'raw',
                'headerOptions' => ['style' => 'width:100px'],
                'value' => 'tujuan',
            ],
            'rencana_berangkat',
            'rencana_kembali',
            [
                'attribute'=>'dim_asrama',
                'label' => 'Asrama',
                'format' => 'raw',
                'headerOptions' => ['style' => 'width:80px'],
                'filter'=>ArrayHelper::map(Asrama::find()->andWhere('deleted!=1')->asArray()->all(), 'asrama_id', 'name'),
                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'ALL'],
                'value' => 'dim.dimAsrama.kamar.asrama.name',
            ],
            // [
            // 'attribute' => 'keasramaan_id',
            // 'label' => 'Disetujui oleh',
            // 'value' => function($model){
            //         if (is_null($model->pegawai['nama'])) {
            //             return '-';
            //         }else{
            //             return $model->pegawai['nama'];
            //         }
            //     }
            // ],
            // [
            //     'attribute'=>'status_request_id',
            //     'label' => 'Status Request',
            //     'filter'=>ArrayHelper::map(StatusRequest::find()->asArray()->all(), 'status_request_id', 'status_request'),
            //     'value' => 'statusRequest.status_request',
            // ],
            ['class' => 'common\components\ToolsColumn',
                'template' => '{view} {approve} {reject} {print}',
                'header' => 'Aksi',
                'buttons' => [
                    'view' => function ($url, $model){
                        return ToolsColumn::renderCustomButton($url, $model, 'View Detail', 'fa fa-eye');
                    },
                    'reject' => function ($url, $model){
                        if ($model->status_request_id == 2 || $model->status_request_id == 3 || $model->status_request_id == 4) {
                            return "";
                        }else{
                            return ToolsColumn::renderCustomButton($url, $model, 'Reject', 'fa fa-times');
                        }
                    },
                    'approve' => function ($url, $model){
                        if ($model->status_request_id == 2 || $model->status_request_id == 3 || $model->status_request_id == 4) {
                            return "";
                        }else{
                            return ToolsColumn::renderCustomButton($url, $model, 'Approve', 'fa fa-check');
                        }
                    },
                    'print' => function ($url, $model){
                        if ($model->status_request_id == 2) {
                            return ToolsColumn::renderCustomButton($url, $model, 'Print', 'fa fa-print');
                        } else {
                            return "";
                        }
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index){
                    $pegawai = Pegawai::find()->where('deleted != 1')->andWhere(['user_id' => Yii::$app->user->identity->user_id])->one();
                    if ($action === 'view') {
                        return Url::toRoute(['izin-by-admin-view', 'id' => $key]);
                    }else if ($action === 'approve') {
                        return Url::toRoute(['approve-by-keasramaan-index', 'id_ib' => $model->izin_bermalam_id, 'id_keasramaan' => $pegawai->pegawai_id]);
                    // }else if ($action === 'del') {
                    //     return Url::toRoute(['del', 'id' => $key]);
                    }else if ($action === 'reject') {
                        return Url::toRoute(['reject-by-keasramaan-index', 'id_ib' => $model->izin_bermalam_id, 'id_keasramaan' => $pegawai->pegawai_id]);
                    }else if ($action === 'print') {
                        return Url::toRoute(['print-ib', 'id' => $key]);
                    }
                }
            ],
            [
                'class' => 'yii\grid\CheckboxColumn',
                // 'contentOptions' => ['style' => 'width: 50px'],
                'name' => 'checked',
                'header' => '',
                'checkboxOptions' => function($model){
                    if ($model->status_request_id != 1) {
                        return ['value' => $model->izin_bermalam_id, 'disabled' => true,];
                    } else{
                        return ['value' => $model->izin_bermalam_id];
                    }
                }
            ]
        ],
    ]);
    Pjax::end() ?>
</div>

<!-- <script type="text/javascript">
    function submit(){
        var dialog = confirm("Setujui request yang dipilih ?");
        if (dialog == true) {
            var keys = $('#tabel-izin-bermalam').yiiGridView('getSelectedRows');
            // alert(keys);
            var ajax = new XMLHttpRequest();
            $.ajax({
                type: "POST",
                url: 'approve-selected',
                data: {keylist: keys},
                success: function(result){
                    console.log(result);
                }
            });
        }
    }
</script> -->

<script type="text/javascript">
    document.getElementById('selected-approve').onclick = function submit(){
        var keys = $('#tabel-izin-bermalam').yiiGridView('getSelectedRows');
            // alert(keys);
            var ajax = new XMLHttpRequest();
            var keasramaan_id = "<?php $pegawai = Pegawai::find()->where('deleted != 1')->andWhere(['user_id' => Yii::$app->user->identity->user_id])->one(); 
            echo $pegawai->pegawai_id; ?>"
            var htmlString = "approve-selected?id_keasramaan=" + keasramaan_id;
            $.ajax({
                type: "POST",
                url: htmlString,
                data: {keylist: keys},
                success: function(result){
                    console.log(result);
                }
            });
    }

    document.getElementById('selected-reject').onclick = function submit(){
        var keys = $('#tabel-izin-bermalam').yiiGridView('getSelectedRows');
            // alert(keys);
            var ajax = new XMLHttpRequest();
            var keasramaan_id = "<?php $pegawai = Pegawai::find()->where('deleted != 1')->andWhere(['user_id' => Yii::$app->user->identity->user_id])->one(); 
            echo $pegawai->pegawai_id; ?>"
            var htmlString = "reject-selected?id_keasramaan=" + keasramaan_id;
            $.ajax({
                type: "POST",
                url: htmlString,
                data: {keylist: keys},
                success: function(result){
                    console.log(result);
                }
            });
    }
</script>