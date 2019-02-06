<?php

use yii\helpers\Html;
use backend\modules\cist\assets\CistAsset;
use yii\widgets\DetailView;
use backend\modules\cist\models\AtasanIzin;
use backend\modules\cist\models\Pegawai;
use common\helpers\LinkHelper;

CistAsset::register($this);
$uiHelper = \Yii::$app->uiHelper;

/* @var $this yii\web\View */
/* @var $model backend\modules\cist\models\PermohonanIzin */

$this->title = "HRD View: ".$model->kategori->name;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Izin', 'url' => ['index-by-hrd']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['header'] = $this->title;
?>
<div class="permohonan-izin-view">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!--STEP HERE!!!!!-->
                <div class="border-box">
                    <div class="stepwizard col-md-6">
                        <div class="stepwizard-row setup-panel">
                            <div class="stepwizard-step col-md-3">
                                <a href="#step-1" type="button" class="btn btn-success btn-circle disabled">1</a>
                                <p>Ajukan Izin</p>
                            </div>
                            <?php
                            if($model->statusIzin->status_by_hrd == "Waiting"){
                                echo '<div class="stepwizard-step col-md-3">
                                            <a href="#step-2" type="button" class="btn btn-default btn-circle">2</a>
                                            <p>HRD</p>
                                           </div>';
                                echo '<div class="stepwizard-step col-md-3">
                                            <a href="#step-3" type="button" class="btn btn-default btn-circle disabled">3</a>
                                            <p>Supervisor</p>
                                           </div>';
                                echo '<div class="stepwizard-step col-md-3">
                                            <a href="#step-4" type="button" class="btn btn-default btn-circle disabled">4</a>
                                            <p>WR 2</p>
                                           </div>';
                            }
                            else if($model->statusIzin->status_by_hrd == "Accepted"){
                                echo '<div class="stepwizard-step col-md-3">
                                            <a href="#step-2" type="button" class="btn btn-success btn-circle">2</a>
                                            <p>HRD</p>
                                           </div>';
                                if($model->statusIzin->status_by_atasan == "Waiting"){
                                    echo '<div class="stepwizard-step col-md-3">
                                            <a href="#step-3" type="button" class="btn btn-default btn-circle">3</a>
                                            <p>Supervisor</p>
                                           </div>';
                                    echo '<div class="stepwizard-step col-md-3">
                                            <a href="#step-4" type="button" class="btn btn-default btn-circle disabled">4</a>
                                            <p>WR 2</p>
                                           </div>';
                                }
                                else if($model->statusIzin->status_by_atasan == "Accepted"){
                                    echo '<div class="stepwizard-step col-md-3">
                                            <a href="#step-3" type="button" class="btn btn-success btn-circle">3</a>
                                            <p>Supervisor</p>
                                           </div>';
                                    if($model->statusIzin->status_by_wr2 == "Waiting") {
                                        echo '<div class="stepwizard-step col-md-3">
                                                    <a href="#step-4" type="button" class="btn btn-default btn-circle">4</a>
                                                    <p>WR 2</p>
                                                   </div>';
                                    }
                                    else if($model->statusIzin->status_by_wr2 == "Accepted"){
                                        echo '<div class="stepwizard-step col-md-3">
                                                    <a href="#step-4" type="button" class="btn btn-success btn-circle">4</a>
                                                    <p>WR 2</p>
                                                   </div>';
                                    }
                                    else if($model->statusIzin->status_by_wr2 == "Rejected"){
                                        echo '<div class="stepwizard-step col-md-3">
                                                    <a href="#step-4" type="button" class="btn btn-danger btn-circle">4</a>
                                                    <p>WR 2</p>
                                                   </div>';
                                    }
                                }
                                else if($model->statusIzin->status_by_atasan == "Rejected"){
                                    echo '<div class="stepwizard-step col-md-3">
                                            <a href="#step-3" type="button" class="btn btn-danger btn-circle">3</a>
                                            <p>Supervisor</p>
                                           </div>';
                                    echo '<div class="stepwizard-step col-md-3">
                                            <a href="#step-4" type="button" class="btn btn-warning btn-circle disabled">4</a>
                                            <p>WR 2</p>
                                           </div>';
                                }
                            }
                            else if($model->statusIzin->status_by_hrd == "Rejected"){
                                echo '<div class="stepwizard-step col-md-3">
                                            <a href="#step-2" type="button" class="btn btn-danger btn-circle">2</a>
                                            <p>HRD</p>
                                           </div>';
                                echo '<div class="stepwizard-step col-md-3">
                                            <a href="#step-3" type="button" class="btn btn-warning btn-circle disabled">3</a>
                                            <p>Supervisor</p>
                                           </div>';
                                echo '<div class="stepwizard-step col-md-3">
                                            <a href="#step-4" type="button" class="btn btn-warning btn-circle disabled">4</a>
                                            <p>WR 2</p>
                                           </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!--END ROW-->

        <div class="row setup-content" id="step-2">
            <div class="col-xs-12">
                <div class="col-md-12">
                    <div class=" ">
                        <div class="box-header">

                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-md-4" for="status">Status</label>
                                <?php
                                if($model->statusIzin->status_by_hrd == 'Waiting'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_hrd',
                                                'label' => 'Status Oleh HRD'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-gray">Waiting</span> Oleh <label>HRD</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_hrd == 'Accepted'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_hrd',
                                                'label' => 'Status Oleh HRD'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-green">Accepted</span> Oleh <label>HRD</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_hrd == 'Rejected'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_hrd',
                                                'label' => 'Status Oleh HRD'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-red">Rejected</span> Oleh <label>HRD</label>',
                                    ]);
                                }
                                ?>
                                <label class="col-md-4" for="status"></label>
                                <?php
                                if($model->statusIzin->status_by_atasan == 'Waiting') {
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_atasan',
                                                'label' => 'Status Oleh Atasan'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-gray">Waiting</span> Oleh <label>Atasan</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_atasan == 'Accepted'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_atasan',
                                                'label' => 'Status Oleh Atasan'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-green">Accepted</span> Oleh <label>Atasan</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_atasan == 'Rejected'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_atasan',
                                                'label' => 'Status Oleh Atasan'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-red">Rejected</span> Oleh <label>Atasan</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_atasan == 'Canceled'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_atasan',
                                                'label' => 'Status Oleh Atasan'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-yellow">Canceled</span> Oleh <label>Atasan</label>',
                                    ]);
                                }
                                ?>
                                <label class="col-md-4" for="status"></label>
                                <?php
                                if($model->statusIzin->status_by_wr2 == 'Waiting') {
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_wr2',
                                                'label' => 'Status Oleh WR2'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-gray">Waiting</span> Oleh <label>WR 2</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_wr2 == 'Accepted'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_wr2',
                                                'label' => 'Status Oleh WR2'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-green">Accepted</span> Oleh <label>WR 2</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_wr2 == 'Rejected'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_wr2',
                                                'label' => 'Status Oleh WR2'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-red">Rejected</span> Oleh <label>WR 2</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_wr2 == 'Canceled'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_atasan',
                                                'label' => 'Status Oleh Atasan'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-yellow">Canceled</span> Oleh <label>WR 2</label>',
                                    ]);
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4" for="nama">Pemohon</label>
                                <?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        [
                                            'attribute' => 'pegawai_id',
                                            'value'     => $model->pegawai->nama,
                                        ],
                                    ],
                                    'template' => '<label class="input-group" id="nama">{value}</label>',
                                ]);
                                ?>
                                <div class="help-block help-block-error "></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4" for="jabatan">Jabatan</label>
                                <label class="input-group" id="nama">Dosen</label>
                                <div class="help-block help-block-error"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4" for="prodi">Prodi/Bagian</label>
                                <label class="input-group" id="Bagian">Teknik Informatika</label>
                                <div class="help-block help-block-error "></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4" for="Tanggal Masuk">Tanggal Masuk</label>
                                <div class="input-group col-sm-5">
                                    <label class="input-group" id="waktuizin">09/06/2013</label>
                                </div>
                                <div class="help-block help-block-error"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4" for="NIDN">NIDN/NIK</label>
                                <label class="input-group" id="NIDN">080989999</label>
                                <div class="help-block help-block-error"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4">Jenis Izin</label>
                                <div class="input-group col-sm-5">
                                    <?= DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'kategori_id',
                                                'value'     => $model->kategori->name,
                                            ],
                                        ],
                                        'template' => '<label class="input-group" id="jenisizin">{value}</label>',
                                    ])
                                    ?>
                                </div>
                                <div class="help-block help-block-error"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4">Waktu Izin</label>
                                <div class="input-group col-sm-5">
                                    <?= DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            'waktu_pelaksanaan',
                                        ],
                                        'template' => '<label class="input-group" id="waktucuti">{value}</label>',
                                    ])
                                    ?>
                                </div>
                                <div class="help-block help-block-error "></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4" for="lamaizin">Lama Izin (Hari)</label>
                                <?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        'lama_izin',
                                    ],
                                    'template' => '<label class="input-group" id="lamaizin">{value}</label>',
                                ])
                                ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4" for="alasanizin">Alasan Izin</label>
                                <form>
                                    <?= DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            'alasan_izin',
                                        ],
                                        'template' => '<label class="input-group" id="alasanizin">{value}</label>',
                                    ])
                                    ?>
                                </form>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4" for="pengalihantugas">Pengalihan Tugas</label>
                                <form>
                                    <?= DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            'pengalihan_tugas',
                                        ],
                                        'template' => '<label class="input-group" id="pengalihantugas">{value}</label>',
                                    ])
                                    ?>
                                </form>
                            </div>

                            <!-- Lampiran -->
                            <?php
                            $kategori = $model->kategori_id;
                            if($kategori == 1) {
                                ?>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="pengalihantugas">Lampiran</label>
                                    <form>
                                        <?= Html::a('Download Lampiran', ['permohonan-izin/download', 'id' => $model->permohonan_izin_id], ['class' => 'btn btn-succes']) ?>
                                    </form>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="form-group">
                                <label class="control-label col-md-4" for="pengalihantugas">Atasan</label>
                                <form>
                                    <?php
                                    $mdl = new AtasanIzin();
                                    $atasan = $mdl->find()->where(['permohonan_izin_id' => $model->permohonan_izin_id])->all();
                                    ?>
                                    <?php
                                    $sum = "";
                                    foreach($atasan as $data){
                                        $pegawai = Pegawai::find()->andWhere(['pegawai_id' => $data['pegawai_id']])->one();
                                        $sum .= $pegawai['nama'];
                                        $sum .= ", ";
                                    }
                                    ?>
                                    <?= DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'atasan',
                                                'value' => $sum,
                                            ],
                                        ],
                                        'template' => '<label class="input-group" id="atasan">{value}</label>',
                                    ]) ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row setup-content" id="step-3">
            <div class="col-xs-12">
                <div class="col-md-12">
                    <div class=" ">
                        <div class="box-header">

                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-md-4" for="status">Status</label>
                                <?php
                                if($model->statusIzin->status_by_hrd == 'Waiting'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_hrd',
                                                'label' => 'Status Oleh HRD'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-gray">Waiting</span> Oleh <label>HRD</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_hrd == 'Accepted'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_hrd',
                                                'label' => 'Status Oleh HRD'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-green">Accepted</span> Oleh <label>HRD</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_hrd == 'Rejected'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_hrd',
                                                'label' => 'Status Oleh HRD'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-red">Rejected</span> Oleh <label>HRD</label>',
                                    ]);
                                }
                                ?>
                                <label class="col-md-4" for="status"></label>
                                <?php
                                if($model->statusIzin->status_by_atasan == 'Waiting') {
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_atasan',
                                                'label' => 'Status Oleh Atasan'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-gray">Waiting</span> Oleh <label>Atasan</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_atasan == 'Accepted'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_atasan',
                                                'label' => 'Status Oleh Atasan'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-green">Accepted</span> Oleh <label>Atasan</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_atasan == 'Rejected'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_atasan',
                                                'label' => 'Status Oleh Atasan'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-red">Rejected</span> Oleh <label>Atasan</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_atasan == 'Canceled'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_atasan',
                                                'label' => 'Status Oleh Atasan'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-yellow">Canceled</span> Oleh <label>Atasan</label>',
                                    ]);
                                }
                                ?>
                                <label class="col-md-4" for="status"></label>
                                <?php
                                if($model->statusIzin->status_by_wr2 == 'Waiting') {
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_wr2',
                                                'label' => 'Status Oleh WR2'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-gray">Waiting</span> Oleh <label>WR 2</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_wr2 == 'Accepted'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_wr2',
                                                'label' => 'Status Oleh WR2'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-green">Accepted</span> Oleh <label>WR 2</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_wr2 == 'Rejected'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_wr2',
                                                'label' => 'Status Oleh WR2'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-red">Rejected</span> Oleh <label>WR 2</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_wr2 == 'Canceled'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_atasan',
                                                'label' => 'Status Oleh Atasan'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-yellow">Canceled</span> Oleh <label>WR 2</label>',
                                    ]);
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4" for="nama">Pemohon</label>
                                <?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        [
                                            'attribute' => 'pegawai_id',
                                            'value'     => $model->pegawai->nama,
                                        ],
                                    ],
                                    'template' => '<label class="input-group" id="nama">{value}</label>',
                                ]);
                                ?>
                                <div class="help-block help-block-error "></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4" for="jabatan">Jabatan</label>
                                <label class="input-group" id="nama">Dosen</label>
                                <div class="help-block help-block-error"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4" for="prodi">Prodi/Bagian</label>
                                <label class="input-group" id="Bagian">Teknik Informatika</label>
                                <div class="help-block help-block-error "></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4" for="Tanggal Masuk">Tanggal Masuk</label>
                                <div class="input-group col-sm-5">
                                    <label class="input-group" id="waktuizin">09/06/2013</label>
                                </div>
                                <div class="help-block help-block-error"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4" for="NIDN">NIDN/NIK</label>
                                <label class="input-group" id="NIDN">080989999</label>
                                <div class="help-block help-block-error"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4">Jenis Izin</label>
                                <div class="input-group col-sm-5">
                                    <?= DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'kategori_id',
                                                'value'     => $model->kategori->name,
                                            ],
                                        ],
                                        'template' => '<label class="input-group" id="jenisizin">{value}</label>',
                                    ])
                                    ?>
                                </div>
                                <div class="help-block help-block-error"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4">Waktu Izin</label>
                                <div class="input-group col-sm-5">
                                    <?= DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            'waktu_pelaksanaan',
                                        ],
                                        'template' => '<label class="input-group" id="waktucuti">{value}</label>',
                                    ])
                                    ?>
                                </div>
                                <div class="help-block help-block-error "></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4" for="lamaizin">Lama Izin (Hari)</label>
                                <?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        'lama_izin',
                                    ],
                                    'template' => '<label class="input-group" id="lamaizin">{value}</label>',
                                ])
                                ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4" for="alasanizin">Alasan Izin</label>
                                <form>
                                    <?= DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            'alasan_izin',
                                        ],
                                        'template' => '<label class="input-group" id="alasanizin">{value}</label>',
                                    ])
                                    ?>
                                </form>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4" for="pengalihantugas">Pengalihan Tugas</label>
                                <form>
                                    <?= DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            'pengalihan_tugas',
                                        ],
                                        'template' => '<label class="input-group" id="pengalihantugas">{value}</label>',
                                    ])
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row setup-content" id="step-4">
            <div class="col-xs-12">
                <div class="col-md-12">
                    <div class=" ">
                        <div class="box-header">

                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-md-4" for="status">Status</label>
                                <?php
                                if($model->statusIzin->status_by_hrd == 'Waiting'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_hrd',
                                                'label' => 'Status Oleh HRD'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-gray">Waiting</span> Oleh <label>HRD</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_hrd == 'Accepted'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_hrd',
                                                'label' => 'Status Oleh HRD'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-green">Accepted</span> Oleh <label>HRD</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_hrd == 'Rejected'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_hrd',
                                                'label' => 'Status Oleh HRD'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-red">Rejected</span> Oleh <label>HRD</label>',
                                    ]);
                                }
                                ?>
                                <label class="col-md-4" for="status"></label>
                                <?php
                                if($model->statusIzin->status_by_atasan == 'Waiting') {
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_atasan',
                                                'label' => 'Status Oleh Atasan'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-gray">Waiting</span> Oleh <label>Atasan</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_atasan == 'Accepted'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_atasan',
                                                'label' => 'Status Oleh Atasan'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-green">Accepted</span> Oleh <label>Atasan</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_atasan == 'Rejected'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_atasan',
                                                'label' => 'Status Oleh Atasan'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-red">Rejected</span> Oleh <label>Atasan</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_atasan == 'Canceled'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_atasan',
                                                'label' => 'Status Oleh Atasan'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-yellow">Canceled</span> Oleh <label>Atasan</label>',
                                    ]);
                                }
                                ?>
                                <label class="col-md-4" for="status"></label>
                                <?php
                                if($model->statusIzin->status_by_wr2 == 'Waiting') {
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_wr2',
                                                'label' => 'Status Oleh WR2'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-gray">Waiting</span> Oleh <label>WR 2</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_wr2 == 'Accepted'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_wr2',
                                                'label' => 'Status Oleh WR2'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-green">Accepted</span> Oleh <label>WR 2</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_wr2 == 'Rejected'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_wr2',
                                                'label' => 'Status Oleh WR2'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-red">Rejected</span> Oleh <label>WR 2</label>',
                                    ]);
                                }
                                else if($model->statusIzin->status_by_wr2 == 'Canceled'){
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'permohonan_izin_id',
                                                'value' => 'statusIzin.status_by_atasan',
                                                'label' => 'Status Oleh Atasan'
                                            ],
                                        ],
                                        'template' => '<span class="label bg-yellow">Canceled</span> Oleh <label>WR 2</label>',
                                    ]);
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4" for="nama">Pemohon</label>
                                <?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        [
                                            'attribute' => 'pegawai_id',
                                            'value'     => $model->pegawai->nama,
                                        ],
                                    ],
                                    'template' => '<label class="input-group" id="nama">{value}</label>',
                                ]);
                                ?>
                                <div class="help-block help-block-error "></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4" for="jabatan">Jabatan</label>
                                <label class="input-group" id="nama">Dosen</label>
                                <div class="help-block help-block-error"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4" for="prodi">Prodi/Bagian</label>
                                <label class="input-group" id="Bagian">Teknik Informatika</label>
                                <div class="help-block help-block-error "></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4" for="Tanggal Masuk">Tanggal Masuk</label>
                                <div class="input-group col-sm-5">
                                    <label class="input-group" id="waktuizin">09/06/2013</label>
                                </div>
                                <div class="help-block help-block-error"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4" for="NIDN">NIDN/NIK</label>
                                <label class="input-group" id="NIDN">080989999</label>
                                <div class="help-block help-block-error"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4">Jenis Izin</label>
                                <div class="input-group col-sm-5">
                                    <?= DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute' => 'kategori_id',
                                                'value'     => $model->kategori->name,
                                            ],
                                        ],
                                        'template' => '<label class="input-group" id="jenisizin">{value}</label>',
                                    ])
                                    ?>
                                </div>
                                <div class="help-block help-block-error"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4">Waktu Izin</label>
                                <div class="input-group col-sm-5">
                                    <?= DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            'waktu_pelaksanaan',
                                        ],
                                        'template' => '<label class="input-group" id="waktucuti">{value}</label>',
                                    ])
                                    ?>
                                </div>
                                <div class="help-block help-block-error "></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4" for="lamaizin">Lama Izin (Hari)</label>
                                <?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        'lama_izin',
                                    ],
                                    'template' => '<label class="input-group" id="lamaizin">{value}</label>',
                                ])
                                ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4" for="alasanizin">Alasan Izin</label>
                                <form>
                                    <?= DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            'alasan_izin',
                                        ],
                                        'template' => '<label class="input-group" id="alasanizin">{value}</label>',
                                    ])
                                    ?>
                                </form>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4" for="filesurat">Lampiran</label>
                                <form>
                                    <?= DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [[
                                            'attribute' => 'file_surat',
                                            'format' => 'html',
                                            'value' => isset($model->file_surat) && $model->file_surat!==''?LinkHelper::renderLink(['options'=>'target = _blank','label'=>$model->file_surat, 'url'=>\Yii::$app->fileManager->generateUri($model->kode_file_surat)]):'-',
                                        ]],
                                        'template' => '<label class="input-group" id="filesurat">{value}</label>',
                                    ])
                                    ?>
                                </form>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4" for="pengalihantugas">Pengalihan Tugas</label>
                                <form>
                                    <?= DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            'pengalihan_tugas',
                                        ],
                                        'template' => '<label class="input-group" id="pengalihantugas">{value}</label>',
                                    ])
                                    ?>
                                </form>
                            </div>
                            <!-- Lampiran -->
                            <?php
                            $kategori = $model->kategori_id;
                            if($kategori == 9) {
                                ?>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="pengalihantugas">Lampiran</label>
                                    <form>
                                        <?= Html::a('Download Lampiran', ['permohonan-izin/download', 'id' => $model->permohonan_izin_id], ['class' => 'btn btn-succes']) ?>
                                    </form>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
