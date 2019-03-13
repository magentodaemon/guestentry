<?php

namespace App\Utils;

class ImageTypeProcessor implements ImageTypeProcessorInterface{

    CONST FILE_UPLOAD_LOCATION = 'images';
    CONST NULL_IMAGE = 'not_found.png';

    public function updateImage($file, $previousImage = false){
        try 
        {
            if($previousImage)
                $filename = $previousImage;
            else
                $filename = time().'_'.$file->getClientOriginalName();
            
            $file->move(self::FILE_UPLOAD_LOCATION, $filename);

        } catch (\Exception $e){
            return self::NULL_IMAGE;
        }

        return $filename;

    }

}