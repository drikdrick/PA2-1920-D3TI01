<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\PosisiPaket */

$this->title = 'Posisi Paket Add';
$this->params['breadcrumbs'][] = ['label' => 'Posisi Paket', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posisi-paket-create">
    <div class="col-sm-2">
    </div>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
