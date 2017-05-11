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
```php           
<?= \alvinux\imagecropper\Cropper::widget([
    'name' => 'Post[picture]',
    // 'value' => 'https://fengyuanchen.github.io/cropper/images/picture.jpg', // Default blank image if not sett
    'options' => [
        ['width' => 200,'height' => 200],
        ['width' => 500,'height' => 200],
        ['width' => 500,'height' => 100],
    ],
    'showThumbnailCropper' => true, // optional, if ( showThumbnailCropper == false && autoCrop == true ) then 'hidden' else 'show',
    'autoCrop' => true, // optional, default (true), if autoCrop = 'true' there is no "Crop Image" button, if set false then you have to click 'Crop Image' button to get value
    'thumbnail' => ['width' => 250, 'height' => 250], // optional, default 150 x 150
    'pluginOptions' => [
        // https://github.com/fengyuanchen/cropper
        // Options default
        // 'autoCropArea'   => true,
        // 'strict'   => false,
        // 'guides'   => true,
        // 'highlight'   => true,
    ]
]); ?>
```

With $model
```php
<?= \alvinux\imagecropper\Cropper::widget([
    'model' => $model,
    'attribute' => 'picture',
    'options' => [
        ['width' => 200,'height' => 200],
        ['width' => 500,'height' => 200],
        ['width' => 500,'height' => 100],
    ],
    'showThumbnailCropper' => true, // optional, if ( showThumbnailCropper == false && autoCrop == true ) then 'hidden' else 'show',
    'autoCrop' => true, // optional, default (true), if autoCrop = 'true' there is no "Crop Image" button, if set false then you have to click 'Crop Image' button to get value
    'thumbnail' => ['width' => 250, 'height' => 250], // optional, default 150 x 150
    'pluginOptions' => [
        //https://github.com/fengyuanchen/cropper
    ]
]); ?>
```

Screenshot
------------

- Default without image <br/>
![without image](/screenshot/screencapture-none-1494417907850.png?raw=true "image empty") 
***

- With image <br/>
![with image](/screenshot/screencapture-true-1494417965449.png?raw=true "image selected")
