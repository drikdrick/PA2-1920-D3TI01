<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmIzinKeluar */

$this->title = 'Create Askm Izin Keluar';
$this->params['breadcrumbs'][] = ['label' => 'Askm Izin Keluars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askm-izin-keluar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
