<?php
declare(strict_types=1);

namespace doganoo\DIP\HTTP;

use doganoo\DI\Entity\File\IFile;
use doganoo\DI\HTTP\IUploadedFileService;
use doganoo\DIP\Entity\File\File;
use Psr\Http\Message\UploadedFileInterface;

class UploadedFileService implements IUploadedFileService {

    public function validateUploadedFile(UploadedFileInterface $file, int $maxSize): bool {
        $uri            = $file->getStream()->getMetadata('uri');
        $error          = $file->getError();
        $tmpName        = $uri;
        $type           = mime_content_type((string) $uri);
        $size           = $file->getSize();
        $isUploadedFile = is_uploaded_file($tmpName);

        return
            0 === $error
            && true === is_string($tmpName)
            && true === is_string($type)
            && true === $isUploadedFile
            && $size > $maxSize;
    }

    public function toFile(UploadedFileInterface $uploadedFile): IFile {
        $uploadedFile->getStream()->rewind();
        $file = new File();
        $file->setName(
            $uploadedFile->getClientFilename()
        );
        $file->setContent(
            $uploadedFile->getStream()->getContents()
        );
        $file->setType(
            $uploadedFile->getClientMediaType()
        );
        $file->setSize(
            $uploadedFile->getSize()
        );
        return $file;
    }

}