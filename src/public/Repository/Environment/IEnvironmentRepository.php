<?php
declare(strict_types=1);

namespace doganoo\DI\Repository\Environment;

use doganoo\DI\Entity\IEnvironment;
use doganoo\PHPAlgorithms\Datastructure\Table\HashTable;

interface IEnvironmentRepository {

    public function insert(IEnvironment $environment): IEnvironment;

    public function update(IEnvironment $environment): IEnvironment;

    public function getAll(): HashTable;

    public function get(string $id): IEnvironment;

    public function remove(string $id): void;

    public function clear(): void;

}