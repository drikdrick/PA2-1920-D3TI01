<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\DimKamar */

$this->title = 'Tambah Penghuni';
$this->params['breadcrumbs'][] = ['label' => 'Asrama', 'url' => ['asrama/index']];
$this->params['breadcrumbs'][] = ['label' => 'Kamar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Penghuni Kamar', 'url' => ['/askm/kamar/view', 'id' => $_GET['id']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dim-kamar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
