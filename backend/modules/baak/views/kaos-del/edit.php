<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\KaosDel */

$this->title = 'Update Stok Kaos Del';
$this->params['breadcrumbs'][] = ['label' => 'Kaos Del', 'url' => ['index-admin']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kaos-del-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formEdit', [
        'model' => $model,
    ]) ?>

</div>
