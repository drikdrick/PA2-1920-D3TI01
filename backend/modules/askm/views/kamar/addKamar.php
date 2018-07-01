<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\Kamar */

$this->title = 'Tambah Kamar';
$this->params['breadcrumbs'][] = ['label' => 'Kamar', 'url' => ['view', 'id' => $_GET['id']]];
$this->params['breadcrumbs'][] = $this->title;
$uiHelper=\Yii::$app->uiHelper;
?>
<div class="kamar-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $uiHelper->renderLine(); ?>

    <?= $this->render('_formEditKamar', [
        'model' => $model,
    ]) ?>

</div>
