<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmIzinBermalam */

$this->title = 'Request Izin Bermalam';
$this->params['breadcrumbs'][] = ['label' => 'Askm Izin Bermalams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askm-izin-bermalam-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
