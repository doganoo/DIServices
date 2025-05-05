<?php
declare(strict_types=1);

namespace doganoo\DI\Repository\Environment;

use doganoo\DI\Entity\EnvironmentInterface;
use doganoo\PHPAlgorithms\Datastructure\Table\HashTable;

interface EnvironmentRepositoryInterface {

    public function insert(EnvironmentInterface $environment): EnvironmentInterface;

    public function update(EnvironmentInterface $environment): EnvironmentInterface;

    public function getAll(): HashTable;

    public function get(string $id): EnvironmentInterface;

    public function remove(string $id): void;

    public function clear(): void;

}