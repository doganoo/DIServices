<?php
declare(strict_types=1);

namespace doganoo\DI\Entity\File;

use doganoo\DI\Entity\JsonEntityInterface;

interface FileInterface extends JsonEntityInterface {

    public function getType(): string;

    public function getSize(): int;

    public function getName(): string;

    public function getContent(): string;

}