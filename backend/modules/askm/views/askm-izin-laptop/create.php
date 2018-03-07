<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmIzinLaptop */

$this->title = 'Create Askm Izin Laptop';
$this->params['breadcrumbs'][] = ['label' => 'Askm Izin Laptops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askm-izin-laptop-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
