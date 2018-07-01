<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\Ktm */

$this->title = 'Request Penggantian Kartu Tanda Mahasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Kartu Tanda Mahasiswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ktm-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formAdd', [
        'model' => $model,
    ]) ?>

</div>
