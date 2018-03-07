<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmIzinPenggunaanRuangan */

$this->title = 'Create Askm Izin Penggunaan Ruangan';
$this->params['breadcrumbs'][] = ['label' => 'Askm Izin Penggunaan Ruangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askm-izin-penggunaan-ruangan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
