<?php

use PHPUnit\Framework\TestCase;
use App\Utils\ImageTypeProcessor;
use App\Utils\ImageTypeProcessorInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageTypeProcessorTest extends TestCase
{
    const TEST_FILENAME = 'test.jpg';
    const NULL_IMAGE = 'not_found_system_file.png';

    public function testShouldbeAnInstanceofImageTypeProcessor()
    {
        $this->assertInstanceOf(ImageTypeProcessorInterface::class, new ImageTypeProcessor());
    }

    public function testShouldReturnStringasFilepath()
    {
        $imageTypeProcessor = new ImageTypeProcessor();

        $file = $this->createMock(UploadedFile::class);
        $file->method('move')->willReturn($file);
        $file->method('getClientOriginalName')->willReturn(self::TEST_FILENAME);

        $imageResult = $imageTypeProcessor->updateImage($file, false);
        $this->assertStringEndsWith(self::TEST_FILENAME, $imageResult);
    }

    public function testshouldHandleException()
    {
        $imageTypeProcessor = new ImageTypeProcessor();

        $file = $this->createMock(UploadedFile::class);
        $file->method('getClientOriginalName')->willReturn(self::TEST_FILENAME);
        $file->method('move')->will($this->throwException(new \Exception('Unable to upload image')));

        $imageTypeProcessor->updateImage($file, false);
        $imageResult = $imageTypeProcessor->updateImage($file, false);
        $this->assertSame(self::NULL_IMAGE, $imageResult);
    }

    public function testShouldReplacePreviousImage()
    {
        $imageTypeProcessor = new ImageTypeProcessor();

        $file = $this->createMock(UploadedFile::class);
        $file->method('move')->willReturn($file);

        $previousImage = 'previousImage.jpg';
        $imageResult = $imageTypeProcessor->updateImage($file, $previousImage);

        $this->assertSame(
            $previousImage,
            $imageResult
        );
    }
}
