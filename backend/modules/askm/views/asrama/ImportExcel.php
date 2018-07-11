<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\admd\models\Dis */

$this->title = 'Import Excel';
$this->params['breadcrumbs'][] = ['label' => 'Asrama', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['header'] = $this->title;
?>
        <div class="row">

      <?php $form = ActiveForm::begin([
              'layout' => 'horizontal',
              'options' => ['enctype' => 'multipart/form-data'],
              'fieldConfig' => [
                  'template' => "{label}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}\n{hint}",
                  'horizontalCssClasses' => [
                      'label' => 'col-sm-2',
                      'wrapper' => 'col-sm-9',
                      'error' => '',
                      'hint' => '',
                  ],
              ],
      ]) ?>

        <?= $form->field($modelImport,'fileImport')->fileInput() ?>

        <div class="form-group">
            <div class="col-md-1 col-md-offset-2">
            <?= Html::submitButton('Import', ['class' => 'btn btn-success']) ?>
        </div></div>

      <?php ActiveForm::end(); ?>

</div>