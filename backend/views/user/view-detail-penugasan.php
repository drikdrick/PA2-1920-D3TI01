<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\grid\GridView;
    use yii\data\ActiveDataProvider;
    use app\models\KrkmKuliah;
    use yii\widgets\Pjax;
    use yii\db\Query;
    use yii\helpers\Url;
    $this->params['header'] = '';
    $uiHelper=\Yii::$app->uiHelper;
?>

<?= $uiHelper->renderContentSubHeader('Detail Pengajar', ['icon' => 'fa fa-list']);?>

<html>
    <div class="page-line"></div>		
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Prodi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>                          
            </tbody>
        </table>