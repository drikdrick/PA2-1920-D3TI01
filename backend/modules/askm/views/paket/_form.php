<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\askm\models\PosisiPaket;
use backend\modules\askm\models\StatusPaket;

use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\Paket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="paket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tag')->textInput() ?>

    <?= $form->field($model, 'pengirim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_kedatangan')->textInput() ?>

    <?= $form->field($model, 'diambil_oleh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_diambil')->textInput() ?>

    <?php 
            $posisiPaket=PosisiPaket::find()->all();
            
            $listData=ArrayHelper::map($posisiPaket,'posisi_id','nama_posisi');
            
            echo $form->field($model, 'posisi')->dropDownList($listData);
        ?>
    <?php 
            $statusPaket=StatusPaket::find()->all();
            
            $listData=ArrayHelper::map($statusPaket,'status_id','status');
            
            echo $form->field($model, 'status')->dropDownList($listData);
        ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6])->label('Deskripsi') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
