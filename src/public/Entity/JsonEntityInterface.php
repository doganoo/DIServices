<?php
declare(strict_types=1);

namespace doganoo\DI\Entity;

use JsonSerializable;

interface JsonEntityInterface extends EntityInterface, JsonSerializable {

}