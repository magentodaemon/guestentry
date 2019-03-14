<?php

namespace App\Utils;

class ImageTypeProcessor implements ImageTypeProcessorInterface{

    CONST FILE_UPLOAD_LOCATION = 'images';
    CONST NULL_IMAGE = 'not_found_system_file.png';

    public function updateImage($file, $previousImage = false): string
    {
        try 
        {
            if($previousImage && $previousImage != self::NULL_IMAGE)
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