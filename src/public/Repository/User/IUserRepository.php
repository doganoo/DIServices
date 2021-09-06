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

use doganoo\DI\Entity\User\IUser;

/**
 * Interface IUserRepository
 * @package doganoo\DI\Repository\User
 * @author  Dogan Ucar <dogan@dogan-ucar.de>
 *
 * Actually no implementation, we let the products implement!
 */
interface IUserRepository {

    public function getUserById(int $id): IUser;

    public function getUserByName(string $name): IUser;

    public function getUserByMail(string $mail): IUser;

    public function updateUser(IUser $user): IUser;

    public function insertUser(IUser $user): IUser;

}