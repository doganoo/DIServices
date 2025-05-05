<?php
declare(strict_types=1);

namespace doganoo\DI\Entity;

use DateTimeInterface;

interface EnvironmentInterface {

    public function getId(): string;

    public function getValue(): string;

    public function getCreateTs(): DateTimeInterface;

}