<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\KeasramaanPegawai */

$this->title = 'Tambah Pengurus';
$this->params['breadcrumbs'][] = ['label' => 'Asrama', 'url' => ['asrama/view', 'id' => $_GET['id_asrama']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="keasramaan-pegawai-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
