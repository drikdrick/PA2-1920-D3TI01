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

CistAsset::register($this);
$uiHelper = \Yii::$app->uiHelper;

/* @var $this yii\web\View */
/* @var $model backend\modules\cist\models\PermohonanIzin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-izin-form">

    <div class="row">
        <div class="col-md-12">
            <!--STEP HERE!!!!!-->
            <div class="border-box">
                <div class="stepwizard col-md-6">
                    <div class="stepwizard-row setup-panel">
                        <div class="stepwizard-step col-md-4">
                            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                            <p>Ajukan Izin</p>
                        </div>
                        <div class="stepwizard-step col-md-4">
                            <a href="#step-2" type="button" class="btn btn-default btn-circle disabled">2</a>
                            <p>Atasan</p>
                        </div>
                        <div class="stepwizard-step col-md-4">
                            <a href="#step-3" type="button" class="btn btn-default btn-circle disabled">3</a>
                            <p>WR 2</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'options' => ['enctype' => 'multipart/form-data'],
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}\n{hint}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-2',
                    'wrapper' => 'col-sm-8',
                    'error' => '',
                    'hint' => '',
                ],
            ],
        ]);
    ?>

    <?php // echo $form->field($model, 'kategori_id')->dropDownList(ArrayHelper::map(KategoriIzin::find()->where('deleted!=1')->all(),'kategori_izin_id', 'name'), ['prompt' => '- Pilih Kategori -',]); ?>

    <div class="row">
        <div class="col-sm-2" style="text-align:right;">
            <label>Tanggal Izin</label>
        </div>
        <div class="col-sm-10">
            <div id="mdp-demo"></div>
        </div>
    </div>
    <?= $form->field($model, 'waktu_pelaksanaan')->hiddenInput(['id' => 'altField'])->label('')?>
    <?= $form->field($model, 'lama_izin')->hiddenInput(['id' => 'numberSelected'])->label('') ?>

    <?= $form->field($model, 'alasan_izin')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'file_surat',[
               'horizontalCssClasses' => ['wrapper' => 'col-sm-4',]
        ])->fileInput()->hint('* Bukti surat sakit atau file lain yang dianggap perlu') ?>

    <?= $form->field($model, 'pengalihan_tugas')->textarea(['rows' => 6]) ?>

    <?php $arrayAtasan = ArrayHelper::map($namaAtasan, 'pegawai_id', 'nama');?>

    <?= $form->field($model, 'atasan_id')->checkboxList($arrayAtasan) ?>

    <br>
    <div class="form-group" style="text-align:center;">
        <?= Html::submitButton($model->isNewRecord ? 'Submit' : 'Edit', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
