<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\PosisiPaket */

$this->title = 'Update: ' . ' ' . $model->nama_posisi;
$this->params['breadcrumbs'][] = ['label' => 'Posisi Paket', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="posisi-paket-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
