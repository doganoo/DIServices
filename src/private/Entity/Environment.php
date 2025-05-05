<?php
declare(strict_types=1);

namespace doganoo\DIP\Entity;

use DateTimeInterface;
use doganoo\DI\Entity\EnvironmentInterface;

class Environment implements EnvironmentInterface {

    public function __construct(
        private string            $id,
        private string            $value,
        private DateTimeInterface $createTs
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getValue(): string {
        return $this->value;
    }

    public function getCreateTs(): DateTimeInterface {
        return $this->createTs;
    }

}