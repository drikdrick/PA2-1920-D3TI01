<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\Supir */

$this->title = 'Tambah Supir';
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Supir', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supir-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
