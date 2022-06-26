<?php
declare(strict_types=1);

namespace doganoo\DI\HTTP;


use Psr\Http\Message\UploadedFileInterface;

interface IUploadedFileService {

    public function validateUploadedFile(UploadedFileInterface $file, int $maxSize): bool;

}