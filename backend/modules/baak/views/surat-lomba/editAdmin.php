<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratLomba */

$this->title = 'Konfimasi Surat Kompetisi';
$this->params['breadcrumbs'][] = ['label' => 'Surat Kompetisi', 'url' => ['index-admin']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="surat-lomba-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formEditAdmin', [
        'model' => $model,
    ]) ?>

</div>