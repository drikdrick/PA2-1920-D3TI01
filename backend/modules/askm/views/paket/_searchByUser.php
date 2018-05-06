<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\base\BaseObject;
/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\search\PaketSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="paket-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index-by-user'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model,'tanggal_kedatangan')->widget(\yii\jui\DatePicker::className(),[
        'options' => ['class' => 'form-control',],
        'dateFormat'=>'yyyy-MM-dd'
    ]) ?>


    <div class="form-group">
        <?= Html::submitButton('Cari', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset',['/askm/paket/index-by-user'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
