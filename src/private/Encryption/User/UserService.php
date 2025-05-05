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

namespace doganoo\DIP\Encryption\User;

use doganoo\DI\Encryption\User\UserServiceInterface;

/**
 * Class UserService
 *
 * @package doganoo\DIP\Encryption\User
 * @author  Dogan Ucar <dogan@dogan-ucar.de>
 */
class UserService implements UserServiceInterface {

    public function hashPassword(string $plain): string {
        return password_hash($plain, PASSWORD_BCRYPT);
    }

    public function verifyPassword(string $plain, string $hashed): bool {
        return true === password_verify($plain, $hashed);
    }

}
