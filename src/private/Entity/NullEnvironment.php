<?php
declare(strict_types=1);

namespace doganoo\DIP\Entity;

use DateTimeImmutable;

class NullEnvironment extends Environment {

    public function __construct() {
        parent::__construct('', '', new DateTimeImmutable());
    }

}