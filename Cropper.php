<?php
/**
 * @alvinux , $alvinojutsu
 */
namespace alvinux\imagecropper;

use yii\base\ErrorException;
use yii\bootstrap\Widget;
use yii\helpers\ArrayHelper;

class Cropper extends Widget {

    public $data;

    public $options       = [];

    public $thumbnail     = ['width' => 150, 'height' => 150];

    public $pluginOptions = [];

    public $model         = null;

    public $attribute     = '';

    public $name          = '';

    public $autoCrop      = true;

    public $showThumbnailCropper    = false;

    public $value;

    /**
     * {@inheritDoc}
     */
    public function init() {
        $this->options       = !empty($this->options) ? $this->options : [['width'  => 185,'height' => 185]];
        $this->pluginOptions = ArrayHelper::merge([
            'autoCrop'   => true,
            'autoCropArea'   => 1,
            'strict'   => false,
            'guides'   => true,
            'highlight'   => true,
            // 'dragCrop'   => false,
            // 'cropBoxMovable'   => false,
            // 'cropBoxResizable'   => false,
            
        ], $this->pluginOptions);
        if ($this->model !== null) {
            if ($this->attribute == '') {
                throw new ErrorException('If "model" was defined, "attribute" must be defined too');
            } else {
                $modelName   = (new \ReflectionClass($this->model))->getShortName();
                $this->name  = $modelName . '[' . $this->attribute . ']';
                $this->value = $this->model->{$this->attribute};
            }
        } else {
            if ($this->name == '') {
                throw new ErrorException('"name" must be defined');
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function run() {
        return $this->render('cropper', [
            'name'          => $this->name,
            'value'         => !empty($this->value)? $this->value : 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7',
            // 'value'         => 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7',
            'attribute'     => $this->attribute,
            'options'       => $this->options,
            'thumbnail'       => $this->thumbnail,
            'autoCrop'       => $this->autoCrop,
            'showThumbnailCropper'       => $this->showThumbnailCropper,
            'pluginOptions' => json_encode($this->pluginOptions),
        ]);
    }
}
