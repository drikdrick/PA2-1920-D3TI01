<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\askm\models\Asrama;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\Kamar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kamar-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">

    <?= $form->field($model, 'nomor_kamar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'asrama_id')->dropDownList(ArrayHelper::map(Asrama::find()->all(), 'asrama_id', 'name'), ['prompt'=>'Pilih'])?>

		</div>
	</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Buat Baru' : 'Selesai Edit', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

        <?= Html::a('Batal', ['view', 'id' => $_GET['id']], ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
