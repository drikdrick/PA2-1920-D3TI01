<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\kaos-del */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kaos-del-form">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kode_ukuran',
            'ukuran',
        ],
    ]) ?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'stok',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->textInput(['type'=>'number','rows' => 3]) ?>

    <div class="form-group">
      <div class="col-md-1 col-md-offset-2">
        <?= Html::submitButton($model->isNewRecord ? 'Update' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div></div>

    <?php ActiveForm::end(); ?>

</div>
