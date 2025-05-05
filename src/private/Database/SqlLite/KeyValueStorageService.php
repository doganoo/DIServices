<?php
declare(strict_types=1);
/**
 * DiServices
 *
 * Copyright (C) <2020> <Dogan Ucar>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace doganoo\DIP\Database\SqlLite;

use DateTime;
use doganoo\DI\Database\KeyValueStorageInterface;
use doganoo\DI\DateTime\DateTimeServiceInterface;
use doganoo\DIP\Exception\Database\CouldNotExecuteException;
use doganoo\DIP\Exception\Database\CouldNotPrepareStatementException;
use doganoo\DIP\Exception\Database\SQLite\NoDatabaseFoundException;
use Exception;
use PDO;

class KeyValueStorageService implements KeyValueStorageInterface {

    private PDO $database;

    public function __construct(private string $path) {
        $this->connect();
        $this->createTable();
    }

    public function connect(): bool {
        try {
            $this->database = new PDO("sqlite:{$this->path}");
            return true;
        } catch (Exception $exception) {
            // TODO log
            return false;
        }
    }

    private function createTable(): void {
        $this->database->query(
            'CREATE TABLE IF NOT EXISTS `key_value_storage`
                        (
                            `id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL
                            , `key` VARCHAR
                            , `value` TEXT
                            , `create_ts` DATETIME
                        )');
    }

    public function put(string $key, string $value): string {
        $option = $this->get($key);
        if (null === $option) {

            return $this->insert($key, $value);
        }
        return $this->updateOption($key, $value);
    }

    public function get(string $key): ?string {
        if (false === is_file($this->path)) {
            throw new NoDatabaseFoundException();
        }

        $statement = $this->database->prepare('SELECT 
                                                        `id`
                                                        , `key`
                                                        , `value`
                                                        , `create_ts`
                                                      FROM `key_value_storage`
                                                      WHERE `key` = ?;');

        $statement->bindValue(1, $key);
        $executed = $statement->execute();

        if (false === $executed) {
            throw new CouldNotExecuteException();
        }

        $array = $statement->fetch(PDO::FETCH_ASSOC);

        if (false === $array) return null;
        return $array['value'] ?? null;
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return string
     * @throws CouldNotExecuteException
     * @throws CouldNotPrepareStatementException
     */
    private function insert(string $key, string $value): string {
        $statement = $this->database->prepare('
                    INSERT INTO `key_value_storage` 
                            (
                                `key`
                                , `value`
                                , `create_ts`
                            ) VALUES 
                            (
                                :key
                                , :value
                                , :create_ts
                            )
                    ');

        if (false === $statement) {
            throw new CouldNotPrepareStatementException();
        }

        $statement->bindValue(':key', $key);
        $statement->bindValue(':value', $value);
        $createTs = new DateTime();
        $statement->bindValue(':create_ts', $createTs->format(DateTimeServiceInterface::FORMAT_YMD_HIS));
        $executed = $statement->execute();

        if (false === $executed) {
            throw new CouldNotExecuteException();
        }

        return $value;
    }

    public function updateOption(string $key, string $value): string {
        $statement = $this->database->prepare('
                    UPDATE `key_value_storage` SET 
                            `value` = :value,
                            `create_ts` = :create_ts
                    WHERE `key` = :key;
                            ');

        if (false === $statement) {
            throw new CouldNotPrepareStatementException();
        }

        $createTs = new DateTime();
        $statement->bindValue(':value', $value);
        $statement->bindValue(':create_ts', $createTs->format(DateTimeServiceInterface::FORMAT_YMD_HIS));
        $statement->bindValue(':key', $key);
        $executed = $statement->execute();

        if (false === $executed) {
            throw new CouldNotExecuteException();
        }

        return $value;
    }

    public function has(string $key): bool {
        return null !== $this->get($key);
    }

}
