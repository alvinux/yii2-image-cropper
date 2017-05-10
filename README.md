yii2 image cropper
==================
yii2 image cropper

this repo is modification from https://github.com/navatech/yii2-cropper

thanks to [@lephuong](https://github.com/phuong17889)

Enhancement
------------
- Crop 1 image multiple size
- Thumbnail default size


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist alvinojutsu/yii2-image-cropper "*"
```

or add

```
"alvinojutsu/yii2-image-cropper": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

Without $model
 ``           <?= \docotel\admindesign\widgets\Cropper::widget([
                'name' => 'Post[picture]',
                // 'value' => 'https://fengyuanchen.github.io/cropper/images/picture.jpg', // Default blank image if not sett
                'options' => [
                    ['width' => 200,'height' => 200],
                    ['width' => 500,'height' => 200],
                    ['width' => 500,'height' => 100],
                ],
				'thumbnail' => ['width' => 250, 'height' => 250],
                'pluginOptions' => [
                    // https://github.com/fengyuanchen/cropper
                    // Options default
                    // 'autoCropArea'   => true,
                    // 'strict'   => false,
                    // 'guides'   => true,
                    // 'highlight'   => true,
                ]
            ]); ?>
``

With $model
``
<?= \docotel\admindesign\widgets\Cropper::widget([
    'model' => $model,
    'attribute' => 'picture',
    'options' => [
        ['width' => 200,'height' => 200],
        ['width' => 500,'height' => 200],
        ['width' => 500,'height' => 100],
    ],
	'thumbnail' => ['width' => 250, 'height' => 250],
    'pluginOptions' => [
        //https://github.com/fengyuanchen/cropper
    ]
]); ?>
``