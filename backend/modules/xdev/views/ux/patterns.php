<?php
use yii\web\View;
use backend\modules\xdev\assets\XdevAsset;

$this->title = 'Systemx-core UX Patterns';
$this->params['breadcrumbs'][] = 'UX Patterns';
$this->params['header'] = 'Systemx-core UX Patterns';

$uiHelper = \Yii::$app->uiHelper;
XdevAsset::register($this);
?>

<?= $uiHelper->renderContentSubHeader("Default Automatic Page Header", ['icon' => 'fa fa-tag', 'id' => 'ph']) ?>
<?= $uiHelper->renderLine(); ?>

<?= $uiHelper->beginContentRow() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'basic-grid',
                                      'width' => 12,
    ]) ?>
    <pre><code class='php'>
&lt;?php
    $this->title = 'Systemx-core UX Patterns';
    $this->params['breadcrumbs'][] = 'UX Patterns';
    $this->params['header'] = 'Systemx-core UX Patterns';
?>
    </code></pre>
    <?= $uiHelper->endContentBlock() ?>
<?= $uiHelper->endContentRow() ?>

<?= $uiHelper->renderContentSubHeader("Manual Page Header", ['icon' => 'fa fa-tag', 'id' => 'manual-ph']) ?>
<?= $uiHelper->renderLine(); ?>
<?= $uiHelper->beginContentRow() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'basic-grid',
                                      'width' => 12,
    ]) ?>
<?= $uiHelper->renderContentHeader("This is Manual Header") ?> 
    <?= $uiHelper->endContentBlock() ?>
<?= $uiHelper->endContentRow() ?>

<?= $uiHelper->beginContentRow() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'basic-grid',
                                      'width' => 12,
    ]) ?>
    <pre><code class='php'>
&lt;?=$uiHelper->renderContentHeader("This is Manual Header") ?> 
    </code></pre>
    <?= $uiHelper->endContentBlock() ?>
<?= $uiHelper->endContentRow() ?>



<?= $uiHelper->renderContentSubHeader("Basic UX Helper function", ['icon' => 'fa fa-tag', 'id' => 'basic-ux']) ?>
<?= $uiHelper->renderLine(); ?>
<?= $uiHelper->beginContentRow() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'basic-grid',
                                      'width' => 6,
    ]) ?>
    <?= $uiHelper->renderContentSubHeader("Content Sub Header followed by line") ?>
    <?= $uiHelper->renderLine(); ?>
    <?= $uiHelper->endContentBlock() ?>
<?= $uiHelper->endContentRow() ?>

<?= $uiHelper->beginContentRow() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'basic-grid',
                                      'width' => 12,
    ]) ?>
    <pre><code>
&lt;?=$uiHelper = \Yii::$app->uiHelper ?>

&lt;?=$uiHelper->renderContentSubHeader("Content Sub Header followed by line") ?>
&lt;?=$uiHelper->renderLine(); ?>
    </code></pre>
    <?= $uiHelper->endContentBlock() ?>
<?= $uiHelper->endContentRow() ?>


<?= $uiHelper->renderContentSubHeader("Grid System (Blocks)", ['icon' => 'fa fa-tag', 'id' => 'grid-system']) ?>
<?= $uiHelper->renderLine(); ?>
<?= $uiHelper->beginContentRow() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'grid-system1',
                                      'width' => 4,
    ]) ?>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    <?= $uiHelper->endContentBlock() ?>

    <?= $uiHelper->beginContentBlock(['id' => 'grid-system2',
                                     'header' => 'With Header and type',
                                      'width' => 4,
                                      'type' => 'danger'
    ]) ?>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    <?= $uiHelper->endContentBlock() ?>

    <?= $uiHelper->beginContentBlock(['id' => 'grid-system3',
                                      'header' => 'Header and icon',
                                      'width' => 4,
                                      'icon' => 'fa fa-gears'
    ]) ?>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    <?= $uiHelper->endContentBlock() ?>    
<?= $uiHelper->endContentRow() ?>

<?= $uiHelper->beginContentRow() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'grid-system1',
                                      'width' => 12,
    ]) ?>
    <pre><code class="php"> 
&lt;?=$uiHelper->beginContentRow() ?>
    //width: mengikuti bootstrap gridsystem, 1 s/d 12
    //width = 4 berarti lebar block = 4/12 x 100% of container
    &lt;?= $uiHelper->beginContentBlock(['id' => 'grid-system1',
            'width' => 4,
        ]) ?>
        Lorem ipsum...
    &lt;?=$uiHelper->endContentBlock()?>
        
    &lt;?=$uiHelper->beginContentBlock(['id' => 'grid-system2',
     'header' => 'With Header',
      'width' => 4,
      'type' => 'danger'
      ]);
        Lorem ipsum...
    &lt;?=$uiHelper->endContentBlock()?>
       
    &lt;?=$uiHelper->beginContentBlock(['id' => 'grid-system3',
      'header' => 'Header and icon',
      'width' => 4,
      'icon' => 'fa fa-gears'
        ]) ?>
        Lorem ipsum...
    &lt;?=$uiHelper->endContentBlock()?>

&lt;?=$uiHelper->endContentRow() ?>
    </code></pre>
    <?= $uiHelper->endContentBlock() ?>

<?= $uiHelper->endContentRow() ?>

<?= $uiHelper->renderContentSubHeader("Block as conteiners example", ['icon' => 'fa fa-tag', 'id' => 'block-container']) ?>
<?= $uiHelper->renderLine(); ?>
<?= $uiHelper->beginContentRow() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'grid-system1',
                                      'width' => 4,
    ]) ?>
        <img width="250px" src="http://www.del.ac.id/wp-content/uploads/2015/03/DSC_0826.jpg">

    <?= $uiHelper->endContentBlock() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'grid-system-xs',
                                      'width' => 5,
    ]) ?>
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

    <?= $uiHelper->endContentBlock() ?>
    <?= $uiHelper->beginContentBlock(['id' => 'grid-system-content',
                                      'width' => 3,
                                      'header' =>'Keterangan'
    ]) ?>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
        nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in...

    <?= $uiHelper->endContentBlock() ?>
<?= $uiHelper->endContentRow() ?>

<?= $uiHelper->beginContentRow() ?>
<?= $uiHelper->beginContentBlock(['id' => 'grid-system-content2',
                                      'width' => 12,]) ?>
<pre><code class="html">
&lt;?= $uiHelper->beginContentRow() ?>
    &lt;?= $uiHelper->beginContentBlock(['id' => 'grid-system1',
                                      'width' => 4,
    ]) ?>
        &lt;img width="250px" src="http://www.del.ac.id/wp-content/uploads/2015/03/DSC_0826.jpg">

    &lt;?= $uiHelper->endContentBlock() ?>
    &lt;?= $uiHelper->beginContentBlock(['id' => 'grid-system2',
                                      'width' => 5,
    ]) ?>
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

    &lt;?= $uiHelper->endContentBlock() ?>
    &lt;?= $uiHelper->beginContentBlock(['id' => 'grid-system3',
                                      'width' => 3,
                                      'header' =>'Keterangan'
    ]) ?>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
        nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in...

    &lt;?= $uiHelper->endContentBlock() ?>
&lt;?= $uiHelper->endContentRow() ?>
</code></pre>

    <?= $uiHelper->endContentBlock() ?>
<?= $uiHelper->endContentRow() ?>


<?php 
  $this->registerJs(
    "hljs.initHighlightingOnLoad();", 
    View::POS_END);
?>
