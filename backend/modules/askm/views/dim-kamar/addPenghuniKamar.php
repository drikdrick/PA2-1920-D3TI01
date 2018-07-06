<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\DimKamar */

$this->title = 'Tambah Penghuni';
$this->params['breadcrumbs'][] = ['label' => 'Asrama', 'url' => ['asrama/index']];
$this->params['breadcrumbs'][] = ['label' => 'Asrama '.$asrama->name, 'url' => ['asrama/view-detail-asrama', 'id' => $asrama->asrama_id]];
$this->params['breadcrumbs'][] = ['label' => 'Daftar Kamar', 'url' => ['kamar/index', 'KamarSearch[asrama_id]' => $asrama->asrama_id, 'id_asrama' => $asrama->asrama_id]];
$this->params['breadcrumbs'][] = ['label' => $kamar->nomor_kamar.' - '. $asrama->name, 'url' => ['/askm/kamar/view', 'id' => $_GET['id']]];
$this->params['breadcrumbs'][] = $this->title;
$uiHelper=\Yii::$app->uiHelper;
?>
<div class="dim-kamar-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $uiHelper->renderLine(); ?>

    <h3>Jumlah penghuni kamar <b style="color: red;"><?= $kamar->nomor_kamar ?></b> saat ini : <b style="color: red; font-size: 22px"><?= $count ?></b> orang</h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
