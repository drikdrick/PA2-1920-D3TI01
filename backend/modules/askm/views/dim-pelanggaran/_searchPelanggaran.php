<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;

$uiHelper = \Yii::$app->uiHelper;

?>

<div class="dim-pelanggaran-search">

    <?php $form = ActiveForm::begin([
        'method'=>'get',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'horizontalCssClasses' => [
                'label' => 'col-md-2',
                'offset' => 'col-md-offset-10',
                'wrapper' => 'col-md-6',
                'error' => '',
                'hint' => '',
            ],
        ],
    ]); ?>

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'tanggal_awal')->widget(DatePicker::className(), [
                    'language' => 'en',
                    'size' => 'ms',
                    'inline' => false,
                    'clientOptions' => [
                        'pickerPosition' => 'bottom-left',
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd', // if inline = false
                    ]
                ]);?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'tanggal_akhir')->widget(DatePicker::className(), [
                    'language' => 'en',
                    'size' => 'ms',
                    'inline' => false,
                    'clientOptions' => [
                        'pickerPosition' => 'bottom-left',
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd', // if inline = false
                    ]
                ]);?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'asrama_id',[
                        'horizontalCssClasses' => ['wrapper' => 'col-sm-12',],
                    ])->dropDownList(ArrayHelper::map($dataAsrama, 'asrama_id', 'name'),
                        ['prompt'=>"Pilih Asrama"])
                        ->label('Asrama')
                ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-md-6 col-sm-6">
                    <?= Html::submitButton('Cari', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
                
    <?php ActiveForm::end(); ?>

</div>
