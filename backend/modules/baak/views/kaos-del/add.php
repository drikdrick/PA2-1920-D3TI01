<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\KaosDel */

$this->title = 'Tambah Ukuran Kaos Del';
$this->params['breadcrumbs'][] = ['label' => 'Kaos Del', 'url' => ['index-admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kaos-del-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formAdd', [
        'model' => $model,
    ]) ?>

</div>
