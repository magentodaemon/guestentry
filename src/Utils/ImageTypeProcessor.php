<?php

namespace App\Utils;

class ImageTypeProcessor implements ImageTypeProcessorInterface{

    CONST FILE_UPLOAD_LOCATION = 'images';

    public function updateImage($file, $previousImage = false){
        try 
        {
            if($previousImage)
                $filename = $previousImage;
            else
                $filename = time().'_'.$file->getClientOriginalName();
            
            $file->move(self::FILE_UPLOAD_LOCATION, $filename);

        } catch (\Exception $e){
            throw new \Exception('Unable to upload image');
        }

        return self::FILE_UPLOAD_LOCATION.DIRECTORY_SEPARATOR.$filename;

    }

}