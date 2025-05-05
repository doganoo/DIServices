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

namespace doganoo\DI\Repository\User;

use doganoo\PHPAlgorithms\Datastructure\Lists\ArrayList\ArrayList;
use UcarSolutions\Entities\User\UserInterface;

/**
 * Interface IUserRepository
 * @package doganoo\DI\Repository\User
 * @author  Dogan Ucar <dogan@dogan-ucar.de>
 *
 * Actually no implementation, we let the products implement!
 */
interface UserRepositoryInterface {

    public function getUserById(string $id): UserInterface;

    public function getUserByName(string $name): UserInterface;

    public function getUserByMail(string $mail): UserInterface;

    public function getUserByToken(string $token): UserInterface;

    public function updateUser(UserInterface $user): UserInterface;

    public function insertUser(UserInterface $user): UserInterface;

    public function getAll(): ArrayList;

}