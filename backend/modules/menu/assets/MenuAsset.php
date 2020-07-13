<?php
namespace backend\modules\menu\assets;

use yii\web\AssetBundle;

class MenuAsset extends AssetBundle {
	public $sourcePath = '@backend/modules/menu/assets/web';

	public $css = [];

	public $js = ['Treant/Treant.js', 'Treant/vendor/raphael.js'];

	public $depends = [
		'backend\themes\v2\assets\V2Asset'
	];

	public $publishOptions = [
    	'forceCopy' => true
	];
}