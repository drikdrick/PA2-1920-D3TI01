<?php
/* @var $this yii\web\View */
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use backend\modules\xdev\assets\XdevAsset;
use common\widgets\Redactor;
use common\widgets\Typeahead;
use common\components\SingleSwitchButton;
use dosamigos\datetimepicker\DateTimePicker;

$this->title = "Systemx-core Dynamic Components";
$this->params['breadcrumbs'][] = 'Dynamic Components';
$this->params['header'] = 'Systemx-core Dynamic Components';

$uiHelper = \Yii::$app->uiHelper;
XdevAsset::register($this);

?>

<?=\Yii::$app->uiHelper->renderContentSubHeader('Flash Messages')?>
<?= $uiHelper->renderLine(); ?>
<?= $uiHelper->beginContentRow() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'basic-grid',
                                      'width' => 12,
    ]) ?>
    <pre><code class='php'>
    //tambahkan flash messages di controller.. 
    \Yii::$app->messenger->addInfoFlash("message flash dibuat!!");

    \Yii::$app->messenger->addSuccessFlash("message flash berhasil dibuat!!");
    \Yii::$app->messenger->addSuccessFlash("message flash berhasil dibuat lagi !!");
    
    \Yii::$app->messenger->addWarningFlash("apakah message flash berhasil dibuat ??");
    
    \Yii::$app->messenger->addErrorFlash("message flash berhasil tidak dibuat !!");
    </code></pre>
    Akan otomatis menampilkan flash message seperti yang ada di awal page ini.
    <?= $uiHelper->endContentBlock() ?>
<?= $uiHelper->endContentRow() ?>

<?=$uiHelper->beginSingleRowBlock(['id' => 'switch-notif', 'header' => 'Single switch button and notif']) ?>
<?=SingleSwitchButton::render($this, ['id' => 'tests', 'data-id' => 1]) ?>
<?=$uiHelper->endSingleRowBlock() ?>

<?=\Yii::$app->uiHelper->renderContentSubHeader('Popover Tooltip')?>
<?= $uiHelper->renderLine(); ?>
<?= $uiHelper->beginContentRow() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'basic-grid',
                                          'width' => 12,
        ]) ?>
        Menampilkan tooltip <?=$uiHelper->renderTooltip("Digunakan untuk memberikan panduan atau help text") ?> <br/>
        Memiliki options <?=$uiHelper->renderTooltip("Yang ini ada Title nya", ['title' => 'Tips']) ?> <br/>
        Memiliki options <?=$uiHelper->renderTooltip("Bisa juga diatur posisinya", ['title' => 'Top', 'position' => 'top']) ?> <br/>
        Contoh penggunaan untuk form: <br/>
        <?php
        $form = ActiveForm::begin([
            'id' => 'application-form',
            'options' => ['class' => 'form-horizontal'],
        ]) ?>
            <div class="form-group">
            <label class="control-label col-sm-3" for="menugroup-desc">Identifier</label>
            <div class="input-group col-sm-4">
                <?=Html::activeInput('text', $model, 'identifier', ['class'=> 'form-control', 'maxlength'=>'50'])?>
                <div class="input-group-tooltip">
                    <?=$uiHelper->renderTooltip("Identifier merupakan ID application yang bersifat unique") ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end() ?>
    <?= $uiHelper->endContentBlock() ?>
<?= $uiHelper->endContentRow() ?>

<?= $uiHelper->beginContentRow() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'basic-grid',
                                      'width' => 12,
    ]) ?>
    <pre><code class='php'>
Menampilkan tooltip &lt;?=$uiHelper->renderTooltip("Digunakan untuk memberikan panduan atau help text") ?> &lt;br/>
Memiliki options &lt;?=$uiHelper->renderTooltip("Yang ini ada Title nya", ['title' => 'Tips']) ?> &lt;br/>
Memiliki options &lt;?=$uiHelper->renderTooltip("Bisa juga diatur posisinya", ['title' => 'Top', 'position' => 'top']) ?> &lt;br/>
Contoh penggunaan untuk form: &lt;br/>
&lt;?php
$form = ActiveForm::begin([
    'id' => 'application-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>
    &lt;div class="form-group">
    &lt;label class="control-label col-sm-3" for="menugroup-desc">Identifier&lt;/label>
    &lt;div class="input-group col-sm-4">
        &lt;?=Html::activeInput('text', $model, 'identifier', ['class'=> 'form-control', 'maxlength'=>'50'])?>
        &lt;div class="input-group-tooltip">
            &lt;?=$uiHelper->renderTooltip("Identifier merupakan ID application yang bersifat unique") ?>
        &lt;/div>
    &lt;/div>
&lt;/div>
&lt;?php ActiveForm::end() ?>
    </code></pre>
    <?= $uiHelper->endContentBlock() ?>
<?= $uiHelper->endContentRow() ?>


<?=\Yii::$app->uiHelper->renderContentSubHeader('Tabs')?>
<?= $uiHelper->renderLine(); ?>
<?= $uiHelper->beginContentRow() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'basic-grid',
                                      'width' => 12,
    ]) ?>

    <?= $uiHelper->beginTab([
        'header' => 'Assign Privileges',
        'icon' => 'fa fa-shield',
        'tabs' => [
            ['id' => 'tab_1', 'label' => 'Application Components', 'isActive' => true],
            ['id' => 'tab_2', 'label' => 'Menu Items', 'isActive' => false],
            ['id' => 'tab_3', 'label' => 'Task', 'isActive' => false],
        ]
    ]) ?>
        <?= $uiHelper->beginTabContent(['id'=>'tab_1', 'isActive' => true]) ?>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        <?= $uiHelper->endTabContent() ?>
        
        <?= $uiHelper->beginTabContent(['id'=>'tab_2', 'isActive' => false]) ?>
            <table class="table">
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>type</td>
                    <td>Image/Jpg</td>
                </tr>
                <tr>
                    <td>Size</td>
                    <td>250Kb</td>
                </tr>
                <tr>
                    <td>Title</td>
                    <td>Penandatanganan MOU</td>
                </tr>
                <tr>
                    <td>Url</td>
                    <td>http://www.del.ac.id/wp-content/uploads/2015/03/DSC_0826.jpg</td>
                </tr>
            </tbody>
        </table>

        <?= $uiHelper->endTabContent() ?>

        <?= $uiHelper->beginTabContent(['id'=>'tab_3', 'isActive' => false]) ?>

            isi tab 3 disini.. 

        <?= $uiHelper->endTabContent() ?>

    <?= $uiHelper->endTab() ?>

    <?= $uiHelper->endContentBlock() ?>
<?= $uiHelper->endContentRow() ?>

<?= $uiHelper->beginContentRow() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'basic-grid',
                                      'width' => 12,
    ]) ?>
    <pre><code class='php'>
&lt;?= $uiHelper->beginTab([
        'header' => 'Assign Privileges',
        'icon' => 'fa fa-shield',
        'tabs' => [
            ['id' => 'tab_1', 'label' => 'Application Components', 'isActive' => true],
            ['id' => 'tab_2', 'label' => 'Menu Items', 'isActive' => false],
            ['id' => 'tab_3', 'label' => 'Task', 'isActive' => false],
        ]
    ]) ?>
    &lt;?= $uiHelper->beginTabContent(['id'=>'tab_1', 'isActive' => true]) ?>

        Lorem ipsum ...

    &lt;?= $uiHelper->endTabContent() ?>
    
    &lt;?= $uiHelper->beginTabContent(['id'=>'tab_2', 'isActive' => false]) ?>
        &lt;table class="table">
        &lt;thead>
            &lt;tr>
                &lt;th>Key&lt;/th>
                &lt;th>Value&lt;/th>
            &lt;/tr>
        &lt;/thead>
        &lt;tbody>
            &lt;tr>
                &lt;td>type&lt;/td>
                &lt;td>Image/Jpg&lt;/td>
            &lt;/tr>
            &lt;tr>
                &lt;td>Size&lt;/td>
                &lt;td>250Kb&lt;/td>
            &lt;/tr>
            &lt;tr>
                &lt;td>Title&lt;/td>
                &lt;td>Penandatanganan MOU&lt;/td>
            &lt;/tr>
            &lt;tr>
                &lt;td>Url&lt;/td>
                &lt;td>http://www.del.ac.id/wp-content/uploads/2015/03/DSC_0826.jpg&lt;/td>
            &lt;/tr>
        &lt;/tbody>
    &lt;/table>

    &lt;?= $uiHelper->endTabContent() ?>

    &lt;?= $uiHelper->beginTabContent(['id'=>'tab_3', 'isActive' => false]) ?>
    
        isi tab 3 disini.. 

    &lt;?= $uiHelper->endTabContent() ?>

&lt;?= $uiHelper->endTab() ?>
    </code></pre>

    <?= $uiHelper->endContentBlock() ?>
<?= $uiHelper->endContentRow() ?>

<?=\Yii::$app->uiHelper->renderContentSubHeader('Button Set')?>
<?= $uiHelper->renderLine(); ?>
<?=$uiHelper->beginSingleRowBlock(['id' => 'buttonset']) ?>
Digunakan untuk menampilkan menu dropdown untuk setiap record yang ditampilkan menggunakan DetailView.<br>
Bisa juga digunakan untuk keperluan yang lain.
<?=$uiHelper->endSingleRowBlock() ?>
<?=$uiHelper->beginSingleRowBlock(['id' => 'buttonset']) ?>
<?php
    $model = $sampleData[0]; 
?>
<div class="pull-right">
    <?=$uiHelper->renderButtonSet([
        'template' => ['edit', 'del', 'member'],
        'buttons' => [
            'edit' => ['url' => '#', 'label' => 'Edit', 'icon' => 'fa fa-pencil'],
            'del' => ['url' => '#', 'label' => 'Delete', 'icon' => 'fa fa-trash'],
            'member' => ['url' => '#', 'label' => 'Manage Member', 'icon' => 'fa fa-users']
        ]
    ]) ?>
</div>

<?= DetailView::widget([
    'model' => $model,
    'options' =>[
            'class' => 'table table-condensed detail-view'
        ],
    'attributes' => [
            'name',
            'desc',
        ]
    ]) ?>

<?=$uiHelper->endSingleRowBlock() ?>

<?= $uiHelper->beginContentRow() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'basic-grid',
                                      'width' => 12,
    ]) ?>
    <pre><code class='php'>
&lt;div class="pull-right">
    &lt;?=$uiHelper->renderButtonSet([
        'template' => ['edit', 'del', 'member'],
        'buttons' => [
            'edit' => ['url' => '#', 'label' => 'Edit', 'icon' => 'fa fa-pencil'],
            'del' => ['url' => '#', 'label' => 'Delete', 'icon' => 'fa fa-trash'],
            'member' => ['url' => '#', 'label' => 'Manage Member', 'icon' => 'fa fa-users']
        ]
    ]) ?>
&lt;/div>

&lt;?= DetailView::widget([
    'model' => $model,
    'options' =>[
            'class' => 'table table-condensed detail-view'
        ],
    'attributes' => [
            'name',
            'desc',
        ]
]) ?>
    </code></pre>

    <?= $uiHelper->endContentBlock() ?>
<?= $uiHelper->endContentRow() ?>


<?=\Yii::$app->uiHelper->renderContentSubHeader('Imperavi Redactor WYSIWYG  Editor')?>
<?= $uiHelper->renderLine(); ?>
<?=$uiHelper->beginSingleRowBlock(['id' => 'redactor']) ?>
Digunakan untuk menampilkan editor wysiwyg. <code><b>Untuk saat ini, fitur untuk menambahkan image belum di buat.</b> </code>
<?=$uiHelper->endSingleRowBlock() ?>
<?=$uiHelper->beginSingleRowBlock(['id' => 'redactor']) ?>

<?= Redactor::widget([
    'model' => $model,
    'attribute' => 'name',
    'options' => [
            'minHeight' => 300,
        ],
    ]) ?>

<?=$uiHelper->endSingleRowBlock() ?>

<?= $uiHelper->beginContentRow() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'basic-grid',
                                      'width' => 12,
    ]) ?>
    <pre><code class='php'>
use common\widgets\Redactor;
//...
//...
//...
&lt;?= Redactor::widget([
    'model' => $model,
    'attribute' => 'name',
    'options' => [
            'minHeight' => 300,
        ],
]) ?>

    </code></pre>

    <?= $uiHelper->endContentBlock() ?>
<?= $uiHelper->endContentRow() ?>


<?=\Yii::$app->uiHelper->renderContentSubHeader('Generating PDF with mPDF')?>
<?= $uiHelper->renderLine(); ?>
<?=$uiHelper->beginSingleRowBlock(['id' => 'redactor']) ?>
Merupakan extension yang digunakan untuk men-generate content/output PDF
<?=$uiHelper->endSingleRowBlock() ?>
<?= $uiHelper->beginContentRow() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'basic-grid',
                                      'width' => 12,
    ]) ?>
    <pre><code class='php'>
&lt;?php
use mPDF;
//...
//...
//...
class xxxController extends Controller {
//...
//...
//...
    public function actionGenReport(){
        $mpdf=new mPDF();
        //render view 'mpdf' yang berdiri sendiri, punya asset (css, js) terpisah dari global css.
        $mpdf->WriteHTML($this->renderPartial('mpdf'));
        //tampilkan di browser
        $mpdf->Output("report.pdf");
        exit;

    }

    public function actionDownloadReport(){
        $mpdf=new mPDF();
        //render view 'mpdf' yang berdiri sendiri, punya asset (css, js) terpisah dari global css.
        $mpdf->WriteHTML($this->renderPartial('mpdf'));
        //tampilkan di browser
        $mpdf->Output("report.pdf", 'D');
        exit;

    }
}
?>

    </code></pre>

    <?= $uiHelper->endContentBlock() ?>
<?= $uiHelper->endContentRow() ?>

<?=\Yii::$app->uiHelper->renderContentSubHeader('Handle Excel File')?>
<?= $uiHelper->renderLine(); ?>
<?=$uiHelper->beginSingleRowBlock(['id' => 'redactor']) ?>
Merupakan extension yang digunakan untuk meng-handle (baca/tulis) file excel
<?=$uiHelper->endSingleRowBlock() ?>
<?= $uiHelper->beginContentRow() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'basic-grid',
                                      'width' => 12,
    ]) ?>
    <pre><code class='php'>
&lt;?php
use PHPExcel;
use PHPExcel_Writer_Excel2007;
//...
//...
//...
class xxxController extends Controller {
//...
//...
//...
    public function actionGenReport(){
        $objPHPExcel = new PHPExcel();
        
        //See phpexcel manual to use (read/generate) excel file
        //https://github.com/PHPOffice/PHPExcel/wiki/User-documentation
        //http://phpexcel.codeplex.com/

        //...
        //...
        // Save Excel 2007 file
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');

        // It will be called file.xls
        header('Content-Disposition: attachment; filename="file.xls"');

        // Write file to the browser
        $objWriter->save('php://output');
        exit;

    }

}
?>

    </code></pre>

    <?= $uiHelper->endContentBlock() ?>
<?= $uiHelper->endContentRow() ?>


<?=\Yii::$app->uiHelper->renderContentSubHeader('Typeahead Autucomplete and suggestions')?>
<?= $uiHelper->renderLine(); ?>
<?=$uiHelper->beginSingleRowBlock(['id' => 'typeahead']) ?>
Digunakan untuk input dengan fitur suggestion/autocomplete dengan menggunakan Twitter Typeahed
<?=$uiHelper->endSingleRowBlock() ?>
<?=$uiHelper->beginSingleRowBlock(['id' => 'typeahead']) ?>
<?= $model->name = null; ?>
<?= Typeahead::widget([
            'model' => $model,
            'attribute' => 'name',
            'withSubmitButton' => true,
            'template' => "<p style='padding:4px'>{{data}} <i>({{email}})</i></p>",
            'htmlOptions' => ['class' => 'typeahead', 'placeholder' => 'Search Username'],
            'options' => [
                            'hint' => false,
                            'highlight' => true,
                            'minLength' => 1
                        ],
            'sourceApiBaseUrl' => Url::toRoute(['/api/bloodhound-data/find-user']),
            'sourceName' => 'sdi',

            ]) ?>

<?=$uiHelper->endSingleRowBlock() ?>

<?= $uiHelper->beginContentRow() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'basic-grid',
                                      'width' => 12,
    ]) ?>
    <pre><code class="php">
&lt;?= $model->name = null; ?>
&lt;?= Typeahead::widget([
        'model' => $model,
        'attribute' => 'name',
        'withSubmitButton' => true,
        'template' => "&lt;p style='padding:4px'>{{data}} &lt;i>({{email}})&lt;/i>&lt;/p>",
        'htmlOptions' => ['class' => 'typeahead', 'placeholder' => 'Search Username'],
        'options' => [
                        'hint' => false,
                        'highlight' => true,
                        'minLength' => 1
                    ],
        'sourceApiBaseUrl' => Url::toRoute(['/api/bloodhound-data/find-user']),
        'sourceName' => 'sdi',

        ]) ?>
    </code></pre>
    <?= $uiHelper->endContentBlock() ?>
<?= $uiHelper->endContentRow() ?>

<?= $uiHelper->beginContentRow() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'basic-grid',
                                      'width' => 12,
    ]) ?>

<?=\Yii::$app->uiHelper->renderContentSubHeader('Render Toolbar')?>
<?= $uiHelper->renderLine(); ?>  
<?=$uiHelper->renderToolbar([
    'pull-right' => true,
    'groupTemplate' => ['group1', 'group2'],
    'groups' => [
        'group1' => [
            'template' => ['add', 'filter'],
            'buttons' => [
                'add' => ['id' =>'add1', 'url' => '#', 'label' => 'add', 'icon' => 'fa fa-plus-circle'],
                'filter' => '<div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Dropdown
                              <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                              <li><a href="#">Dropdown link</a></li>
                              <li><a href="#">Dropdown link</a></li>
                            </ul>
                          </div>',
            ]
        ],
        'group2' => [
            'template' => ['refresh', 'close'],
            'buttons' => [
                'refresh' => ['id' => 'toolbar-refresh', 'url' => '#', 'label' => '', 'icon' => 'fa fa-refresh'],
                'close' => ['id' => 'toolbar-close',  'url' => '#', 'label' => '', 'icon' => 'fa fa-times']
            ]
        ],
    ],
    'clientScript' => [
        'view' => $this,
        'script' => "
            $('#toolbar-refresh').on('click', function(event){
                event.preventDefault();
                event.stopPropagation();
                console.log('refreshing page');
                location.reload();
            })
            $('#toolbar-close').on('click', function(event){
                event.preventDefault();
                event.stopPropagation();
                console.log('closing page');
                alert('are you sure want to close this application?');
            })
        ",
    ]
]) ?>

    <?= $uiHelper->endContentBlock() ?>
<?= $uiHelper->endContentRow() ?>

<?= $uiHelper->beginContentRow() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'basic-grid',
                                      'width' => 12,
    ]) ?>
    <pre><code class="php">
&lt;?=$uiHelper->renderToolbar([
    'pull-right' => true,
    'groupTemplate' => ['group1', 'group2'],
    'groups' => [
        'group1' => [
            'template' => ['add', 'filter'],
            'buttons' => [
                'add' => ['id' =>'add1', 'url' => '#', 'label' => 'add', 'icon' => 'fa fa-plus-circle'],
                'filter' => '&lt;div class="btn-group btn-group-sm" role="group">
                            &lt;button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Dropdown
                              &lt;span class="caret">&lt;/span>
                            &lt;/button>
                            &lt;ul class="dropdown-menu">
                              &lt;li>&lt;a href="#">Dropdown link&lt;/a>&lt;/li>
                              &lt;li>&lt;a href="#">Dropdown link&lt;/a>&lt;/li>
                            &lt;/ul>
                          &lt;/div>',
            ]
        ],
        'group2' => [
            'template' => ['refresh', 'close'],
            'buttons' => [
                'refresh' => ['id' => 'toolbar-refresh', 'url' => '#', 'label' => '', 'icon' => 'fa fa-refresh'],
                'close' => ['id' => 'toolbar-close',  'url' => '#', 'label' => '', 'icon' => 'fa fa-times']
            ]
        ],
    ],
    'clientScript' => [
        'view' => $this,
        'script' => "
            $('#toolbar-refresh').on('click', function(event){
                event.preventDefault();
                event.stopPropagation();
                console.log('refreshing page');
                location.reload();
            })
            $('#toolbar-close').on('click', function(event){
                event.preventDefault();
                event.stopPropagation();
                console.log('closing page');
                alert('are you sure want to close this application?');
            })
        ",
    ]
]) ?>
    </code></pre>
    <?= $uiHelper->endContentBlock() ?>
<?= $uiHelper->endContentRow() ?>

<?= $uiHelper->beginContentRow() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'basic-grid',
                                      'width' => 12,
    ]) ?>

<?=\Yii::$app->uiHelper->renderContentSubHeader('Date Time Widget menggunakan plugin 2amigos')?>
    <?= $uiHelper->renderLine(); ?>  
        referensi: <a href="https://github.com/2amigos/yii2-date-time-picker-widget" title="">https://github.com/2amigos/yii2-date-time-picker-widget</a>
        <?php
        $formdp = ActiveForm::begin([
            'id' => 'application-form',
            // 'options' => ['class' => 'form-horizontal'],
        ]) ?>
        <?= $form->field($model, 'name')->widget(DateTimePicker::className(), [
            'language' => 'en',
            'size' => 'ms',
            'pickButtonIcon' => 'glyphicon glyphicon-time',
            'inline' => false,
            'clientOptions' => [
                'pickerPosition' => 'bottom-left',
                'autoclose' => true,
                'format' => 'yyyy-mm-dd hh:ii:00', // if inline = false
                'todayBtn' => true
            ]
        ]);?>
        <?php ActiveForm::end() ?>
    <?= $uiHelper->endContentBlock() ?>
<?= $uiHelper->endContentRow() ?>

<?= $uiHelper->beginContentRow() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'basic-grid',
                                      'width' => 12,
    ]) ?>
    <pre><code class="php">
use dosamigos\datetimepicker\DateTimePicker;
...
...

 &lt;?php
    $formdp = ActiveForm::begin([
        'id' => 'application-form',
    ]) ?>
    ...
    ...
    &lt;?= $form->field($model, 'name')->widget(DateTimePicker::className(), [
        'language' => 'en',
        'size' => 'ms',
        'pickButtonIcon' => 'glyphicon glyphicon-time',
        'inline' => false,
        'clientOptions' => [
            'pickerPosition' => 'bottom-left',
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii:00', // if inline = false
            'todayBtn' => true
        ]
    ]);?>
    ...
    ...
&lt;?php ActiveForm::end() ?>
    </code></pre>
    <?= $uiHelper->endContentBlock() ?>
<?= $uiHelper->endContentRow() ?>
<?php 
  $this->registerJs(
    "hljs.initHighlightingOnLoad();", 
    View::POS_END);
?>