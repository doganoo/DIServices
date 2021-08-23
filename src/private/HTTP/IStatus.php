<?php
declare(strict_types=1);
/**
 * DiServices
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

namespace doganoo\DIP\HTTP;

final class IStatus {

    public const OK          = 200;
    public const BAD_REQUEST = 400;
    public const NOT_FOUND   = 404;

    public const OK_TEXT          = "OK";
    public const BAD_REQUEST_TEXT = "BAD REQUEST";
    public const NOT_FOUND_TEXT   = "NOT FOUND";

}