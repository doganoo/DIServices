<?php
declare(strict_types=1);

namespace doganoo\DIP\Entity\File;

use doganoo\DI\Entity\File\IFile;

class File implements IFile {

    private string $type;
    private int    $size;
    private string $name;
    private string $content;

    /**
     * @return string
     */
    public function getType(): string {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getSize(): int {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize(int $size): void {
        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getContent(): string {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void {
        $this->content = $content;
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
