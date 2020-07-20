<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\grid\GridView;
    use yii\data\ActiveDataProvider;
    use app\models\KrkmKuliah;
    use yii\widgets\Pjax;
    use yii\db\Query;
    //use yii\console\widgets\Table;
    //$table = new Table();
    $this->params['header'] = 'Penugasan Pengajaran';
    $uiHelper=\Yii::$app->uiHelper;
?>
<html>
    <head>
        <title>Pengajuan RPP</title>
        <style>
            th{
                height: 40px;
                text-align: center;
                color: #3c8dbc;
                padding: 5px;
            }
            td{
                padding: 10px;
                text-align: center;
            }
            table{
                border: 1px solid #d2d6de;
            }
            select{
                border: 1px solid #d2d6de;
            }
        </style>
    </head>
    <body>
            <?php $form = ActiveForm::begin();?>
                <?= $uiHelper->renderContentSubHeader('Cari Penugasan', ['icon' => 'fa fa-search']);?>
                <?=$uiHelper->renderLine(); ?>
                <div style="margin:20px">
                    <h3>Tahun Ajaran</h3>
                    <?= Html::dropDownList('selectedProdi','',$list_prodi,['class'=>'form-control','prompt' => 'Select...'])?>
                </div>
                <div style="margin:20px">
                    <h3>Prodi dan Jenjang</h3>
                    <?= Html::dropDownList('selectedProdi','',$list_prodi,['class'=>'form-control','prompt' => 'Select...'])?>
                </div>
                <div style="margin:20px">
                    <h3>Tahun Ajaran</h3>
                    <?= Html::dropDownList('selectedProdi','',$list_prodi,['class'=>'form-control','prompt' => 'Select...'])?>
                </div>
                <div style="margin:20px">
                    <?= Html::submitButton('Cari',['class'=>['btn btn-primary','custom-btn']]);?>
                </div>
            <?php $form = ActiveForm::end(); ?>
    </body>
</html>