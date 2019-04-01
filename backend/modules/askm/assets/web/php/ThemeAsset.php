<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2018
 * @package yii2-widgets
 * @subpackage yii2-widget-select2
 * @version 2.1.4
 */

namespace backend\modules\askm\assets\web\php;

use backend\modules\askm\assets\web\vendor\src\AssetBundle;

/**
 * Base theme asset bundle.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class ThemeAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $depends = [
        'backend\modules\askm\assets\web\php\Select2Asset'
    ];
}
