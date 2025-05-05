<?php
declare(strict_types=1);

namespace doganoo\DIP\Entity\File;

use doganoo\DI\Entity\File\FileInterface;

final class File implements FileInterface {

    public function __construct(
        private string $type,
        private int    $size,
        private string $name,
        private string $content
    ) {
    }

    /**
     * @return string
     */
    public function getType(): string {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getSize(): int {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getContent(): string {
        return $this->content;
    }

    public function jsonSerialize(): array {
        return [
            'type'    => $this->getType(),
            'size'    => $this->getSize(),
            'name'    => $this->getName(),
            'content' => $this->getContent()
        ];
    }

}
