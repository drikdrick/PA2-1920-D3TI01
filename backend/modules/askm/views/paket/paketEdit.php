<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\Paket */

$this->title = 'Update Paket: ' . ' ' . $model->tag;
$this->params['breadcrumbs'][] = ['label' => 'Paket', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tag, 'url' => ['paket-view', 'id' => $model->data_paket_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="paket-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
