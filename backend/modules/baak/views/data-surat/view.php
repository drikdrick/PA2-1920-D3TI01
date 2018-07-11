<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\DataSurat */
$this->title = 'Manajemen Data Surat';
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Data Surat'];
?>
<div class="data-surat-view">

    <br><p>
        <?= Html::a('Update', ['edit', 'id' => $model->data_surat_id], ['class' => 'btn btn-primary']) ?>    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama_institut',
            'alamat:ntext',
            'nomor_telepon',
            'nomor_fax',
            'email:email',
            'alamat_web',
        ],
    ]) ?>

</div>
