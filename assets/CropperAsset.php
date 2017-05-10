<?php

namespace alvinux\imagecropper\assets;

use yii\web\AssetBundle;

class CropperAsset extends AssetBundle {

	public $sourcePath = '@bower';

	public $depends    = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
		'yii\bootstrap\BootstrapPluginAsset',
	];

	public $js         = ['cropper/dist/cropper.min.js'];

	public $css        = [
        'cropper/dist/cropper.min.css',
        'fontawesome/css/font-awesome.min.css'
    ];
}