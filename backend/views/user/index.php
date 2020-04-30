<?php
/* @var $this yii\web\View */
    use yii\helpers\Html;
?>
<html>
    <head>
        <title>RPP IT DEL</title>
        <style>
            td{
                height:80px;
            }
            button{
                height: 50px;
                font-size: 30px;
                font-style: bold;
            }
            .custom-btn{
                font-size: 20px;
            }
        </style>
    </head>
    <body>
        <h1>Rancangan Penugasan dosen</h1>
        <table class="col-xs-8">
            <tr>
                <td>
                    <?= Html::a('Semester1',['user/semester'],['class'=>['col-xs-5','btn btn-success','custom-btn']])?>
                    <div class="col-xs-2"></div>
                    <?= Html::a('Semester2',['/user/semester'],['class'=>['col-xs-5','btn btn-success','custom-btn']])?>
                </td>
            </tr>
            <tr>
                <td>
                    <?= Html::a('Semester3',['/user/semester'],['class'=>['col-xs-5','btn btn-warning','custom-btn']])?>
                    <div class="col-xs-2"></div>
                    <?= Html::a('Semester4',['/user/semester'],['class'=>['col-xs-5','btn btn-warning','custom-btn']])?>
                </td>
            </tr>
            <tr>
                <td>
                    <?= Html::a('Semester5',['/user/semester'],['class'=>['col-xs-5','btn btn-danger','custom-btn']])?>
                    <div class="col-xs-2"></div>
                    <?= Html::a('Semester6',['/user/semester'],['class'=>['col-xs-5','btn btn-danger','custom-btn']])?>
                </td>
            </tr>
            <tr>
                <td>
                    <?= Html::a('Semester7',['/user/semester'],['class'=>['col-xs-5','btn btn-primary','custom-btn']])?>
                    <div class="col-xs-2"></div>
                    <?= Html::a('Semester8',['/user/semester'],['class'=>['col-xs-5','btn btn-primary','custom-btn']])?>
                </td>
            </tr>
        </table>
    </body>
</html>

