<?php
namespace backend\modules\xdev\assets;

use yii\web\AssetBundle;

class XdevAsset extends AssetBundle {
	public $sourcePath = '@backend/modules/xdev/assets/web';


	public $css = ['css/highlight/monokai_sublime.css'];

	public $js = ['js/highlight/highlight.pack.js'];

	public $depends = [
			'backend\assets\AppAsset',
	];


}