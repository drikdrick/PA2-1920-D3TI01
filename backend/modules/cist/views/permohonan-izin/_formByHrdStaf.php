<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\InputWidget;
use yii\base\Widget;
use yii\base\Component;
use yii\base\BaseObject;
use yii\base\Configurable;
use yii\base\ViewContextInterface;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use backend\modules\cist\models\KategoriIzin;
use backend\modules\cist\models\WaktuRequestIzin;
use common\widgets\Typeahead;
use yii\helpers\Url;
use backend\modules\cist\assets\CistAsset;
use yii\widgets\DetailView;
use \yii\web\JsExpression;

CistAsset::register($this);
$uiHelper = \Yii::$app->uiHelper;

/* @var $this yii\web\View */
/* @var $model backend\modules\cist\models\PermohonanIzin */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="permohonan-izin-form">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!--STEP HERE!!!!!-->
                <div class="border-box">
                    <div class="stepwizard col-md-6">
                        <div class="stepwizard-row setup-panel">
                            <div class="stepwizard-step col-md-3">
                                <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                <p>Ajukan Izin</p>
                            </div>
                            <div class="stepwizard-step col-md-3">
                                <a href="#step-2" type="button" class="btn btn-default btn-circle">2</a>
                                <p>HRD</p>
                            </div>
                            <div class="stepwizard-step col-md-3">
                                <a href="#step-3" type="button" class="btn btn-default btn-circle">3</a>
                                <p>Supervisor</p>
                            </div>
                            <div class="stepwizard-step col-md-3">
                                <a href="#step-4" type="button" class="btn btn-default btn-circle">4</a>
                                <p>WR 2</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!--END ROW-->

        <!--FORM START HERE!!!!!-->
        <?php
        $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}\n{hint}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-2',
                    'wrapper' => 'col-sm-8',
                    'error' => '',
                    'hint' => '',
                ],
            ],
        ]) ?>
        <div class="row setup-content" id="step-1">
            <div class="col-xs-12">
                <div class="col-md-12">
                    <div class="">
                        <div class="box-header">

                        </div>
                        <div class="box-body">
                            <!--NAMA PEGAWAI-->
                            <div class="form-group">
                                <label class="control-label col-sm-3">Pegawai</label>
                                <div class="input-group col-sm-8">
                                    <?= Typeahead::widget([
                                        'model' => $model,
                                        'attribute' => 'pegawai_id',
                                        'template' => "<p style='padding:4px'>{{data}}</p>",
                                        'htmlOptions' => [
                                            'class' => 'form-control',
                                            'placeholder' => 'Nama Pegawai',
                                            'style' => 'width: 515px; margin-left: 55px',
                                            'required' => true,
                                            'id' => 'atas',
                                        ],

                                        'options' => [
                                            'hint' => false,
                                            'highlight' => true,
                                            'minLength' => 1,
                                        ],
                                        'sourceApiBaseUrl' => Url::toRoute(['/cist/permohonan-izin/pegawai']),
                                        'sourceName' => 'nama',
                                    ]) ?>
                                </div>
                            </div>

                            <!--KATEGORI IZIN-->
                            <div class="form-group">
                                <label class="control-label col-sm-3">Jenis Izin</label>
                                <div class="input-group col-sm-8">
                                    <?= $form->field($model, 'kategori_id',[
                                        'horizontalCssClasses' => [
                                            'wrapper' => 'col-sm-6',
                                            'label' => 'col-sm-1',
                                        ]
                                    ])->dropDownList(
                                        ArrayHelper::map(KategoriIzin::find()->where('deleted!=1')->all(),'kategori_izin_id', 'name'),
                                        [
                                            'prompt' => '- Pilih Kategori -',
                                        ])->label('')?>

                                </div>
                                <div class="help-block help-block-error "></div>
                            </div>

                            <!--DATE RANGE-->
                            <div class="form-group">
                                <label class="control-label col-sm-3">Waktu Izin</label>
                                <div class="input-group col-sm-8">
                                    <div id="mdp-demo" style="margin-left: 55px"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3"></label>
                                <div class="input-group col-sm-8">
                                    <?= $form->field($model, 'waktu_pelaksanaan',[
                                        'horizontalCssClasses' => [
                                            'wrapper' => 'col-sm-10',
                                            'label' => 'col-sm-1',
                                        ]
                                    ])->textInput([
                                        'id' => 'altField',
                                    ])->label('')?>

                                </div>
                                <div class="help-block help-block-error "></div>
                            </div>

                            <!--LAMA IZIN-->
                            <div class="form-group">
                                <label class="control-label col-sm-3">Lama Izin (Hari)</label>
                                <div class="input-group col-sm-8">
                                    <?= $form->field($model, 'lama_izin',[
                                        'horizontalCssClasses' => [
                                            'wrapper' => 'col-sm-10',
                                            'label' => 'col-sm-1',
                                        ]
                                    ])->textInput([
                                        'id' => 'numberSelected',
                                    ])->label('')?>

                                </div>
                                <div class="help-block help-block-error "></div>
                            </div>

                            <!--ALASAN IZIN-->
                            <div class="form-group">
                                <label class="control-label col-sm-3">Alasan Izin</label>
                                <div class="input-group col-sm-8">
                                    <?= $form->field($model, 'alasan_izin',[
                                        'horizontalCssClasses' => [
                                            'wrapper' => 'col-sm-10',
                                            'label' => 'col-sm-1',
                                        ]
                                    ])->textarea([
                                        'maxlength' => true,
                                        'rows' => '6',
                                        'placeholder' => 'Isi alasan di sini',
                                    ])->label('')?>

                                </div>
                                <div class="help-block help-block-error "></div>
                            </div>

                            <!--PENGALIHAN TUGAS-->
                            <div class="form-group">
                                <label class="control-label col-sm-3">Pengalihan Tugas</label>
                                <div class="input-group col-sm-8">
                                    <?= $form->field($model, 'pengalihan_tugas',[
                                        'horizontalCssClasses' => [
                                            'wrapper' => 'col-sm-10',
                                            'label' => 'col-sm-1',
                                        ]
                                    ])->textarea([
                                        'maxlength' => true,
                                        'rows' => '6',
                                        'placeholder' => 'Isi pengalihan tugas di sini',
                                    ])->label('')?>

                                </div>
                                <div class="help-block help-block-error "></div>
                            </div>

                            <!--ATASAN-->
                            <div class="form-group">
                                <label class="control-label col-sm-3">Atasan</label>
                                <div class="input-group col-sm-8">
                                    <?= $form->field($model, 'atasan',[
                                        'horizontalCssClasses' => [
                                            'wrapper' => 'col-sm-10',
                                            'label' => 'col-sm-1',
                                        ]
                                    ])->checkboxList([])->label('')?>

                                </div>
                                <div class="help-block help-block-error "></div>
                            </div>

                            <!--BUTTON SUBMIT-->
                            <div class="form-group">
                                <label class="control-label col-md-4"> </label>
                                <?= Html::submitButton($model->isNewRecord ? 'Submit' : 'Update', ['class' => $model->isNewRecord ? 'input-group col-sm-1 btn btn-primary nextBtn' : 'btn btn-primary']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </section>
</div>

<?php
$this->registerJs('
    $("#atas").on("typeahead:selected",  function(evt, item){
        $.get("'.Url::toRoute('permohonan-izin/atasan').'", { id_pegawai: item.value})
            .done(function (data){
            $("#permohonanizin-atasan").html(data);
        })
    })'
);
?>
