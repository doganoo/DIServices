<?php
declare(strict_types=1);

namespace doganoo\DIP\Repository\Environment;

use doganoo\DI\DateTime\DateTimeServiceInterface;
use doganoo\DI\Entity\EnvironmentInterface;
use doganoo\DI\Repository\Environment\EnvironmentRepositoryInterface;
use doganoo\DIP\Entity\Environment;
use doganoo\DIP\Entity\NullEnvironment;
use doganoo\PHPAlgorithms\Datastructure\Table\HashTable;
use PDO;

class EnvironmentRepository implements EnvironmentRepositoryInterface {

    private PDO $database;

    public function __construct(
        private DateTimeServiceInterface $dateTimeService,
        private string                   $path
    ) {
        $this->database = new PDO("sqlite:{$this->path}");
        $this->createTable();
    }

    public function insert(EnvironmentInterface $environment): EnvironmentInterface {
        $statement = $this->database->prepare('INSERT INTO `instance` (`id`, `value`, `create_ts`) VALUES (:id, :value, :create_ts)');
        $statement->bindValue(':id', $environment->getId());
        $statement->bindValue(':value', $environment->getValue());
        $statement->bindValue(':create_ts', $this->dateTimeService->toYMDHIS($environment->getCreateTs()));
        $statement->execute();
        return $environment;
    }

    public function update(EnvironmentInterface $environment): EnvironmentInterface {
        $statement = $this->database->prepare('UPDATE `instance` SET `value` = :value, `create_ts` = :create_ts WHERE `id` = :id');
        $statement->bindValue(':id', $environment->getId());
        $statement->bindValue(':value', $environment->getValue());
        $statement->bindValue(':create_ts', $this->dateTimeService->toYMDHIS($environment->getCreateTs()));
        $statement->execute();
        return $environment;
    }

    public function getAll(): HashTable {
        $all = new HashTable();

        $statement = $this->database->prepare('SELECT 
                                                        `id`
                                                        , `value`
                                                        , `create_ts`
                                                      FROM `instance`;');
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $all->add($row['id'], new Environment(
                $row['id'],
                $row['value'],
                $this->dateTimeService->fromString($row['create_ts'])
            ));
        }

        return $all;
    }

    public function get(string $id): EnvironmentInterface {
        $statement = $this->database->prepare('SELECT 
                                                        `id`
                                                        , `value`
                                                        , `create_ts`
                                                      FROM `instance`
                                                      WHERE `id` = ?;');

        $statement->bindValue(1, $id);
        $statement->execute();
        $array = $statement->fetch(PDO::FETCH_ASSOC);

        if ($array === false) {
            return new NullEnvironment();
        }
        return new Environment(
            $array['id'],
            $array['value'],
            $this->dateTimeService->fromString($array['create_ts'])
        );
    }

    public function remove(string $id): void {
        $sql       = 'DELETE FROM `instance` WHERE `id` = :id';
        $statement = $this->database->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
    }

    public function clear(): void {
        $statement = $this->database->prepare('DELETE FROM `instance`;');
        $statement->execute();
    }

    private function createTable(): void {
        $this->database->query(
            'CREATE TABLE IF NOT EXISTS `instance`
                        (
                             `id` STRING PRIMARY KEY NOT NULL
                            , `value` TEXT
                            , `create_ts` DATETIME
                        )');
    }

}