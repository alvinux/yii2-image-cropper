<?php

namespace alvinux\imagecropper\components;

use ReflectionClass;
use Yii;
use yii\base\Model;

class ImageCrop {

    private $data;

    public  $extension;

    public static function getInstance($model, $attribute) {

        $modelName = (new ReflectionClass($model))->getShortName();
        $post      = Yii::$app->request->post($modelName);
        $data      = $post[$attribute];
        
        $resultImages = array();
        $resultImages['original'] = \yii\web\UploadedFile::getInstance($model, $attribute);

        foreach ($data as $key => $item) {
            $imageCrop = new ImageCrop();
            if ($key == 'original') continue;
            list(, $item) = explode(';', $item);
            list(, $item) = explode(',', $item);
            $imageCrop->data      = base64_decode($item);
            $f                    = finfo_open();
            $mime_type            = finfo_buffer($f, $imageCrop->data, FILEINFO_MIME_TYPE);
            $imageCrop->extension = self::extension($mime_type);
            $resultImages[$key] = $imageCrop;
        }        
        return $resultImages;
    }


    public function saveAs($path,$name) {
        if (!file_exists(dirname($path))) mkdir(dirname($path), 0777, true);
        if (!file_exists(rtrim($path,'/'))) mkdir(rtrim($path,'/'), 0777, true);
        return file_put_contents($path.$name.$this->extension, $this->data);
    }


    private static function extension($mime_type) {
        $extensions = [
        'image/gif'           => '.gif',
        'image/jpeg'          => '.jpg',
        'image/png'           => '.png',
        'image/x-windows-bmp' => '.bmp',
        ];
        return isset($extensions[$mime_type]) ? $extensions[$mime_type] : '.png';
    }

    public static function getInstanceAll($images = array()) {
        $imageCrop = new ImageCrop();
        $modelName = (new ReflectionClass($model))->getShortName();
        $post      = Yii::$app->request->post($modelName);
        $data      = $post[$attribute];
        list(, $data) = explode(';', $data);
        list(, $data) = explode(',', $data);
        $imageCrop->data      = base64_decode($data);
        $f                    = finfo_open();
        $mime_type            = finfo_buffer($f, $imageCrop->data, FILEINFO_MIME_TYPE);
        $imageCrop->extension = self::extension($mime_type);
        return $imageCrop;
    }

    //additional tool
    public static function saveAll($path,$name, $files) {
        $fileName = '';
        $status = true;
        foreach ($files as $key => $file) {
            if(($key) == 'original'){
                
                if (!file_exists(dirname($path))) mkdir(dirname($path), 0777, true);
                if (!file_exists(rtrim($path,'/'))) mkdir(rtrim($path,'/'), 0777, true);

                $fileName = $name.self::extension($file->type);
                $file->saveAs($path.$fileName);
                continue;
            }
            if (!$file->saveAs($path, $name."($key)")) {
                $status = false;
            }
        }
        return ['status' => $status, 'fileName' => $fileName];
    }

}
