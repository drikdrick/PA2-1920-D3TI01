<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\widgets\Typeahead;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\DimKamar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dim-kamar-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'kamar_id')->hiddenInput(['value' => $_GET['id']])->label(false) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'dim_id')->widget(Typeahead::classname(),[
                'attribute' => 'dim_id',
               'withSubmitButton' => false,
               
               'template' => "<p style='padding:4px'>{{data}}</p>",
               'htmlOptions' => ['class' => 'typeahead', 'placeholder' => 'NIM atau Nama','required'=>true],
               'options' => [
                    'hint' => false,
                    'highlight' => true,
                    'minLength' => 1
               ], 
               'sourceApiBaseUrl' => Url::toRoute(['/askm/dim-kamar/list-mahasiswa']),
               
                
            ])->label(false) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Buat Baru' : 'Selesai Edit', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

        <!-- <?= Html::a('Batal', ['index'], ['class' => 'btn btn-danger']) ?> -->
    </div>

    <?php ActiveForm::end(); ?>

</div>