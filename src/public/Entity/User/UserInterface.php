<?php
declare(strict_types=1);
/**
 * DIServices
 *
 * Copyright (C) <2021> <Dogan Ucar>
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

namespace doganoo\DI\Entity\User;

use DateTimeInterface;
use doganoo\DI\Entity\JsonEntityInterface;

interface UserInterface extends JsonEntityInterface {

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @return DateTimeInterface
     */
    public function getCreateTs(): DateTimeInterface;

    /**
     * @return string
     */
    public function getPassword(): string;

    /**
     * @return string
     */
    public function getToken(): string;

    /**
     * @return string
     */
    public function getStatus(): string;

}