<?php
declare(strict_types=1);

namespace doganoo\DIP\Entity;

use DateTimeInterface;
use doganoo\DI\Entity\IEnvironment;

class Environment implements IEnvironment {

    private string            $id;
    private string            $value;
    private DateTimeInterface $createTs;

    public function __construct(
        string            $id,
        string            $value,
        DateTimeInterface $createTs
    ) {
        $this->id       = $id;
        $this->value    = $value;
        $this->createTs = $createTs;
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