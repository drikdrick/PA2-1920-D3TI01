<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\KaosDel */

$this->params['breadcrumbs'][] = ['label' => 'Stok Kaos Del', 'url' => ['index-admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kaos-del-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['edit', 'id' => $model->kaos_del_id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ukuran',
            'stok',
        ],
    ]) ?>

</div>
