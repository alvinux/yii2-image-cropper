<?php
/**
 * @alvinux, @alvinojutsu
 * 
 * @var string $name
 * @var string $value
 * @var string $attribute
 * @var array  $pluginOptions
 * @var array  $options
 */
use alvinux\imagecropper\assets\CropperAsset;
use yii\bootstrap\Html;
use yii\helpers\Json;

CropperAsset::register($this);
?>
<style style="text/css">
    .img-container label {
        position: absolute;
        width: 100%;
        height: 100%;
        text-align: center;
        background: #fafafa;
        opacity: 0.8;
        cursor: pointer;
        display: block;
    }

    .img-container label i {
        font-size: 100px;
        color: #70ca63;
        margin-top: 30%;
        display: block;
    }

    .img-container canvas {
        width: 100%;
        height: 100%;
    }
			
    .img-preview > img {
        max-width: 100%;
    }
    .img-container, .img-preview {
        background-color: #f7f7f7;
        overflow: hidden;
        width: 100%;
        text-align: center;
    }
    .img-preview {
        float: left;
        margin-right: 10px;
        margin-bottom: 10px;
    }
    .preview-lg {
        width: 263px;
        height: 148px;
    }
</style>

<!-- begin: .tray-center -->
<div class="row tray tray-center">

    <div class="col-sm-12">
        <label class="btn btn-primary btn-lg btn-upload" for="inputImage<?= $attribute ?>" title="Upload image file">
            <input name="<?= $name ?>" class="sr-only " id="inputImage<?= $attribute ?>" name="file" type="file" accept="image/*" required="required" >
            <span class="docs-tooltip" title="Import image with Blob URLs">
                Choose Image <span class="fa fa-upload"></span>
            </span>
        </label>
    </div>

    <?php foreach ($options as $item): ?>
        <?php 
            echo $this->render('cropper-content',[
                'item' => $item,
                'value' => $value,
                'name' => $name,
                'autoCrop' => $autoCrop,
                'pluginOptions' => $pluginOptions,
            ]); 
        ?>
    <?php endforeach ?>


    <?php 
        echo $this->render('cropper-thumbnail',[
            'item' => $thumbnail,
            'value' => $value,
            'name' => $name,
            'autoCrop' => $autoCrop,
            'showThumbnailCropper' => $showThumbnailCropper,
            'pluginOptions' => $pluginOptions,
        ]); 
    ?>


</div>



<?php 

$options = json_encode($options);
$script = <<<JAVASCRIPT
jQuery(document).ready(function() {

    // Import image
    var ArrayImageSize = $options;
    var varInputImage = $('#inputImage' + '$attribute'),
    URL = window.URL || window.webkitURL,
    blobURL;

    if (URL) {
        varInputImage.change(function() {
            var files = this.files,
            file;

            if (files && files.length) {
                file = files[0];

                if (/^image\/\w+$/.test(file.type)) {
                    blobURL = URL.createObjectURL(file);

                    $.each(ArrayImageSize, function( k, data ) {
                        $('.img-marker' + data['width'] + 'x' +data['height'] + '> img').one('built.cropper', function() {
                            // URL.revokeObjectURL(blobURL); // Revoke when load complete
                        }).cropper('reset', true).cropper('replace', blobURL);
                    });

                    //Special for thumbnail
                    $('.img-markerthumbnail > img').one('built.cropper', function() {
                    }).cropper('reset', true).cropper('replace', blobURL)

                    $('.successCrop').hide();
                    $('.panel-cropper').show();

                    if ('$autoCrop' !== '1') {
                        $('.value64base').val(''); //reset value 
                    }
                    // varInputImage.val(''); //reset value
                } else {
                    showMessage('Please choose an image file.');
                }
            }
        });
    } else {
        varInputImage.parent().remove();
    }


});

JAVASCRIPT;
$this->registerJS($script);

 ?>
 


