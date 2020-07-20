<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\grid\GridView;
    use yii\data\ActiveDataProvider;
    use app\models\KrkmKuliah;
    use yii\widgets\Pjax;
    use yii\db\Query;
    use yii\helpers\Url;
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
                    <label>Tahun Ajaran</label>
                    <?= Html::dropDownList('selectedTA','',$list_ta,['class'=>'form-control','prompt' => 'Select...'])?>
                </div>
                <div style="margin:20px">
                    <label>Prodi dan Jenjang</label>
                    <?= Html::dropDownList('selectedProdi','',$list_prodi,['class'=>'form-control','prompt' => 'Select...'])?>
                </div>
                <div style="margin:20px">
                    <label>Semester</label>
                    <?= Html::dropDownList('selectedSemester','',$semester,['class'=>'form-control','prompt' => 'Select...'])?>
                </div>
                <div style="margin:20px">
                    <?= Html::submitButton('Cari',['class'=>['btn btn-primary']]);?>
                </div>
            <?php $form = ActiveForm::end(); ?>

            <?php
            // print_r($krkm);
            if(!empty($krkm)){
                echo $uiHelper->renderContentSubHeader('Data Penugasan', ['icon' => 'fa fa-list']);
                $uiHelper->renderLine(); 
            
            ?>
            <div class="content-sub-header">			
		</div>
		
                <div class="page-line"></div>		
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>SKS</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($krkm as $krkms){
                        
                        ?>
                            <tr><td><?=$krkms->kode_mk?></td>
                            <td><?=Html::a($krkms->nama_kul_ind, Url::to(['user/detail-penugasan','id'=>$krkms->kuliah_id]))?></td>
                            <td><?=$krkms->sks?></td>
                            </tr>
                        <?php
                        }
                        ?>                            
                            </tbody>
                    </table>
                    <?php
            }
            ?>

    </body>
</html>