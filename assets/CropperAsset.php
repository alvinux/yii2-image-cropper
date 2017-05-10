<?php

namespace alvinux\imagecropper\assets;

use yii\web\AssetBundle;

class CropperAsset extends AssetBundle {

	public $sourcePath = '@bower/cropper/dist';

	public $depends    = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
		'yii\bootstrap\BootstrapPluginAsset',
	];

	public $js         = ['cropper.min.js'];

	public $css        = ['cropper.min.css'];
}