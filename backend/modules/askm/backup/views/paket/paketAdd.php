<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\Paket */

$this->title = 'Tambah Paket';
$this->params['breadcrumbs'][] = ['label' => 'Pakets', 'url' => ['index-by-admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paket-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
