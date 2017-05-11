        <?php 
            $width =  $item["width"]; 
            $height =  $item["height"]; 
            $widthHeight = $item["width"].'x'.$item["height"]; 
        ?>

        <!-- Image Cropper Start  -->
        <div class="col-sm-8">
            <div class="panel mt20" id="spy1">
                <div class="panel-heading">
                    <span class="panel-icon">
                        <i class="fa fa-crop"></i>
                    </span>
                    <span class="panel-title"> Image Cropping Utility <?php echo "Width: {$width}, Height: {$height}"; ?></span>
                </div>

                <div class="panel-body pn">
                    <div class="row img-container table-layout table-clear-xs">

                        <label class="hover successCrop successCrop<?= $widthHeight ?>" style="z-index: 9; display: none;">
                            <i class="fa fa-check"></i>
                        </label>

                        <div class="col-xs-12 col-sm-7">
                            <div class="img-container img-marker<?= $widthHeight ?> pv10">
                                <img src="<?= $value ?>">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-5 bg-light br-l br-grey va-t pv10">
                            <div class="clearfix">
                                <div class="img-preview img-preview<?= $widthHeight ?> preview-lg"><img src="<?= $value ?>"></div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="panel-footer panel-cropper panel<?= $widthHeight ?>">
                    <div class="docs-buttons text-center">
                        <div class="btn-group">
                            <button class="btn btn-primary btn-sm" data-methodcrop="setDragMode" data-option="move" type="button" title="Move">
                                <span class="docs-tooltip" data-toggle="tooltip" >
                                    <span class="fa fa-arrows"></span>
                                </span>
                            </button>
                            <button class="btn btn-primary btn-sm" data-methodcrop="zoom" data-option="0.1" type="button" title="Zoom In">
                                <span class="docs-tooltip" data-toggle="tooltip" >
                                    <span class="fa fa-search-plus"></span>
                                </span>
                            </button>
                            <button class="btn btn-primary btn-sm" data-methodcrop="zoom" data-option="-0.1" type="button" title="Zoom Out">
                                <span class="docs-tooltip" data-toggle="tooltip" >
                                    <span class="fa fa-search-minus"></span>
                                </span>
                            </button>
                            <button class="btn btn-primary btn-sm" data-methodcrop="rotate" data-option="-45" type="button" title="Rotate Left">
                                <span class="docs-tooltip" data-toggle="tooltip" >
                                    <span class="fa fa-rotate-left"></span>
                                </span>
                            </button>
                            <button class="btn btn-primary btn-sm" data-methodcrop="rotate" data-option="45" type="button" title="Rotate Right">
                                <span class="docs-tooltip" data-toggle="tooltip" >
                                    <span class="fa fa-rotate-right"></span>
                                </span>
                            </button>
                        </div>

                        <div class="btn-group">
                            <button class="btn btn-primary btn-sm" data-methodcrop="disable" type="button" title="Disable">
                                <span class="docs-tooltip" data-toggle="tooltip" >
                                    <span class="fa fa-lock"></span>
                                </span>
                            </button>
                            <button class="btn btn-primary btn-sm" data-methodcrop="enable" type="button" title="Enable">
                                <span class="docs-tooltip" data-toggle="tooltip" >
                                    <span class="fa fa-unlock"></span>
                                </span>
                            </button>
                            <button class="btn btn-primary btn-sm" data-methodcrop="reset" type="button" title="Reset">
                                <span class="docs-tooltip" data-toggle="tooltip" >
                                    <span class="fa fa-refresh"></span>
                                </span>
                            </button>
                        </div>

                        <?php if (!$autoCrop): ?>
                        <div class="btn-group btn-group-crop">
                            <button class="btn btn-success btn-sm" data-methodcrop="getCroppedCanvas" data-option="{ &quot;width&quot;: <?= $width ?>, &quot;height&quot;: <?= $height ?> }" type="button">
                                <span class="docs-tooltip" data-toggle="tooltip" >
                                    Crop Image <span class="fa fa-check"></span>
                                </span>
                            </button>
                        </div>
                        <?php endif ?>

                        <div class="form-group" hidden="hidden">
                            <textarea name="<?= $name.'['.$widthHeight.']' ?>" class="form-control value64base value64image1<?= $widthHeight ?>" > </textarea>
                        </div>

                    </div>
                </div>
            </div>

            <?php  

            $script = <<< JAVASCRIPT

                jQuery(document).ready(function() {
                // Cropper
                (function() {

                    var ImageWidth = $width ; 
                    var ImageHeight = $height ;
                    var WidthHeight = '$widthHeight' ;

                    var varImage = $('.img-marker' + WidthHeight + ' > img'),
                    
                    pluginOptions = $pluginOptions;

                    options = {
                        aspectRatio: ImageWidth / ImageHeight,
                        preview: '.img-preview' + WidthHeight,
                    };

                    $.extend( options, pluginOptions );

                    if ('$autoCrop' == '1') {
                        varImage.on({
                            'built.cropper' : function () {
                                convert = varImage.cropper('getCroppedCanvas', { "width": ImageWidth, "height": ImageHeight }).toDataURL();
                                $('.value64image1' + WidthHeight).val(convert);
                            },
                            'cropmove.cropper' : function () {
                                convert = varImage.cropper('getCroppedCanvas', { "width": ImageWidth, "height": ImageHeight }).toDataURL();
                                $('.value64image1' + WidthHeight).val(convert);
                            },
                            'zoom.cropper' : function () {
                                convert = varImage.cropper('getCroppedCanvas', { "width": ImageWidth, "height": ImageHeight }).toDataURL();
                                $('.value64image1' + WidthHeight).val(convert);
                            },
                            'crop.cropper': function (e) {
                                convert = varImage.cropper('getCroppedCanvas', { "width": ImageWidth, "height": ImageHeight }).toDataURL();
                                $('.value64image1' + WidthHeight).val(convert);
                            },
                        }).cropper(options);
                    } else {
                        varImage.cropper(options);
                    }

                    $('.successCrop' + WidthHeight).click(function(){
                        varImage.cropper('reset', true);
                        $('.successCrop' + WidthHeight).hide();
                        $(".panel" + WidthHeight).show();
                        $('.value64image1' + WidthHeight).val('');
                    });

                    // Methods
                    $(".panel" + WidthHeight).on('click', '[data-methodcrop]', function() {
                        var data = $(this).data(),
                        varTarget,
                        result;

                        if (data.methodcrop) {
                            data = $.extend({}, data); // Clone a new one
                            result = varImage.cropper(data.methodcrop, data.option);
                            if (data.methodcrop === 'getCroppedCanvas') {
                                $('.value64image1' + WidthHeight).val(result.toDataURL());
                                $('.successCrop' + WidthHeight).show();
                                $(".panel" + WidthHeight).hide();
                            }

                            if ($.isPlainObject(result) && varTarget) {
                                try {
                                    varTarget.val(JSON.stringify(result));
                                } catch (e) {
                                    console.log(e.message);
                                }
                            }
                        }
                    });

                }());
                    
                });
JAVASCRIPT;

            $this->registerJS($script);
            ?>

        </div>
        <!-- Image Cropper Start  -->
