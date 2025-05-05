<?php
declare(strict_types=1);

namespace doganoo\DI\Test\Http;

use doganoo\DI\HTTP\IUploadedFileService;
use doganoo\DI\Test\Suite\TestCase;
use doganoo\DIP\Http\UploadedFileService;

class UploadedFileServiceTest extends TestCase {

    private IUploadedFileService $fileService;

    protected function setUp(): void {
        parent::setUp();
        $this->fileService = new UploadedFileService();
    }

    public function testFileUpload(): void {
        $this->markTestSkipped('need to override is_uploaded_file');
    }

}