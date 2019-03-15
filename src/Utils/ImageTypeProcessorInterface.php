<?php

namespace App\Utils;

interface ImageTypeProcessorInterface{

    /**
     * updateImage
     *
     * @param mixed $file
     * @param mixed $previousImage
     *
     */
    public function updateImage($file, $previousImage = false): string;

}