<?php

use PHPUnit\Framework\TestCase;
use App\Utils\ImageTypeProcessor;
use App\Utils\ImageTypeProcessorInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageTypeProcessorTest extends TestCase{

    CONST FILE_UPLOAD_LOCATION = 'images';
    
    public function testShouldbeAnInstanceofImageTypeProcessor(){

        $this->assertInstanceOf(ImageTypeProcessorInterface::class,new ImageTypeProcessor());

    }

    public function testShouldReturnStringasFilepath()
    {
        $imageTypeProcessor = new ImageTypeProcessor();
        
        $file = $this->createMock(UploadedFile::class);
        $file->method('move')->willReturn($file);

        $imageResult = $imageTypeProcessor->updateImage($file,false);
        $this->assertStringStartsWith(self::FILE_UPLOAD_LOCATION, $imageResult);
    }

    public function testshouldHandleException()
    {
        $imageTypeProcessor = new ImageTypeProcessor();
        
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Unable to upload image');
        $file = $this->createMock(UploadedFile::class);
        $file->method('move')->will($this->throwException(new \Exception()));

        $imageTypeProcessor->updateImage($file,false);
    }

    public function testShouldReplacePreviousImage()
    {

        $imageTypeProcessor = new ImageTypeProcessor();
        
        $file = $this->createMock(UploadedFile::class);
        $file->method('move')->willReturn($file);

        $previousImage = 'previousImage.jpg';
        $imageResult = $imageTypeProcessor->updateImage($file,$previousImage);
        
        $this->assertSame(
            self::FILE_UPLOAD_LOCATION.DIRECTORY_SEPARATOR.$previousImage,
            $imageResult
        );

    }
}