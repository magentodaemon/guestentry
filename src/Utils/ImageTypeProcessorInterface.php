<?php

namespace App\Utils;

interface ImageTypeProcessorInterface{

    public function updateImage($file, $previousImage = false);

}