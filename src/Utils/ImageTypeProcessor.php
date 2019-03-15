<?php

namespace App\Utils;

class ImageTypeProcessor implements ImageTypeProcessorInterface
{
    const FILE_UPLOAD_LOCATION = 'images';
    const NULL_IMAGE = 'not_found_system_file.png';

    public function updateImage($file, $previousImage = false): string
    {
        try {
            if ($previousImage && self::NULL_IMAGE != $previousImage) {
                $filename = $previousImage;
            } else {
                $filename = time().'_'.$file->getClientOriginalName();
            }

            $file->move(self::FILE_UPLOAD_LOCATION, $filename);
        } catch (\Exception $e) {
            return self::NULL_IMAGE;
        }

        return $filename;
    }
}
